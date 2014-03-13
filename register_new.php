<?php
require_once('include.php');
session_start();
if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['passwd'])){
  $email = $_POST['email'];
  $username = $_POST['username'];
  $passwd = $_POST['passwd'];
}
try{
  if (!valid_email($email)){
    $_SESSION['username'] = $username;
    $_SESSION['error'] = "邮箱格式不对！";
    header("location:register_form.php");
  }
  else{
    register($email, $username, $passwd);
    $_SESSION['valid_user'] = $email;
    $_SESSION['log'] = "注册成功！";
    header("location:loading.php");
  }
}
catch (Exception $e){
  $_SESSION['username'] = $username;
  $_SESSION['error'] = $e->getMessage();
  header("location:register_form.php");
}
?>
