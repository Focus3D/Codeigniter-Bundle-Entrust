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
			->add_view('user/create/form')
			->render();	
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /{{ COLLECTION }}/store
	 */

	/**
 	* @todo recycle some code here (upgrade)
 	*/	
	public function store()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('', '');
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
			$new_user = [
				'firstname' => $this->input->post('firstname'),
				'lastname'  => $this->input->post('lastname'),
				'email'     => $this->input->post('email'),
				'password'  => $this->input->post('password')
			];	

			if ($this->cerberus->user->create($new_user)) 
			{
				$data       = array();				
				list($user) = $this->cerberus->user->get_by('email', $this->input->post('email'));
				$roles      = json_decode($this->input->post('h_roles'));

				if ($this->cerberus->role->assign($user['id'], $roles)) 
				{
					$this->session->set_flashdata('store_success', 'User created!');
					
					redirect('entrust/users');
				}
				else
				{
					$data['error'] = 'Could not assign the user roles';
				}			
			}
			else
			{
				$data['error'] = 'Could not create the user.';
			}
		}

		$this->load->helper('form');

		$this->attire
			->add_global([
				'page' => [
				 	'title' => 'Users',
				 	'subtitle' => 'Create',
				 	'menu' => [
				 		'back_url' => 'entrust/users'
				 	]
				]
			])
			->set_manifest('entrust_user_create_app')
			->add_view('user/create/error', $data)
			->render();			
	}

	/**
	 * Update user
	 * POST /{{ COLLECTION }}/store
	 */
	public function update()
	{
		$this->load->helper('form');

		$this->attire
			->add_global([
				'page' => [
				 	'title' => 'Users',
				 	'subtitle' => 'Update',
				 ]
			])
			->add_view('user/update/form')
			->render();			
	}
}

/* End of file Users.php */
/* Location: ./application/bundles/EntrustBundle/controllers/Users.php */