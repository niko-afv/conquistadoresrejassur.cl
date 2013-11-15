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
|   example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|   http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|   $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|   $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*FrontEnd*/
$route['default_controller']                =   "frontend/home";
$route['404_override']                      =   '';

/*BackEnd*/
$route['admin']                             =   "backend/CtrlPrincipal";
$route['admin/logout']                      =   "backend/CtrlPrincipal/logout";
$route['bo/pin']                            =   "backend/CtrlPrincipal/pin";

$route['admin/login']                       =   "backend/CtrlLogin";
$route['admin/login/(:any)']                =   "backend/CtrlLogin/$1";

$route['admin/upload/(:any)']               =   "backend/upload/$1";

$route['admin/integrantes_form']            =   "backend/CtrlIntegranteForm";
$route['admin/integrantes_form/(:any)']     =   "backend/CtrlIntegranteForm/$1";
$route['admin/integrantes_list']            =   "backend/CtrlIntegranteList";
$route['admin/integrantes_list/(:any)']     =   "backend/CtrlIntegranteList/$1";

$route['admin/unidades_form']               =   "backend/ctrl_unidad_formulario";
$route['admin/unidades_form/(:any)']        =   "backend/ctrl_unidad_formulario/$1";
$route['admin/unidades_list']               =   "backend/ctrl_unidad_listado";
$route['admin/unidades_list/(:any)']        =   "backend/ctrl_unidad_listado/$1";
$route['admin/agregar_integrantes']         =   "backend/ctrlUnidadIntegrantes";
$route['admin/agregar_integrantes/(:any)']  =   "backend/ctrlUnidadIntegrantes/$1";

$route['admin/flujo_caja']                  =   "backend/CtrlFlujoCajaList";
$route['admin/flujo_caja/(:any)']           =   "backend/CtrlFlujoCajaList/$1";

$route['admin/flujo_caja_form']             =   "backend/CtrlFlujoCajaForm";
$route['admin/flujo_caja_form/(:any)']      =   "backend/CtrlFlujoCajaForm/$1";

$route['admin/listados_form']             =   "backend/CtrlListForm";
$route['admin/listados_form/(:any)']      =   "backend/CtrlListForm/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */