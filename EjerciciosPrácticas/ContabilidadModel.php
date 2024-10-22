<?php

namespace Dondis\models;

use Dondis\entities\ddmssql\AlbarancompralineasQuery;
use Dondis\entities\ddmssql\Map\AlbarancompralineasTableMap;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Propel\Runtime\ActiveQuery\Criteria;
use Exception;

class ContabilidadModel
{
    public function obtenerAlbaranes($fechaInicioCompra, $fechaFinCompra, $fechaInicioVenta, $fechaFinVenta)
    {
        try {
            // Consulta principal para AlbaranCompraLineas
            $albaranesCompra = AlbarancompralineasQuery::create()
                ->addJoin(array(
                    AlbarancompralineasTableMap::COL_CODIGOEMPRESA,
                    AlbarancompralineasTableMap::COL_EJERCICIOALBARAN,
                    AlbarancompralineasTableMap::COL_SERIEALBARAN,
                    AlbarancompralineasTableMap::COL_NUMEROALBARAN,
                ),
                    array(
                        'Albarancompracabecera.CodigoEmpresa',
                        'Albarancompracabecera.EjercicioAlbaran',
                        'Albarancompracabecera.SerieAlbaran',
                        'Albarancompracabecera.NumeroAlbaran'
                    ),
                    Criteria::INNER_JOIN)
                ->filterByCodigoEmpresa(2)  // Filtro por empresa
                ->where("'$fechaInicioCompra' <= AlbaranCompraLineas.FechaRegistro AND AlbaranCompraLineas.FechaRegistro <= '$fechaFinCompra'")
                ->filterByCodigodelproveedor(array('00001', '00039', '400000266', '00113', '00166', '00253', '00271'))
                ->clearSelectColumns()
                ->select('CodigoArticulo')
                ->addAsColumn('DescripcionArticulos',"(SELECT DescripcionArticulo FROM Articulos WHERE  Articulos.CodigoArticulo = AlbaranCompraLineas.CodigoArticulo and Articulos.CodigoEmpresa = AlbaranCompraLineas.CodigoEmpresa)")
                ->addAsColumn('UnidadesCompradas', '(SUM (Albarancompralineas.Unidades))')  // Sumar unidades compradas

                ->addAsColumn('UnidadesVendidasAlbaran',"(SELECT SUM(Unidades) FROM AlbaranVentaLineas WHERE AlbaranVentaLineas.CodigoArticulo = AlbaranCompraLineas.CodigoArticulo and AlbaranVentaLineas.SerieAlbaran  IN ('A', 'WEB') and AlbaranVentaLineas.SerieAlbaran NOT LIKE '%R%' and AlbaranVentaLineas.FechaRegistro >= '$fechaInicioVenta' and AlbaranVentaLineas.FechaRegistro <= '$fechaFinVenta' and AlbaranVentaLineas.CodigoEmpresa = AlbaranCompraLineas.CodigoEmpresa group by CodigoArticulo)")

                ->addAsColumn('UnidadesVendidasTicket',"(SELECT SUM(Unidades) FROM LineasTicket WHERE LineasTicket.CodigoArticulo = AlbaranCompraLineas.CodigoArticulo and  LineasTicket.FechaRegistro >= '$fechaInicioVenta' and LineasTicket.FechaRegistro <= '$fechaFinVenta' and LineasTicket.CodigoEmpresa = AlbaranCompraLineas.CodigoEmpresa group by CodigoArticulo )")

                ->addAsColumn('CodigoProveedor'," (SELECT a.CodigoProveedor FROM Articulos as a WHERE a.CodigoEmpresa=AlbaranCompraLineas.CodigoEmpresa and AlbaranCompraLineas.CodigoArticulo=a.CodigoArticulo)")

                ->groupBy(AlbarancompralineasTableMap::COL_CODIGOARTICULO)
                ->groupBy(AlbarancompralineasTableMap::COL_CODIGOEMPRESA);//

            $resultado = $albaranesCompra->toString(); // Convertimos los resultados a array
            $resultadoFinal = $albaranesCompra->find()->toArray();

            return $resultadoFinal; // Devolvemos el array asociativo

        } catch (Exception $e) {
            error_log("Error al obtener los albaranes: " . $e->getMessage());
            return null;
        }
    }

    public function generarExcel($fechaInicioCompra, $fechaFinCompra, $fechaInicioVenta, $fechaFinVenta)
    {
        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $hojaExcel = $spreadsheet->getActiveSheet();

        // Asignar encabezados a las celdas
        $hojaExcel->setCellValue('A1', 'Código Artículo');
        $hojaExcel->setCellValue('B1', 'Descripción Artículo');
        $hojaExcel->setCellValue('C1', 'Unidades Compradas');
        $hojaExcel->setCellValue('D1', 'Unidades Vendidas Albarán');
        $hojaExcel->setCellValue('E1', 'Unidades Vendidas Ticket');
        $hojaExcel->setCellValue('F1', 'Código Proveedor');

        $datos = $this->obtenerAlbaranes($fechaInicioCompra, $fechaFinCompra, $fechaInicioVenta, $fechaFinVenta);

        $fila = 2;
        foreach ($datos as $dato) {

            $hojaExcel->setCellValue('A' . $fila, $dato['CodigoArticulo']);
            $hojaExcel->setCellValue('B' . $fila, $dato['DescripcionArticulos']);
            $hojaExcel->setCellValue('C' . $fila, $dato['UnidadesCompradas']);
            $hojaExcel->setCellValue('D' . $fila, $dato['UnidadesVendidasAlbaran']);
            $hojaExcel->setCellValue('E' . $fila, $dato['UnidadesVendidasTicket']);
            $hojaExcel->setCellValue('F' . $fila, $dato['CodigoProveedor']);

            $fila++; // Avanzar a la siguiente fila
        }

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");

        // Guardar el contenido en memoria
        ob_start();
        $writer->save('php://output');
        $excelOutput = ob_get_contents();
        ob_end_clean();

        return base64_encode($excelOutput);
    }


}


