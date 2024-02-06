<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;


class TestController extends Controller
{
    public function generatePdf()
    {
        $data = [
            'foo' => 'hello 1',
            'bar' => 'hello 2'
        ];

        $pdf = PDF::loadView('pdf.document', $data);
        return $pdf->stream('document.pdf');
    }
}
