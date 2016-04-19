<?php
/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
| Enables a CSRF cookie token to be set. When set to TRUE, token will be
| checked on a submitted form. If you are accepting user data, it is strongly
| recommended CSRF protection be enabled.
|
| 'csrf_token_name' = The token name
| 'csrf_cookie_name' = The cookie name
| 'csrf_expire' = The number in seconds the token should expire.
| 'csrf_regenerate' = Regenerate token on every submission
| 'csrf_exclude_uris' = Array of URIs which ignore CSRF checks
*/
$config['csrf_protection']   = TRUE;
$config['csrf_token_name']   = 'ci_csrf_entrust_token';
$config['csrf_cookie_name']  = 'ci_csrf_entrust_cookie';
$config['csrf_expire']       = 7200;
$config['csrf_regenerate']   = FALSE;
$config['csrf_exclude_uris'] = array(
	'entrust/api/cerberus/(.+)'
);