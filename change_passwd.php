<?php
require_once('include.php');
session_start();
if (isset($_POST['old_passwd']) && isset($_POST['new_passwd']) && isset($_POST['new_passwd2'])){
  $old_passwd = $_POST['old_passwd'];
  $new_passwd = $_POST['new_passwd'];
  $new_passwd2 = $_POST['new_passwd2'];
}
try{
  if ($new_passwd != $new_passwd2){
    $_SESSION['error'] = "请输入相同新密码！";
    header("location:change_passwd_form.php");
  }
  else{
    change_password($_SESSION['valid_user'], $old_passwd, $new_passwd);
    $_SESSION['log'] = "修改成功！";
    header("location:loading.php");
  }
}
catch (Exception $e){
  $_SESSION['error'] = $e->getMessage();
  header("location:change_passwd_form.php");
}
?>
