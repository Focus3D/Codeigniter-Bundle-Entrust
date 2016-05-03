<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Entrust_Controller extends Bundle_Controller 
{
	protected $theme  = 'material';
	protected $layout = 'entrust/sidebar';

	const PATH = BUNDLEPATH.'EntrustBundle/';

	public function __construct()
	{	
		parent::__construct();

		$this->load->library('attire/attire');
		$this->load->model('config_model');

		$this->attire
			->set_theme($this->theme, [
				'paths' => [self::PATH.'views/_theme/']
			])
			->set_layout($this->layout)
			->set_mainview_path(self::PATH)
			->add_pipeline_path(self::PATH.'assets/')
			->set_manifest('entrust_app')
			->add_global([
				'system' => [
					'menu' => json_decode($this->config_model->get('system_menu'), TRUE),
					'user' => $this->cerberus->check()
				]
			]);
	}
}

/* End of file Entrust_Controller.php */
/* Location: ./bundles/EntrustBundle/core/Entrust_Controller.php */