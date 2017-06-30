<?php

class Students_model extends MY_Model {

  var $alumni_data_table      ; 
  var $alumni_main_table      ; 
  var $users_table            ;
  var $faculties_table        ;
  var $academic_degrees_table ;
  var $degrees_table ;
  var $uploads_folder;
var $_table_name = 'students';
  function Student_model(){
    parent::__construct();
    //$this->_table_name = 'students';
   $this->uploads_folder = realpath(APPPATH .'uploads');


   $this->file = $this->uploads_folder .'/qq.sql';
      $this->load->helper('file');      

  }

  function get_students(){
      $lang = $this->config->item('language');
    $select = array(
      's.id'    =>'id',
      "s.$lang" =>'name', 
      "f.$lang" =>'faculty',
      's.levid' =>'level_id' 
    );
      foreach ($select as $col=>$alias) {
        // code...
        $this->db->select("$col as $alias");    
      }
      $q = $this->db->from("students s")
        ->join("$this->faculties_table f", 'f.id=s.fid', 'left')
        ->get();
      return $q->result();

  }
  function get_num_search($_fid=0, $_year=0, $_ac_degree=0, $_name='')
  {
      $this->db->from("$this->alumni_data_table g");
      $this->db->join("$this->users_table u", 'g.alumni_id=u.id', 'left');
      $this->db->join("$this->alumni_main_table m", 'g.alumni_id=m.id', 'left');
      $this->db->join("$this->faculties_table f", 'f.id=g.fid', 'left');
      $this->db->join("$this->academic_degrees_table d", 'd.id=g.certificate_type_id', 'left');
      


    if($_fid!=0)
      $this->db->where('g.fid', $_fid);
    if($_year!=0){
      $year_r = $this->input->post('year-r');
      switch ($year_r) {
        case 'lt':
          $this->db->where('g.graduation_year <', $_year);
          break;
        case 'eq':
          $this->db->where('g.graduation_year', $_year);
           break;
        default:
          $this->db->where('g.graduation_year >', $_year);

          break;
      }
    }
    if($_ac_degree!=0)
      $this->db->where('g.certificate_type_id', $_ac_degree);

    if($_name!='')
      $this->db->where( "u.name like '$_name%'");

    //$q .= " order by graduation_year desc ";
      
    
   $query = $this->db->count_all_results();
    
            write_file($this->file, $this->db->last_query() .";\n", 'a');

   return $query;
  }
  
  function get_all($_limit=0, $_offset=0, $_fid=0, $_year=0, $_ac_degree=0, $_name=''){
      
      $faculty_field = $this->translate_field('faculty', $this->faculties_table);
      $academic_degree_field = $this->translate_field('scientific_degree', $this->academic_degrees_table);
//      $academic_degree_field = $this->translate_field('certificate_type', $this->academic_degrees_table);
      //$faculty_field = $this->_translate_field('faculty');

      $this->db->select(" alumni_id,u.name, graduation_year, f.$faculty_field, d.$academic_degree_field  ");
      $this->db->from("$this->alumni_data_table g");
      $this->db->join("$this->users_table u", 'g.alumni_id=u.id', 'left');
      $this->db->join("$this->alumni_main_table m", 'g.alumni_id=m.id', 'left');
      $this->db->join("$this->faculties_table f", 'f.id=g.fid', 'left');
      $this->db->join("$this->academic_degrees_table d", 'd.id=g.certificate_type_id', 'left');
    if($_fid!=0)
      $this->db->where('g.fid', $_fid);
    if($_year!=0){
      $year_r = $this->input->post('year-r');
      switch ($year_r) {
        case 'lt':
          $this->db->where('g.graduation_year <', $_year);
          break;
        case 'eq':
          $this->db->where('g.graduation_year', $_year);
           break;
        case 'gt':
          $this->db->where('g.graduation_year >', $_year);

          break;

        default:
          $this->db->where('g.graduation_year >=', $_year);

          break;
      }
    }
    if($_ac_degree!=0)
      $this->db->where('g.certificate_type_id', $_ac_degree);

    if($_name!='')
      $this->db->where( "u.name like '$_name%'");

    $this->db->limit($_limit, $_offset);
    $query = $this->db->get();
    //$debug = "<div class='query'><p>Search query year = $_year, year_r=$year_r</p>" .$this->db->last_query() .'</div>';
    //        write_file($this->file, $debug .";\n", 'a');

    return $query->result();

  }

  function get_num_fac($_fid)
  {
    $q = "SELECT count(*) as number 
      FROM `$alumni_data_table` g
      left join $users_table u on g.alumni_id=u.id
      left join $faculties_table f on f.id=g.fid
      where u.usertype='الخريجين' and f.id=$_fid
      ";
    $query = $this->db->query("$q ");
    $result = $query->result();
    $cnt = $result[0];
    return $cnt->number;

  }

