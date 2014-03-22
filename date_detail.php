<?php ob_start();
session_start();
require_once('include.php');
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
}
else{
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
  exit();
}
if (isset($_GET['id'])){
  $id = $_GET['id'];
}
$date = get_date_detail($id);
do_html_header($date['title']);
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

          <div class="row-fluid">
            <div class="control-group span6">
              <label class="control-label span3" for="title">聚会名称</label>

              <div class="controls span3">
                <input type="text" class="input-xlarge"
                       id="title" name="title"
                  <?php
                  echo 'value="';
                  echo $date['title'];
                  echo '"';
                  ?>
                       required>
              </div>
            </div>

            <div class="control-group span6">
              <label class="control-label span3" for="begintime">开始时间</label>

              <div class="controls input-append span3 date form_datetime">
                <input type="text" class="input-medium"
                       id="begintime" name="begintime"
                  <?php
                  echo 'value="';
                  echo $date['begintime'];
                  echo '"';
                  ?>
                       required>
                <span class="add-on"><i class="icon-th"></i></span>
              </div>
            </div>
          </div>

          <div class="row-fluid">
            <div class="control-group span6">
              <label class="control-label span3" for="location">聚会地点</label>

              <div class="controls span3">
                <input type="text" class="input-xlarge"
                       id="location" name="location"
                  <?php
                  echo 'value="';
                  echo $date['location'];
                  echo '"';
                  ?>
                  >
              </div>
            </div>

            <div class="control-group span6">
              <label class="control-label span3" for="endtime">结束时间</label>

              <div class="controls input-append span3 date form_datetime">
                <input type="text" class="input-medium"
                       id="endtime" name="endtime"
                  <?php
                  echo 'value="';
                  echo $date['endtime'];
                  echo '"';
                  ?>
                  >
                <span class="add-on"><i class="icon-th"></i></span>
              </div>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="bulletin">公告/备注</label>

            <div class="controls span10">
              <textarea rows="4" class="span10"
                        id="bulletin" name="bulletin" placeholder=""><?php
                echo $date['bulletin'];
                ?></textarea>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="member">
              成员
            </label>

            <div class="controls span10">
              <textarea rows="8" class="span10"
                        id="member" name="member" placeholder="一行一个成员"><?php
                $member_array = get_date_member($id);
                foreach ($member_array as $member){
                  echo $member['useremail']."\n";
                }
                ?></textarea>
            </div>
          </div>

          <?php
          if ($email == $date['useremail']){
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