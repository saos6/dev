<?php

namespace App\Http\Controllers;

use PDF;

class SampleController extends Controller
{
    public function pdf_sample()
    {
        $pdf = PDF::loadView('pdf_sample');
        // return $pdf->download('pdf_sample.pdf');
        return $pdf->stream('pdf_file.pdf');
    }
}
