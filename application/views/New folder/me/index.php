<style type="text/css" media="all">
  thead{border:solid}
</style>
<?php
//echo form_open("my_admin/insert")
//  echo form_submit('submit');
//echo form_close();
//var_dump($header);
?>
<table>
<thead>
  <tr>
    <?php foreach ($header[1] as $key=>$value) {
      echo "<td>[$key]";
      //var_dump($value);
      echo $value;
      echo "</td>";
    }
    ?>
  </tr>
</thead>
<tbody>
<?php $i = 0;?>
<input type="check" name="" id="" value="" />
<?php foreach ($staff_arr as $key=>$value) {
  $class = ($i % 2 == 0)? 'even':'odd';
  echo "<tr class='$class'>";
  foreach ($value as $cell) {
    echo "<td>$cell</td>";
  }
  echo "</tr>";
  $i++;
}
?>
</tbody>
</table>
