<?php
namespace App\Services;

use Illuminate\Http\Request;
use PDF;

class PdfService
{
    public function generatePdf($data)
    {
        $pdf = PDF::loadView('invoice', $data);
        return $pdf->download('facture.pdf');
    }
}
