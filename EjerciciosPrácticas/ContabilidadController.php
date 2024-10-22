<?php
namespace Dondis\controllers;

use Dondis\models\ContabilidadModel;
use Dondis\views\ContabilidadView;
use Dondisfraz\Base\controller\BaseController;
use Dondisfraz\Base\services\UtilsService;

class ContabilidadController extends BaseController
{
    public function indexAction()
    {
        $this->listAction();
    }

    public function listAction()
    {
        $view = new ContabilidadView();
        echo $view->indexHtml();
    }

    public function ajaxAction()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

            $_vars = $_POST; // Captura las variables del POST

            $contabilidadModel = new ContabilidadModel();

            // Inicializamos las variables
            $exito = false;
            $html = '';

            // Verificamos que se hayan enviado todas las fechas necesarias
            if (isset($_vars['fechaInicioCompra'], $_vars['fechaFinCompra'], $_vars['fechaInicioVenta'], $_vars['fechaFinVenta'])) {

                // Asignamos las fechas a variables
                $fechaInicioCompra = $_vars['fechaInicioCompra'];
                $fechaFinCompra = $_vars['fechaFinCompra'];
                $fechaInicioVenta = $_vars['fechaInicioVenta'];
                $fechaFinVenta = $_vars['fechaFinVenta'];

                // Formatear fechas
                $fechaInicioCompra = $this->formatearFecha($fechaInicioCompra);
                $fechaFinCompra = $this->formatearFecha($fechaFinCompra);
                $fechaInicioVenta = $this->formatearFecha($fechaInicioVenta);
                $fechaFinVenta = $this->formatearFecha($fechaFinVenta);

                // Intentamos obtener los albaranes
                $contabilidad = $contabilidadModel->obtenerAlbaranes($fechaInicioCompra, $fechaFinCompra, $fechaInicioVenta, $fechaFinVenta);


                if ($contabilidad !== null) {
                    $exito = true;

                    $html = (new ContabilidadView())->render("tablaAlbaranes.phtml", ['contabilidad' => $contabilidad]);

                    // Definimos los encabezados personalizados
                    $encabezados = ['CodigoArticulo', 'DescripcionArticulos', 'UnidadesCompradas', 'UnidadesVendidasAlbaran', 'UnidadesVendidasTicket','CodigoProveedor'];

                    // Insertamos los encabezados en la primera posición del array
                    array_unshift($contabilidad, $encabezados);

                    // Generamos el Excel usando array2XLS
                    $_utils = new UtilsService();
                    $nombreArchivo = 'Albaranes_' . date('Ymd') . '.xlsx';  // Nombre para el archivo Excel
                    $rutaArchivo = $_utils->array2XLS($contabilidad, 'Albaranes', $nombreArchivo);


                } else {
                    // Si no hay resultados, manejamos el error
                    $contenidoExcel = "No se encontraron albaranes para las fechas especificadas.";
                }
            } else {
                // Si las fechas no están definidas correctamente, manejamos el error
                $contenidoExcel = "No se han proporcionado todas las fechas necesarias.";
            }

            if ($rutaArchivo) {
                $mensaje = str_replace('/var/www/html', 'http://localhost', $rutaArchivo);
            } else {
                $contenidoExcel = "Error al generar el archivo Excel.";
            }

            echo json_encode([
                "exito" => $exito,
                "mensaje" => $mensaje,
                "html" => $html
            ]);
        }
    }

    private function formatearFecha($fecha)
    {
        try {
            $dateTime = new \DateTime($fecha);
            return $dateTime->format('Ymd H:i:s');
        } catch (\Exception $e) {
            error_log("Error al formatear la fecha: " . $e->getMessage());
            return null;
        }
    }
}
