<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Entrust_Controller 
{
	protected $layout = 'entrust/login';

	public function index()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->lang->load('login');

		$this->form_validation->set_rules('username', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) 
		{
			if ($this->cerberus->authenticate([
				'username' => $this->input->post('username'), 
				'password' => $this->input->post('password')
			])) 
			{
				redirect('entrust');
			}
		}		

		$data = [
			'lang' => $this->lang->line('index', FALSE),
			'messages' => [
				'errors' => $this->cerberus->errors()
			]			
		];

		$this->attire
			->add_view('login/index/form', $data)
			->render();
	}

	public function logout()
	{
		$this->cerberus->dismiss();
		redirect('entrust');
	}

	/**
	 * @todo Password:
	 * 
	 * - change
	 * - forgot
	 * - reset
	 */
}

/* End of file Login.php */
/* Location: ./application/bundles/EntrustBundle/controllers/Login.php */