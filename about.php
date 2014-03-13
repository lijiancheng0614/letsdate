<?php
require_once('include.php');
session_start();
do_html_header('关于');
?>
<style type="text/css">
  p {
    font-size: 16px;
  }
</style>
<div class="container well" style="max-width: 72%; margin: 0 auto 20px;">
  <h2>关于</h2>
  <hr/>

  <h3>网站理念</h3>

  <p>Let's Date主要面向经常需要管理聚会、会议、约会等人群。</p>

  <p>整个网站简单直接，方便实用，这将是我们不懈的追求。</p>
  <br/>

  <h3>联系我</h3>

  <p>LiJiancheng</p>

  <p>email: lijiancheng0614@gmail.com</p>

  <p>blog:
    <a href="http://blog.sina.com.cn/lijiancheng5201314">
      http://blog.sina.com.cn/lijiancheng5201314
    </a>
  </p>
  <br/>

  <h3>更新日志</h3>

  <p>2013.3.13 Beta版运行</p>
  <br/>

</div>
<?php
do_html_footer();
?>
