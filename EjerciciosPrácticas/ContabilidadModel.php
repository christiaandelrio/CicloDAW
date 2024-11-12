<?php

namespace Dondis\models;

use Dondis\dao\ExitAlbaranVentaDao;
use Dondis\dao\ExitEfectosRemesaDao;
use Dondis\dao\ExitVencimientosDao;
use Dondis\entities\ddmssql\AlbarancompralineasQuery;
use Dondis\entities\ddmssql\Map\AlbarancompralineasTableMap;
use Dondisfraz\Base\resources\BaseDD;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Propel\Runtime\ActiveQuery\Criteria;
use Exception;

class ContabilidadModel extends BaseDD
{

    public function __construct(){

        $this->SESSION_NAME = "dd.contabilidad";
        parent::__construct();
        $this->log->setEcho(true);
        $this->log->setFileLogName("contabilidadModel%s.txt");

    }

    public function procesaReembolsos($_codRemesa){

        $_xlsDir = $this->ini['xls_dir'];

        $_excel = $_xlsDir . "/remesa" . $_codRemesa . ".xlsx";

        $daoAlbaran = new ExitAlbaranVentaDao();
        $mLogistica = new LogisticaModel();

        ob_implicit_flush(true);
        $this->log->debug(sprintf("[START] REMESA %d", $_codRemesa));

        if (file_exists($_excel)) {
            try {
                $xlsObj = IOFactory::load($_excel);

                //Leemos el XLS
                $xlsData = $xlsObj->getActiveSheet()->toArray(null, true, true, true);

                $daoVencimiento = new ExitVencimientosDao();

                //Obtenemos la información de la remesa
                $daoRemesa = new ExitEfectosRemesaDao();
                $_filtroRemesa = array(
                    "CodigoEmpresa" => sprintf(" = '%d'", $this->ini['cod_empresa']),
                    "Remesa"        => sprintf(" = '%d'", $_codRemesa),
                    "TipoRemesa"    => sprintf(" = '%s'", 'C'),
                    "StatusContabilidad" => sprintf(" = '%d'", 0)
                );
                $infoRemesa = $daoRemesa->setFilters($_filtroRemesa)->get();

                if ($infoRemesa){

                    //Recorremos las filas
                    $_albaranes = array();
                    $_importeRemesa = 0;
                    $_cont = 1;

                    /*foreach ($xlsData as $c => $_fila) {
                        if (stripos($_fila['A'], '03304G') !== false){
                            $this->log->debug(sprintf("%d) Etiqueta manual: %s, nombre %s", $_cont, $_fila['A'], $_fila['H']));
                            $_cont++;
                        }else {

                            if ($_fila['E'] == "Referencia del cliente") {
                                $_refCliente = $_fila['H'];
                                $_importe = floatval((str_replace(array(" Mín.", ","), array("", "."), $xlsData[$c - 1]['K'])));
                                $this->log->debug(sprintf("%d) Vencimiento! Referencia %s, Importe %s", $_cont, $_refCliente, $_importe));
                                $_cont++;
                            }

                        }
                    }

                    die();*/

                    foreach ($xlsData as $c => $_fila) {

                        //Si es una etiqueta manual
                        if (stripos($_fila['A'], '03304G') !== false){
                            $_refCliente = $_fila['H'];
                            $_importe = floatval((str_replace(array(" Mín.", ","), array("", "."), $_fila['K'])));
                            $this->log->debug(sprintf(" (%d) Etiqueta manual: %s, nombre %s. Importe: %.2f", $_cont, $_refCliente, $_fila['H'], $_importe));
                            $_cont++;
                        }else {

                            if ($_fila['E'] == "Referencia del cliente") {

                                $_refCliente = $_fila['H'];
                                if (is_null($_refCliente))
                                    $_refCliente = $_fila['G'];

                                if (!is_null($_refCliente)){
                                    $_refCliente = $this->parseRefCliente($_refCliente);
                                }

                                if (trim($xlsData[$c - 1]['K']) != '') {
                                    //$_importe = floatval((str_replace(array(" Mín.", ","), array("", "."), $xlsData[$c - 1]['K'])));
                                    $_celdaImporte = $xlsData[$c - 1]['K'];
                                }else{
                                    $_celdaImporte =  $xlsData[$c - 1]['H'];
                                    //$_importe = floatval(preg_replace('/[^0-9,\.]/', '', $xlsData[$c - 1]['K']));//floatval((str_replace(array(" Mín.", ","), array("", "."), $xlsData[$c - 1]['K'])));
                                }
                                $_importe = floatval(str_replace(",", ".", (preg_replace('/[^0-9,]/', '', $_celdaImporte))));
                                //$_movGUI = UtilsService::mssqlGuid();

                                //die($_movGUI);

                                //Obtenemos la información del albaran
                                if (stripos($_refCliente, "/") !== false) {
                                    $_numAlbaran = $mLogistica->getArrayFromDocCode($_refCliente);
                                    $daoAlbaran->setFilters(array(
                                        "EjercicioAlbaran" => sprintf(" = '%d'", $_numAlbaran['Ejercicio']),
                                        "SerieAlbaran" => sprintf(" = '%s'", $_numAlbaran['Serie']),
                                        "NumeroAlbaran" => sprintf(" = '%d'", $_numAlbaran['Numero'])
                                    ));
                                } else {
                                    $_incrementId = $_refCliente;
                                    $daoAlbaran->setFilters(array(
                                        "DON_order_increment_id" => sprintf(" = '%s'", $_incrementId)
                                    ));
                                }
                                $_infoAlbaran = $daoAlbaran->get();

                                if ($_infoAlbaran) {

                                    $_filVencimiento = array(
                                        "SerieFactura" => sprintf(" = '%s'", $_infoAlbaran->Fields('SerieFactura')),
                                        "NumeroFactura" => sprintf(" = '%d'", $_infoAlbaran->Fields('NumeroFactura')),
                                        "Activo" => sprintf(" = '%d'", -1)
                                    );

                                    //Obtenemos la información del Vencimiento
                                    $_infoVencimiento = $daoVencimiento->setFilters($_filVencimiento)->get();

                                    if ($_infoVencimiento) {

                                        //Si es el mismo importe
                                        if ((float) $_importe == (float) $_infoVencimiento->Fields('ImporteVencimiento')){

                                            //Lo añadimos a la remesa indicada
                                            $_res = $daoVencimiento->update(array(
                                                "TipoRemesaEfecto" => $infoRemesa->Fields('TipoRemesa'),
                                                "FechaRemesa" => $infoRemesa->Fields('Fecha'),
                                                "BancoRemesa" => $infoRemesa->Fields('Banco'),
                                                "CodigoContableRemesa" => $infoRemesa->Fields('CodigoContable'),
                                                "NumeroRemesa" => $infoRemesa->Fields('Remesa'),
                                                "MovEfectoRemesa" => $infoRemesa->Fields('LineasPosicion'),
                                                "StatusRemesado" => -1
                                            ), $_filVencimiento);
                                            //$_res = true;
                                            if ($_res) {
                                                /*$this->log->debug(sprintf(" (%d) Vencimiento remesado!! La ref cliente %s (con importe %.2f corresponde a la factura %s/%d del albaran %d/%s/%d. Importe %.2f",
                                                    $_cont,
                                                    $_refCliente,
                                                    $_importe,
                                                    $_infoAlbaran->Fields('SerieFactura'),
                                                    $_infoAlbaran->Fields('NumeroFactura'),
                                                    $_infoAlbaran->Fields('EjercicioAlbaran'),
                                                    $_infoAlbaran->Fields('SerieAlbaran'),
                                                    $_infoAlbaran->Fields('NumeroAlbaran'),
                                                    $_importe
                                                ), true, false);*/

                                                $_importeRemesa += $_importe;

                                                //Actualizamos importe remesa
                                                $daoRemesa->update(array(
                                                    "ImporteRemesa" => $_importeRemesa
                                                ), $_filtroRemesa);

                                                $_cont++;
                                                /*if ($_cont == 2)
                                                    die("OK");*/

                                            }else{
                                                $this->log->debug(sprintf("Ocurrio un error al actualizar el vencimiento de la factura %s/%d . Importe %.2f",
                                                        $_infoAlbaran->Fields('SerieFactura'),
                                                        $_infoAlbaran->Fields('NumeroFactura'),
                                                        $_importe
                                                    )
                                                );
                                            }
                                        }else{
                                            $this->log->debug(sprintf("IMPORTE INCORRECTO!! El vencimiento de la factura %s/%d (%s) no tiene el mismo importe (%.2f) que la factura de mrw (%.2f)",
                                                    $_infoAlbaran->Fields('SerieFactura'),
                                                    $_infoAlbaran->Fields('NumeroFactura'),
                                                    $_refCliente,
                                                    $_infoVencimiento->Fields('ImporteVencimiento'),
                                                    $_importe
                                                )
                                            );
                                        }



                                    }else{
                                        $this->log->debug(sprintf("El vencimiento de la factura %s/%d (%s) no se pudo cargar de la BDD. Importe %.2f",
                                                $_infoAlbaran->Fields('SerieFactura'),
                                                $_infoAlbaran->Fields('NumeroFactura'),
                                                $_refCliente,
                                                $_importe
                                            )
                                        );
                                    }

                                } else {
                                    $this->log->debug(sprintf("El albaran con ref cliente: %s NO EXISTE EN EXIT", $_refCliente));
                                }

                            }
                        }
                        if (ob_get_level() > 0)
                            ob_flush();
                    }

                }else{
                    $this->log->debug(sprintf("La remesa %d no existe o ya está contabilizada!!", $_codRemesa));
                }


            } catch (Exception $e) {
                $this->log->debug('Error loading file "' . pathinfo($_excel, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }
        }else{
            $this->log->debug('Error loading file "' . pathinfo($_excel, PATHINFO_BASENAME) . '"');
        }
        $this->log->debug(sprintf("[END] REMESA %d", $_codRemesa));

    }


    private function parseRefCliente($_refCliente){
        //DD2018A062068
        $_albaran = array();
        if (stripos($_refCliente, "DD") == 0){
            $_albaran['Ejercicio']  = intval(substr($_refCliente, 2, 4));
            $_albaran['Serie']      = substr($_refCliente, 6, 1);
            $_albaran['Numero']      = intval(substr($_refCliente, 7, 6));
        }
        return sprintf("%s/%s/%s",
            $_albaran['Ejercicio'],
            $_albaran['Serie'],
            $_albaran['Numero']
        );
    }
    public function obtenerAlbaranes($fechaInicioCompra, $fechaFinCompra, $fechaInicioVenta, $fechaFinVenta)
    {
        try {

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
                    Criteria::LEFT_JOIN)
                ->filterByCodigoEmpresa(2)  // Filtro por empresa
                ->where("'$fechaInicioCompra' <= Albarancompracabecera.FechaFactura AND Albarancompracabecera.FechaFactura <= '$fechaFinCompra'")
                ->filterByCodigodelproveedor(array('00001', '00039', '00269', '400000266', '00113', '00166', '00253', '00274', '00275', '00271'))
                ->clearSelectColumns()
                ->select('CodigoArticulo')

                ->addAsColumn('DescripcionArticulos',"(SELECT DescripcionArticulo FROM Articulos WHERE Articulos.CodigoArticulo = AlbaranCompraLineas.CodigoArticulo AND Articulos.CodigoEmpresa = AlbaranCompraLineas.CodigoEmpresa)")

                ->addAsColumn('UnidadesCompradas', 'SUM(AlbaranCompraLineas.Unidades)')

                ->addAsColumn('UnidadesVendidasAlbaran',"(SELECT SUM(Unidades) FROM AlbaranVentaLineas WHERE AlbaranVentaLineas.CodigoArticulo = AlbaranCompraLineas.CodigoArticulo AND AlbaranVentaLineas.SerieAlbaran IN ('A', 'WEB') AND AlbaranVentaLineas.SerieAlbaran NOT LIKE '%R%' AND AlbaranVentaLineas.FechaRegistro >= '$fechaInicioVenta' AND AlbaranVentaLineas.FechaRegistro <= '$fechaFinVenta' AND AlbaranVentaLineas.CodigoEmpresa = AlbaranCompraLineas.CodigoEmpresa GROUP BY CodigoArticulo)")

                ->addAsColumn('UnidadesVendidasTicket',"(SELECT SUM(Unidades) FROM LineasTicket WHERE LineasTicket.CodigoArticulo = AlbaranCompraLineas.CodigoArticulo AND LineasTicket.FechaRegistro >= '$fechaInicioVenta' AND LineasTicket.FechaRegistro <= '$fechaFinVenta' AND LineasTicket.CodigoEmpresa = AlbaranCompraLineas.CodigoEmpresa GROUP BY CodigoArticulo)")

                ->addAsColumn('CodigoProveedor',"(SELECT a.CodigoProveedor FROM Articulos AS a WHERE a.CodigoEmpresa = AlbaranCompraLineas.CodigoEmpresa AND AlbaranCompraLineas.CodigoArticulo = a.CodigoArticulo)")

                ->groupByCodigoarticulo()
                ->groupByCodigoempresa(); // Agrupamos por artículo y empresa

            $resultado = $albaranesCompra->toString();
            $resultadoFinal = $albaranesCompra->find()->toArray();

            $resultadoFormateado = [];
            foreach ($resultadoFinal as $resultado) {
                $resultadoFormateado[] = [
                    'CodigoArticulo'       => !is_null($resultado['CodigoArticulo']) ? $resultado['CodigoArticulo'] : '',
                    'DescripcionArticulos'       => !is_null($resultado['DescripcionArticulos']) ? $resultado['DescripcionArticulos'] : '',
                    'UnidadesCompradas'       => !is_null($resultado['UnidadesCompradas']) ? intval($resultado['UnidadesCompradas']) : 0,
                    'UnidadesVendidasAlbaran'       => !is_null($resultado['UnidadesVendidasAlbaran']) ? intval($resultado['UnidadesVendidasAlbaran']) : 0,
                    'UnidadesVendidasTicket'       => !is_null($resultado['UnidadesVendidasTicket']) ? intval($resultado['UnidadesVendidasTicket']) : 0,
                    'CodigoProveedor'       => !is_null($resultado['CodigoProveedor']) ? ($resultado['CodigoProveedor']) : '',
                ];
            }

            return $resultadoFormateado;

        } catch (Exception $e) {
            $this->log->error("Error al obtener los albaranes: " . $e->getMessage());
            return null;
        }
    }

    public function formatearFecha($fecha)
    {
        try {
            $dateTime = new \DateTime($fecha);

            return $dateTime->format('Ymd H:i:s');
        } catch (\Exception $e) {
            error_log("Error al formatear la fecha: " . $e->getMessage());
            return null;
        }
    }
    public function formatearFechaFin($fecha)
    {
        try {
            $dateTime = new \DateTime($fecha);

            $dateTime->setTime(23, 0);

            return $dateTime->format('Ymd H:i:s');
        } catch (\Exception $e) {
            error_log("Error al formatear la fecha: " . $e->getMessage());
            return null;
        }
    }

}
