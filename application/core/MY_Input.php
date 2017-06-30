<?php
class MY_Input extends CI_Input {
	
	
	function save_query($query_array) {
		
		$CI =& get_instance();
		
		$CI->db->insert('alexu_alumni_ci_query', array('query' => http_build_query($query_array)));
		
		return $CI->db->insert_id();
	}
	
	function load_query($query_id) {
		
		$CI =& get_instance();
		
		$rows = $CI->db->get_where('alexu_alumni_ci_query', array('id' => $query_id))->result();
		if (isset($rows[0])) {
			parse_str($rows[0]->query, $_GET);		
		}
		
	}
	
}
