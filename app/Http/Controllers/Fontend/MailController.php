<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Exception;
use PDF;
class MailController extends Controller
{
    public function index()
    {
        $data = [
            'subject'=>'hoangochapianist Mail',
            'body'=>'Thanks for orders'
            
        ];
          
        try {

            Mail::to('minhbeo2kavc@gmail.com')->send(new MailNotify($data));
            return redirect()->route('homepage');
        } catch (Exception $th) {
            return  $th;
        }
    }
  
}
