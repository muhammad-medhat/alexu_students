
<div id='registration'>
  <div class='errors'>
    <?php echo validation_errors('<p class="error">'); ?>
<?php
//var_dump($this->session->userdata);
?>
  </div>
<fieldset>
  <?php
echo form_open('alumni/update');
    //$this->load->view('signup/main');
    //$this->load->view('signup/login');
    $this->load->view('signup/personal');
$image = base_url() ."/images/b.png";
    echo form_submit('submit', 'تعديل', 'class="reg" ' ."style='background-image:url($image)'");

    echo form_close(); 
?>
  

  </fieldset>
<?php ?>
</div>
