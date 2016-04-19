<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['entrust']                   = 'dashboard';
$route['entrust/logout']            = 'login/logout';
$route['entrust/users']             = 'user/index';
$route['entrust/api/cerberus/(.+)'] = 'cerberus/$1';

$route['default_controller']        = 'dashboard';

/* End of file routes.php */
/* Location: .bundles/EntrustBundle/config/routes.php */