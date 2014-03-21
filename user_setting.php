<?php ob_start();
session_start();
require_once('include.php');
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
}

if (isset($_POST['username'])){
  $username = $_POST['username'];
}

if (isset($_POST['phone'])){
  $phone = $_POST['phone'];
}
else $phone = '';

if (isset($_POST['location'])){
  $location = $_POST['location'];
}
else $location = '';

if (isset($_POST['intro'])){
  $intro = $_POST['intro'];
}
else $intro = '';

$is_phone_private = 0;
$is_location_private = 0;
$is_intro_private = 0;
if (isset($_POST['checkbox'])){
  $checkbox = $_POST['checkbox'];
  foreach ($checkbox as $key => $value) {
    if ($value == 'is_phone_private') $is_phone_private = true;
    else if ($value == 'is_location_private') $is_location_private = true;
    else if ($value == 'is_intro_private') $is_intro_private = true;
  }
}

try{
  update_profile($email, $username, $phone, $is_phone_private,
    $location, $is_location_private, $intro, $is_intro_private);
  $_SESSION['success'] = "修改成功！";
  header("location:user_setting_form.php");
  exit();
}
catch (Exception $e){
  $_SESSION['error'] = $e->getMessage();
  header("location:user_setting_form.php");
  exit();
}
?>
