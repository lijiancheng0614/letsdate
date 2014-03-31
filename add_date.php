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
if (isset($_POST['title'])){
  $title = $_POST['title'];
}
if (isset($_POST['begintime'])){
  $begintime = $_POST['begintime'];
}
if (isset($_POST['endtime'])){
  $endtime = $_POST['endtime'];
}
if (isset($_POST['location'])){
  $location = $_POST['location'];
}
if (isset($_POST['bulletin'])){
  $bulletin = $_POST['bulletin'];
}
if (isset($_POST['member'])){
  $member_list = trim($_POST['member']);
  if ($member_list == ''){
    $member = array();
  }
  else{
    $member = explode("\r\n", $member_list);
    $member = array_unique($member);
  }
}
try{
  add_date($email, $title, $begintime, $endtime, $location, $bulletin, $member);
  $_SESSION['success'] = "发起成功！";
  header("location:date.php");
  exit();
}
catch (Exception $e){
  $_SESSION['error'] = $e->getMessage();
  header("location:add_date_form.php");
  exit();
}
?>
