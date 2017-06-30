<?php
  class Frontend_Controller  extends MY_Controller{

    public $data = array();

      public function __construct(){
        parent::__construct();

        $this->template = 'template/index';
        $this->data['Controller'] = config_item('Frontend_Controller');




      //echo '<h1>shift id is ' .$this->session->userdata('shift_id').'</h1>';
        //var_dump($this->session->userdata);
      }
  }
?>