  function get_num_all()
  {
    
    $q = "SELECT count(*) as number 
      FROM `$this->alumni_data_table` g
      left join $this->users_table u on g.alumni_id=u.id
      left join $this->alumni_main_table m on g.alumni_id=m.id
      left join $this->faculties_table f on f.id=g.fid
      where u.usertype='الخريجين' and m.approved=1
      ";
    $query = $this->db->query("$q ");
    $result = $query->result();
    $cnt = $result[0];
    //echo"<div class='query'>" .$this->db->last_query() ."</div>";
    return $cnt->number;
  }

  function get_academic_levels()
  {
    $this->db->order_by('order asc');
    $ac_levels = $this->db->get(academic_degree_table);
    return $ac_levels->result();

  }

  function get_faculties()
  {
    $faculties = $this->univ_db->get($this->faculties_table);
    return $faculties->result();
  }

  function get_faculties_ddl()
  {
    $faculties = $this->get_faculties();
    $ret = array();
    /*
    foreach ($faculties as $key=>$value) {
      $ret[$key] = $value;
    }
    return $ret;*/
    $faculties = $this->get_faculties();
    foreach ($faculties as $f) {
      $ret[$f->id] = $f->arabic;
    }
      return $ret;
  }

  function get_degrees()
  {
    //$this->db->select("id, arabic");
    $this->db->where("order > ", "0");
    $deg = $this->db->get(degrees_table);
    return $deg->result();
  }


  function get_years()
  {

    $q = "select distinct(graduation_year) from $this->alumni_data_table where graduation_year!='' 
      order by graduation_year desc";
    $query = $this->db->query($q);
    return $query->result();
  }

  function get_num_res($_fid=0, $_year=0, $_ac_degree=0)
  {
    $q = "SELECT count(*) as number 
      FROM `$this->alumni_data_table` g
      left join $this->users_table u on g.alumni_id=u.id
      left join $this->faculties_table f on f.id=g.fid
      where u.usertype='الخريجين' ";
    if($_fid!=0)
      $q .= " and f.id=$_fid";
    if($_year!=0)
      $q .= " and g.graduation_year=$_year";
    if($_ac_degree!=0)
      $q .= " and g.certificate_type_id=$_ac_degree";

    $query = $this->db->query("$q ");
    $result = $query->result();
    $cnt = $result[0];
    return $cnt->number;
  }

  function get_alumni($_alumni_id)
  {
      $faculty_field = $this->translate_field('faculty', $this->faculties_table);
      $academic_degree_field = $this->translate_field('scientific_degree', $this->academic_degrees_table);

    $query = "select g.alumni_id,g.graduation_year, ac.$academic_degree_field,
      u.name, f.$faculty_field,
      g.department, g.division,d.arabic as degree
      from  $this->alumni_data_table g
      
      left join $this->alumni_main_table m on g.alumni_id=m.id
      left join $this->users_table u  on m.user_id=u.id 
      left join $this->faculties_table f on f.id=g.fid
      left join $this->academic_degrees_table ac on ac.id=g.certificate_type_id
      left join $this->degrees_table d on d.id=g.gid

      where u.id=$_alumni_id
      ";
    $q = $this->db->query($query);
    return $q->result();
  }

  function add_user($_name, $_email, $_username, $_password)
  {

    $name  = $_name;
    $email = $_email;
    $username = $_username;
    $password = $_password;
    $registerDate = Date("Y-m-d h:m:s");
    $usertype = 'الخريجين';

/*    $q = "insert into " .$this->users_table ."(name, email, username, password,  usertype) 
      values('$name', '$email', '$username', md5('$password'), '$usertype')";
    $this->db->query($q);*/
    $ins_arr = array(
      'name'          => $name, 
      'email'         => $email,
      'username'      => $username,
      'password'      => $password,
      //'registerDate'  => Date("Y-m-d h:m:s"),
      'usertype'      => 'الخريجين'
    );
    $this->db->insert($this->users_table, $ins_arr);
    //echo $this->db->last_query();
  }

  function add_alumni($_user_id, $_approved)
  {
    $q = "insert into " .$this->alumni_main_table ."(user_id, approved) values ($_user_id, $_approved)";
    $this->db->query($q);
    //echo "<br>" .$this->db->last_query();

  }

  function add_alumni_data(
      $_alumni_id, 
      $_year ,      $_faculty,    $_ac_level, 
      $_department='', $_devision='', $_phone='', 
      $_country='',    $_city='',     $_location='', 
      $_job='',      $_grade_id,      $_mobile=''
  )
  {
       
      $q = "
      insert into $this->alumni_data_table 
      (
      `alumni_id`, 
      `graduation_year`, `fid`      ,  `certificate_type_id`,
      `department`     , `division` ,  `phone`,
      `country`        , `city`     ,  `address`,
      `job`            , `gid`      ,  `mobile`) VALUES ( 
        $_alumni_id, 
      '$_year'        , $_faculty , $_ac_level, 
      '$_department'  , '$_devision', '$_phone', 
      '$_country'     , '$_city'    , '$_location', 
      '$_job'         , $_grade_id, '$_mobile'
    )";
    $this->db->query($q);
    //echo "<br>" .$this->db->last_query();
  }
 
  function update_alumni()
  {
    var_dump($this->session->userdata);
   // echo "<div class='query'>job is ".$this->input->post('job') ."</div>";
      $alumni_id = $this->session->userdata('alumni_id'); 
      $user_id = $this->session->userdata('user_id'); 
      $email   = ($this->input->post('email')=='')? $this->session->userdata('email'): $this->input->post('email'); 
      $address = ($this->input->post('address')=='')? $this->session->userdata('address'): $this->input->post('address'); 
      $job     = ($this->input->post('job') =='')?    $this->session->userdata('job'):     $this->input->post('job'); 
      $city    = ($this->input->post('city') =='')?   $this->session->userdata('city'):    $this->input->post('city'); 
      $country = ($this->input->post('country')=='')? $this->session->userdata('country'): $this->input->post('country'); 
      $phone   = ($this->input->post('phone')=='')?   $this->session->userdata('phone'):   $this->input->post('phone'); 
      $mobile  = ($this->input->post('mobile')=='')?  $this->session->userdata('mobile'):  $this->input->post('mobile');
      $args = array(
        'address' => $address, 
        'email'   => $email,
        'job'     => $job,
        'city'    =>$city, 
        'country' =>$country, 
        'phone'   =>$phone, 
        'mobile'  =>$mobile 
      );
     // var_dump($args);
   // $this->db->update($this->alumni_data_table, $data, "alumni_id = " .$alumni_id);
    $q = "UPDATE $this->alumni_data_table SET 
      `address`='$address',      
      `job`='$job',
      `city`='$city',
      `country`='$country',
      `phone`='$phone',
      `mobile`='$mobile'
      WHERE alumni_id=$alumni_id";
      //echo "query is $q";
      $query = $this->db->query($q);
      $q2 = "update $this->users_table set email ='$email' where id=$user_id";
      $query2 = $this->db->query($q2);
  }

  function get_faculty_name($_fid)
  {
      $faculty_field = $this->translate_field('faculty', $this->faculties_table, true);

    $this->db->select($faculty_field);
    $this->db->where('id',$_fid);
    $query = $this->db->get($this->faculties_table);
    $res = $query->result();
    //var_dump($res);
   // echo $this->db->last_query();
    $arr = $res[0];
    return $arr->$faculty_field;
  }

  function get_ac_degree_name($_fid)
  {
      $field = $this->translate_field('faculty', $this->academic_degrees_table, true);
    
    $this->db->select($field);
    $this->db->where('id',$_fid);
    $query = $this->db->get($this->academic_degrees_table);
    $res = $query->result();
    //var_dump($res);
    $arr = $res[0];
    return $arr->$field;
  }

  function get_degree_name($_fid)
  {
    $field = $this->translate_field('faculty', $this->degrees_table, true);
    $this->db->select($field);
    $this->db->where('id',$_fid);
    $query = $this->db->get($this->degrees_table);
    $res = $query->result();
    //var_dump($res);
    $arr = $res[0];
    return $arr->$field;
  }

  function update_cert($_alumni_id, $_ext)
  {
    //$alumni_id = pathinfo($_filename);
      $q = "update $this->alumni_data_table set cert_file='$_alumni_id.$_ext' where alumni_id=$_alumni_id";
      //echo "<p class='query'>$q</p>";
      $this->db->query($q);
  }


  function do_upload($_file_name)
  {
    $config = array(
        'upload_path'  => $this->uploads_folder,
        'allowed_types' => 'jpg|jpeg|gif|png',
        'file_name' => $_file_name
       );
    $this->load->library('upload', $config);
    $this->upload->do_upload('certeficate');
    
    $image_data = $this->upload->data(); 
    $config_image = array(
      'source_image' => $image_data['full_path'], 
      'new_image' => $this->uploads_folder .'/thumbs', 
      'maintain_ratio' =>true, 
      'width'=>200, 
      'height'=>100
    );

    //Create a thumbnails
    $this->load->library('image_lib', $config_image);
    $this->image_lib->resize();
  }
/*
  function get_name_field($table_name){
    //gets the name field of the table
    //because there is some tables with
    //a field "name or english"
      $lang = $this->session->userdata('site_lang');
      $field = $lang;
      if(!$lang){
        $field = $this->config->item('language');
      } else{
        if($lang == 'english'){
          if(!$this->_is_column_exist($lang, $_table_name))
           $field = 'name';
        }
      }

return $field
  }
*/
  function translate_field($_field_name, $_table_name, $only_name=false){
      $lang = $this->session->userdata('site_lang');
      $field = $lang;
      if(!$lang){
        $field = $this->config->item('language');
      } else{
        if($lang == 'english'){
          if(!$this->_is_column_exist($lang, $_table_name))
           $field = 'name';
        }
      }
      if(!$only_name)
        return "$field as $_field_name";
      else
        return $field;
  }
  function _is_column_exist($column_name, $table_name){
    $q = "select * from information_schema.columns where
      table_schema ='" .$this->db->database ."' and table_name = '$table_name' and column_name = '$column_name'";
      $query = $this->db->query($q);
      return ($query->num_rows() ==1);
        
  }
}
