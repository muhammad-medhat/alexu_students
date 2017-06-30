<?php

class Student extends Frontend_Controller 
{
	function __construct()
	{
		parent::__construct();

$this->load->model('students_model');
    header('Content-Type: text/html; charset=utf-8');
  }

  function index($lang='')
  {
    $students = $this->students_model->get_students();
    $this->data['students'] = $students;
      $this->load->view('def', $this->data);

    //var_dump($students);
   // $this->all();
  }
  function fac(){
    $faculties = $this->students_model->get_faculties();
    var_dump($faculties);
  }

  function all()
  {

      $num_rows = $this->db->count_all_results($this->alumni_data_table);

    //display all alumnies for the university
    
   /* if($this->session->userdata('total_all_univ') == ''){
      $num_rows = $this->db->count_all_results($this->alumni_table);
      $this->session->set_userdata('total_all_univ', $num_rows);
    } 
    else {
      $num_rows = $this->session->userdata('total_all_univ');
    }*/

    $limit = general_limit;
    $offset = $this->uri->segment(3);
    $url_segment=3;

    ############################
    if($num_rows>$limit){
      
      $this->load->library('pagination');
/*
      $config['base_url'] = site_url('alumni/all');
      $config['total_rows'] = $num_rows;
      $config['per_page'] = $limit;
      $config['uri_segment'] = 3;
*/
  $base_url = 'alumni/all';
  $url_segment=3;

      //$this->pagination->initialize($config);
    $this->pagination($base_url, $num_rows, $limit, $url_segment);


      $this->data['pagination'] = $this->pagination->create_links();
      $offset = $this->uri->segment(3);
    } 
    else{
      $this->data['pagination'] = '';
      $offset = 0;
    }
    ################################
    $this->data['num_rows'] = $num_rows;
    $alumni_list = $this->alumni_model->get_all($limit, $offset);    
    $this->data['alumni_list'] = $alumni_list;
    
    $this->data['page_title'] = $this->lang->line('alumni');
    $this->data['main_content'] = 'alumni_view';
    $this->load->view('includes/template', $this->data);

  }

  function search()
  {
    $alumni_id = $this->input->post('alumni_id');
    $name      = $this->input->post('name');
    $year      = $this->input->post('year');
    $year_r    = $this->input->post('year-r');
    $faculties = $this->input->post('faculties');
    $ac_deg    = $this->input->post('ac_deg');

    $this->session->set_userdata('total_all_fac', '');

    if($this->session->userdata('total_all_fac') == ''){
      $num_rows = $this->alumni_model->get_num_search($faculties, $year, $ac_deg, $name);
      $this->session->set_userdata('total_all_fac', $num_rows);
    } 
    else {
      $num_rows = $this->session->userdata('total_all_fac');
    }


    $query_array = array(
      'alumni_id' => $alumni_id,
      'name'      => $name, 
      'year'      => $year, 
      'year-r'    => $year_r, 
      'faculties' => $faculties, 
      'ac_deg'    => $ac_deg 
    );

    $query_id = $this->input->save_query($query_array);
		redirect("alumni/display/$query_id");
  }

  function display($query_id = 0, $offset = 0)
  {
    $limit=general_limit;
    $offset = $this->uri->segment(4);
    $url_segment=4;
     
    $this->input->load_query($query_id);
    $query_array = array(
      'alumni_id' => $this->input->get('alumni_id'), 
      'name'      => $this->input->get('name'), 
      'year'      => $this->input->get('year'), 
      'year-r'    => $this->input->get('year-r'), 
      'faculties' => $this->input->get('faculties'), 
      'ac_deg'    => $this->input->get('ac_deg') 
    );

    $alumni_id  = $query_array['alumni_id'];
    $name       = $query_array['name'];
    $year       = $query_array['year'];
    $year_r     = $query_array['year-r'];
    $faculties  = $query_array['faculties'];
    $ac_deg     = $query_array['ac_deg'];



    $num_rows = $this->session->userdata('total_all_fac');


    if($alumni_id){
      $alumni_list = $this->alumni_model->get_alumni($alumni_id);
      $this->data['pagination'] = '';
    $this->data['num_rows'] = 1;
    }
    else{
      $alumni_list = $this->alumni_model->get_all($limit, $offset, $faculties, $year, $ac_deg, $name);
      $this->data['pagination'] = $this->pagination->create_links();
    $this->data['num_rows'] = $num_rows;

    }
    $this->data['alumni_list'] = $alumni_list; 
    //var_dump($query_array);
    
    $base_url = "alumni/display/$query_id";
    
    $this->pagination($base_url, $num_rows, $limit, $url_segment);


    $thiw->data['page_title'] = $this->lang->line('alumni');
    $this->data['main_content'] = 'alumni_view';
    $this->load->view('includes/template', $this->data);

  }


  function pagination($url, $num_rows, $limit, $offset)
  {
    $base_url = $url;
    $config = array();
    $config["base_url"]       = site_url($base_url);
    $config["total_rows"]     = $num_rows;
    $config["per_page"]       = $limit;
    $config["uri_segment"]    = $offset;
    //$config["uri_segment"]    = 4;

    $config['full_tag_open']  = "<div class='paging'>";
    $config['full_tag_close'] = "</div>";

    $config['full_tag_open']  = "<div class='paging'>";
    $config['full_tag_close'] = "</div>";

    $config['first_link'] = $this->lang->line('first_link');
    $config['last_link']  = $this->lang->line('last_link');
    $config['next_link']  = $this->lang->line('next_link');
    $config['prev_link']  = $this->lang->line('prev_link');
    
    $this->pagination->initialize($config);
  }

