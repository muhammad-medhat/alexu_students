<div id="login_form">

	<h1><?php echo $this->lang->line('login')?> </h1>
  <p>
    <?php echo $this->lang->line('login_message')?>
  </p>
  <table>
  <?php echo form_open('login/validate_credentials') ?>
  	<tr>
      <td>
        <?php echo form_input('username', '', 'placeholder=' .$this->lang->line('username'))?>
      </td>
      <td></td>
    </tr>
  	
    <tr>
      <td>
        <?php echo form_password('password', '', 'placeholder='.$this->lang->line('password'))?>
      </td>
      <td></td>
    </tr>
    <?php $image = base_url() ."/images/signin.png";?>
    
    <tr>
      <td colspan='2'> 
        <?php echo form_submit('submit', 'signin', 'class="reg" ' 
            ."style='background-image:url($image)'")?>
      </td>
    </tr>
<?php
  //	echo form_submit('submit', 'تسجيل الدخول');
  //	echo anchor('login/signup', 'Create Account');
  	echo form_close();
  	?>
</table>

</div><!-- end login_form-->
