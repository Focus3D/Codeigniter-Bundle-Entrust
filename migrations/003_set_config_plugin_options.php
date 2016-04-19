<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Set_config_plugin_options extends CI_Migration {

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
	}

	public function up() 
	{
		$object = array(
			'plugin' => 'entrust',
			'name'   => 'system_menu',
			'value'  => json_encode(array(
				'dashboard' => array(
					'icon'  => 'dashboard',
					'label' => 'Dashboard',
					'url'   => 'entrust'
				),
				'users' => array(
					'icon'  => 'supervisor_account',
					'label' => 'Users',
					'url'   => 'entrust/users'
				)
			),TRUE)
		);
		$this->db->insert('ci_bdl_entrust_config_plugins', $object);	
	}

	public function down() 
	{
		$this->db->where('plugin', 'entrust');
		$this->db->delete('ci_bdl_entrust_config_plugins');
	}

}

/* End of file 003_set_config_plugin_options.php */
/* Location: ./application/bundles/EntrustBundle/migrations/003_set_config_plugin_options.php */