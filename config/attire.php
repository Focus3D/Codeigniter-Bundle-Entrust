<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Twig Global Vars 
|--------------------------------------------------------------------------
|
| Global variables can be registered in the Twig environment. Same as 
| declare a function:
|
| $config['global_vars'] = array(
| 	'some' => 'hello world',
| );
|
| Call the functions in Twig environment:
|		
|	{{ some }}
|
*/
$config['global_vars']['system']['fullname'] = 'EntrustBundle';

/*
|--------------------------------------------------------------------------
| Sprockets-PHP - Assets Paths
|--------------------------------------------------------------------------
|
| The asset paths are divided by "modules" to be as flexible as it can.
|
| You have 2 keys in each modules: 
|	- Directories: which list directories where the Pipeline must search 
|		files.
|	- Prefixes: which will append the path for the extension to the 
|		directory (ie a js file will get javascripts/ appended to its paths).
|	
| Set the external directories where the pipeline can find the bower 
| components, composer packages, etc.
|
*/
$config['pipeline_paths']['external']['directories'] = array(
	FCPATH.'bower_components/',
	BUNDLEPATH.'EntrustBundle/assets/bower_components/'
);