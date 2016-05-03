<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($name, $plugin_search = FALSE)
	{
		$this->db->select('value');
		$this->db->from('ci_bdl_entrust_config');
		$this->db->where('name', $name);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array()['value'];
	}
}

/* End of file Config_model.php */
/* Location: ./application/bundles/EntrustBundle/models/Config_model.php */