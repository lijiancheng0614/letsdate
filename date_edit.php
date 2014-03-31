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

            <dl class="dl-horizontal span6">
              <dt class="span4">聚会名称</dt>
              <dd class="span8">
                <input type="text" class="input-xlarge"
                       id="title" name="title"
                  <?php
                  echo 'value="';
                  echo $date['title'];
                  echo '"';
                  ?>
                       required>
              </dd>
            </dl>

            <dl class="dl-horizontal span6">
              <dt class="span4">开始时间</dt>
              <dd class="span8 input-append date form_datetime">
                <input type="text" class="input-medium"
                       id="begintime" name="begintime"
                  <?php
                  echo 'value="';
                  echo $date['begintime'];
                  echo '"';
                  ?>
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
                  <?php
                  echo 'value="';
                  echo $date['location'];
                  echo '"';
                  ?>
                  >
              </dd>
            </dl>

            <dl class="dl-horizontal span6">
              <dt class="span4">结束时间</dt>
              <dd class="span8 input-append date form_datetime">
                <input type="text" class="input-medium"
                       id="endtime" name="endtime"
                  <?php
                  echo 'value="';
                  echo $date['endtime'];
                  echo '"';
                  ?>
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
                          id="bulletin" name="bulletin"><?php
                  echo $date['bulletin'];
                  ?></textarea>
              </dd>
            </dl>

          </div>

          <div class="row-fluid">

            <dl class="dl-horizontal">
              <dt class="span2">成员</dt>
              <dd class="span9">
                <textarea rows="8" class="span12"
                          id="member" name="member" placeholder="一行一个成员邮箱"><?php
                  $member_array = get_date_member($id);
                  foreach ($member_array as $member){
                    echo $member['useremail']."\n";
                  }
                  ?></textarea>
              </dd>
            </dl>

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