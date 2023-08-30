<?php

namespace App\Http\Controllers;

use PDF; 

class TraineeController extends Controller
{
  public function outputPdf()
  {
    /**
     * 出力したいviewを読み込む
     * この場合、views/output/pdf.blade.phpを出力する
     * パラメータを渡したい場合、普段のview()関数と同様に第二引数に指定してあげればOK
     * PDF::loadView('output.pdf', ['message' => 'Hello']);
     */
    $pdf = PDF::loadView('output.pdf');
    // PDF出力 (引数にはPDFのファイル名を設定できる)
    return $pdf->stream('pdf_file.pdf');

    // PDFをダウンロードしたい場合はこっち
    // return $pdf->download('pdf_file.pdf');
  }
}