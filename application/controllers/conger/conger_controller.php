<?php

class conger_controller extends CI_controller
{
    public function __construct(){
        parent::__construct();
        // Chargez le modèle d'employés
        $this->load->model('conger_model','cm');
        $this->load->model('personnel_model','pm');
    }

    // solde conger
    public function solde_conger(){
        $this->load->model('Notification_model');

        // Charger la vue principale
        $this->load->view('Template/inclure/header');// Charge le header (qui inclut les notifications)
        $this->load->view('partials/header_notifications'); // Charge le contenu spécifique à la page
        $this->load->view('Template/conger/solde_conger_view');
    }
    public function fetch_solde(){
        if ($this->input->is_ajax_request()) {
            if ($posts = $this->cm->get_entries())
                $data = array('responce' => 'success','posts' => $posts);
            else {
                $data = array('responce' => 'error', 'message' => 'Erreur de récupération de données');
            }
            echo json_encode($data);
        }
        else {
            echo 'No direct script access allowed';
        }
    }

    public function save_user() {
        $data = $this->cm->increment_solde_conge();
        $response = array('message' => 'Solde congé incrémenté de 2.5 jours');
        echo json_encode($response);
    }
    

    // type de conger
    public function type_conger(){
        $this->load->model('Notification_model');

        // Charger la vue principale
        $this->load->view('Template/inclure/header');// Charge le header (qui inclut les notifications)
        $this->load->view('partials/header_notifications'); // Charge le contenu spécifique à la page        
        $this->load->view('Template/conger/type_conger_view');
    }
    public function add_type_conger(){

        if ($this->input->is_ajax_request()) {
            // Utilisez "required" au lieu de "obligatoire" pour les règles de validation
            $this->form_validation->set_rules('nom', 'Nom', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<small class = "text-danger">', '</small>');

    
            if ($this->form_validation->run() == FALSE) {
                $data = array('responce' => 'error', 'message' => validation_errors()); // Utilisez "validation_errors()" au lieu de "validation_error()"
            } else {

                $ajax_data = $this->input->post();
                if ($this->cm->insert_type_conger($ajax_data)) {
                    $data = array('responce' => 'success', 'message' => 'Type de conger ajouté avec succès');
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
    public function fetch_type(){
        if ($this->input->is_ajax_request()) {
            if ($posts = $this->cm->get_entries_type()) {
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
    public function delete_type_conger(){
        if ($this->input->is_ajax_request()) {
            $del_id = $this->input->post('del_id');

            if ($this->cm->delete_entry_type($del_id)) {
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
    public function edit_type_conger(){
        if ($this->input->is_ajax_request()) {
            $edit_id = $this->input->post('edit_id');
            if ($posts = $this->cm->edit_entry_type($edit_id)){
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
    public function update_type_conger(){
        if ($this->input->is_ajax_request()) {
            
            
            // Utilisez "required" au lieu de "obligatoire" pour les règles de validation
            $this->form_validation->set_rules('edit_nom', 'Nom', 'required');
            $this->form_validation->set_rules('edit_status', 'Status', 'required');
            
            $this->form_validation->set_error_delimiters('<small class = "text-danger">', '</small>');
            
            
            if ($this->form_validation->run() == FALSE) {
                $data = array('responce' => 'error', 'message' => validation_errors()); // Utilisez "validation_errors()" au lieu de "validation_error()"
            } else {

                $data['type_id'] = $this->input->post('edit_id');
                $data['nom'] = $this->input->post('edit_nom');
                $data['status'] = $this->input->post('edit_status');

                if ($this->cm->update_type_conger($data)) {
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



    // demande de conger
    public function demande_conger(){
        $this->load->model('Notification_model');

        // Charger la vue principale
        $this->load->view('Template/inclure/header');// Charge le header (qui inclut les notifications)
        $this->load->view('partials/header_notifications'); // Charge le contenu spécifique à la page
        $this->load->view('Template/conger/demande_conger_view');
    }
    public function add_conger() {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('code_em', 'Code employer', 'required');
            $this->form_validation->set_rules('type_conger', 'type_conger', 'required');
            $this->form_validation->set_rules('date_debut', 'date du debut', 'required');
    
            $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    
            if ($this->form_validation->run() == FALSE) {
                $data = array('responce' => 'error', 'message' => validation_errors());
            } else {
                $ajax_data = $this->input->post();
    
                // Insérer le téléchargement d'image ici (si un fichier est sélectionné)
                if (!empty($_FILES['img_reason']['name'])) {
                    $config['upload_path'] = realpath(FCPATH . 'assets/images/piece_justificatif');
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                    $this->load->library('upload', $config);
    
                    if (!$this->upload->do_upload('img_reason')) {
                        $data = array('responce' => 'error', 'message' => $this->upload->display_errors());
                    } else {
                        $image_data = $this->upload->data();
                        $ajax_data['img_reason'] = $image_data['file_name'];
                    }
                }
                $this->load->model('Notification_model');

               // ...
               $id_conger = $this->cm->insert_conger($ajax_data);

                if ($id_conger) {
                        // Obtenez le nom et le prénom en fonction du code_em
                    $nomPrenom = $this->pm->getNomPrenomByCodeEm($ajax_data['code_em']);
                    // Obtenez l'ID auto-incrémenté de la dernière insertion
                    
                    if ($id_conger > 0) {  // Assurez-vous que l'ID est valide
                        // Insérez dans la table "notification"
                        $notification_data = array(
                            'nom' => $nomPrenom['nom'],
                            'prenom' => $nomPrenom['prenom'],
                            'id_conger' => $id_conger,
                            'code_em' => $ajax_data['code_em'],
                            'status_conger' => $ajax_data['status_conger'],
                            'duree_conger' => $ajax_data['duree_conger'],
                            'date_notification' => $ajax_data['date_demande'],
                            'date_debut' => $ajax_data['date_debut'],
                            'etat' => 'non lu'
                        );

                        $this->Notification_model->insertNotification($notification_data);

                        $data = array('responce' => 'success', 'message' => 'Demande de conger ajouter avec success');
                    } else {
                        $data = array('responce' => 'error', 'message' => "Erreur lors de la récupération de l'ID de la demande de congé");
                    }
                } else {
                    $data = array('responce' => 'error', 'message' => "Erreur d'enregistrement");
                }

// ...

            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }  
    public function fetch_conger(){
        if ($this->input->is_ajax_request()) {
            if ($posts = $this->cm->get_conger()) {
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
    public function delete_conger(){
        if ($this->input->is_ajax_request()) {
            $del_id = $this->input->post('del_id');

            if ($this->cm->delete_entry_conger($del_id)) {
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
    public function accepter_conger1() {
        if ($this->input->is_ajax_request()) {
            $accept_id = $this->input->post('accept_id');
            $status = $this->input->post('status_conger');
            $this->load->model('Notification_model','Nm');
            
            if ($this->cm->accepter_entry_conger($accept_id, $status)) {
                $this->Nm->status_modifier($accept_id, $status);
                $data = array('responce' => 'success');
            } else {
                $data = array('responce' => 'error', 'message' => 'Erreur lors de la mise en attente du congé.');
            }
    
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
    public function accepter_conger2() {
        if ($this->input->is_ajax_request()) {
            $accept_id = $this->input->post('accept_id');
            $status = $this->input->post('status_conger');
            $code_em = $this->cm->get_code($accept_id);
            $type_conger = $this->cm->get_type($accept_id);
    
            // Récupérer la durée du congé à partir de la demande de congé
            $duree_conger = $this->cm->get_duree_conger($accept_id);
    
            // Récupérer le solde de congé actuel de l'employé
            $solde = $this->cm->get_solde_conger($code_em);
    
            if ($solde !== false) {
                $this->load->model('Notification_model','Nm');
                if ($type_conger == 'Avec solde') {
                    $nouveau_solde = $solde->nbr_jrs - $duree_conger;
                    // Mettre à jour le solde de congé dans la base de données
                    if ($this->cm->mettre_a_jour_solde_conger($code_em, $nouveau_solde,$type_conger)) {
                        $this->cm->accepter_entry_conger($accept_id, $status);
                        $this->Nm->status_modifier($accept_id, $status);
                        $data = array('responce' => 'success');
                    } else {
                        $data = array('responce' => 'error', 'message' => 'Erreur lors de la mise à jour du solde de congé.');
                    }
                } elseif ($type_conger == 'Exceptionnel') {
                    $nouveau_solde = $solde->solde_exeptionnel - $duree_conger;

                    // Mettre à jour le solde de congé dans la base de données
                    if ($this->cm->mettre_a_jour_solde_conger($code_em, $nouveau_solde,$type_conger)) {
                        $this->cm->accepter_entry_conger($accept_id, $status);
                        $this->Nm->status_modifier($accept_id, $status);
                        $data = array('responce' => 'success');
                    } else {
                        $data = array('responce' => 'error', 'message' => 'Erreur lors de la mise à jour du solde de congé.');
                    }
                } else {
                    if ($this->cm->accepter_entry_conger($accept_id, $status)) {
                        $this->Nm->status_modifier($accept_id, $status);
                        $data = array('responce' => 'success');
                    } else {
                        $data = array('responce' => 'error', 'message' => 'Erreur lors de la mise à jour du solde de congé.');
                    }
                }
            } else {
                $data = array('responce' => 'error', 'message' => 'Erreur lors de la récupération du solde de congé.');
            }
    
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
    
      
    public function rejeter_conger(){
        if ($this->input->is_ajax_request()) {
            $rejet_id = $this->input->post('rejet_id');
            $status = $this->input->post('status_conger');
            $this->load->model('Notification_model','Nm');

            if ($this->cm->rejeter_entry_conger($rejet_id,$status)) {
                $this->Nm->status_modifier($rejet_id, $status);
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


    public function get_code_em_by_nom_prenom()
    {
        $nom = $this->input->post('nom');
        $prenom = $this->input->post('prenom');
        
        $query = $this->db->query("SELECT code_em FROM personnel WHERE nom = ? AND prenom = ?", array($nom, $prenom));
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
        
            $code_em = $row->code_em;
        
            return [
                'success' => true,
                'code_em' => $code_em,
            ];
        } else {
            return [
                'success' => false,
            ];
        }
    }
    
    public function get_nom_prenom_by_code_em()
    {
        $code_em = $this->input->post('code_em');
    
        $query = $this->db->query("SELECT nom, prenom FROM personnel WHERE code_em = ?", array($code_em));
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
        
            $nom_prenom = $row->nom . ' ' . $row->prenom;
        
            return [
                'success' => true,
                'nom_prenom' => $nom_prenom,
            ];
        } else {
            return [
                'success' => false,
            ];
        }
    }
    


    //solde conger
    public function get_solde(){
        $code_em = $this->input->post('code_em');
        $this->load->model('dashboard_model');
        $solde = $this->dashboard_model->Getsolde_conger($code_em);

        if ($solde) {
            $response = array(
                'responce' => 'success',
                'message' => 'Vous n\'avez pas assez de solde pour cette demande',
                'solde_conger' => $solde->nbr_jrs,
                'solde_exceptionnel' => $solde->solde_exeptionnel
            );
        } else {
            $response = array(
                'responce' => 'error',
                'message' => 'Impossible de récupérer la solde.'
            );
        }

        echo json_encode($response);
    }


    // conger en cours de validation
    public function conger_en_cours(){
        $this->load->model('Notification_model');

        // Charger la vue principale
        $this->load->view('Template/inclure/header');// Charge le header (qui inclut les notifications)
        $this->load->view('partials/header_notifications'); // Charge le contenu spécifique à la page
        $this->load->view('Template/conger/demande_en_cours_de_validation');
    }
    public function fetch_conger_en_cours(){
        if ($this->input->is_ajax_request()) {
            if ($posts = $this->cm->get_conger_en_cours()) {
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
    // conger gagner
    public function conger_gagner(){
        $this->load->model('Notification_model');

        // Charger la vue principale
        $this->load->view('Template/inclure/header');// Charge le header (qui inclut les notifications)
        $this->load->view('partials/header_notifications'); // Charge le contenu spécifique à la page
        $this->load->view('Template/conger/conger_gagner_view');
    }
    public function fetch_conger_gagner(){
        if ($this->input->is_ajax_request()) {
            if ($posts = $this->cm->get_conger_gagner()) {
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

    // historique des conger
    public function historique_conger(){
        $this->load->model('Notification_model');

        // Charger la vue principale
        $this->load->view('Template/inclure/header');// Charge le header (qui inclut les notifications)
        $this->load->view('partials/header_notifications'); // Charge le contenu spécifique à la page
        $this->load->view('Template/conger/historique_conger_view');

    }
    public function fetch_historique_conger(){
        if ($this->input->is_ajax_request()) {
            if ($posts = $this->cm->get_historique_conger()) {
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

}


?>