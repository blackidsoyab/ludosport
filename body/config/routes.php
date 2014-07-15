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

//Country Management
$route['country'] = "countries/viewcountry";
$route['country/list'] = "countries/viewcountry";
$route['country/add'] = "countries/addcountry";
$route['country/edit/(:num)'] = "countries/editcountry/$1";
$route['country/delete/(:num)'] = "countries/deletecountry/$1";
$route['country/getJson'] = "json/getCountryJsonData";

//State Management
$route['states'] = "states/viewstates";
$route['states/list'] = "states/viewstates";
$route['states/add'] = "states/addstates";
$route['states/edit/(:num)'] = "states/editstates/$1";
$route['states/delete/(:num)'] = "states/deletestates/$1";
$route['states/getJson'] = "json/getStatesJsonData";

//State Management
$route['city'] = "cities/viewcity";
$route['city/list'] = "cities/viewcity";
$route['city/add'] = "cities/addcity";
$route['city/edit/(:num)'] = "cities/editcity/$1";
$route['city/delete/(:num)'] = "cities/deletecity/$1";
$route['city/getJson'] = "json/getCitiesJsonData";

/* End of file routes.php */
/* Location: ./application/config/routes.php */