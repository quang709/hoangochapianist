<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Customer;
use App\Models\News;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;

class HomepageController extends Controller
{

    protected $product;
    public function __construct()
    {
        $this->product = new Product();
    }


    public function index(Request $request)
    {
        $products = $this->product->withName($request->name)
            ->withPrice($request->price)->get();
        return view('pages.homepage.index', compact('products'));
    }

  
}
