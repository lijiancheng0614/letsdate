<?php
require_once('db.php');

function get_date_detail($id)
{
  $conn = db_connect();
  $result = $conn->query("select * from date
                          where id='".$id."'");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    throw false;
  return $result->fetch_row();
}

function get_date_member($id)
{
  $conn = db_connect();
  $result = $conn->query("select * from datemember
                          where id='".$id."'");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    return array();
  $member_array = array();
  for ($count = 1; $row = $result->fetch_row(); ++$count){
    $member_array[$count] = $row[1];
  }
  return $member_array;
}

function get_date($email)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    throw false;
  $result = $conn->query("select * from date
                          where useremail='".$email."'");
  //order by endtime desc");
  if (!$result){
    throw false;
  }
  $date_array = array();
  for ($count = 1; $row = $result->fetch_row(); ++$count){
    $date_array[$count] = $row[0];
  }
  $result = $conn->query("select id from datemember
                          where useremail='".$email."'");
  for (; $row = $result->fetch_row(); ++$count){
    $date_array[$count] = $row[0];
  }
  return array_unique($date_array);
}

function get_mydate($email)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    throw false;
  $result = $conn->query("select id from date
                          where useremail='".$email."'");
  if (!$result){
    throw false;
  }
  $date_array = array();
  for ($count = 1; $row = $result->fetch_row(); ++$count){
    $date_array[$count] = $row[0];
  }
  return $date_array;
}

function get_invited_date($email)
{
  $date = get_date($email);
  $mydate = get_mydate($email);
  return array_diff($date, $mydate);
}

function add_date($email, $title, $begintime, $endtime, $location, $bulletin, $member)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    throw false;
  $result = $conn->query("select max(id) from date");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    throw false;
  $row = $result->fetch_row();
  $id = $row[0] + 1;
  $result = $conn->query("insert into date values
                          (".$id.", '".$title."', '"
    .$email."', '"
    .$begintime."', '"
    .$endtime."', '"
    .$location."', '"
    .$bulletin."')");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  foreach ($member as $obj){
    $result = $conn->query("insert into datemember values
                          (".$id.", '"
      .$obj."')");
    if (!$result){
      throw new Exception('抱歉，请重新再试！');
    }
  }
  return $id;
}

function update_date($id, $email, $title, $begintime, $endtime, $location, $bulletin, $member)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    throw false;
  $result = $conn->query("update date
                          set
                          title = '".$title."',
                          begintime = '".$begintime."',
                          endtime = '".$endtime."',
                          location = '".$location."',
                          bulletin = '".$bulletin."'
                          where id = ".$id);
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  $result = $conn->query("delete from datemember
                          where id = ".$id);
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  foreach ($member as $obj){
    $result = $conn->query("insert into datemember values
                          (".$id.", '"
      .$obj."')");
    if (!$result){
      throw new Exception('抱歉，请重新再试！');
    }
  }
  return $id;
}

function delete_date($id)
{
  $conn = db_connect();
  $result = $conn->query("delete from datemember
                          where id = ".$id);
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  $result = $conn->query("delete from date
                          where id = ".$id);
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  return true;
}

function search_date($keywords)
{
  $conn = db_connect();
  $result = $conn->query("select id from date
                          where title like '%".$keywords."%' or
                          location like '%".$keywords."%' or
                          bulletin like '%".$keywords."%'");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows == 0)
    return array();
  $id_array = array();
  for ($count = 1; $row = $result->fetch_row(); ++$count){
    $id_array[$count] = $row[0];
  }
  return $id_array;
}

function recommand_date($email)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    throw false;
  $result = $conn->query("select id from date where useremail in
                          (select d2.useremail from datemember d1, datemember d2
                          where d1.id=d2.id and d1.useremail!=d2.useremail
                          and d1.useremail='".$email."')");
  if (!$result){
    throw false;
  }
  $date_array = array();
  for ($count = 1; $row = $result->fetch_row(); ++$count){
    $date_array[$count] = $row[0];
  }
  $date = get_date($email);
  return array_diff($date_array, $date);
}

?>