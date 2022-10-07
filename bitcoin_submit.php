<?php
//connect to database

echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

$connection=mysqli_connect('localhost','candlest_cd','candlest_cd','candlest_cd');

//get user input data

if(isset($_POST["submit"])) {

$username=mysqli_real_escape_string($connection,$_POST['username']);

//check if username exists in database to ensure that hatuweki the wrong data or non-existing username

$query=mysqli_query($connection,"select * from users where username=$username LIMIT 1");

$rows=mysqli_num_rows($query);

if($rows>0){
    $amount=mysqli_real_escape_string($connection,$_POST['amount']);


    //file upload
      
      $errors= array();
      $file_name = $_FILES['filename']['name'];
      $file_size =$_FILES['filename']['size'];
      $file_tmp =$_FILES['filename']['tmp_name'];
      $file_type=$_FILES['filename']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['filename']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"upload/".$file_name);
         
         //insert the response to database
        //  echo "Success";
         
         $sql=mysqli_query($connection,"insert into btc_uploads (username,amount,url) VALUES ('$username','$amount','$file_name')");
         
         if($sql){
             
             //notify admin
             $message="Kindly check payment by $username of amount $amount. Check screenshot from the url https://candlesticktrade.xyz/upload/$file_name";
             $mobile="254114020205";
             
             send_sms($mobile,$message);
             
             
             echo "<script>
            alert('Document Uploaded')
            </script>";
         }else{
              echo "<script>
            alert('Error Uploading document')
            </script>";
         }
      }else{
         echo($errors[0]);
      }
      
        
}
//username not found
else{
    echo 
    "<script>
    alert('Username not found')
    </script>";
    
    
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



?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bg-img {
  /* The image used */
  background-image: url("img_nature.jpg");

  min-height: 380px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

/* Add styles to the form container */
.container {
  position: absolute;
  right: 0;
  margin: 20px;
  max-width: 300px;
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div>
      <h4>Deposit your coins to this bitcoin adress</h4> 
      <input type="text" value="bc1qjt3memvlcm8f9m225fltqgjpj533uyx0pfvxnv" id="myInput">
<button onclick="myFunction()">Copy address</button>

<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied succesfully" );
}
</script>
        
    </div>
    

<h4>Fill the payments details here</h4>
<div class="bg-img">
  <form method="post" action="bitcoin_submit.php" class="container" enctype="multipart/form-data">
    <h3>Input correct details!</h3>

    <label for="username"><b>Your Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>
    <br><br>
    
    <label  for="Amount"><b>Amount of BTC You Deposit</b></label>
    <input type="text" min="10" placeholder="$1000" name="amount" required>
    <br><br>
    
     
    
    <label ><b>Transaction screenshot</b></label>
    <br><br>
     <input type="file" id="myFile" name="filename" required>
    <br><br>
    <button type="submit" class="btn" name="submit">SUBMIT</button>
  </form>
  
  <a href="https://www.candlesticktrade.xyz/">Go to Dashboard</a>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>