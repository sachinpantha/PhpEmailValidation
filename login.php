<?php
$db= require_once("database.php");
if (isset($_POST['submit'])) {
   if (!empty(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
   {
      $email=$_POST['email'];
   }
   else 
   {
       $EmailErr="Email error";
   }
   if (!empty($_POST['password'])) 
   {
     if (strlen($_POST['password'])<8) 
     {
       $PassErr="Password must be 8 characters long"; 
     }
     else {
         $password=$_POST['password'];
     }
   }
   else 
   {
       
       $PassErr="Password error";
   }
   if (!isset($EmailErr) && !isset($PassErr)) 
   {
      foreach($db as $item){
          if ($email==$item['email']) {
              if (md5($password)==$item['password']) {
                     include 'test.html';

              }
              else {
                  $PassErr="password didn't matched";
              }
              $NotFound="";
              break;
          }
          else {
              $NotFound="User not found";
          }
      }
      if (isset($msg)) {
          
          echo $msg."<br>";
      }
      if (isset($PassErr)) {
         
          echo $PassErr."<br>";
      }
      if (isset($NotFound)) {

          echo $NotFound."<br>";
      }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phpvalidation</title>
    <style>
        .container{
            padding: 20px;
            border:1px solid black;
            width: 300px;
            margin: 0 auto;
            background-color: #ccc;
            border-radius: 10px;
        }
        .btn{
            border:1px solid black;
            padding: 5px;
            margin-left: 36%;
            margin-top: 12px;
        }
        .btn:hover{
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            Email <input type="email" name="email" id=""><br><br>
            Password <input type="password" name="password" id=""><br>
            <button type="submit" class="btn" name="submit">Submit</button>
        </form>
    </div>   
</body>
</html>
