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
                $msg= "Login success";
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
      echo $msg."<br>";
      echo $PassErr."<br>";
      echo $NotFound."<br>";
   }
}
?>
<form action="" method="POST">
    Email <input type="email" name="email" id=""><br><br>
    Password <input type="password" name="password" id=""><br>
    <button type="submit" name="submit">Submit</button>
</form>