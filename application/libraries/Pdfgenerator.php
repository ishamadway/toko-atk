<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// panggil autoload dompdf nya
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;
class Pdfgenerator {
    public function cetak_label($html, $filename= '', $stream=TRUE)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('a5', 'portrait');
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }
}
