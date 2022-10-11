<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class PlaceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreOrderRequest $request)
    {

        if (isset(Session::get('customer')->id)) {

            $shipping = new Shipping();
            $shipping->name = $request->name;
            $shipping->email = $request->email;
            $shipping->address = $request->address;
            $shipping->phone = $request->phone;
            $shipping->note = $request->note ? $request->note : '';
            $shipping->save();

            $payment = Payment::where('name', $request->payment)->first();
            $order_id = DB::table('orders')->insertGetId([
                'customer_id' => Session::get('customer')->id,
                'shipping_id' => $shipping->id,
                'payment_id' => $payment->id,
                'total' => Session::get('Cart')->totalPrice,
                'status' => 'pending'
            ]);

            foreach (Session::get('Cart')->products as $item) {

                DB::table('order_details')->insert([
                    'order_id' => $order_id,
                    'product_id' => $item['productInfo']->id,
                    'product_name' => $item['productInfo']->name,
                    'product_price' => $item['productInfo']->price,
                    'product_quantily' => $item['quanty'],
                ]);
            }
            $request->session()->forget('Cart');
            return redirect()->route('cart.list');
        } else {
            return route('sigin-in.index');
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
