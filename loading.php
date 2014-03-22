<?php
session_start();
require_once('include.php');
?>
<html>
<head>
  <title>Let's Date</title>
  <meta name="description" content="letsdate">
  <meta http-equiv="Content-Type" content="text/html; charset=unicode">
  <meta name="author" content="LiJiancheng" charset="utf-8">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
  <link rel="stylesheet" type="text/css" href="css/main.css"/>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/scrollUp.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<div class="container maindiv">
  <script language='javascript' type='text/javascript'>
    var secs = 2;
    var URL;
    function Load(url) {
      URL = url;
      for (var i = secs; i >= 0; i--) {
        window.setTimeout('doUpdate(' + i + ')', (secs - i) * 1000);
      }
    }
    function doUpdate(num) {
      document.getElementById('ShowDiv').innerHTML =
        '将在' + num + '秒后跳转...';
      if (num == 0) window.location = URL;
    }
  </script>
  <?php
  if (isset($_SESSION['log'])){
    echo '<p>';
    echo $_SESSION['log'];
    echo "</p>";
    unset($_SESSION['log']);
  }
  ?>
  <div id="ShowDiv"></div>
  <script language="javascript">
    Load("index.php");
  </script>
  <?php
  do_html_footer();
  ?>
