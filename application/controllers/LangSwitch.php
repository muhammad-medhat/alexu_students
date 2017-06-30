<?php
class LangSwitch extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        /*
        $l = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        echo "############### LANGUAGE ##############";
        var_dump($l);*/
    }

    function switchLanguage($language = "") {
        $language = ($language != "") ? $language : $this->config->item('language');
        $this->session->set_userdata('site_lang', $language);
        //echo "<div class='query'>XXX></div>";
        redirect(base_url());
    }
}
