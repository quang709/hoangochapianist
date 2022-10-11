<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Exception;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'subject'=>'hoangochapianist Mail',
            'body'=>'Thanks for orders'
        ];

        try {
            Mail::to('quangquangquang321@gmail.com')->send(new MailNotify($data));
            return redirect()->route('homepage');
        } catch (Exception $th) {
            return  $th;
        }
    }
  
}
