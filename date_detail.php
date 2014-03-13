<?php
require_once('include.php');
session_start();
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
}
else{
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
}
if (isset($_GET['id'])){
  $id = $_GET['id'];
}
$date = get_date_detail($id);
do_html_header($date[1]);
?>

  <div class="container">
    <div class="row-fluid">
      <div class="span9">
        <form class="form-horizontal well"
              method="post"
          <?php
          echo "action='update_date.php?id=";
          echo $id;
          echo "'";
          ?>
          >
          <h2>聚会详情</h2>
          <br/>
          <?php if (isset($_SESSION['error'])){
            echo '<div class="alert alert-error">';
            echo $_SESSION['error'];
            echo "</div>";
            unset($_SESSION['error']);
          } ?>
          <?php if (isset($_SESSION['success'])){
            echo '<div class="alert alert-success">';
            echo $_SESSION['success'];
            echo "</div>";
            unset($_SESSION['success']);
          } ?>

          <div class="control-group">
            <label class="control-label span2" for="title">聚会名称</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="title" name="title" placeholder="聚会名称"
                <?php
                echo 'value="';
                echo $date[1];
                echo '"';
                ?>
                     required>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="begintime">开始时间</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="begintime" name="begintime"
                <?php
                echo 'value="';
                echo $date[3];
                echo '"';
                ?>
                     required>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="endtime">结束时间</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="endtime" name="endtime"
                <?php
                echo 'value="';
                echo $date[4];
                echo '"';
                ?>
                >
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="location">聚会地点</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="location" name="location"
                <?php
                echo 'value="';
                echo $date[5];
                echo '"';
                ?>
                >
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="bulletin">公告/备注</label>

            <div class="controls">
              <textarea rows="4" class="span9"
                        id="bulletin" name="bulletin" placeholder=""><?php
                echo $date[6];
                ?></textarea>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="member">
              成员
            </label>

            <div class="controls">
              <textarea rows="8" class="span9"
                        id="member" name="member" placeholder="一行一个成员"><?php
                $member_array = get_date_member($id);
                foreach ($member_array as $member){
                  echo "$member\n";
                }
                ?></textarea>
            </div>
          </div>
          <?php
          if ($email == $date[2]){
            ?>
            <br/>
            <button class="offset3 btn btn-large btn-warning" type="submit">
              &nbsp;修改&nbsp;
            </button>
            <a class="offset1 btn btn-large btn-danger"
              <?php
              echo "href='delete_date.php?id=";
              echo $id;
              echo "'";
              ?>
              >
              &nbsp;删除&nbsp;
            </a>
          <?php
          }
          ?>
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