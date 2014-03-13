<?php
require_once('include.php');
session_start();
if (isset($_GET['id'])){
  $id = $_GET['id'];
}
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
}
$date = get_date_detail($id);
if ($date[2] != $email){
  $_SESSION['error'] = "抱歉！您不是该聚会的发起者！";
  header("location:date_detail.php?id=".$id);
  exit;
}
try{
  delete_date($id);
  $_SESSION['success'] = "删除成功！";
  header("location:date.php");
}
catch (Exception $e){
  $_SESSION['error'] = $e->getMessage();
  header("location:date_detail.php?id=".$id);
}
?>
