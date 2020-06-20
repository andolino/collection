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
$route['default_controller'] 					= 'admin';
$route['constituent-list'] 						= 'Admin/member_list';
$route['monthly-bills'] 						= 'Admin/monthly_bills';
$route['add-constituent'] 						= 'Admin/add_constituent';
$route['add-monthly-bills'] 						= 'Admin/add_monthly_bills';
$route['save-constituent'] 						= 'Admin/save_constituent';
$route['save-monthly-bills'] 						= 'Admin/save_monthly_bills';
$route['server-tbl-lgu-constituent'] 	= 'Admin/server_tbl_lgu_constituent';
$route['server-tbl-monthly-bills'] 	= 'Admin/server_tbl_monthly_bills';
$route['login'] 											= 'Admin/usr_login';
$route['submit-login'] 								= 'Admin/proceed_login';
$route['logout'] 											= 'Admin/destroy_sess';
$route['lgu-id/(:any)'] 							= 'Admin/showID';
$route['lgu-c-details'] 							= 'Admin/fetch_indvl_details';
$route['show-multiple-ids'] 					= 'Admin/show_multiple_ids';
$route['show-mltple-const/(:any)'] 		= 'Admin/show_multiple_constituent';
$route['view-constituent'] 						= 'Admin/view_constituent_list';
$route['upload-dp'] 									= 'Admin/upload_const_dp';
$route['control-token'] 							= 'Admin/control_token';
$route['show-gen-token'] 							= 'Admin/show_gen_token';
$route['generate-token'] 							= 'Admin/generateToken';
$route['save-token'] 									= 'Admin/saveToken';
$route['edit-constituent'] 						= 'Admin/edit_constituent';
$route['delete-constituent'] 					= 'Admin/deleteConstituent';
$route['tbl-constituent-list'] 				= 'Admin/tbl_constituent_list';
$route['tbl-monthly-bills'] 				= 'Admin/tbl_monthly_bills';



$route['404_override'] 					= '';
$route['translate_uri_dashes'] 	= FALSE;
