<?php

class info_user extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library("pagination");
        $this->load->model('register_model','rm');
        $this->load->model('personnel_model','pm');
        $this->load->model('conger_model','cm');

        if($this->session->userdata('position') != "AezakmiHesoyamWhosyourdaddy"){
			redirect('login');
		}
    }
    
    public function admin_dashboard(){
        $this->load->model('dashboard_model');
        $this->load->model('Notification_model');
         // Charger la vue principale
        $this->load->view('Template/inclure/header'); // Charge le header (qui inclut les notifications)
        $this->load->view('Template/dashboard'); // Passez également $data à la vue principale
    }
    
    public function em_dashboard(){
        echo 'Page Employer';
    }

    // -----///--- personnel ---///------//
    public function personnel(){
        $this->load->model('Notification_model');

        // Charger la vue principale
        $this->load->view('Template/inclure/header');// Charge le header (qui inclut les notifications)
        $this->load->view('partials/header_notifications'); // Charge le contenu spécifique à la page
        $this->load->view('Template/Personnel');
    }
    public function add_personnel() {
        if ($this->input->is_ajax_request()) {
            // Utilisez "required" au lieu de "obligatoire" pour les règles de validation
            $this->form_validation->set_rules('code_em', 'Code employer', 'required');
            $this->form_validation->set_rules('nom', 'Nom', 'required');
            $this->form_validation->set_rules('email', 'Adresse e-mail', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Mot de passe', 'required');
            $this->form_validation->set_rules('adresse', 'Adresse', 'required');
            $this->form_validation->set_rules('date_nais', 'Date de naissance', 'required');
            $this->form_validation->set_rules('contact', 'Numero telephone', 'required');
            $this->form_validation->set_rules('sexe', 'Genre (sexe)', 'required');
            $this->form_validation->set_rules('post', "Post de l'employer", 'required');
            $this->form_validation->set_rules('departement', "Departement de l'employer", 'required');
            $this->form_validation->set_rules('role', 'Rôle', 'required');
            $this->form_validation->set_rules('date_creation', 'Date de creation', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<small class = "text-danger">', '</small>');

    
            if ($this->form_validation->run() == FALSE) {
                $data = array('responce' => 'error', 'message' => validation_errors()); // Utilisez "validation_errors()" au lieu de "validation_error()"
            } else {

                $ajax_data = $this->input->post();
                $code_em = $this->input->post('code_em');
                $date_dernier_mise_jrs = $this->input->post('date_creation');
                if ($this->pm->insert_personnel($ajax_data)) {
                // Insertion dans la table "solde_conger" avec l'ID généré
                    $solde_data = array(
                        'code_em' => $code_em,
                        'nbr_jrs' => 2.5, // Initialisez avec la valeur souhaitée
                        'date_dernier_mise_jrs' => $date_dernier_mise_jrs,
                        'solde_exeptionnel' => 10 // Initialisez avec la valeur souhaitée
                    );

                    if ($this->cm->insert_solde_conger($solde_data)) {
                        $data = array('responce' => 'success', 'message' => 'Personnel ajouté avec succès');
                    } else {
                        $data = array('responce' => 'error', 'message' => 'Erreur d\'enregistrement dans la table "solde_conger"');
                    }                
                }
                else {
                    $data = array('responce' => 'error', 'message' => "Erreur d'enregistrement");
                }
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
    public function fetch(){
        if ($this->input->is_ajax_request()) {
            if ($posts = $this->pm->get_entries()) {
                $data = array('responce' => 'success','posts' => $posts);
            }
            else {
                $data = array('responce' => 'error', 'message' => 'Erreur de récupération de données');
            }
            echo json_encode($data);
        }
        else {
            echo "No direct script access allowed";
        }
    }
    public function delete(){
        if ($this->input->is_ajax_request()) {
            $del_id = $this->input->post('del_id');

            if ($this->pm->delete_entry($del_id)) {
                $data = array('responce' => 'success');
            }else {
                $data = array('responce' => 'error');
            }
            echo json_encode($data);
        }
        else {
            echo "No direct script access allowed";
        }
    }
    public function edit(){
        if ($this->input->is_ajax_request()) {
            $edit_id = $this->input->post('edit_id');
            if ($posts = $this->pm->edit_entry($edit_id)){
                $data = array('responce' => 'success','posts' => $posts);
            }
            else {
                $data = array('responce' => 'error', 'message' => 'Erreur de récupération de données');
            }
            echo json_encode($data);
        }
        else {
            echo "No direct script access allowed";
        }
    }
    public function update(){
        if ($this->input->is_ajax_request()) {
            
            
            // Utilisez "required" au lieu de "obligatoire" pour les règles de validation
            $this->form_validation->set_rules('edit_code', 'Code employer', 'required');
            $this->form_validation->set_rules('edit_nom', 'Nom', 'required');
            $this->form_validation->set_rules('edit_email', 'Adresse e-mail', 'required|valid_email');
            $this->form_validation->set_rules('edit_password', 'Mot de passe', 'required');
            $this->form_validation->set_rules('edit_adresse', 'Adresse', 'required');
            $this->form_validation->set_rules('edit_nais', 'Date de naissance', 'required');
            $this->form_validation->set_rules('edit_contact', 'Numero telephone', 'required');
            $this->form_validation->set_rules('edit_sexe', 'Genre (sexe)', 'required');
            $this->form_validation->set_rules('edit_post', "Post de l'employer", 'required');
            $this->form_validation->set_rules('edit_departement', "Departement de l'employer", 'required');
            $this->form_validation->set_rules('edit_role', 'Rôle', 'required');
            $this->form_validation->set_rules('edit_date', 'Date de creation', 'required');
            $this->form_validation->set_rules('edit_status', 'Status', 'required');
            
            $this->form_validation->set_error_delimiters('<small class = "text-danger">', '</small>');
            
            
            if ($this->form_validation->run() == FALSE) {
                $data = array('responce' => 'error', 'message' => validation_errors()); // Utilisez "validation_errors()" au lieu de "validation_error()"
            } else {

                $data['id'] = $this->input->post('edit_id');
                $data['code_em'] = $this->input->post('edit_code');
                $data['nom'] = $this->input->post('edit_nom');
                $data['prenom'] = $this->input->post('edit_prenom');
                $data['email'] = $this->input->post('edit_email');
                $data['password'] = $this->input->post('edit_password');
                $data['adresse'] = $this->input->post('edit_adresse');
                $data['date_nais'] = $this->input->post('edit_nais');
                $data['sexe'] = $this->input->post('edit_sexe');
                $data['contact'] = $this->input->post('edit_contact');
                $data['post'] = $this->input->post('edit_post');
                $data['departement'] = $this->input->post('edit_departement');
                $data['role'] = $this->input->post('edit_role');
                $data['date_creation'] = $this->input->post('edit_date');
                $data['status'] = $this->input->post('edit_status');

                if ($this->pm->update_personnel($data)) {
                // Insertion dans la table "solde_conger" avec l'ID généré
                    $data = array('responce' => 'success', 'message' => 'Personnel Modifier avec succès');
                } else {
                    $data = array('responce' => 'error', 'message' => 'Erreur de modification');
                }                
            }
            echo json_encode($data);
        }
        else {
            echo "No direct script access allowed";
        }
    }

// -------------------------------//
    //  ------ Departement ------
    public function departement(){
                $this->load->model('Notification_model');

        // Charger la vue principale
        $this->load->view('Template/inclure/header');// Charge le header (qui inclut les notifications)
        $this->load->view('partials/header_notifications'); // Charge le contenu spécifique à la page
        $this->load->view('Template/Departement');
    }
    public function add_departement(){
        
        if ($this->input->is_ajax_request()) {
            // Utilisez "required" au lieu de "obligatoire" pour les règles de validation
            $this->form_validation->set_rules('dep_name', 'Nom du departement', 'required');

            $this->form_validation->set_error_delimiters('<small class = "text-danger">', '</small>');

    
            if ($this->form_validation->run() == FALSE) {
                $data = array('responce' => 'error', 'message' => validation_errors()); // Utilisez "validation_errors()" au lieu de "validation_error()"
            } else {

                $ajax_data = $this->input->post();
                if ($this->pm->insert_departement($ajax_data)) {
                    $data = array('responce' => 'success', 'message' => 'Departement ajouté avec succès');
                }
                else {
                    $data = array('responce' => 'error', 'message' => "Erreur d'enregistrement");
                }
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
    public function fetch_departement(){
        if ($this->input->is_ajax_request()) {
            if ($posts = $this->pm->get_departement()) {
                $data = array('responce' => 'success','posts' => $posts);
            }
            else {
                $data = array('responce' => 'error', 'message' => 'Erreur de récupération de données');
            }
            echo json_encode($data);
        }
        else {
            echo 'No direct script access allowed';
        }
    }
    public function delete_departement(){
        if ($this->input->is_ajax_request()) {
            $del_id = $this->input->post('del_id');

            if ($this->pm->delete_departement($del_id)) {
                $data = array('responce' => 'success');
            }else {
                $data = array('responce' => 'error');
            }
            echo json_encode($data);
        }
        else {
            echo "No direct script access allowed";
        }
    }
    public function edit_departement(){
        if ($this->input->is_ajax_request()) {
            $edit_id = $this->input->post('edit_id');
            if ($posts = $this->pm->edit_departement($edit_id)){
                $data = array('responce' => 'success','posts' => $posts);
            }
            else {
                $data = array('responce' => 'error', 'message' => 'Erreur de récupération de données');
            }
            echo json_encode($data);
        }
        else {
            echo "No direct script access allowed";
        }
    }
    public function update_departement(){
        if ($this->input->is_ajax_request()) {
                   
            // Utilisez "required" au lieu de "obligatoire" pour les règles de validation
            $this->form_validation->set_rules('edit_dep_name', 'Nom du departement', 'required');
            
            $this->form_validation->set_error_delimiters('<small class = "text-danger">', '</small>');
            
            
            if ($this->form_validation->run() == FALSE) {
                $data = array('responce' => 'error', 'message' => validation_errors()); // Utilisez "validation_errors()" au lieu de "validation_error()"
            } else {

                $data['id_dep'] = $this->input->post('edit_id');
                $data['dep_name'] = $this->input->post('edit_dep_name');

                if ($this->pm->update_departement($data)) {
                    $data = array('responce' => 'success', 'message' => 'Departement Modifier avec succès');
                } else {
                    $data = array('responce' => 'error', 'message' => 'Erreur de modification');
                }                
            }
            echo json_encode($data);
        }
        else {
            echo "No direct script access allowed";
        }
    }
    

    // -------------------------------//
        //  ------ Post ------ //
    public function post(){
                $this->load->model('Notification_model');

        // Charger la vue principale
        $this->load->view('Template/inclure/header');// Charge le header (qui inclut les notifications)
        $this->load->view('partials/header_notifications'); // Charge le contenu spécifique à la page
        $this->load->view('Template/Post');
    }
    public function add_post(){
        
        if ($this->input->is_ajax_request()) {
            // Utilisez "required" au lieu de "obligatoire" pour les règles de validation
            $this->form_validation->set_rules('design', 'Designation', 'required');

            $this->form_validation->set_error_delimiters('<small class = "text-danger">', '</small>');

    
            if ($this->form_validation->run() == FALSE) {
                $data = array('responce' => 'error', 'message' => validation_errors()); // Utilisez "validation_errors()" au lieu de "validation_error()"
            } else {

                $ajax_data = $this->input->post();
                if ($this->pm->insert_post($ajax_data)) {
                    $data = array('responce' => 'success', 'message' => 'Post ajouté avec succès');
                }
                else {
                    $data = array('responce' => 'error', 'message' => "Erreur d'enregistrement");
                }
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
    public function fetch_post(){
        if ($this->input->is_ajax_request()) {
            if ($posts = $this->pm->get_entries_post()) {
                $data = array('responce' => 'success','posts' => $posts);
            }
            else {
                $data = array('responce' => 'error', 'message' => 'Erreur de récupération de données');
            }
            echo json_encode($data);
        }
        else {
            echo 'No direct script access allowed';
        }
    }
    public function delete_post(){
        if ($this->input->is_ajax_request()) {
            $del_id = $this->input->post('del_id');

            if ($this->pm->delete_post($del_id)) {
                $data = array('responce' => 'success');
            }else {
                $data = array('responce' => 'error');
            }
            echo json_encode($data);
        }
        else {
            echo "No direct script access allowed";
        }
    }
    public function edit_post(){
        if ($this->input->is_ajax_request()) {
            $edit_id = $this->input->post('edit_id');
            if ($posts = $this->pm->edit_post($edit_id)){
                $data = array('responce' => 'success','posts' => $posts);
            }
            else {
                $data = array('responce' => 'error', 'message' => 'Erreur de récupération de données');
            }
            echo json_encode($data);
        }
        else {
            echo "No direct script access allowed";
        }
    }
    public function update_post(){
        if ($this->input->is_ajax_request()) {
                   
            // Utilisez "required" au lieu de "obligatoire" pour les règles de validation
            $this->form_validation->set_rules('edit_design', 'Designation', 'required');
            
            $this->form_validation->set_error_delimiters('<small class = "text-danger">', '</small>');
            
            
            if ($this->form_validation->run() == FALSE) {
                $data = array('responce' => 'error', 'message' => validation_errors()); // Utilisez "validation_errors()" au lieu de "validation_error()"
            } else {

                $data['id_post'] = $this->input->post('edit_id');
                $data['design'] = $this->input->post('edit_design');

                if ($this->pm->update_post($data)) {
                // Insertion dans la table "solde_conger" avec l'ID généré
                    $data = array('responce' => 'success', 'message' => 'Post Modifier avec succès');
                } else {
                    $data = array('responce' => 'error', 'message' => 'Erreur de modification');
                }                
            }
            echo json_encode($data);
        }
        else {
            echo "No direct script access allowed";
        }
    }
}

?> 