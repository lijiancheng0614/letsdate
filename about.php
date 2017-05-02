<?php ob_start();
session_start();
require_once('include.php');
do_html_header('关于');
?>
<style type="text/css">
  ol, p {
    font-size: 16px;
  }

  ol li {
    line-height: 200%;
  }
</style>
<div class="container well" style="max-width: 72%; margin: 0 auto 20px;">

  <h2>关于</h2>

  <hr/>

  <h3>网站理念</h3>

  <p>Let's Date主要面向经常需要管理聚会、会议、约会等人群。</p>

  <p>整个网站简单直接，方便实用，这将是我们不懈的追求。</p>

  <br/>

  <h3>网站特色</h3>

  <ol>
    <li>网站简洁、直观。支持不同设备的访问。</li>
    <li>
      方便管理，一键排序，并能记住上一次排序的关键字。
    </li>
    <li>
      简单明了的聚会信息，让你一下能找到你发起的聚会以及受邀请的聚会。
      <br/>
      <code>侧边栏让人感觉很方便实用呢~</code>
    </li>
    <li>
      还有推荐的聚会让你不再空虚！
      <br/>
      <code>让你更快知道你的朋友最近都在参加什么聚会！</code>
    </li>
    <li>
      方便的编辑、搜索功能，想找什么找什么！
    </li>
    <li>
      清晰看到用户资料，并支持html语言的简介。
      如：
      <br/>
      <code>
        试试在简介中输入&lt;a href="http://lijiancheng0614.github.io/"&gt;
        我的网站
        &lt;/a&gt;
      </code>
    </li>
  </ol>

  <br/>

  <h3>联系我</h3>

  <p>Jiancheng Li</p>

  <p>email: lijiancheng0614@gmail.com</p>

  <p>blog:
    <a href="http://lijiancheng0614.github.io/">
      http://lijiancheng0614.github.io/
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
