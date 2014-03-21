<?php ob_start();
session_start();
require_once('include.php');
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
  $date_array = get_mydate($email);
}
else{
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
  exit();
}
do_html_header('发起的聚会');
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
        <h2>发起的聚会</h2>
        <br/>
        <?php
        do_html_table();
        ?>
        <p class="pull-right">
          共
          <?php
          do_html_table($date_array);
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