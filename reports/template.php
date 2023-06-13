<?php

//Librerías obtenidas COMPOSER
require '../vendor/autoload.php';

//Namesspaces (espacios de nombres/contenedor de clases)
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

//¿Cómo estructurar el reporte?
//PDF = múltiples páginas / cada sección se construya de forma independiente
//Construcción reporte PDF
try {
    //Contenido (HTML) que renderizaremos como PDF
    $content = "";

    //Iniciamos la creación del binario
    ob_start();

    //Invocar todas las secciones (archivo.php)
    //include 'seccion1.php';

    //Cierre creación binario
    $content .= ob_get_clean();

    //Configuración del archivo PDF
    $html2pdf = new Html2Pdf('P', 'A4', 'es',true, 'UTF-8', array(15, 15, 15, 15));
    $html2pdf->writeHTML($content);
    $html2pdf->output('reporte.pdf');
} catch (Html2PdfException $error) {
    $formatter = new ExceptionFormatter($error);
    echo $formatter->getHtmlMessage();
}