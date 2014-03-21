<?php ob_start();
session_start();
require_once('include.php');
if (isset($_GET['id'])){
  $id = $_GET['id'];
}
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
}
$date = get_date_detail($id);
if ($date['useremail'] != $email){
  $_SESSION['error'] = "抱歉！您不是该聚会的发起者！";
  header("location:date_detail.php?id=".$id);
  exit();
}
try{
  delete_date($id);
  $_SESSION['success'] = "删除成功！";
  header("location:date.php");
  exit();
}
catch (Exception $e){
  $_SESSION['error'] = $e->getMessage();
  header("location:date_detail.php?id=".$id);
  exit();
}
?>
