<?php ob_start();
session_start();
require_once('include.php');
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
}
else{
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
  exit();
}
if (isset($_POST['new_comment'])){
  $new_comment = $_POST['new_comment'];
}
if (isset($_GET['id'])){
  $id = $_GET['id'];
}
try{
  add_date_comment($id, $email, $new_comment, date('Y-m-d H:i:s'));
  $_SESSION['success'] = "评论成功！";
  header("location:date_detail.php?id=".$id);
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
  exit();
}
catch (Exception $e){
  $_SESSION['error'] = $e->getMessage();
  header("location:date_detail.php?id=".$id);
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");
  exit();
}
?>
