<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// --- login et inscription pour un utilisateur et un administrateur ---
$route['login']['GET'] = 'Login/login_controller/login';
$route['action'] = 'Login/login_controller/action';
$route['admin_dashboard'] = 'info_user/admin_dashboard';
$route['em_dashboard'] = 'info_user/em_dashboard';
$route['logout'] = 'Login/login_controller/logout';

// personnel //
$route['personnel'] = 'info_user/personnel';
$route['add_personnel'] = 'info_user/add_personnel';
$route['fetch'] = 'info_user/fetch';
$route['update'] = 'info_user/update';
$route['delete'] = 'info_user/delete';
$route['edit'] = 'info_user/edit';
$route['solde_conger'] = 'conger/conger_controller/solde_conger';
$route['fetch_solde'] = 'conger/conger_controller/fetch_solde';

// post //
$route['post'] = 'info_user/post';
$route['add_post'] = 'info_user/add_post';
$route['fetch_post'] = 'info_user/fetch_post';
$route['delete_post'] = 'info_user/delete_post';
$route['edit_post'] = 'info_user/edit_post';
$route['update_post'] = 'info_user/update_post';

// departement //
$route['departement'] = 'info_user/departement';
$route['add_departement'] = 'info_user/add_departement';
$route['fetch_departement'] = 'info_user/fetch_departement';
$route['delete_departement'] = 'info_user/delete_departement';
$route['edit_departement'] = 'info_user/edit_departement';
$route['update_departement'] = 'info_user/update_departement';

// type conger //
$route['type_conger'] = 'conger/conger_controller/type_conger';
$route['add_type_conger'] = 'conger/conger_controller/add_type_conger';
$route['fetch_type'] = 'conger/conger_controller/fetch_type';
$route['delete_type_conger'] = 'conger/conger_controller/delete_type_conger';
$route['edit_type_conger'] = 'conger/conger_controller/edit_type_conger';
$route['update_type_conger'] = 'conger/conger_controller/update_type_conger';

// demande conger //
$route['demande_conger'] = 'conger/conger_controller/demande_conger';
$route['add_conger'] = 'conger/conger_controller/add_conger';
$route['fetch_conger'] = 'conger/conger_controller/fetch_conger';
$route['delete_conger'] = 'conger/conger_controller/delete_conger';
$route['accepter_conger1'] = 'conger/conger_controller/accepter_conger1';
$route['rejeter_conger'] = 'conger/conger_controller/rejeter_conger';
$route['get_nom_prenom_by_code_em'] = 'conger/conger_controller/get_nom_prenom_by_code_em';
$route['get_code_em_by_nom_prenom'] = 'conger/conger_controller/get_code_em_by_nom_prenom';


//solde conger
$route['get_solde'] = 'conger/conger_controller/get_solde';

//conger en cours de validation
$route['conger_en_cours'] = 'conger/conger_controller/conger_en_cours';
$route['fetch_conger_en_cours'] = 'conger/conger_controller/fetch_conger_en_cours';
$route['accepter_conger2'] = 'conger/conger_controller/accepter_conger2';

// conger gagner
$route['conger_gagner'] = 'conger/conger_controller/conger_gagner';
$route['fetch_conger_gagner'] = 'conger/conger_controller/fetch_conger_gagner';

// Historique des conger
$route['historique_conger'] = 'conger/conger_controller/historique_conger';
$route['fetch_historique_conger'] = 'conger/conger_controller/fetch_historique_conger';
