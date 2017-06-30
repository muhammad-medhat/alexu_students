<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  	<title>alexandria university | <?php echo $page_title?></title>
  	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" />
 
<!--[if gt IE 4]>
 <link rel="stylesheet" href="<?php echo base_url();?>css/ie-style.css" type="text/css" media="screen" />
 <![endif]-->    
    <script src="<?php echo base_url()  ?>js/jquery.min.js" type="text/javascript" charset="utf-8"></script>  
    <script src="<?php echo base_url()  ?>js/scripts.js" type="text/javascript" charset="utf-8"></script>  
    <script src="<?php echo base_url()  ?>js/sottable.js" type="text/javascript" charset="utf-8"></script>  
  </head>
  <body>
    <div id='header'>
    <img src="<?php echo base_url()?>images/header.png"  />
    <div id='nav_links'>
      <div class='l'></div>
      <div class='m'>
        <div class'links'>  
          <?php echo anchor('staff', 'staff');?>
          <?php // echo anchor('login', 'تسجيل الدخول');?>
          <?php if($this->session->userdata('is_logged_in'))
                  echo anchor('login/logout', 'تسجيل الخروج');
          ?>
        </div>
      </div>
      <div class='r'></div>
      
    </div>
    
 </div> 
<?php
//var_dump($this->session->userdata);
?>

