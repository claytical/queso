<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "frontpage";
$route['quests/(:num)'] = 'common_auth/quest/view/$1';
$route['quests/completed'] = 'common_auth/quest/completed';
$route['quests/available/(:any)'] = 'common_auth/quest/available/$1';
/*$route['admin/quests/available/(:any)'] = 'admin/quest/available/$1';*/
$route['admin/quests/grade/(:any)'] = 'admin/quest/grade/$1';
$route['admin/quests/skills/get'] = 'admin/quest/skill_rewards';
$route['submission/(:num)'] = 'common_auth/submission/view/$1';
$route['submission/revise/(:num)'] = 'common_auth/submission/revise/$1';

$route['admin/submission/(:num)'] = 'admin/submission/grade/$1';
$route['admin/submissions/(:any)'] = 'admin/submission/$1';
$route['quests'] = 'common_auth/quest';
$route['admin/quests'] = 'admin/quest';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['register'] = 'auth/create_user';
$route['user/password'] = 'auth/change_password';

$route['admin/skills'] = 'admin/skill';
$route['admin/skills/(:any)'] = 'admin/skill/$1';
$route['users'] = 'user';
$route['users/(:any)'] = 'user/$1';
$route['pages/(:any)'] = 'pages/view/$1';
$route['quest/(:any)'] = 'common_auth/quest/$1';

//$route['(:any)'] = 'pages/view/$1';
//$route['default_controller'] = "pages/view";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
