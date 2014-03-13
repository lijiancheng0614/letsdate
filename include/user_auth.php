<?php
require_once('db.php');
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

function notify_password($username, $password)
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
  $from = "From: admin@letsdate.com\r\n";
  $mesg = "您的新密码为".$password."\r\n"
    ."请尽快修改\r\n";

  if (mail($email, "Let's Date 重置密码", $mesg, $from)){
    return true;
  }
  else{
    throw new Exception('抱歉，不能发送邮件！');
  }
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

function get_phone($email)
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
  return $row->phone;
}

function update_profile($email, $username, $phone)
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
                            phone = '".$phone."'
                            where email = '".$email."'");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  else{
    return true;
  }
}

?>