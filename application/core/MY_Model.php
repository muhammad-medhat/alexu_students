<?php
  class MY_Model extends CI_Model{

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamp = false;

      public function __construct(){
        parent::__construct();
      $this->univ_db = $this->load->database('main', true);
        
        $this->students_table           = $this->db->dbprefix('students');
        $this->faculties_table          = $this->univ_db->database .'.' .$this->univ_db->dbprefix(faculties_table);


        $this->academic_degrees_table   = $this->db->dbprefix(academic_degree_table);
        $this->degrees_table            = $this->db->dbprefix(degrees_table);

        //$this->settings_table           = $this->db->dbprefix(settings_table);  

   
      }

    public function num_rows(){
        return $this->db->count_all_results($this->_table_name);
    }

    
    function result_ret($q , $ret_object=false){
    //q represents the db query object
      switch (true) {
      case $q->num_rows() ==1:
        if($ret_object)
          return $q->row();
        else return $q->result();
          break;
      case $q->num_rows() > 1:
          return $q->result();
      default:
          return null;
          break;
      }
    }

    public function get($id=null, $single=false){
      if($id != null)  {
        //we need a single record
        $filter = $this->_primary_filter;
        $id=$filter($id);
        $this->db->where($this->_primary_key, $id);
        $method = 'row';
      } 
      elseif($single==true){
        $method='row';
      }else {
        $method = 'result';
      }

      if($this->_order_by){
        $this->db->order_by($this->_order_by);
      }
      $return = $this->db->get($this->_table_name)->$method();
      //echo"<div class='red'>" .$this->db->last_query(); var_dump($this); echo "</div>";;
      return $return;
    }

    public function get_by($where, $single=false){
      $this->db->where($where); 
      $user = $this->db->get($this->_table_name, $single);
      return $user;
    }

    public function save($data, $id=null){

      if($this->_timestamp == true){
        $now = date(mysql_datetime_format);
        $id || $data['created'] = $now;
        //$data['modified'] = $now;
      }

      if($id===null){
        //insert 
        !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = null;
        $this->db->insert($this->_table_name, $data);
        $id = $this->db->insert_id();
      } else{

        //update
        $filter = $this->_primary_filter;
        //??bug gets a value of id=0, intvar(id) always becoms 0
        //$id = $filter($data[$this->_primary_key]);

        $this->db->set($data);
        $this->db->where($this->_primary_key, $id);
        $this->db->update($this->_table_name);
      } 

      return $id;
    }

    public function delete($id){
      
      $filter = $this->_primary_filter;
      $id = $filter($id);
      //echo "<p>id = $id</p><p> filter is $filter</p>";

      if(!$id){
        return false;
      }
      $this->db->where($this->_primary_key, $id);
      $this->db->limit(1);
      $this->db->delete($this->_table_name);
    }
    function array_from_post($fields){
      
      $data = array();
      foreach($fields as $field){
        $data[$field] = $this->input->post($field);
      }
      return $data;
    }
    
  }
?>
