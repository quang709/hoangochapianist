<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        
        $news = News::latest()->get();
    
        return view('pages.homepage', compact('news'));
    }

}
