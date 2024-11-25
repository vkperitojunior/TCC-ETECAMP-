<?php

    // include autoloader
    // require_once 'dompdf/autoload.inc.php';
    require 'extensions/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;    

    $choice = isset($id) ? $id : null;

    echo $choice;



    if($choice == 1){
        // página de gincanas

    // Inicie o buffer de saída
    ob_start();
    include 'frontend/principal/gincanas.php'; // Inclua a página que você deseja converter
    $htmlContent = ob_get_clean(); // Capture a saída e limpe o buffer

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $dompdf->set_option('isRemoteEnabled', true);

    // $dompdf->getFontMetrics()->registerFont('path/to/DejaVuSans.ttf');

    // $htmlContent = '<!DOCTYPE html>
    // <html>
    // <head>
    //     <title>Gincanas Semana Paulo Freire</title>
    // </head>
    // <body>
    //     <h1>Olá, Mundo!</h1>
    //     <p>Este é um exemplo de PDF gerado com Dompdf.</p>
    // </body>
    // </html>';
    $dompdf->loadHtml($htmlContent);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();

                //     // Saída do PDF para o navegador
                // $dompdf->stream('minha_pagina.pdf', ['Attachment' => 0]); // 0 para abrir no navegador, 1 para forçar download


    }else if($choice == 2){
        // página de fotos

    
    // Inicie o buffer de saída
    ob_start();
    include 'frontend/principal/fotos.php'; // Inclua a página que você deseja converter
    $htmlContent = ob_get_clean(); // Capture a saída e limpe o buffer

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $dompdf->set_option('isRemoteEnabled', true);

    // $dompdf->getFontMetrics()->registerFont('path/to/DejaVuSans.ttf');
    
    // $htmlContent = '<!DOCTYPE html>
    // <html>
    // <head>
    //     <title>Gincanas Semana Paulo Freire</title>
    // </head>
    // <body>
    //     <h1>Olá, Mundo!</h1>
    //     <p>Este é um exemplo de PDF gerado com Dompdf.</p>
    // </body>
    // </html>';
    $dompdf->loadHtml($htmlContent);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();

                //     // Saída do PDF para o navegador
                // $dompdf->stream('minha_pagina.pdf', ['Attachment' => 0]); // 0 para abrir no navegador, 1 para forçar download


    }

?>