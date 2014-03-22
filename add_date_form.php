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
            <div class="control-group span6">
              <label class="control-label span3" for="title">聚会名称</label>

              <div class="controls span3">
                <input type="text" class="input-xlarge"
                       id="title" name="title" required>
              </div>
            </div>

            <div class="control-group span6">
              <label class="control-label span3" for="begintime">开始时间</label>

              <div class="controls input-append span3 date form_datetime">
                <input type="text" class="input-medium"
                       id="begintime" name="begintime" required>
                <span class="add-on"><i class="icon-th"></i></span>
              </div>
            </div>
          </div>

          <div class="row-fluid">
            <div class="control-group span6">
              <label class="control-label span3" for="location">聚会地点</label>

              <div class="controls span3">
                <input type="text" class="input-xlarge"
                       id="location" name="location">
              </div>
            </div>

            <div class="control-group span6">
              <label class="control-label span3" for="endtime">结束时间</label>

              <div class="controls input-append span3 date form_datetime">
                <input type="text" class="input-medium"
                       id="endtime" name="endtime">
                <span class="add-on"><i class="icon-th"></i></span>
              </div>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="bulletin">公告/备注</label>

            <div class="controls span10">
              <textarea rows="4" class="span10"
                        id="bulletin" name="bulletin" placeholder=""></textarea>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="member">
              成员
            </label>

            <div class="controls span10">
              <textarea rows="8" class="span10"
                        id="member" name="member" placeholder="一行一个成员"></textarea>
            </div>
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