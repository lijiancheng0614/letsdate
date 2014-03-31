<?php ob_start();
session_start();
require_once('include.php');
if (isset($_GET['dateid'])){
  $dateid = $_GET['dateid'];
}
if (isset($_GET['id'])){
  $id = $_GET['id'];
}
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
}
else{
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
  exit();
}
try{
  delete_date_comment($id, $email);
  $_SESSION['success'] = "删除成功！";
  header("location:date_detail.php?id=".$dateid);
  exit();
}
catch (Exception $e){
  $_SESSION['error'] = $e->getMessage();
  header("location:date_detail.php?id=".$dateid);
  exit();
}
?>
