<?php

require_once '../vendor/autoload.php';

// referenciando o namespace do dompdf

use Dompdf\Dompdf;

// instanciando o dompdf

$dompdf = new Dompdf();
$dompdf->set_base_path('../css/');

//lendo o arquivo HTML correspondente

ob_start();

require 'template_movimento.php';

$data = ob_get_contents();



ob_end_clean();

// $dompdf->set_base_path("/www/public/css/");

//inserindo o HTML que queremos converter

$dompdf->loadHtml($data);
$dompdf->set_option('isHtml5ParserEnabled', true);

// Definindo o papel e a orientação

$dompdf->setPaper('A5', 'portrait');

// Renderizando o HTML como PDF

$dompdf->render();

// Enviando o PDF para o browser

$dompdf->stream("", array("Attachment" => 1));