# Codeigniter Bundle - Entrust (Beta)

Entrust is a succinct and flexible way to add Role-based Permissions and Session Authorization to Codeigniter 3.

## Installation

With compoer:

	composer require "dsv/codeigniter-bundle-entrust"

Then enable it inside your bundle configuration:

    $config['bundles'] = array(
    	'EntrustBundle' => array(
    		'location' => 'EntrustBundle',
    		'route'    => 'entrust',
    		'default'  => TRUE
    	)
    );
    
In your application config file, enable the Hooks:

	$config['enable_hooks'] = TRUE;

DB Setup
--------

just run the migration schemes inside the `migrations` directory with the [Migration Class](https://codeigniter.com/user_guide/libraries/migration.html).

Optionally, if you're using [CLI Craftsman](https://github.com/davidsosavaldes/Craftsman):

    php vendor/bin/craftsman migration:latest --path="path/to/application/bundles/EntrustBundle/migrations"

Requirements
------------

* PHP 5.4 or later
* [Codeigniter Bundle](https://github.com/davidsosavaldes/Codeigniter-Bundle)
* [Attire Library](https://github.com/davidsosavaldes/Attire)
* [Cerberus Driver](https://github.com/davidsosavaldes/Cerberus)
