<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  	<title>خريجين جامعة الاسكندرية | <?php echo $page_title?></title>
    
    <?php //css file
      $style = $this->session->userdata('site_lang') ? 'style_'. $this->session->userdata('site_lang'): 'style';
    ?>
  	
    <link rel="stylesheet" href="<?php echo base_url() .'css/' .$style ?>.css" type="text/css" media="screen" />
 
<!--[if gte IE 4]>
 <link rel="stylesheet" href="<?php echo base_url();?>css/ie-style.css" type="text/css" media="screen" />
 <![endif]-->    
    <script src="<?php echo base_url()  ?>js/jquery.min.js" type="text/javascript" charset="utf-8"></script>  
    <script src="<?php echo base_url()  ?>js/scripts.js" type="text/javascript" charset="utf-8"></script>  
    <script src="<?php echo base_url()  ?>js/sottable.js" type="text/javascript" charset="utf-8"></script>  
  </head>
  <body>
    <div id='header'>
    <?php $this->load->view('includes/languages')?>
         <div id='nav_links'>
        <div class='l'></div>
        <div class='m'>
          <div class'links'>  

            <?php echo anchor('alumni',            $this->lang->line('alumni_list'));?>
            <?php echo anchor('alumni/add_alumni', $this->lang->line('registration'));?>
            <?php echo anchor('login/',            $this->lang->line('login'));?>
            <?php //echo anchor('login/logout',      'destroy');?>
        

          <?php 
            if($this->session->userdata('role') == 'admin')
              echo anchor('admin', 'admin');
          ?>
          </div><?php // links?>
         </div><?// m?>
        <div class='r'></div>
      
      </div><?php // nav_links?>
    
      </div> <?php //header?>
