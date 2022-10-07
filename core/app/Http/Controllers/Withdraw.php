<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\investment;
use App\activities;
use Session;
use App\User;

class Withdraw extends Controller
{
    
 public function wd_invest(Request $req)
  {        
      
   
    
    // $amt="";
    
    
    
      $user = Auth::User();

      if($user->status == 'pending' || $user->status == 0 )
      {
        Session::put('msgType', "err");              
        Session::put('status', 'Account not activated! Please contact support.');
        return redirect('/login');
      }

      if($user->status == 'Blocked' || $user->status == 2 )
      {
        Session::put('msgType', "err");              
        Session::put('status', 'Account Blocked! Please contact support.');
        return redirect('/login');
      }

      if(!empty($user))
      {            
        
        try
        {  

        //   $amt = $req->input('amt');
          
          if($req->input('pack_type') == 'xpack')
          {
              $pack = xpack_inv::find($req->input('p_id'));
          }
          else
          {
              $pack = investment::find($req->input('p_id'));
          }

          $in = $pack;
          $withdrawable = 0;
          $ended = '';

          $totalElapse = getDays(date('Y-m-d'), $in->end_date);
          if($totalElapse == 0)
          {
              $lastWD = $in->last_wd;
              $enddate = ($in->end_date);
              $Edays = getDays($lastWD, $enddate);
              $ern  = $Edays*$in->interest*$in->capital;
              $withdrawable = $ern;              
              $totalDays = getDays($in->date_invested, $in->end_date);
              $ended = "yes";
          }
          else
          {
              $lastWD = $in->last_wd;
              $enddate = (date('Y-m-d'));
              $Edays = getDays($lastWD, $enddate);
              $ern  = $Edays*$in->interest*$in->capital;
              $withdrawable = 0;
              if ($Edays >= $in->days_interval)
              {
                  $withdrawable = $in->days_interval*$in->interest*$in->capital;
              }                                         
              $totalDays = getDays($in->date_invested, date('Y-m-d'));
              $ended = "no";
          }
          
          

        //   if($req->input('amt') != $withdrawable)
        //   {
        //     return back()->with([
        //       'toast_msg' => 'Invalid amount!',
        //       'toast_type' => 'err'
        //     ]);
        //   }
          
          $amt = $withdrawable;

          if($amt <= 0)
          {
            return back()->with([
              'toast_msg' => 'Invalid amount/Package Expired!',
              'toast_type' => 'err'
            ]);
          }

          if($ended == 'yes')
          {
            if($pack->status != 'Expired')
            {
                $user->wallet += $pack->capital;
                $user->save();
            }
            $pack->last_wd = $pack->end_date;
            $pack->status = 'Expired';

          }    
          else
          {
              
            $dt = strtotime($pack->last_wd);
            $days = $pack->days_interval;
           
            while ($days > 0) 
            {
              $dt    +=   86400   ;     
              $actualDate = date('Y-m-d', $dt);
              // if (date('N', $dt) < 6) 
              // {
                  $days--;
              //}
            }
            $pack->last_wd = $actualDate;
          }
          
          $pack->w_amt += $amt;            
          $pack->save();

          $usr = User::find($user->id);
          $usr->wallet += $amt;
          $usr->save();

          $act = new activities;
          $act->action = "User withdrawn to wallet from ".$pack->package.'package. package id: '.$pack->id;
          $act->user_id = $user->id;
          $act->save();

          Session::put('status', 'Package Withdrawal Successful, Amount Withdrawn Has Been Added to your Wallet');
          Session::put('msgType', "suc");
          return back();

        }
        catch(\Exception $e)
        {
          Session::put('status', 'Error submitting your withdrawal');
          Session::put('msgType', "err");
          return back();
        }
          
      }
      else
      {
        return redirect('/');
      }
  }
}
