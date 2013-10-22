<?php

    require 'libs/html2pdf/html2pdf.class.php';
     ob_start();
    include(dirname(__FILE__).'/pdfTemplate.php');
    $content = ob_get_clean();
    $html2pdf = new HTML2PDF('P','A3','es');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
?>
