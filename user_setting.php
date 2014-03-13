<?php
require_once('include.php');
session_start();
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
}
if (isset($_POST['username'])){
  $username = $_POST['username'];
}
if (isset($_POST['phone'])){
  $phone = $_POST['phone'];
}
try{
  update_profile($email, $username, $phone);
  $_SESSION['success'] = "修改成功！";
  header("location:user_setting_form.php");
}
catch (Exception $e){
  $_SESSION['error'] = $e->getMessage();
  header("location:user_setting_form.php");
}
?>
