<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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

include_once (APPPATH . 'helpers/inflector_helper.php');

$path = explode('/', $_SERVER['REQUEST_URI']);

$route[$path[2]] = plural($path[2]) . "/view" . ucwords($path[2]);
$route[$path[2] . '/list'] = plural($path[2]) . "/view" . ucwords($path[2]);
$route[$path[2] . '/view/(:num)'] = plural($path[2]) . "/view" . ucwords($path[2]) . "/$1";
$route[$path[2] . '/view/(:num)/(:any)'] = plural($path[2]) . "/view" . ucwords($path[2]) . "/$1/$2";
$route[$path[2] . '/add'] = plural($path[2]) . "/add" . ucwords($path[2]);
$route[$path[2] . '/edit/(:num)'] = plural($path[2]) . "/edit" . ucwords($path[2]) . "/$1";
$route[$path[2] . '/delete/(:num)'] = plural($path[2]) . "/delete" . ucwords($path[2]) . "/$1";
$route[$path[2] . '/getjson'] = "json/get" . plural($path[2]) . "JsonData";

//Permission
$route['permission/getmethod/(:any)/(:any)'] = "ajax/getMethodsFromControllers/$1/$2";
$route['permission/check/(:num)'] = "ajax/checkValidPermision/$1";

//Role
$route['role/check/(:num)'] = "ajax/checkValidRole/$1";

//Classes
$route['clan/getschools/(:num)'] = "ajax/getSchoolsOptionFromAcademy/$1";
$route['clan/teacherlist'] = "clans/clanTeacherList";
$route['clan/teacherjson'] = "json/getTeachersJsonData";

//Email Templates
$route['email/remove_attachment/(:num)'] = "emails/removeAttachment/$1";

//Default
$route['default_controller'] = "dashboard";
$route['404_override'] = '';

//Authenticate
$route['login'] = "authenticate/index";
$route['validate'] = "authenticate/validateUser";
$route['logout'] = "authenticate/logout";
$route['forgot_password'] = "authenticate/userForgotPassword";
$route['send_reset_password_link'] = "authenticate/userSendResetPasswordLink";
$route['reset_password/(:any)'] = "authenticate/userResetPassword/$1";
$route['register'] = "authenticate/register";
$route['add_user'] = "authenticate/saveUser";
$route['checkusername/(:num)'] = "ajax/checkUsernameExit/$1";
$route['checkemail/(:num)'] = "ajax/checkEmailExit/$1";
$route['denied'] = "authenticate/permissionDenied";

//Commom
$route['getstate/(:num)'] = "ajax/getAllStatesOptionsFromCountry/$1";
$route['getcity/(:num)'] = "ajax/getAllCitiesOptionsFromState/$1";
$route['checkNotification/(:num)'] = "ajax/checkNotification/$1";
$route['load_more_notification/(:num)'] = "ajax/notificationPanigate/$1";

//Dashboard
$route['dashboard'] = "dashboard";
$route['change_language/(:any)'] = "ajax/setNewLanguage/$1";
$route['change_role/(:any)'] = "ajax/setNewRole/$1";
$route['mark_all_notification_read'] = "ajax/markAllNotificationRead";

//Profile
$route['change_password'] = "profiles/changePassword";
$route['check_current_password'] = "ajax/checkCurrentPassword";
/* End of file routes.php */
/* Location: ./application/config/routes.php */