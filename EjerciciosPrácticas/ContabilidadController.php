<?php
namespace Dondis\controllers;

use Dondis\models\ContabilidadModel;
use Dondis\views\ContabilidadView;
use Dondisfraz\Base\controller\BaseController;
use Dondisfraz\Base\services\UtilsService;

class ContabilidadController extends BaseController
{

    public function informePlasticoAction()
    {
        $view = new ContabilidadView();
        echo $view->indexHtml();
    }

    public function ajaxAction()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

            $_vars = $_POST; // Captura las variables del POST
            $appUrl_base = $this->ini['app_url_base'];
            $contabilidadModel = new ContabilidadModel();

            // Inicializamos las variables
            $exito = false;
            $html = '';

            switch($_vars['action']) {

                case 'generarExcel':

                    $data = [];

                    // Verificamos que se hayan enviado todas las fechas necesarias
                    if (isset($_vars['fechaInicioCompra'], $_vars['fechaFinCompra'], $_vars['fechaInicioVenta'], $_vars['fechaFinVenta'])) {

                        // Asignamos las fechas a variables
                        $fechaInicioCompra = $_vars['fechaInicioCompra'];
                        $fechaFinCompra = $_vars['fechaFinCompra'];
                        $fechaInicioVenta = $_vars['fechaInicioVenta'];
                        $fechaFinVenta = $_vars['fechaFinVenta'];

                        // Formatear fechas
                        $fechaInicioCompra = $contabilidadModel->formatearFecha($fechaInicioCompra);
                        $fechaFinCompra = $contabilidadModel->formatearFechaFin($fechaFinCompra);
                        $fechaInicioVenta = $contabilidadModel->formatearFecha($fechaInicioVenta);
                        $fechaFinVenta = $contabilidadModel->formatearFechaFin($fechaFinVenta);

                        // Intentamos obtener los albaranes
                        $contabilidad = $contabilidadModel->obtenerAlbaranes($fechaInicioCompra, $fechaFinCompra, $fechaInicioVenta, $fechaFinVenta);


                        if ($contabilidad !== null) {
                            $exito = true;

                            // Inicializar arrays para agrupar por proveedor
                            $comprasPorProveedor = [];
                            $ventasPorProveedor = [];

                            $totales = [
                                'PesoTotalCompras' => 0,
                                'PesoTotalVentas' => 0
                            ];

                            $datosTabla = [];


                            // Definimos los encabezados personalizados
                            $encabezados = ['CodigoArticulo', 'DescripcionArticulos', 'UnidadesCompradas', 'UnidadesVendidasAlbaran', 'UnidadesVendidasTicket','CodigoProveedor','Peso','PesoCompras','PesoVentas'];

                            // Insertamos los encabezados en la primera posición del array
                            array_unshift($contabilidad, $encabezados);

                            // Calculamos el peso total para cada artículo
                            foreach ($contabilidad as $key => &$fila) {
                                if ($key === 0) continue; // Saltamos los encabezados

                                $codigoProveedor = $fila['CodigoProveedor'];


                                // Obtenemos la descripción del artículo y las unidades vendidas
                                $descripcionArticulo = $fila['DescripcionArticulos'];
                                $unidadesCompradas = $fila['UnidadesCompradas'];
                                $unidadesVendidasTicket = $fila['UnidadesVendidasTicket'];
                                $unidadesVendidasAlbaran = $fila['UnidadesVendidasAlbaran'];

                                // Definimos el peso basado en si es un disfraz o un accesorio
                                $pesoUnidad = (stripos($descripcionArticulo, 'Dis') === 0) ? 50 : 5;

                                $pesoCompras = $pesoUnidad * $unidadesCompradas;
                                $pesoVentas = ($pesoUnidad * $unidadesVendidasTicket) + ($pesoUnidad * $unidadesVendidasAlbaran);

                                $comprasPorProveedor[$codigoProveedor] += $pesoCompras;
                                $ventasPorProveedor[$codigoProveedor] += $pesoVentas;

                                // Añadimos el peso total a la fila
                                $fila['Peso'] = $pesoUnidad;
                                $fila['PesoCompras'] = $pesoCompras;
                                $fila['PesoVentas'] = $pesoVentas;

                                $datosGrafico = [];

                                foreach ($contabilidad as &$fila) {
                                    if (isset($fila['CodigoProveedor'])) {
                                        $codigoProveedor = $fila['CodigoProveedor'];

                                        // Verificamos que el proveedor tenga datos en ambos arreglos
                                        $fila['PesoTotalComprasProveedor'] = isset($comprasPorProveedor[$codigoProveedor]) ? $comprasPorProveedor[$codigoProveedor] : 0;
                                        $fila['PesoTotalVentasProveedor'] = isset($ventasPorProveedor[$codigoProveedor]) ? $ventasPorProveedor[$codigoProveedor] : 0;
                                    }
                                }

                                foreach ($comprasPorProveedor as $codigoProveedor => $pesoTotalCompras) {
                                    $pesoTotalVentas = isset($ventasPorProveedor[$codigoProveedor]) ? $ventasPorProveedor[$codigoProveedor] : 0;
                                    $datosGrafico[] = [
                                        "CodigoProveedor" => $codigoProveedor,
                                        "PesoTotalComprasProveedor" => $pesoTotalCompras,
                                        "PesoTotalVentasProveedor" => $pesoTotalVentas,
                                    ];

                                    $datosTabla[] = [
                                        "CodigoProveedor" => $codigoProveedor,
                                        "PesoTotalCompras" => $pesoTotalCompras,
                                        "PesoTotalVentas" => $pesoTotalVentas,
                                    ];

                                    $totales['PesoTotalCompras'] += $pesoTotalCompras;
                                    $totales['PesoTotalVentas'] += $pesoTotalVentas;
                                }

                                $datosTabla[] = [
                                    "CodigoProveedor" => "Total",
                                    "PesoTotalCompras" => $totales['PesoTotalCompras'],
                                    "PesoTotalVentas" => $totales['PesoTotalVentas'],
                                ];

                                $data['datosGrafico'] = $datosGrafico;
                                $data['datosTabla'] = $datosTabla;
                            }

                            // Generamos el Excel usando array2XLS
                            $_utils = new UtilsService();
                            $nombreArchivo = 'Albaranes_' . date('Ymd') . '.xlsx';  // Nombre para el archivo Excel
                            $rutaArchivo = $_utils->array2XLS($contabilidad, 'Albaranes', $nombreArchivo);

                            $html = (new ContabilidadView())->render("tablaAlbaranes.phtml", ['contabilidad' => $contabilidad]);

                        } else {
                            // Si no hay resultados, manejamos el error
                            $contenidoExcel = "No se encontraron albaranes para las fechas especificadas.";
                        }
                    } else {
                        // Si las fechas no están definidas correctamente, manejamos el error
                        $contenidoExcel = "No se han proporcionado todas las fechas necesarias.";
                    }



                    $mensaje =  sprintf("/var/xls/%s/%s", gethostname(), $nombreArchivo);


                    echo json_encode([
                        "exito" => $exito,
                        "mensaje" => $mensaje,
                        "html" => $html,
                        "data" => $data

                    ]);

            }
        }
    }


}
