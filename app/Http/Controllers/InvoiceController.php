<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Facade de dompdf

class InvoiceController extends Controller
{
    // InvoiceController.php
    public function generatePDF()
    {
        $data = [
            'invoice_number' => 'F123456',
            'date' => '6 août 2024',
            'items' => [
                ['name' => 'Article 1', 'quantity' => 2, 'unit_price' => '10,00 €', 'total' => '20,00 €'],
                ['name' => 'Article 2', 'quantity' => 1, 'unit_price' => '15,00 €', 'total' => '15,00 €'],
            ],
            'total_to_pay' => '35,00 €',
            'amount_given' => '50,00 €',
            'amount_due' => '15,00 €',
        ];

        $pdf = PDF::loadView('invoice', $data);
        return $pdf->download('facture.pdf');
    }

}
