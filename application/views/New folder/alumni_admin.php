<style type="text/css" >
  table td{
    vertical-align:top;
  }
.sortable td{ word-wrap:break-word; width:150px;text-align:right; }
.request{width:50px;}  
.sortable{width:100%}
</style>
<div style='text-align:center'>
<?php
echo form_open_multipart('admin/upload_file');
  echo form_upload('alumni_file');
  echo form_submit('','upload');
echo form_close();
?>
