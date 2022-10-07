<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

use Validator;
use App\states;
use App\country;
use Session;
use Hash;
use File;
use Auth;
use App\User;
use App\banks;
use App\activities;
use App\packages;
use App\investment;
use App\msg;
use App\withdrawal;
use App\deposits;
use App\ref;
use App\fund_transfer;
use App\xpack_inv;
use App\xpack_packages;
use App\site_settings;
use App\ticket;
use App\comments;
use App\admin;
use App\kyc;
use App\ref_set;
use GuzzleHttp\Client as GuzzleClient;
use DotenvEditor;

use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Checkout;
use CoinbaseCommerce\Resources\Charge;

use Google2FA;
use App\Offers;

class Offerscontroller extends Controller
{
    //
    
    public function create(){
        return view('user.createoffer');
    }
    
    
    public function update(Request $req) {
        $offercode=$req->code;
        
        $offers=Offers::where('code',$offercode)->get();
        
        return view('user.update')->with(compact('offers'));
    }
    
      public function updater(Request $req) {
          
        $user=Auth::user()->id;
        
        $offercode=$req->code;
        
        $infos=Offers::where('code',$offercode)->get();
        foreach($infos as $info){
            $user_changing=$info->user_id;
            if($user_changing !=$user){
                 return back()->with('error','Not authorized to change this offer');
            }
        }
        
        $offer =new Offers();
        
        $offer->min=$req->min;
        $offer->max=$req->min;
        $offer->rate=$req->rate;
        
        $updates=Offers::where('code',$offercode)->update(['min'=>$req->min,'max'=>$req->max,'rate'=>$req->rate]);
        
        
        
        
        if($updates){
            return back()->with('success','Offer updated Successfully');
        }else{
            return back()->with('error','An error occured');
        }
        
    }
    
    public function post(Request $req){
        
        
        $user=Auth::user()->id;
        $offertype=$req->offertype;
        
            function generateRandomString($length = 10) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                return $randomString;
             }
                 
                 
        $refcode=generateRandomString($length = 10);
        
        $rate=$req->rate;
        
        $min=$req->min;
        
        $max=$req->max;
        
        $offer=new Offers();
        
        $offer->user_id=$user;
        $offer->offer_type=$offertype;
        $offer->code=$refcode;
        $offer->status=1;
        $offer->rate=($rate);
        $offer->min=$min;
        $offer->max=$max;
        $offer->payment=$req->payment;
        
        if($offer->save()){
         //send email
          return back()->with('success','Offer created Successfully');
        }else{
          return back()->with('error','An error occured');
        }
        
            }
            
    public function buylisting(){
        $buyoffers=Offers::where('status',1)
        
        ->where('offer_type',2)
        ->orderBy('rate','ASC')
        ->get();
        
        return view('user.buylisting')->with(compact('buyoffers'));
        
        
        
        
    }
            
        
}
