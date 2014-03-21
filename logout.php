<?php ob_start();
session_start();
require_once('include.php');
if (isset($_SESSION['valid_user'])){
  $old_user = $_SESSION['valid_user'];
  unset($_SESSION['valid_user']);
  $_SESSION['log'] = "退出成功！";
  header("location:loading.php");
  exit();
}
else{
  $_SESSION['log'] = "您还没有登录！";
  header("location:loading.php");
  exit();
}
?>
