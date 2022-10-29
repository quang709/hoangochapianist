<?php

namespace App\Http\Controllers\Fontend;

use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Validator;
use Stripe;
class DebitOrCreditCardController extends Controller
{
    public function postPaymentStripe(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            // 'amount' => 'required',
        ]);
 
        $input = $request->except('_token');
 
        if ($validator->passes()) { 
            $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));
             
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);
 
                if (!isset($token['id'])) {
                    return redirect()->route('stripe.add.money');
                }
                 
            $price = Currency::convert()
            ->from('VND')
            ->to('USD')
            ->amount($request->toTalPrice)
            ->round(2)
            ->get();

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => $price,
                    'description' => 'wallet',
                ]);
                
                if($charge['status'] == 'succeeded') {
                    // dd($charge);
                    return  response()->json(['success' => 'create successfully.']);
                } else {
                    return response()->json(['error' => 'something went wrong']);
                }
            } catch (Exception $e) {
                return redirect()->route('cart.list')->with('error',$e->getMessage());
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return redirect()->route('cart.list')->with('error',$e->getMessage());
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return redirect()->route('cart.list')->with('error',$e->getMessage());
            }
        }
    }
}