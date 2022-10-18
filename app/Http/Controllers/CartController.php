<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;

use Session;
use Response;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.listcart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product != null) {
            $oldCart = Session('Cart') ?? null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($product, $id);
            $request->session()->put('Cart', $newCart);
        }
        return view('pages.cart.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         foreach($request->list as $item)
         {
            $oldCart = Session('Cart') ?? null;
            $newCart = new Cart($oldCart);
            $newCart->updateCart($item['id'],$item['value']);
            $request->session()->put('Cart',$newCart);
         }

         return Response()->json([
            'sublistcart' => view('pages.listcart.sublistcart')->render(),
            'cart' => view('pages.cart.index')->render()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyItem(Request $request,$id)
    {
        $oldCart = Session('Cart') ?? null;
        $newCart = new Cart($oldCart);
        $newCart->deleteCart($id);
        if(Count($newCart->products)>0){
            $request->session()->put('Cart', $newCart);
        }else{
            $request->session()->forget('Cart');
        }
        return view('pages.cart.index');
    }

    public function  destroyList(Request $request,$id)
    {
        $oldCart = Session('Cart') ?? null;
        $newCart = new Cart($oldCart);
        $newCart->deleteCart($id);
        if(Count($newCart->products)>0){
            $request->session()->put('Cart', $newCart);
        }else{
            $request->session()->forget('Cart');
        }
        return Response()->json([
            'sublistcart' => view('pages.listcart.sublistcart')->render(),
            'cart' => view('pages.cart.index')->render()
        ]);
    }

   
}
