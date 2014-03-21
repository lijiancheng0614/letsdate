<?php ob_start();
session_start();
require_once('include.php');
if (isset($_POST['email']) && isset($_POST['passwd'])){
  $email = $_POST['email'];
  $passwd = $_POST['passwd'];
  try{
    login($email, $passwd);
    $_SESSION['valid_user'] = $email;
  }
  catch (Exception $e){
    $_SESSION['email'] = $email;
    $_SESSION['error'] = $e->getMessage();
    header("location:login.php");
    exit();
  }
}
do_html_header('首页');
?>
<div class="hero-unit">
  <h1>Let's Date!</h1>
  <br/>

  <p>组织聚会总是烦于统计吗？</p>

  <p>总是找不到一个平台吗？</p>

  <p>想聚会找不到小伙伴吗？</p>

  <p>使用我们的网站吧！让我们一起聚会吧~</p>
  <?php
  if (isset($_SESSION['valid_user'])){
    ?>
    <p><a href="add_date_form.php" class="btn btn-primary btn-large">新的聚会！</a></p>
  <?php
  }
  else{
    ?>
    <p><a href="register_form.php" class="btn btn-primary btn-large">立刻注册！</a></p>
  <?php
  }
  ?>
</div>

<div class="row">
  <div class="span4">
    <h2>直观的数据</h2>

    <p>直观清晰的表格</p>
  </div>
  <div class="span4">
    <h2>简洁的网站</h2>

    <p>简单直接，方便实用。</p>
  </div>
  <div class="span4">
    <h2>方便的管理</h2>

    <p>一键统计、一键排序。</p>
  </div>
</div>
<?php
do_html_footer();
?>
