  <fieldset>
  <legend><?php echo $this->lang->line('contact_info')?></legend>
  <?php
$email   = $this->session->userdata('email');
$phone   = $this->session->userdata('phone');
$mobile  = $this->session->userdata('mobile');
$country = $this->session->userdata('country');
$city    = $this->session->userdata('city');
$address = $this->session->userdata('address');
$job     = $this->session->userdata('job');

//var_dump($this->session->userdata);
//echo "<hr>";


  echo form_input('email',    set_value('email'   , $email  ), 'placeholder="'.$this->lang->line('email')   .'"');
  echo form_input('phone',    set_value('phone'   , $phone  ), 'placeholder="'.$this->lang->line('phone')   .'"');
  echo form_input('mobile',   set_value('mobile'  , $mobile ), 'placeholder="'.$this->lang->line('mobile')  .'"');
  echo form_input('country',  set_value('country' , $country), 'placeholder="'.$this->lang->line('country') .'"');
  echo form_input('city',     set_value('city'    , $city   ), 'placeholder="'.$this->lang->line('city')    .'"');
  echo form_input('address',  set_value('address' , $address), 'placeholder="'.$this->lang->line('address') .'"');
  echo form_input('job',      set_value('job'     , $job    ), 'placeholder="'.$this->lang->line('job')     .'"');
?>
</fieldset>
