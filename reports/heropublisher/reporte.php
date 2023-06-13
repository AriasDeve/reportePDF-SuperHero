<?php

//Utilizaremos datos de backend(modelo)
//Librerías obtenidas COMPOSER
require '../../vendor/autoload.php';

//Paso 1: Incorporamos modelo
require '../../models/SuperHero.php';

//Namesspaces (espacios de nombres/contenedor de clases)
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

//Construcción reporte PDF
try {

    //Paso 2: Instancia clase
    $superhero = new SuperHero();

    //Paso 3:Obtener datos (Método: listByPublisher)
    $datos = $superhero->listByPublisher(["publisher_id" => $_GET['publisher_id']]);
    $titulo = $_GET['titulo'];

    //Contenido (HTML) que renderizaremos como PDF
    $content = "";

    //Render PRUEBA
    //$content .= "<p>" . $datos[28]["superhero_name"] . "</p>";
    ob_start();

    include '../estilos.html';
    include './datos.php';

    $content .= ob_get_clean();

    //Configuración del archivo PDF
    $html2pdf = new Html2Pdf('P', 'A4', 'es',true, 'UTF-8', array(15, 15, 15, 15));
    $html2pdf->writeHTML($content);
    $html2pdf->output('reporte.pdf');
} catch (Html2PdfException $error) {
    $formatter = new ExceptionFormatter($error);
    echo $formatter->getHtmlMessage();
}