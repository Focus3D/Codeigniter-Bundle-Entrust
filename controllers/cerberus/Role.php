<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends Bundle_Controller 
{
	public function get_all()
	{
		echo json_encode($this->cerberus->role->get_all(), TRUE);		
	}

}

/* End of file Role.php */
/* Location: ./application/bundles/EntrustBundle/controllers/cerberus/Role.php */