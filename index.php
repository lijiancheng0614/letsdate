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

<style type="text/css">
  @-webkit-keyframes mac-scroll {
    0% {
      -webkit-transform: translate3d(0, 0, 0)
    }
    100% {
      -webkit-transform: translate3d(0, -200px, 0)
    }
  }

  @keyframes mac-scroll {
    0% {
      transform: translate3d(0, 0, 0)
    }
    100% {
      transform: translate3d(0, -200px, 0)
    }
  }

  .scroll-image {
    background: url(img/figure_1_inside.png);
    background-repeat: repeat-y;
    width: 230px;
    height: 580px;
    margin-left: 17px;
    -webkit-animation: mac-scroll 5s linear infinite;
    animation: mac-scroll 5s linear infinite
  }

  .figure_1 .mac-frame {
    width: 264px;
    height: 165px;
    position: relative;
    left: 53px;
    top: 17px;
    background: #fff;
    overflow: hidden
  }

  .figure_1 {
    width: 370px;
    height: 220px;
    background-image: url(img/figure_1.png);
  }

  .figure_2 {
    width: 370px;
    height: 220px;
    background-image: url(img/figure_2.png);
  }

  @-webkit-keyframes del-scroll {
    0% {
      -webkit-transform: translate3d(0, 0, 0)
    }
    50% {
      -webkit-transform: translate3d(-100%, 0, 0)
    }
    100% {
      -webkit-transform: translate3d(-100%, 0, 0)
    }
  }

  @keyframes del-scroll {
    0% {
      transform: translate3d(0, 0, 0)
    }
    50% {
      transform: translate3d(-100%, 0, 0)
    }
    100% {
      transform: translate3d(-100%, 0, 0)
    }
  }

  @-webkit-keyframes shift-scroll {
    0% {
      -webkit-transform: translate3d(0, 0, 0)
    }
    50% {
      -webkit-transform: translate3d(0, 0, 0)
    }
    100% {
      -webkit-transform: translate3d(0, -100%, 0)
    }
  }

  @keyframes shift-scroll {
    0% {
      transform: translate3d(0, 0, 0)
    }
    50% {
      transform: translate3d(0, 0, 0)
    }
    100% {
      transform: translate3d(0, -100%, 0)
    }
  }

  .scroll-del {
    -webkit-animation: del-scroll 2s linear infinite;
    animation: del-scroll 2s linear infinite;
  }

  .scroll-shift {
    -webkit-animation: shift-scroll 2s linear infinite;
    animation: shift-scroll 2s linear infinite;
  }

  .figure_3 .frame {
    width: 264px;
    height: 165px;
    position: relative;
    left: 53px;
    top: 34px;
    overflow: hidden
  }

  .figure_3 {
    width: 370px;
    height: 220px;
  }
</style>
<div class="row">
  <div class="span4">
    <h2>直观的数据</h2>

    <p>直观清晰的表格。</p>

    <p>快速获取资料。</p>

    <div class="figure_1">
      <div class="mac-frame">
        <div class="scroll-image" data-animate=""></div>
      </div>
    </div>
  </div>
  <div class="span4">
    <h2>简洁的网站</h2>

    <p>简单直接，方便实用。</p>

    <p>支持多平台访问。</p>

    <div class="figure_2">
    </div>
  </div>
  <div class="span4">
    <h2>方便的管理</h2>

    <p>一键统计、一键排序。</p>

    <p>批量处理你的聚会。</p>

    <div class="figure_3">
      <div class="frame">
        <table class="table table-">
          <thead>
            <tr>
              <th>#</th>
              <th>■■■</th>
              <th>■■■</th>
              <th>■■■</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>■■■</td>
              <td>■■■</td>
              <td>■■■</td>
            </tr>
            <tr class="scroll-del">
              <td>2</td>
              <td>■■■</td>
              <td>■■■</td>
              <td>■■■</td>
            </tr>
            <tr class="scroll-shift">
              <td>3</td>
              <td>■■■</td>
              <td>■■■</td>
              <td>■■■</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
do_html_footer();
?>
