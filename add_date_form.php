<?php
require_once('include.php');
session_start();
if (!isset($_SESSION['valid_user'])){
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
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

          <div class="control-group">
            <label class="control-label span2" for="title">聚会名称</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="title" name="title" placeholder="聚会名称"
                <?php
                if (isset($_SESSION['title'])){
                  echo 'value="';
                  echo $_SESSION['title'];
                  echo '"';
                }
                ?>
                     required autofocus>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="begintime">开始时间</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="begintime" name="begintime"
                     required>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="endtime">结束时间</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="endtime" name="endtime"
                >
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="location">聚会地点</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="location" name="location">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="bulletin">公告/备注</label>

            <div class="controls">
              <textarea rows="4" class="span9"
                        id="bulletin" name="bulletin" placeholder=""></textarea>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="member">
              成员
            </label>

            <div class="controls">
              <textarea rows="8" class="span9"
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

<?php
do_html_footer();
?>