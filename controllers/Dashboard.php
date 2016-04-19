<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Entrust_Controller 
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->attire
			->add_global([
				'page' => [
				 	'title' => 'Dashboard',
				 	'subtitle' => 'Backend',
				 ]
			])
			->set_manifest('entrust_dashboard_app','css')
			->add_view('dashboard/index/version-1')
			->render();
	}
}

/* End of file Dashboard.php */
/* Location: ./application/bundles/EntrustBundle/controllers/Dashboard.php */