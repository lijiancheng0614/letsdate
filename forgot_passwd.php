<?php
require_once("include.php");
session_start();
if (isset($_POST['email'])){
  $email = $_POST['email'];
}
try{
  if (!valid_email($email)){
    $_SESSION['error'] = "邮箱格式不对！";
    header("location:forgot_form.php");
  }
  else{
    $password = reset_password($email);
    notify_password($email, $password);
    $_SESSION['log'] = "密码已发到邮箱！请尽快修改！";
    header("location:loading.php");
  }
}
catch (Exception $e){
  $_SESSION['email'] = $email;
  $_SESSION['error'] = $e->getMessage();
  header("location:forgot_form.php");
}
?>
