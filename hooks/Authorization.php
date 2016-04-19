<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorization
{
	/**
	 * CI Instance
	 * @var object
	 */
	protected $CI;

	/**
	 * Controllers White List
	 * @var array
	 */
	protected $_white_list;

	/**
	 * Class constructor
	 * 
	 * @param array $white_list Controllers White List
	 */
	public function __construct(array $white_list = [])
	{
        $this->CI =& get_instance();
        
        $this->_white_list = array_merge($white_list, [
        	'entrust/login',
			'entrust/login/(.+)',
			'entrust/api/cerberus/(.+)'
		]);
	}

	public function check()
	{
		$this->CI->load->driver('cerberus');
		$this->CI->load->helper('url');

		// Check if URI has been whitelisted from CSRF checks
		foreach ($this->_white_list as $excluded)
		{
			if (preg_match('#^'.$excluded.'$#i'.(UTF8_ENABLED ? 'u' : ''), $this->CI->uri->uri_string()))
			{
				return FALSE;
			}
		}

		if (! $this->CI->cerberus->check()) 
		{
			redirect('entrust/login');
		}
	}
}

/* End of file Authorization.php */
/* Location: ./application/bundles/EntrustBundle/hooks/Authorization.php */
