<?php ob_start();
session_start();
require_once('include.php');
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
  $date_array = get_invited_date($email);
}
else{
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
  exit();
}
do_html_header('受邀的聚会');
?>
  <script type="text/javascript">
    var n = 0;
    function sortTable(tableID, iCol) {
      var oTable = document.getElementById(tableID);
      var oTbody = oTable.tBodies[0];
      var oRows = oTbody.rows;

      var arr = new Array();
      for (var i = 0; i < oRows.length; i++) arr.push(oRows[i]);
      if (oTable.sortCol == iCol) arr.reverse();
      else {
        if (n % 2 == 0) arr.sort(compare(iCol, 1));
        else if (n % 2 == 1) arr.sort(compare(iCol, -1));
      }

      var oFragment = document.createDocumentFragment();
      for (var i = 0; i < arr.length; i++) oFragment.appendChild(arr[i]);
      oTbody.appendChild(oFragment);
      oTable.sortCol = iCol;
    }
    ;

    function compare(iCol, direction) {
      return function compare(row1, row2) {
        var value1 = row1.cells[iCol].innerHTML;
        var value2 = row2.cells[iCol].innerHTML;
        return direction * value1.localeCompare(value2);
      };
    }
    ;
  </script>

  <div class="container">
    <?php if (isset($_SESSION['success'])){
      echo '<div class="alert alert-success">';
      echo $_SESSION['success'];
      echo "</div>";
      unset($_SESSION['success']);
    } ?>
    <div class="row-fluid">
      <div class="span9">
        <h2>受邀的聚会</h2>
        <br/>
        <table id="contestTable" sortCol="-1"
               class="table table-hover table-bordered">
          <thead>
          <tr>
            <th onClick="sortTable('contestTable',0)" style="cursor:pointer">聚会名称</th>
            <th onClick="sortTable('contestTable',1)" style="cursor:pointer">开始时间</th>
            <th onClick="sortTable('contestTable',2)" style="cursor:pointer">结束时间</th>
            <th onClick="sortTable('contestTable',3)" style="cursor:pointer">地点</th>
            <th onClick="sortTable('contestTable',4)" style="cursor:pointer">发起人</th>
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
            echo $obj['useremail'];
            echo "</td>\n";
            //var_dump($obj);
            echo "</tr>\n";
          }
          ?>
          </tbody>
        </table>
        <p class="pull-right">
          共
          <?php
          echo count($date_array);
          ?>
          个聚会&nbsp;
        </p>
      </div>

      <?php
      do_html_sidebar();
      ?>
    </div>
  </div>

<?php
do_html_footer();
?>