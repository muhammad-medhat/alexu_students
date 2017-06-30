<style type="text/css" media="all">
 .sortable td{ 
    word-wrap:break-word; 
    width:150px;
    text-align:right;
}
img{/*
width:200px;
height:100px;
*/}
.even{background-color: #e6f3f8;}  
.odd{background-color: #e1e1e1;}  
.sortable{
  width: 77%;
  margin-right: 144px;
  -webkit-box-shadow: 5px 4px 5px 0px #999;
} 
.cert_image{display:none;}
.cert_image img{
  width:400px;
  height:200px;
float:left;
z-index:100;
}
</style>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    
    $('.accept, .deny').click(function(){
      alumni_id=this.id;
      $.ajax({
        url:"<?php echo site_url('admin/change_state/')?>/" + alumni_id, 
        success: check_state($(this))
      });
    });
    
    $('.cert_thumbs').mouseout(function(){
      id = this.id;
      alumni_id=id.substr(6, 10);
      //alert(id + "xxxxxxxxxx" + alumni_id);
      $('#cert_' + alumni_id).hide();
     
    });

    $('.cert_thumbs').hover(function(){
      id = this.id;
      alumni_id=id.substr(6, 10);
      //alert(id + "xxxxxxxxxx" + alumni_id);
      $('#cert_' + alumni_id).show();
    });


  });
  function check_state(res){
    if(res.hasClass( "accept" )){
      res.removeClass('accept').addClass('deny');
    } else{
        res.removeClass('deny').addClass('accept');

    } 
  }
</script>
<?php
//var_dump($this->session->userdata);
$images = scandir(APPPATH .uploads_folder .DIRECTORY_SEPARATOR .thumbs_folder);
$files = array_diff($images, array('.', '..'));
?>
<table class='sortable'>
<thead>
<tr>
      <td>id</td>
      <td>الاسم</td>
      <td>سنة التخرج</td>
      <td>الكلية</td>
      <td>تم النشر</td>
      <td>الشهادة</td>
</tr>
</thead>
<tbody>

<?php foreach ($alumnies as $graduate) { ?>
  <tr>
    <td><?php echo $graduate->alumni_id?></td>
    <td><?php echo $graduate->name?></td>
    <td><?php echo $graduate->graduation_year?></td>
    <td><?php echo $graduate->faculty?></td>
    <td style='width:16px'>
      <?php
        $approved = $graduate->approved;
        $class = ($approved == '1')? 'accept':'deny'; 
      ?>
        <div id="<?php echo $graduate->alumni_id?>" class="<?php echo $class?>"> </div>

    </td>
<?php 
        $thumbs_filename = base_url() .APPPATH .uploads_folder 
          .DIRECTORY_SEPARATOR .thumbs_folder 
          .DIRECTORY_SEPARATOR .$graduate->cert_file;
        $cert_image = base_url() .APPPATH .uploads_folder 
          .DIRECTORY_SEPARATOR .$graduate->cert_file;

?>
    <td>
      <img id='<?php echo "thumb_$graduate->alumni_id" ?>' class='cert_thumbs' 
          src="<?php echo $thumbs_filename?>" alt="Certeficate" />   
    </td>

  </tr>
  <tr>
    <td colspan='5'>
      <div class='cert_image' id='<?php echo "cert_$graduate->alumni_id"?>'>
        <img src='<?php echo $cert_image ?>' />
      </div>
    </td>
  </tr>
<?php } ?>
<tr>
  <td colspan='3'><?php echo"" . $this->pagination->create_links();?>
</td>
</tr>
</tbody>
</table>