  function show_alumni($_id)
  {
    $alumni = $this->alumni_model->get_alumni($_id);
    
    $data['alumni'] =  $alumni[0];
    $data['page_title'] = "بيانات الخريج";
    $data['main_content'] = 'single_alumni_view';
    $this->load->view('includes/template', $data);
  }

  function add_alumni()
  {
    $this->data['main_content'] = 'alumni_signup';
    $this->data['page_title'] = $this->lang->line('registration');
    $this->load->view('includes/template', $this->data);
  }

  function register()
  {
    //add user
    //add alumni
    //add alumni data
    $name       = $this->input->post('name');
    $email      = $this->input->post('email');
    $username   = $this->input->post('username');
    $password   = $this->input->post('password');
    $faculty    = $this->input->post('faculty');
    $year       = $this->input->post('year');
    $grade_id   = $this->input->post('grade_id');
    $department = $this->input->post('department');
    $division   = $this->input->post('division');
    $ac_level   = $this->input->post('ac_level');
    $phone      = $this->input->post('phone');
    $country    = $this->input->post('country');
    $city       = $this->input->post('city');
    $location   = $this->input->post('location');
    $job        = $this->input->post('job');
    $mobile     = $this->input->post('mobile');
############################################################################3

##################################################################################
      $this->load->library('form_validation');
		
   
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', "الاسم",  'required');
    $this->form_validation->set_rules('year', "السنة",  'trim|required');

    $this->form_validation->set_rules('username', 'اسم المستخدم',     'required');
    $this->form_validation->set_rules('password', 'كلمة المرور',      'required');
    $this->form_validation->set_rules('retype', 'تأكيد كلمة المرور',  'required|matches[retype]');
    //$this->form_validation->set_rules('email', 'البريد الالكتروني',    'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('email', 'البريد الالكتروني',    'required|valid_email');

			
    if ($this->form_validation->run() != FALSE)
		{

      $this->alumni_model->add_user($name, $email, $username, $password);
      $user_id = $this->db->insert_id();

      $this->alumni_model->add_alumni($user_id, 0);
      $alumni_id = $this->db->insert_id();

      $this->alumni_model->add_alumni_data(
        $alumni_id, 
        $year       , $faculty  , $ac_level, 
        $department , $division , $phone, 
        $country    , $city     , $location, 
        $job        , $grade_id , $mobile
      );
      $fname = $this->alumni_model->get_faculty_name($faculty);
      $ac_deg_name = $this->alumni_model->get_ac_degree_name($ac_level);
      $deg_name = $this->alumni_model->get_degree_name($grade_id);
      $registered_user_data = array(
         array('reg_user_id'   , $user_id      ,''),
         array('reg_alumni_id' , $alumni_id    ,''),
         array('reg_name'      ,  $name        ,$this->lang->line('name')       ),    
         array('reg_email'     ,  $email       ,$this->lang->line('email')      ),   
         array('reg_username'  ,  $username    ,$this->lang->line('username')   ),
         //array('reg_password'  ,  $password   $this->lang->line( ,''),
         array('reg_faculty '  ,  $fname       ,$this->lang->line('faculty')    ),
         array('reg_year'      ,  $year        ,$this->lang->line('graduation_year')       ),    
         array('reg_grade_id'  ,  $deg_name    ,$this->lang->line('alumni_degree')      ),
         array('reg_department',  $department  ,$this->lang->line('department') ),
         array('reg_division'  ,  $division    ,$this->lang->line('division')    ),
         array('reg_ac_level'  ,  $ac_deg_name ,$this->lang->line('scientific_degree') ),
         array('reg_phone'     ,  $phone       ,$this->lang->line('phone')      ),   
         array('reg_country'   ,  $country     ,$this->lang->line('country')    ), 
         array('reg_city'      ,  $city        ,$this->lang->line('city')       ),    
         array('reg_location'  ,  $location    ,$this->lang->line('address')    ),
         array('reg_job'       ,  $job         ,$this->lang->line('job')        ),     
         array('reg_mobile'    ,  $mobile      ,$this->lang->line('mobile')     )  
      );
      $this->session->set_userdata($registered_user_data);
      $data['registered_user_data'] = $registered_user_data;
      $data['alumni_id'] = $alumni_id;

      $data['main_content'] = 'signup/complete';
      $data['page_title'] = 'تسجيل خريج';
      $this->load->view('includes/template', $data);
    } else{
      $this->add_alumni(); 
    }
  }

  function edit()
  {
      $data['main_content'] = 'alumni_edit_view';
      $data['page_title'] = 'تعديل البيانات';
      $this->load->view('includes/template', $data);
  }

  function update()
  {
    
    $this->alumni_model->update_alumni();
    $data['alumni_name'] = 'adsf';
      $data['main_content'] = 'messages/success_edit';
      $data['page_title'] = 'شكرا للتعديل';
      $this->load->view('includes/template', $data);


  }

  function upload_cert($file_name)
  {
    /*
    $this->load->helper('file');
    $file = "application" .DIRECTORY_SEPARATOR .'uploads' .DIRECTORY_SEPARATOR .'file.txt';
    $data = 'adfsadsfasdf';
    write_file($file, $data);
     */

    $this->alumni_model->do_upload($file_name);

    $name = $_FILES['certeficate']['name'];
    $ext = end((explode(".", $name)));

    $this->alumni_model->update_cert($file_name ,$ext);

    $data['main_content'] = 'signup/success';
    $data['page_title'] = 'تم التسجيل';
    $this->load->view('includes/template', $data);

/*
    $this->admin_model->do_upload();
    $upload_data = $this->upload->data();
    $file_name = $upload_data['file_name'];
    $this->display_file($file_name); 
   */
  }
}
