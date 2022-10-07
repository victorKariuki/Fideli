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

class Usereg extends Controller
{
    //
    
     public function verify_reg($usn, $code)
  {      
          
        try
        {

            $usr = User::where('usr', $usn)->get();
            
            
            // dd($usr);
            if(count($usr) > 0)
            {
                if($usr[0]->act_code == 0000000000)
                {
                    Session::put('status', "Account already activated once");
                      Session::put('msgType', "err");
                }
                elseif($usr[0]->act_code == $code)
                {
                    $usr[0]->status = 1;
                    $usr[0]->act_code = 0000000000;
                      $usr[0]->save();
                      
                      Session::put('status', "Account activation successful");
                      Session::put('msgType', "suc");
                }
                else
                {
                    Session::put('status', "Invalid activation code passed!");
                      Session::put('msgType', "err");
                }
            }
            else
            {
                
                  Session::put('status', "Account Activation Error");
                  Session::put('msgType', "err");
                  
            }
           
              return view('auth.act_verify');
        }
        catch(\Exception $e)
        {
          Session::put('status', $e->getMessage()."Error Updating your account. Please contact support");
              Session::put('msgType', "err");
            return view('auth.act_verify');
        }
          
      
  } 
}
