<?php

       //connect to mysqli database hapa
       
       $sql=mysqli_connect('localhost','candlest_cd','candlest_cd','candlest_cd');
       
       
       $query=mysqli_query($sql,"select phone from users where status='0' ");
       
       if(mysqli_num_rows($query)>1){
           while($row=mysqli_fetch_assoc($query)){
               
               if(is_numeric($row['phone'])){
                   $ptn = "/^0/";  // Regex
                    $str = $row['phone']; //Your input, perhaps $_POST['textbox'] or whatever
                    $rpltxt = "254";  // Replacement string
                    $receiver=preg_replace($ptn, $rpltxt, $str);
                    
                    
                    $message="Greetings from candletrade,we are here to say thanks for your esteemed cooperation with us,beside this we needed to notify you that on 5th we will be operating globally,lets be ambasadors outside and stick in unity #from executive ";
       
                    send_sms($receiver,$message);
               }
       
           }
       }
       

       function send_sms($mobile,$message){
           
           
           $baseUrl="https://sms.lifegeegs.com/sms/api";
           
            $data= array(
                'action'=>'send-sms',
                'api_key' =>'RGVub3N0ZTpEZW5vMUBraXBsYQ==' ,
                'to' =>$mobile ,
                'from' =>'Main' ,
                'sms' =>$message,
                
                );
                $ch = curl_init($baseUrl);
                $payload = json_encode($data);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Accept:application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                curl_close($ch);
                
       }
       
       
       
       

                
