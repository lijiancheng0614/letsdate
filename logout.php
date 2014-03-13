<?php
require_once('include.php');
session_start();
if (isset($_SESSION['valid_user'])){
  $old_user = $_SESSION['valid_user'];
  unset($_SESSION['valid_user']);
  $_SESSION['log'] = "退出成功！";
  header("location:loading.php");
}
else{
  $_SESSION['log'] = "您还没有登录！";
  header("location:loading.php");
}
?>
