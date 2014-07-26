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
$route['register/checkusername'] = "ajax/registerCheckUsername";
$route['register/checkemail'] = "ajax/registerCheckEmail";
$route['denied'] = "authenticate/permissionDenied";

//Commom
$route['getstate/(:num)'] = "ajax/getAllStatesOptionsFromCountry/$1";
$route['getcity/(:num)'] = "ajax/getAllCitiesOptionsFromState/$1";
$route['checkNotification/(:num)'] = "ajax/checkNotification/$1";

//Dashboard
$route['dashboard'] = "dashboard";
$route['change_language/(:any)'] = "ajax/setNewLanguage/$1";
$route['change_role/(:any)'] = "ajax/setNewRole/$1";

//Country Management
$route['country'] = "countries/viewCountry";
$route['country/list'] = "countries/viewCountry";
$route['country/add'] = "countries/addCountry";
$route['country/edit/(:num)'] = "countries/editCountry/$1";
$route['country/delete/(:num)'] = "countries/deleteCountry/$1";
$route['country/getjson'] = "json/getCountryJsonData";

//State Management
$route['state'] = "states/viewStates";
$route['state/list'] = "states/viewStates";
$route['state/add'] = "states/addStates";
$route['state/edit/(:num)'] = "states/editStates/$1";
$route['state/delete/(:num)'] = "states/deleteStates/$1";
$route['state/getjson'] = "json/getStatesJsonData";

//State Management
$route['city'] = "cities/viewCity";
$route['city/list'] = "cities/viewCity";
$route['city/add'] = "cities/addCity";
$route['city/edit/(:num)'] = "cities/editCity/$1";
$route['city/delete/(:num)'] = "cities/deleteCity/$1";
$route['city/getjson'] = "json/getCitiesJsonData";

//Permission Management
$route['permission'] = "permissions/viewPermission";
$route['permission/list'] = "permissions/viewPermission";
$route['permission/add'] = "permissions/addPermission";
$route['permission/edit/(:num)'] = "permissions/editPermission/$1";
$route['permission/delete/(:num)'] = "permissions/deletePermission/$1";
$route['permission/getjson'] = "json/getPermissionsJsonData";
$route['permission/getmethod/(:any)/(:any)'] = "ajax/getMethodsFromControllers/$1/$2";
$route['permission/check/(:num)'] = "ajax/checkValidPermision/$1";

//Role Management
$route['role'] = "roles/viewRole";
$route['role/list'] = "roles/viewRole";
$route['role/add'] = "roles/addRole";
$route['role/edit/(:num)'] = "roles/editRole/$1";
$route['role/delete/(:num)'] = "roles/deleteRole/$1";
$route['role/getjson'] = "json/getRolesJsonData";
$route['role/check/(:num)'] = "ajax/checkValidRole/$1";

//User Managmanet
$route['user'] = "users/viewUser";
$route['user/list'] = "users/viewUser";
$route['user/add'] = "users/addUser";
$route['user/edit/(:num)'] = "users/editUser/$1";
$route['user/delete/(:num)'] = "users/deleteUser/$1";
$route['user/getjson'] = "json/getUsersJsonData";
$route['user/extrapermission/(:num)'] = "users/extraPermissionUser/$1";

//Academy Managment
$route['academy'] = "academies/viewAcademy";
$route['academy/list'] = "academies/viewAcademy";
$route['academy/view/(:num)'] = "academies/viewAcademy/$1";
$route['academy/add'] = "academies/addAcademy";
$route['academy/edit/(:num)'] = "academies/editAcademy/$1";
$route['academy/delete/(:num)'] = "academies/deleteAcademy/$1";
$route['academy/getjson'] = "json/getAcademiesJsonData";

//School Managment
$route['school'] = "schools/viewSchool";
$route['school/list'] = "schools/viewSchool";
$route['school/view/(:num)'] = "schools/viewSchool/$1";
$route['school/add'] = "schools/addSchool";
$route['school/edit/(:num)'] = "schools/editSchool/$1";
$route['school/delete/(:num)'] = "schools/deleteSchool/$1";
$route['school/getjson'] = "json/getSchoolsJsonData";

//Class / Clan Management
$route['clan'] = "clans/viewClan";
$route['clan/list'] = "clans/viewClan";
$route['clan/view/(:num)'] = "clans/viewClan/$1";
$route['clan/add'] = "clans/addClan";
$route['clan/edit/(:num)'] = "clans/editClan/$1";
$route['clan/delete/(:num)'] = "clans/deleteClan/$1";
$route['clan/getjson'] = "json/getClansJsonData";
$route['clan/getschools/(:num)'] = "ajax/getSchoolsOptionFromAcademy/$1";
$route['clan/teacherlist'] = "clans/clanTeacherList";
$route['clan/teacherjson'] = "json/getTeachersJsonData";

//Manage Class Levels
$route['level'] = "levels/viewLevel";
$route['level/list'] = "levels/viewLevel";
$route['level/add'] = "levels/addLevel";
$route['level/edit/(:num)'] = "levels/editLevel/$1";
$route['level/delete/(:num)'] = "levels/deleteLevel/$1";
$route['level/getjson'] = "json/getLevelsJsonData";

//Manage Email Templates
$route['email'] = "emails/viewEmail";
$route['email/list'] = "emails/viewEmail";
$route['email/edit/(:num)'] = "emails/editEmail/$1";
$route['email/getjson'] = "json/getEmailsJsonData";
$route['email/remove_attachment/(:num)'] = "emails/removeAttachment/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */