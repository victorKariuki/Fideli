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


class HomeController extends Controller
{
    private $st;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->st = site_settings::find(1);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
    }
    
     public function user_ref_wd(Request $req)
     {        
    //   dd($req);
    //   exit('please wait..');
      $user = Auth::User();

      if(env('WITHDRAWAL') != 1  )
      {
        Session::put('msgType', "err");              
        Session::put('status', 'Withdrawal disabled! Please contact support.');
        return back()->with('error','Withdrawal disabled! Please contact support.');
      }

      if($user->status == 'Blocked' || $user->status == 2 )
      {
        Session::put('msgType', "err");              
        Session::put('status', 'Account Blocked! Please contact support.');
        return back()->with('error','Account Blocked! Please contact support.');
      }

      if($user->status == 'pending' || $user->status == 0 )
      {
        Session::put('msgType', "err");              
        Session::put('status', 'Account not activated! Please contact support.');
       return back()->with('error','Account not activated! Please contact support.');
      }

      if(intval($req->input('amt')) < env('MIN_WD'))
      {
        Session::put('msgType', "err");              
        Session::put('status', 'Amount is lower than minimum withdrawal of '.env('MIN_WD'));
        return back()->with('error','Amount is lower than minimum withdrawal of '.env('MIN_WD'));
      }

      if(intval($req->input('amt')) > env('WD_LIMIT'))
      {
        Session::put('msgType', "err");              
        Session::put('status', env('WD_LIMIT').' Withdrawal limit exceeded!');
        return back()->with('error','Withdrawal limit exceeded!');
      } 

      if(intval($req->input('amt')) > intval($user->ref_bal) || intval($req->input('amt')) == 0)
      {
        Session::put('msgType', "err");              
        Session::put('status', 'Invalid withdrawal amount. Amount must be greater than zero(0) and not more than referral balance');
        return back()->with('error','Invalid withdrawal amount. Amount must be greater than zero(0) and not more than referral balance');
      }


      if(!empty($user))
      { 
        //   dd($user);
        //   exit;
        $iv = investment::where('user_id', $user->id)->get();
        // if(count($iv) < 1)
        // {
        //   Session::put('msgType', "err");              
        //   Session::put('status', 'Sorry you have to invest at least once before you can withdraw your referral bonus.');
        //   return back();
        // }
                  
        try
        {  

          $usr = User::find($user->id);
          $usr->ref_bal -= intval($req->input('amt'));
          $usr->save();

          $wd = new withdrawal;
          $wd->user_id = $user->id;
          $wd->usn = $user->username;
          $wd->package = 'ref_bonus';
          $wd->invest_id = $user->id;
          $wd->amount = intval($req->input('amt'));
          $wd->account = $req->input('bank');
          $wd->w_date = date('Y-m-d');
          $wd->currency = $user->currency;
          $wd->charges = $charge = intval($req->input('amt'))*env('WD_FEE');
          $wd->recieving = intval($req->input('amt'))-$charge;
          $wd->save();

          $act = new activities;
          $act->action = "User requested withdrawal from referral bonus to bank";
          $act->user_id = $user->id;
          $act->save();
          
          $maildata = ['email' => $user->email, 'username' => $user->username];
          Mail::send('mail.wd_notification', ['md' => $maildata], function($msg) use ($maildata){
              $msg->from(env('MAIL_USERNAME'), env('APP_NAME'));
              $msg->to($maildata['email']);
              $msg->subject('User Withdrawal Notification');
          });

          $maildata = ['email' => $user->email, 'username' => $user->username];
          Mail::send('mail.wd_notification',['md' => $maildata], function($msg) use ($maildata){
              $msg->from(env('MAIL_USERNAME'), env('APP_NAME'));
              $msg->to(env('SUPPORT_EMAIL'));
              $msg->subject('User Withdrawal Notification');
          });
         
          Session::put('status', 'Referral Withdrawal Successful');
          Session::put('msgType', "suc");
          return back()->with('success','Referral Withdrawal Successful');

        }
        catch(\Exception $e)
        {
          Session::put('status', $e->getMessage().' Error submitting your withdrawal');
          Session::put('msgType', "err");
          return back();
        }
          
      }
      else
      {
        return redirect('/');
      }
  }
    
    
    
     public function invest(Request $req)
  {        
      $user = Auth::User();


      if($this->st->investment != 1 )
      {
        Session::put('msgType', "err");              
        Session::put('status', 'Investment disabled! You will be notified when it is available.');
        return back();
      }

      if($user->status == 'Blocked' || $user->status == 2 )
      {
        Session::put('msgType', "err");              
        Session::put('status', 'Account Blocked! Please contact support.');
        return redirect('/login');
      }

      if($user->status == 'pending' || $user->status == 0 )
      {
        Session::put('msgType', "err");              
        Session::put('status', 'Account not activated! Please contact support.');
        return redirect('/login');
      }



      if(!empty($user))
      {            
          
        try
        {     
          $capital = $req->input('capital');
          $pack = packages::find($req->input('p_id'));

          if($user->wallet < $capital)
          {
            Session::put('status', 'Your wallet balance is lower than capital.');
            Session::put('msgType', "err");
            return back()->with('error','Your wallet balance is lower than capital.');
          }
          
          if($user->wallet < $pack->min)
          {
            Session::put('status', 'Wallet balance is lower than minimum investment.');
            Session::put('msgType', "err");
            return back()->with('error','Wallet balance is lower than minimum investment.');
          }
          
          if($capital > $pack->max)
          {
            Session::put('status', 'Input Capital is greater than maximum investment.');
            Session::put('msgType', "err");
            return back()->with('error','Input Capital is greater than maximum investment.');
          }
          
          if($capital < $pack->min)
          {
            Session::put('status', 'Input Capital is less than minimum investment.');
            Session::put('msgType', "err");
            return back()->with('error','Input Capital is less than minimum investment.');
          }

          if($capital >= $pack->min && $capital <= $pack->max) 
          {
            $inv = new investment;
            $inv->capital = $capital;
            $inv->user_id = $user->id;
            $inv->usn = $user->username;
            $inv->package = $pack->package_name;
            $inv->date_invested = date("Y-m-d");
            $inv->period = $pack->period;    
            $inv->days_interval = $pack->days_interval;          
            $inv->i_return = (round($capital*$pack->daily_interest*$pack->period,2));
            $inv->interest = $pack->daily_interest;
            // $no = 0;
            $dt = strtotime(date('Y-m-d'));
            $days = $pack->period;
            
            while ($days > 0) 
            {
                $dt    +=   86400   ;     
                $actualDate = date('Y-m-d', $dt);                  
                $days--;
            }  

            $inv->package_id = $pack->id;
            $inv->currency = $this->st->currency;
            $inv->end_date = $actualDate;
            $inv->last_wd = date("Y-m-d");
            $inv->status = 'Active';

            $user->wallet -= $capital;
            $user->save();
            
            $inv->save();

            if(!empty($user->referal))
            {
              $ref_bonuses = ref_set::all();
              
              if(env('REF_TYPE') == 'Once' && count($ref_bonuses) > 0)
              {
                $ref_cnt = env('REF_LEVEL_CNT');
                $new_ref_user = $user->referal;
                $itr_cnt = 0;                

                $refExist = ref::where('user_id', $user->id)->get();
                if(count($refExist) == 0)
                {
                    while ($itr_cnt <= $ref_cnt-1)
                    {
                        $refUser = User::where('username', $new_ref_user)->get();
                        if(count($refUser) > 0)
                        {
                            $ref = new ref;
                            $ref->user_id = $user->id;
                            $ref->username = $new_ref_user;
                            $ref->wdr = 0;
                            $ref->currency = env('CURRENCY');
                            $ref->amount = $capital * $ref_bonuses[$itr_cnt]->val;
                            $ref->level = $itr_cnt+1;
                            $ref->save();
                
                            $refUser[0]->ref_bal += $capital * $ref_bonuses[$itr_cnt]->val;
                            $new_ref_user = $refUser[0]->referal;   
                            $refUser[0]->save(); 
                        }                    
                        $itr_cnt += 1; 
                        if(env('REF_SYSTEM') == 'Single_level')
                        {
                          break;
                        }
                    }
                              
                }                
                
              }
              if(env('REF_TYPE') == 'Continous' && count($ref_bonuses) > 0)
              {
                $ref_cnt = env('REF_LEVEL_CNT');
                $new_ref_user = $user->referal;
                $itr_cnt = 0;    

                while ($itr_cnt <= $ref_cnt-1)
                {
                    $refUser = User::where('username', $new_ref_user)->get();
                    if(count($refUser) > 0)
                    {
                        $ref = new ref;
                        $ref->user_id = $user->id;
                        $ref->username = $new_ref_user;
                        $ref->wdr = 0;
                        $ref->currency = env('CURRENCY');
                        $ref->amount = $capital * $ref_bonuses[$itr_cnt]->val;
                        $ref->level = $itr_cnt+1;
                        $ref->save();
                    
                        $refUser[0]->ref_bal += $capital * $ref_bonuses[$itr_cnt]->val;
                        $refUser[0]->save(); 
                        $new_ref_user = $refUser[0]->referal;   
                    }                    
                    $itr_cnt += 1; 
                    if(env('REF_SYSTEM') == 'Single_level')
                    {
                        break;
                    }
                }
              }
            }
            
            $maildata = ['email' => $user->email, 'username' => $user->username];
            Mail::send('mail.user_inv_notification', ['md' => $maildata], function($msg) use ($maildata){
                $msg->from(env('MAIL_USERNAME'), env('APP_NAME'));
                $msg->to($maildata['email']);
                $msg->subject('User Investment');
            });

            $maildata = ['email' => $user->email, 'username' => $user->username];
            Mail::send('mail.admin_inv_notification', ['md' => $maildata], function($msg) use ($maildata){
                $msg->from(env('MAIL_USERNAME'), env('APP_NAME'));
                $msg->to(env('SUPPORT_EMAIL'));
                $msg->subject('User Investment');
            });

            $act = new activities;
            $act->action = "User Invested ".$capital." in ".$pack->package_name." package";
            $act->user_id = $user->id;
            $act->save();

            Session::put('status', "Investment Successful");
            Session::put('msgType', "suc");
           return back()->with('success','Investment Successful');
          }
          else
          {
            Session::put('status', "Invalid amount! Try again.");
            Session::put('msgType', "err");
            return back()->with('error','Invalid amount');
          }            
                                
        }
        catch(\Exception $e)
        {
            Session::put('status', "Error creating investment! Please Try again.".$e->getMessage());
            Session::put('msgType', "err");
           return back()->with('error','Error creating investment! Please Try again.');
        }                 
          
      }
      else
      {
        return redirect('/');
      }
          
  }
}
