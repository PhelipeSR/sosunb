<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = 'welcome/not_found';
$route['translate_uri_dashes'] = FALSE;

// Rotas de usuário
$route['api/user']['post']   = 'api/user/register_user';
$route['api/user']['get']    = 'api/user/get_user';
$route['api/user']['put']    = 'api/user/update_user';
$route['api/user']['delete'] = 'api/user/delete_user';

// Rotas de Sessão
$route['api/session']['post'] = 'api/session/post';

// Rotas de tipo de problemas
$route['api/type-problem']['post']   = 'api/type_problem/add_type_problem';
$route['api/type-problem']['get']    = 'api/type_problem/get_type_problem';
$route['api/type-problem']['put']    = 'api/type_problem/update_type_problem';
$route['api/type-problem']['delete'] = 'api/type_problem/delete_type_problem';

// Rotas de tipo de demanda
$route['api/type-demand']['post']   = 'api/type_demand/add_type_demand';
$route['api/type-demand']['get']    = 'api/type_demand/get_type_demand';
$route['api/type-demand']['put']    = 'api/type_demand/update_type_demand';
$route['api/type-demand']['delete'] = 'api/type_demand/delete_type_demand';

// Rotas de status
$route['api/status']['post']   = 'api/status/add_status';
$route['api/status']['get']    = 'api/status/get_status';
$route['api/status']['put']    = 'api/status/update_status';
$route['api/status']['delete'] = 'api/status/delete_status';
