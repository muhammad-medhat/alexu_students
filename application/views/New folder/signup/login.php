  <fieldset>
  <legend><?php echo $this->lang->line('login_info')?></legend>

  <?php
$username = $this->session->userdata('username');
  echo form_input('username',   set_value('',    $username), 'placeholder="'. $this->lang->line('username').' " ');
  echo form_password('password',   set_value('',    ''), 'placeholder="'. $this->lang->line('password') .'"');
  echo form_password('retype',  set_value('',   ''), 'placeholder="'. $this->lang->line('retype_password').'"');
  ?>
  
  </fieldset>
