<?php

class Brand_model extends CI_Model {

    var $brand_name = '';
    var $description = '';
    var $logo = '';
    var $size_chart = '';

    function __construct() {
        parent::__construct();
    }
	
	function add_brand()
	{
		$this->brand_name = $this->input->post('brand_name');
		$this->description = $this->input->post('description');
		$this->logo = $this->input->post('logo');
		$this->size_chart = $this->input->post('size_chart');
		
		$this->db->insert('brands',$this);
	}
	
	function edit_brand()
	{
		$this->brand_name = $this->input->post('brand_name');
		$this->description = $this->input->post('description');
		$this->logo = $this->input->post('logo');
		$this->size_chart = $this->input->post('size_chart');
		
		$this->db->update('brands',$this,array('brand_name' => $_POST['brand_name']));
	}
	
	function delete_brand()
	{
		$this->db->delete('brands',array('brand_name' => $_POST['brand_name']));
	
	
	function view_brand()
	{
		$query = $this->db->get('brands');
        return $query->result();
	}
	
}

?>