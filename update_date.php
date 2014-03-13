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
  update_date($id, $email, $title, $begintime, $endtime, $location, $bulletin, $member);
  $_SESSION['success'] = "修改成功！";
  header("location:date_detail.php?id=".$id);
}
catch (Exception $e){
  $_SESSION['error'] = $e->getMessage();
  header("location:date_detail.php?id=".$id);
}
?>
