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

$route['default_controller'] = "frontpage/dashboard";
$route['posts'] = 'public/post/index';
$route['post/(:num)'] = 'public/post/view/$1';
$route['pages/(:any)'] = 'pages/view/$1';
$route['quest/(:any)'] = 'common_auth/quest/$1';
$route['quests'] = 'common_auth/quest';
$route['quests/(:num)'] = 'common_auth/quest/view/$1';
$route['quests/completed'] = 'common_auth/quest/completed';
$route['quests/available/(:any)'] = 'common_auth/quest/available/$1';
$route['admin/quests/available/(:any)'] = 'admin/quest/available/$1';
$route['submission/(:num)'] = 'common_auth/submission/view/$1';
$route['submission/revise/(:num)'] = 'common_auth/submission/revise/$1';
$route['discuss/(:num)'] = 'common_auth/submission/discuss/$1';
$route['discussion'] = 'common_auth/submission/discussion';
$route['file/do_upload/(:num)'] = 'common_auth/file_submission/do_upload/$1';
$route['file/view/(:num)'] = 'common_auth/file_submission/view/$1';
$route['admin/file/grade/(:num)'] = 'admin/file_submission/grade/$1';
$route['admin/quests'] = 'admin/quest';
$route['admin/quest/kill/(:any)'] = 'admin/quest/remove_student/$1';
$route['admin/quests/grade/(:any)'] = 'admin/quest/grade/$1';
$route['admin/quests/skills/get'] = 'admin/quest/skill_rewards';
$route['admin/submission/(:num)'] = 'admin/submission/grade/$1';
$route['admin/submissions/(:any)'] = 'admin/submission/$1';
$route['admin/posts'] = 'admin/post/index';
$route['admin/grades'] = 'admin/grade';
$route['admin/skills'] = 'admin/skill';
$route['admin/skills/(:any)'] = 'admin/skill/$1';
$route['admin/users'] = 'auth';
$route['admin/user/(:num)'] = 'admin/user/view/$1';

$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['register'] = 'auth/create_user';
$route['user/password'] = 'auth/change_password';
$route['users'] = 'user';
$route['users/(:any)'] = 'user/$1';

//$route['(:any)'] = 'pages/view/$1';
//$route['default_controller'] = "pages/view";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
