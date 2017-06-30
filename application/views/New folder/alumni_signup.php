
<div id='registration'>
  <div class='errors'>
    <?php echo validation_errors('<p class="error">'); ?>
<?php
//var_dump($this->session->userdata);
?>
  </div>

<fieldset>
  <?php
echo form_open('alumni/register');
    $this->load->view('signup/main');
    $this->load->view('signup/login');
    $this->load->view('signup/personal');
    $image = base_url() ."/images/reg.png";
    echo form_submit('submit', 'تسجيل', 'class="reg" ' ."style='background-image:url($image)'");
echo form_close(); 
?>
  

  </fieldset>
<?php ?>
</div>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $('.upload_ajax').click(function(){
      $.ajax({
        url:"<?php echo site_url('alumni/upload_cert')?>", 
        success: function(){alert('Success')}
      });
    });
  });
</script>
