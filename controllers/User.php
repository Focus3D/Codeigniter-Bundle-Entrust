<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Entrust_Controller 
{
	public function index()
	{
		$data = [
			'users' => $this->cerberus->user->get_all(),
			'csrf'  => [
		    	'name' => $this->security->get_csrf_token_name(),
		    	'hash' => $this->security->get_csrf_hash()
			],
			'notifications' => [
				'create' => $this->session->flashdata('create_message')
			]
		];

		array_walk($data['users'], function(&$user) {
			$user['roles'] = $this->cerberus->role->get_assigned($user['id']);
		});

		$this->attire
			->add_global([
				'page' => [
				 	'title'    => 'Users',
				 	'subtitle' => 'List',
				 ]
			])
			->set_manifest('entrust_user_index_app')
			->add_view('user/index/list', $data)
			->render();	
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /{{ COLLECTION }}/create
	 */
	public function create()
	{
		$this->load->helper('form');

		$data = [
			'form_errors' => $this->session->flashdata('flash_form_errors'),
			'form_post'   => $this->session->flashdata('flash_post'),
			'errors' 	  => $this->session->flashdata('flash_errors')
		];

		$this->attire
			->add_global([
				'page' => [
				 	'title'    => 'Users',
				 	'subtitle' => 'Create',
				 	'menu'     => [
				 		'back_url' => 'entrust/users'
				 	]
				 ]
			])
			->set_manifest('entrust_user_create_app')
			->add_view('user/create/form', $data)
			->render();	
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /{{ COLLECTION }}/store
	 */

	public function store()
	{
		if ($this->input->method(TRUE) == 'POST') 
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('firstname', 'Firstname', 'required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required');
			/**
			 * @todo is_unique[table.field] validation
			 */
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('c_password', 'Password Confirmation', 'required|matches[password]');
			$this->form_validation->set_rules('h_roles', 'Roles', 'required');
	
			if ($this->form_validation->run()) 
			{
				$_user = [
					'firstname' => $this->input->post('firstname'),
					'lastname'  => $this->input->post('lastname'),
					'email'     => $this->input->post('email'),
					'password'  => $this->input->post('password'),
				];

				$this->cerberus->user->create($_user);

				list($user) = $this->cerberus->user->get_by('email', $this->input->post('email'));
				$roles      = json_decode($this->input->post('h_roles'));

				$this->cerberus->role->assign($user['id'], $roles);

				if (! empty($this->cerberus->errors())) 
				{
					$this->session->set_flashdata('flash_errors', $this->cerberus->errors());
					$this->session->set_flashdata('flash_post', $_POST);				
				}
				else
				{
					$this->session->set_flashdata('create_message', 'User successfully created!');

					return redirect('entrust/user');	
				}
			}
			else
			{
				$this->load->helper('array');

				$data = array();

				$validation_fields = ['firstname','lastname','email','h_roles','password','c_password'];

				foreach (elements($validation_fields, $_POST) as $key => $value) 
				{
					$data[$key] = $this->form_validation->error($key);
				}

				$this->session->set_flashdata('flash_form_errors', $data);
				$this->session->set_flashdata('flash_post', $_POST);
			}
		}
		return redirect('entrust/user/create');
	}
}

/* End of file Users.php */
/* Location: ./application/bundles/EntrustBundle/controllers/Users.php */