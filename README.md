# Codeigniter-Bundle-Entrust (Beta)

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

DB Setup
--------

just run the migration schemes inside the `migrations` directory with the [Migration Class](https://codeigniter.com/user_guide/libraries/migration.html).

Optionally, if you're using [CLI Craftsman](https://github.com/davidsosavaldes/Craftsman):

    php vendor/bin/craftsman migration:latest --path="path/to/application/bundles/EntrustBundle/migrations"

Relational DB Setup
-------------------

This package requires the [Cerberus Driver](https://github.com/davidsosavaldes/Cerberus), so follow the installation instructions to complete the bundle installation.