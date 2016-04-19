<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_backend_config_plugins extends CI_Migration {

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
	}

	public function up() 
	{
		$this->add_backend_config_plugins_table();
	}

	public function down() 
	{
		$this->dbforge->drop_table('ci_bdl_entrust_config_plugins');
	}

	private function add_backend_config_plugins_table()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'null' => FALSE,
				'auto_increment' => TRUE,
				'unsigned' => TRUE,
				'constraint' => 10
			),
			'plugin' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => TRUE,
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => FALSE,
			),
			'value' => array(
				'type' => 'LONGTEXT',
				'null' => FALSE,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('ci_bdl_entrust_config_plugins', TRUE);		
	}
}

/* End of file 002_add_backend_config_plugins.php.php */
/* Location: application/bundles/EntrustBundle/migrations/002_add_backend_config_plugins.php */