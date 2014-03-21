<?php
require_once('db.php');

function get_user_detail($email)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    throw false;
  return $result->fetch_assoc();
}

function get_name($email)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows == 0)
    throw new Exception("没有该用户！");
  $row = $result->fetch_object();
  return $row->name;
}

function register($email, $username, $password)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows > 0){
    throw new Exception('抱歉，该邮箱已被使用。');
  }

  $result = $conn->query("insert into user values
                           ('".$email."', '".$username."', sha1('".$password."'))");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  return true;
}

function login($email, $password)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows == 0)
    throw new Exception("没有该用户！");

  $result = $conn->query("select * from user
                           where email='".$email."'
                           and passwd = sha1('".$password."')");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows == 0)
    throw new Exception('密码错误！');

  return true;
}

function change_password($email, $old_password, $new_password)
{
  login($email, $old_password);
  $conn = db_connect();
  $result = $conn->query("update user
                            set passwd = sha1('".$new_password."')
                            where email = '".$email."'");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  else{
    return true;
  }
}

function reset_password($email)
{
  $new_password = md5($email.time());
  $conn = db_connect();
  $result = $conn->query("update user
                            set passwd = sha1('".$new_password."')
                            where email = '".$email."'");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  else{
    return $new_password;
  }
}

function notify_password($email, $password)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows == 0)
    throw new Exception("没有该用户！");
  $row = $result->fetch_object();
  $email = $row->email;
  $from = "From: letsdate_welcome@sina.com\r\n";
  $msg = "您的新密码为".$password."\r\n"
    ."请尽快修改。\r\n"
    ."\r\n"
    ."* 这是一封自动产生的email，请勿回复。\r\n"
    ."您可以通过邮箱 letsdate_welcome@sina.com 联系我们，或者关注我们的新浪微博与我们取得联系。";

  if (mail($email, "Let's Date 重置密码", $msg, $from)){
    return true;
  }
  else{
    throw new Exception('抱歉，不能发送邮件！');
  }
}

function update_profile($email, $username,
  $phone, $is_phone_private,
  $location, $is_location_private,
  $intro, $is_intro_private)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows == 0)
    throw new Exception("没有该用户！");

  $result = $conn->query("update user
                            set name = '".$username."', 
                            phone = '".$phone."', 
                            is_phone_private = ".$is_phone_private.", 
                            location = '".$location."', 
                            is_location_private = ".$is_location_private.", 
                            intro = '".$intro."', 
                            is_intro_private = ".$is_intro_private."
                            where email = '".$email."'");
  if (!$result){
    throw new Exception("update user
                            set name = '".$username."', 
                            phone = '".$phone."', 
                            is_phone_private = ".$is_phone_private.", 
                            location = '".$location."', 
                            is_location_private = ".$is_location_private.", 
                            intro = '".$intro."', 
                            is_intro_private = ".$is_intro_private."
                            where email = '".$email."'".'抱歉，请重新再试！');
  }
  else{
    return true;
  }
}

?>