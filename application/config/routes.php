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
$route['default_controller'] = 'site';
$route['404_override'] = 'site/not_found';
$route['translate_uri_dashes'] = FALSE;

$route['administrador']  = 'admin/login/index';
$route['gestor']         = 'admin/login/index';
$route['usuario']        = 'admin/login/index';
$route['login']          = 'admin/login/index';
$route['logout']         = 'admin/login/sign_out';
$route['authentication'] = 'admin/login/sign_in';
$route['cadastro/sign_up'] = 'admin/cadastro/sign_up';

// Rotas de usuário
$route['user']['post']   = 'api/user/register_user';
$route['user']['get']    = 'api/user/get_user';
$route['user']['put']    = 'api/user/update_user';
$route['user']['delete'] = 'api/user/delete_user';

// Rotas de Sessão
$route['sessions']['post'] = 'api/sessions/post';

// Rotas de tipo de problemas
$route['type-problem']['post']   = 'api/type_problem/add_type_problem';
$route['type-problem']['get']    = 'api/type_problem/get_type_problem';
$route['type-problem']['put']    = 'api/type_problem/update_type_problem';
$route['type-problem']['delete'] = 'api/type_problem/delete_type_problem';

// Rotas de tipo de demanda
$route['type-demand']['post']   = 'api/type_demand/add_type_demand';
$route['type-demand']['get']    = 'api/type_demand/get_type_demand';
$route['type-demand']['put']    = 'api/type_demand/update_type_demand';
$route['type-demand']['delete'] = 'api/type_demand/delete_type_demand';

// Rotas de status
$route['status']['post']   = 'api/status/add_status';
$route['status']['get']    = 'api/status/get_status';
$route['status']['put']    = 'api/status/update_status';
$route['status']['delete'] = 'api/status/delete_status';

// Rotas de coments
$route['coments']['post']   = 'api/coments/add_coments';
$route['coments']['get']    = 'api/coments/get_coments';
$route['coments']['put']    = 'api/coments/update_coments';
$route['coments']['delete'] = 'api/coments/delete_coments';

// Rotas de likes
$route['like']['post']   = 'api/likes/add_like';
$route['like']['delete'] = 'api/likes/delete_like';

// Rotas de Demandas
$route['demands']['post']   = 'api/demands/add_demands';
$route['demands']['put']    = 'api/demands/update_demands';
$route['demands']['delete'] = 'api/demands/delete_demands';
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
$route['get-demands/ranking']['get']    = 'api/get_demands/ranking';
// $route['get-demands']['get']    = 'api/demands/get_coments';

// Rotas de local
$route['local']['post']   = 'api/local/add_local';
$route['local']['get']    = 'api/local/get_local';
$route['local']['put']    = 'api/local/update_local';
$route['local']['delete'] = 'api/local/delete_local';
