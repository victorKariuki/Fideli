@extends('layouts.main')

@section('content')


<style>
    body{
        background-color: black;
    }
    </style>
<br><br>

     <div class="card ">
                                <div class="card-header bg-gradient-info">
                                    <div class="card-title bg-gradient-info text-warning">{{ __('REFERRALS WHO HAVE INVESTED') }}</div>
                                </div>
                                <div class="card-body bg-gradient-info pb-5">
                                    <?php
                                        $ref_levels = App\ref_set::all();
                                        $rsum = 0;
                                    ?>                    
                                        @foreach($ref_levels as $ref_level)
                                            <?php
                                                $activities = App\ref::where('username', $user->username)->where('level', $ref_level->id)->orderby('id', 'asc')->get();
                                                // $rsum += $activities
                                            ?>
                                            
                                            <div class="table-responsive mt-5">                                        
                                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                                    <thead>
                                                        <tr>
                                                            <!-- <th data-field="state" data-checkbox="true"></th> -->
                                                            <th>{{ __('Name') }}</th>
                                                            <th>{{ __('Username') }}</th>
                                                            <th>{{ __('Level') }}</th>
                                                            <th>{{ __('Earned') }}</th>
                                                            <th>{{ __('Investment') }}</th>
                                                            <th>{{ __('Date Registered') }}</th>   
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        @if(count($activities) > 0 )
                                                            @foreach($activities as $activity)
                                                                <?php  
                                                                    $ref_d = App\User::find($activity->user_id);                
                                                                ?>
                                                                <tr>                                                            
                                                                    <td>
                                                                        {{$ref_d->firstname}} {{$ref_d->lastname}}
                                                                    </td>
                                                                    <td>{{$ref_d->username}}</td>
                                                                    <td>{{$activity->level}}</td>
                                                                    <td>{{ env('CURRENCY').' '.$activity->amount}}</td>
                                                                    <td>
                                                                        <?php  
                                                                            $ref_inv = App\investment::where('user_id', $activity->user_id)->get();
                                                                            echo count($ref_inv);
                                                                        ?>
                                                                    </td>                                                            
                                                                    <td>{{substr($ref_d->created_at,0,10)}}</td>                     
                                                                </tr>
                                                                @php($rsum += $activity->amount)
                                                            @endforeach
                                                        @else
                                                            <tr>                                                    
                                                                <td colspan="4">No data</td>                     
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                    
                                                </table>

                                            </div>
                                                       
                                                    
                                        @endforeach   
                                   
                                                    
                                </div>
                            </div>
        <div class="main-panel bg-success ">
            <div class="card-header bg-gradient-info text-center"><b>ALL THE  REFERALS</b></div>
            <div class="card-body bg-gradient-info">
              
              
              <!------------------------------------------------------->
              
              
              
              
              
              
                        
<table id="" class=" table table-stripped table-hover">
    <thead>
        <tr>                
            <th> {{ __('firstName') }} </th>
            <th> {{ __('Username') }} </th>
            <th> {{ __('phone') }} </th>
            <th> {{ __('st') }} </th>   
        </tr>
    </thead>
    <tbody>

        <?php
            // $activities = App\User::where('referal', $user->username)->orderby('id', 'desc')->get();
              $activities = App\User::where('referal', $user->username)->where('status', 1)->orderby('id', 'desc')->get();
        ?>
        @if(count($activities) > 0 )
            @foreach($activities as $activity)
                <tr>                                                            
                    <td>{{$activity->firstname}} {{$activity->lastname}}</td>
                    <td>{{$activity->username}}</td>
                  <td>{{$activity->phone}}</td>                                                                            
                    <td>{{$activity->status}}</td>                     
                </tr>
            @endforeach
        @else
            
        @endif
    </tbody>
</table>

              
   
  
            </div>
</div>
           

@endSection
            