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
  return $result->fetch_assoc();
}

function get_date_member($id)
{
  $conn = db_connect();
  $result = $conn->query("select useremail from datemember
                          where id='".$id."'");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    return array();
  return $result;
}

function get_date($email)
{
  $conn = db_connect();
  $result = $conn->query("select * from user
                          where email='".$email."'");
  if (!$result){
    return array();
  }
  if ($result->num_rows == 0)
    return array();
  $result = $conn->query("select * from date
                          where useremail='".$email."'");
  //order by endtime desc");
  if (!$result){
    return array();
  }
  $date_array = array();
  for ($count = 1; $row = $result->fetch_assoc(); ++$count){
    $date_array[$count] = $row['id'];
  }
  $result = $conn->query("select id from datemember
                          where useremail='".$email."'");
  for (; $row = $result->fetch_assoc(); ++$count){
    $date_array[$count] = $row['id'];
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
  for ($count = 1; $row = $result->fetch_assoc(); ++$count){
    $date_array[$count] = $row['id'];
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
  $row = $result->fetch_assoc();
  $id = $row['max(id)'] + 1;
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
  $result = $conn->query("select * from date
                          where id = ".$id);

  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows == 0)
    throw new Exception('抱歉，请重新再试！');
  $row = $result->fetch_assoc();

  if ($row['useremail'] != $email)
    throw new Exception('抱歉！您不能删除该聚会！');


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
    return array();
  }
  if ($result->num_rows == 0)
    return array();
  $date_array = array();
  for ($count = 1; $row = $result->fetch_assoc(); ++$count){
    $date_array[$count] = $row['id'];
  }
  return $date_array;
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
  for ($count = 1; $row = $result->fetch_assoc(); ++$count){
    $date_array[$count] = $row['id'];
  }
  $date = get_date($email);
  return array_diff($date_array, $date);
}

function add_date_comment($dateid, $useremail, $comment, $time)
{
  $conn = db_connect();
  $result = $conn->query("select * from date
                          where id='".$dateid."'");
  if (!$result){
    return false;
  }
  if ($result->num_rows == 0)
    return false;

  $result = $conn->query("select max(id) from datecomment");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows == 0)
    throw new Exception('抱歉，请重新再试！');

  $row = $result->fetch_assoc();
  $id = $row['max(id)'] + 1;

  $result = $conn->query("insert into datecomment values
                          (".$id.", ".$dateid.
                            ", '".$useremail.
                            "', '".$comment.
                            "', '".$time."')");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  return true;
}

function update_date_comment($id, $comment)
{
  $conn = db_connect();
  $result = $conn->query("select * from datecomment
                          where id='".$id."'");
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows == 0)
    throw new Exception('抱歉，请重新再试！');

  $result = $conn->query("update into datecomment
                          set
                          comment = '".$comment."'
                          where id = ".$id);
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  return true;
}

function delete_date_comment($id, $email)
{
  $conn = db_connect();
  $result = $conn->query("select * from datecomment
                          where id = ".$id);

  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  if ($result->num_rows == 0)
    throw new Exception('抱歉，请重新再试！');
  $row = $result->fetch_assoc();

  if ($row['useremail'] != $email)
    throw new Exception('抱歉！您不能删除该评论！');

  $result = $conn->query("delete from datecomment
                          where id = ".$id);
  if (!$result){
    throw new Exception('抱歉，请重新再试！');
  }
  return true;
}

function get_date_comment($dateid)
{
  $conn = db_connect();
  $result = $conn->query("select * from datecomment
                          where dateid='".$dateid."'");
  if (!$result){
    throw false;
  }
  if ($result->num_rows == 0)
    return array();
  return $result;
}

?>