<?php

namespace App\Admin\Controllers;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\User;

use PDF;

class SampleController extends AdminController
{
    public function pdf_sample()
    {
        $pdf = PDF::loadView('pdf_sample');
        return $pdf->download('pdf_sample.pdf');
        // return $pdf->stream('pdf_file.pdf');
        
    }
}
