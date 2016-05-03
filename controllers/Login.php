<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Entrust_Controller 
{
	protected $layout = 'entrust/login';

	public function index()
	{
		$this->load->helper('form');
		$this->lang->load('login');	

		$data = [
			'lang'        => $this->lang->line('index', FALSE),
			'form_errors' => $this->session->flashdata('flash_form_errors'),
			'form_post'   => $this->session->flashdata('flash_post'),
			'errors'      => $this->session->flashdata('flash_errors'),		
		];

		$this->attire
			->add_view('login/index/form', $data)
			->render();
	}

	public function validate()
	{
		if ($this->input->method(TRUE) == 'POST')
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run()) 
			{
				if ($this->cerberus->authenticate([
					'username' => $this->input->post('username'), 
					'password' => $this->input->post('password')
				])) 
				{
					return redirect('entrust');
				}
				else 
				{
					$this->session->set_flashdata('flash_errors', $this->cerberus->errors());
					$this->session->set_flashdata('flash_post', $_POST);					
				}				
			}
			else
			{
				$this->load->helper('array');

				$data = array();

				$validation_fields = ['username', 'password'];

				foreach (elements($validation_fields, $_POST) as $key => $value) 
				{
					$data[$key] = $this->form_validation->error($key);
				}

				$this->session->set_flashdata('flash_form_errors', $data);
				$this->session->set_flashdata('flash_post', $_POST);				
			}
		}
		return redirect('entrust/login');
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