<?php ob_start();
session_start();
require_once('include.php');
if (!isset($_SESSION['valid_user'])){
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
  exit();
}
do_html_header('新的聚会');
?>

  <div class="container">
    <div class="row-fluid">
      <div class="span9">
        <form class="form-horizontal well"
              method="post" action="add_date.php">
          <h2>新的聚会</h2>
          <br/>
          <?php if (isset($_SESSION['error'])){
            echo '<div class="alert alert-error">';
            echo $_SESSION['error'];
            echo "</div>";
            unset($_SESSION['error']);
          } ?>

          <div class="row-fluid">

            <dl class="dl-horizontal span6">
              <dt class="span4">聚会名称</dt>
              <dd class="span8">
                <input type="text" class="input-xlarge"
                       id="title" name="title"
                       required>
              </dd>
            </dl>

            <dl class="dl-horizontal span6">
              <dt class="span4">开始时间</dt>
              <dd class="span8 input-append date form_datetime">
                <input type="text" class="input-medium"
                       id="begintime" name="begintime"
                       required>
                <span class="add-on"><i class="icon-th"></i></span>
              </dd>
            </dl>

          </div>

          <div class="row-fluid">
            <dl class="dl-horizontal span6">
              <dt class="span4">聚会地点</dt>
              <dd class="span8">
                <input type="text" class="input-xlarge"
                       id="location" name="location"
                  >
              </dd>
            </dl>

            <dl class="dl-horizontal span6">
              <dt class="span4">结束时间</dt>
              <dd class="span8 input-append date form_datetime">
                <input type="text" class="input-medium"
                       id="endtime" name="endtime"
                  >
                <span class="add-on"><i class="icon-th"></i></span>
              </dd>
            </dl>

          </div>

          <div class="row-fluid">

            <dl class="dl-horizontal">
              <dt class="span2">公告/备注</dt>
              <dd class="span9">
                <textarea rows="4" class="span12"
                          id="bulletin" name="bulletin"></textarea>
              </dd>
            </dl>

          </div>

          <div class="row-fluid">

            <dl class="dl-horizontal">
              <dt class="span2">成员</dt>
              <dd class="span9">
                <textarea rows="8" class="span12"
                          id="member" name="member" placeholder="一行一个成员邮箱"></textarea>
              </dd>
            </dl>

          </div>

          <br/>
          <button class="offset3 btn btn-large btn-success" type="submit">
            &nbsp;发起&nbsp;
          </button>
        </form>
      </div>

      <?php
      do_html_sidebar();
      ?>
    </div>
  </div>

  <script type="text/javascript">
    $(".form_datetime").datetimepicker({
      language: 'zh-CN',
      format: "yyyy-MM-dd hh:mm:ss",
      autoclose: 1
    });
  </script>

<?php
do_html_footer();
?>