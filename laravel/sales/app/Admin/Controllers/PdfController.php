<?php

namespace App\Admin\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Author;
use Barryvdh\Facade as PDF;
use Carbon\Carbon;
use Encore\Admin\Layout\Content;

class PdfController extends Controller
{
    public function index($author_id)
    {
        $author = Author::whereId($author_id)->first();
        $date = new Carbon();
 
        $pdf=PDF::loadView('admin.nouhin',compact('author','date'));
        return $pdf->download('納品書.pdf'); //こちらがダウンロード用機能
    }
 
    public function view($customer_id)
    {
        $author = Author::whereId($author_id)->first();
        $date = new Carbon();
 
        return view('admin.nouhin',compact('author','date')); //こちらがブラウザ表示用機能
    }
}