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
		$config = array();
		$this->db->select('value');
		$this->db->from('ci_bdl_entrust_config');
		$this->db->where('name', $name);
		$query = $this->db->get();
		
		foreach ($query->result_array() as $key => $row) 
		{
			$config = array_merge($config, json_decode($row['value'], TRUE));
		}
		
		$this->db->select('plugin, value');
		$this->db->from('ci_bdl_entrust_config_plugins');
		$this->db->where('name', $name);
		$query = $this->db->get();
		
		foreach ($query->result_array() as $key => $row) 
		{
			$config[$row['plugin']] = json_decode($row['value'], TRUE);
		}		
		
		return $config;
	}
}

/* End of file Config_model.php */
/* Location: ./application/bundles/EntrustBundle/models/Config_model.php */