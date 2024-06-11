<?php

namespace App\services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService 
{
    private $domPdf;

    public function __construct() {
        $this->domPdf = new Dompdf();

        $pdfOptions = new Options();

        $pdfOptions->set('A4', 'lnandscape');

        $this->domPdf->setOptions($pdfOptions);
    }

    public function ShowPdfFile($html)
    {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->stream("new file", array('Attachement'=>0));
    }



}
    
