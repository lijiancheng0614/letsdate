<?php
function do_html_header($title)
{
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Let's Date - <?php echo $title; ?></title>
    <meta name="description" content="letsdate">
    <meta http-equiv="Content-Type" content="text/html; charset=unicode">
    <meta name="author" content="Jiancheng Li" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/scrollUp.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.zh-CN.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
  </head>
  <body>
  <div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
      <div class="container">
        <div class="brand" style="padding:2px">
          <img src="logo.png" alt="logo">
          &nbsp;
        </div>
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="brand" href="index.php">
          Let's Date!</a>

        <div class="nav-collapse collapse">
          <ul class="nav">
            <li
              <?php
              if ($title == "首页") echo 'class="active"';
              ?>
              >
              <a href="index.php">首页</a>
            </li>
            <?php
            if (isset($_SESSION['valid_user'])){
              ?>
              <li
                <?php
                if ($title == "我的聚会") echo 'class="active"';
                ?>
                >
                <a href="date.php">
                  我的聚会
                  <span class="label label-info">
                    <?php
                    echo count(get_date($_SESSION['valid_user']));
                    ?>
                  </span>
                </a>
              </li>
              <li
                <?php
                if ($title == "推荐聚会") echo 'class="active"';
                ?>
                >
                <a href="recommand_date.php">推荐聚会</a>
              </li>
            <?php
            }
            ?>
            <li
              <?php
              if ($title == "关于") echo 'class="active"';
              ?>
              >
              <a href="about.php">关于</a>
            </li>
          </ul>
          <form class="navbar-form form-search span4"
                method="post" action="search_date.php">
            <div class="input-append">
              <input class="search-query span2" type="text"
                     id="keywords" name="keywords" placeholder="搜索聚会...">
              <button class="btn" type="submit">
                <i class="icon-search"></i>
              </button>
            </div>
          </form>
          <?php
          if (isset($_SESSION['valid_user'])){
            ?>
            <ul class="nav pull-right">
              <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">

                  <?php echo get_name($_SESSION['valid_user']); ?>
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="user_setting_form.php">账号设置</a>
                  </li>
                  <li class="divider"></li>
                  <li>
                    <a href="change_passwd_form.php">修改密码</a>
                  </li>
                  <li>
                    <a href="logout.php">退出</a>
                  </li>
                </ul>
              </li>
            </ul>
          <?php
          }
          else do_html_header_login();
          ?>
        </div>
        <!-- /.nav-collapse -->
      </div>
      <!-- /.container -->
    </div>
  </div><!-- /.navbar -->
  <div class="container maindiv">
<?php } ?>

<?php
function do_html_header_login()
{
  ?>
  <form class="navbar-form pull-right">
    <a href="login.php"
       class="btn btn-success">
      登录
    </a>
    <a href="register_form.php"
       class="btn btn-warning">
      注册
    </a>
  </form>
<?php
}

?>

<?php
function do_html_sidebar()
{
  ?>
  <div class="span3">
    <div class="well sidebar-nav">
      <ul class="nav nav-list">
        <!--<li class="nav-header">Sidebar</li>
        <li class="active"><a href="#">Link</a></li>-->
        <li>
          <a href="add_date_form.php">
            新的聚会
          </a>
        </li>
        <li>
          <a href="date.php">所有聚会</a>
        </li>
        <li>
          <a href="invited_date.php">受邀的聚会</a>
        </li>
        <li>
          <a href="mydate.php">发起的聚会</a>
        </li>
      </ul>
    </div>
    <!--/.well -->
  </div>
<?php
}

?>

<?php
function do_html_footer()
{
  ?>
  <a id="scrollUp" href="#top" title="" style="position: fixed; z-index: 2147483647"></a>
  <hr>
  <footer>
    <p class="text-center">Copyrights &copy; <a href="http://lijiancheng0614.github.io/">Jiancheng Li</a> 2014</p>
  </footer>
  </div>
  </body>
  </html>
<?php
}

?>

<?php
function do_html_table($date_array)
{
  ?>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
      $('#data_table').dataTable();
    });
  </script>
  <table id="data_table" class="table table-hover">
    <thead>
    <tr>
      <th>聚会名称</th>
      <th>开始时间</th>
      <th>结束时间</th>
      <th>地点</th>
      <th>发起人</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($date_array as $id){
      $obj = get_date_detail($id);
      echo "<tr>\n";
      echo "  <td>";
      echo "<a href='date_detail.php?id=";
      echo $obj['id'];
      echo "'>";
      echo $obj['title'];
      echo "</a>";
      echo "</td>\n";
      echo "  <td>";
      echo $obj['begintime'];
      echo "</td>\n";
      echo "  <td>";
      echo $obj['endtime'];
      echo "</td>\n";
      echo "  <td>";
      echo $obj['location'];
      echo "</td>\n";
      echo "  <td>";
      echo "<a href='user_detail.php?user=";
      echo $obj['useremail'];
      echo "'>";
      echo $obj['useremail'];
      echo "</a>";
      echo "</td>\n";
      //var_dump($obj);
      echo "</tr>\n";
    }
    ?>
    </tbody>
  </table>
<?php
}

?>