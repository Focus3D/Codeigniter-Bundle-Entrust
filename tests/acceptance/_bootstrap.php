<?php
// Here you can initialize variables that will be available to your tests
if (empty(ini_get('date.timezone'))) 
{
	date_default_timezone_set('UTC');	
}