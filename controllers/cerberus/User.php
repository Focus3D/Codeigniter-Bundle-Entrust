<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Bundle_Controller 
{
	public function enable()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') 
		{
			echo json_encode([
				'status' => $this->cerberus->user->update(
					$this->input->post('id'), 
					['deleted' => $this->input->post('deleted')]
				)
			], TRUE);
		}
	}
}

/* End of file User.php */
/* Location: ./application/bundles/EntrustBundle/controllers/api/cerberus/User.php */