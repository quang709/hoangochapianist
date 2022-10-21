<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use AmrShawky\LaravelCurrency\Facade\Currency;

class PayPalController extends Controller
{
    // Import the class namespaces first, before using it directly

    public function create(Request $request)
    {
     
        $data = json_decode($request->getContent(), true);
        
        $converted = '';

        $convertedObj = Currency::convert()

            ->from('VND')
            ->to('USD')
            ->amount($data['price'])
            ->round(2);

            $price = $convertedObj->get();
        // $provider = \Paypal::setProvider();
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        // $response = $provider->capturePaymentOrder($request['token']);
     


        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $price
                    ]
                ]
            ]
        ]);
        return response()->json($order);
    }

    public function capture(Request $request)
    {
                  
            $data = json_decode($request->getContent(), true);
            $orderId = $data['orderId'];
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $result = $provider->capturePaymentOrder($orderId);

            $shipping = new Shipping();
            $shipping->name =$data['name'];
            $shipping->email =$data['email'];
            $shipping->address =$data['address']??'';
            $shipping->phone =$data['phone'];
            $shipping->note = $data['note'] ?? '';
            $shipping->save();


            $price = Currency::convert()
            ->from('VND')
            ->to('USD')
            ->amount($data['price'])
            ->round(2)
            ->get();

         
            $payment = Payment::where('name', $data['payment'])->first();
            $order_id = DB::table('orders')->insertGetId([
                'customer_id' => $data['customer_id'], 
                'shipping_id' => $shipping->id,
                'payment_id' => $payment->id,
                'total' => $price,
                'status' => 'pending'
            ]);
           
            
            foreach ($data['products'] as $item) {           
                $dataNew['order_id'] = $order_id;
                $dataNew['product_id'] = $item['id'];
                $dataNew['product_name'] = $item['name'];
                $dataNew['product_price'] =  $item['price'];
                $dataNew['product_quantily'] = $item['quantity'];
                $products[] = $dataNew; 
            }
            DB::table('order_details')->insert($products);
            // $request->session()->forget('Cart');
            return response()->json($result);
        } 
    }

