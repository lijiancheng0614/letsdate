<?php
function db_connect()
{
  $result = new mysqli('localhost', 'admin', 'passwd', 'letsdate');
  if (!$result){
    throw new Exception('无法连接到数据库服务器！');
  }
  else{
    return $result;
  }
}

?>
