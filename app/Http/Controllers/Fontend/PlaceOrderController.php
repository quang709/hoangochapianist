<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use Mail;
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

                $dataNew['order_id'] = $order_id;
                $dataNew['product_id'] = $item['productInfo']->id;
                $dataNew['product_name'] = $item['productInfo']->name;
                $dataNew['product_price'] =  $item['productInfo']->price;
                $dataNew['product_quantily'] = $item['quanty'];             
                $data[] = $dataNew;
            }
            DB::table('order_details')->insert($data);

            $orders = Order::with('customer')->with('shipping')->where('id',$order_id)->get();
            $product = DB::table('order_details')->where('order_id',$order_id)->get();

            $dataMail["email"] = $shipping->email;
            $dataMail["title"] = "Welcome to hoangngocha.com";
            $dataMail["date"] = date('m/d/Y');
            $dataMail["orders"] =  $orders;
            $dataMail["product"] = $product;        
            $dataMail["body"] ="Thanks for orders";
        
            $pdf = PDF::loadView('PDF/index', $dataMail);
         
            Mail::send('email.index', $dataMail, function($message)use($dataMail, $pdf) {
                $message->to($dataMail["email"], $dataMail["email"])
                        ->subject($dataMail["title"])
                        ->attachData($pdf->output(), "Order.pdf");
            });

           if (Session::get('coupon')){
            DB::table('coupon_customer')->insert([
                'coupon_id' => Session::get('coupon')->id,
                'customer_id'=>Session::get('customer')->id,
            ]);
            
            $coupon =  Coupon::where('id',Session::get('coupon')->id)->first();     
            $coupon->quantity = $coupon->quantity - 1 ;
            $coupon->save();

            $request->session()->forget(['Cart','coupon']);
           } else {
            $request->session()->forget(['Cart']);
           }
           

          
            return redirect()->route('cart.list');
        } else {
            return  redirect()->route('sigin-in.index');
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
