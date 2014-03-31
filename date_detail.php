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
          echo "action='add_date_comment.php?id=";
          echo $id;
          echo "'";
          ?>
        >
          <div class="row-fluid">
            <h2 class="span9">聚会详情</h2>
            <?php
            if ($email == $date['useremail']){
              ?>
              <br/>
              <div class="span3">
                
                <a class="pull-right btn btn-primary"
                  <?php
                  echo "href='date_edit.php?id=";
                  echo $id;
                  echo "'";
                  ?>
                >
                &nbsp;编辑&nbsp;
                </a>
                
              </div>
            <?php
            }
            ?>
          </div>
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
                <?php
                echo $date['title'];
                ?>
              </dd>
            </dl>

            <dl class="dl-horizontal span6">
              <dt class="span4">开始时间</dt>
              <dd class="span8">
                <?php
                echo $date['begintime'];
                ?>
              </dd>
            </dl>

          </div>

          <div class="row-fluid">

            <dl class="dl-horizontal span6">
              <dt class="span4">聚会地点</dt>
              <dd class="span8">
                <?php
                echo $date['location'];
                ?>
              </dd>
            </dl>

            <dl class="dl-horizontal span6">
              <dt class="span4">结束时间</dt>
              <dd class="span8">
                <?php
                echo $date['endtime'];
                ?>
              </dd>
            </dl>

          </div>

          <div class="row-fluid">

            <dl class="dl-horizontal">
              <dt class="span2">公告/备注</dt>
              <dd class="span9">
                <pre><?php
                  echo $date['bulletin'];
                  ?></pre>
              </dd>
            </dl>

          </div>

          <div class="row-fluid">

            <dl class="dl-horizontal">
              <dt class="span2">成员</dt>
              <dd class="span9">
                <pre><?php
                  $member_array = get_date_member($id);
                  foreach ($member_array as $member){
                    $useremail = $member['useremail'];
                    $detail = get_user_detail($useremail);
                    if ($detail){
                      echo "<a href='user_detail.php?user=";
                      echo $useremail;
                      echo "'>";
                      echo $detail['name'];
                      echo " ($useremail)";
                      echo "</a>\n";
                    }
                    else{
                      echo $useremail."\n";
                    }
                  }
                  ?></pre>
              </dd>
            </dl>

          </div>


          <div class="row-fluid">

            <dl class="dl-horizontal">
              <dt class="span2">评论</dt>
              <dd class="span9">
                <pre><?php
                  $comment_array = get_date_comment($id);
                  foreach ($comment_array as $comment){
                    $useremail = $comment['useremail'];
                    $detail = get_user_detail($useremail);
                    echo "<blockquote>";
                    echo "<p>";
                    echo $comment['comment'];
                    echo "</p>";
                    echo "<small>";
                    echo "<a href='user_detail.php?user=";
                    echo $useremail;
                    echo "'>";
                    echo $detail['name'];
                    echo "</a>  ";
                    echo $comment['time'];
                    if ($useremail == $email){
                      echo " <a href='delete_date_comment.php?dateid=";
                      echo $id;
                      echo "&id=";
                      echo $comment['id'];
                      echo "'>";
                      echo "删除";
                      echo "</a>";
                    }
                    echo "</small>";
                    echo "</blockquote>";
                  }
                  ?></pre>
              </dd>
            </dl>

          </div>

          <div class="row-fluid">

            <dl class="dl-horizontal">
              <dt class="span2"></dt>
              <dd class="span9">
                <textarea rows="4" class="span12"
                          id="new_comment" name="new_comment"
                          placeholder="发表我的评论"></textarea>
              </dd>
            </dl>
              
              <button class="offset3 btn btn-large btn-primary" type="submit">
                &nbsp;发表评论&nbsp;
              </button>

          </div>

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