<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GoogleSocialiteController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {
     
            $user = Socialite::driver('google')->user();
            $finduser = Customer::where('social_id', $user->id)->first();
      
            if($finduser){ 
               Session::put('customer', $finduser);
                return redirect('/homepage');
      
            }elseif($customer = Customer::where('email',$user->email)->first()){
                $customer->name = $user->name;                 
                $customer->save();       
                Session::put('customer', $customer);
                return redirect('/homepage');
            }else{
                $newUser = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone'=>'',
                    'social_id'=> $user->id,
                    'social_type'=> 'google',
                    'password' => md5('my-google')
                ]);
               // Auth::login($newUser);
                Session::put('customer', $newUser);
                return redirect('/homepage');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}