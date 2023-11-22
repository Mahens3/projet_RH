<?php

class auto_incrementation_solde extends CI_controller
{
    public function __construct(){
        parent::__construct();
        // Chargez le modèle d'employés
        $this->load->model('conger_model','cm');
    }

    public function incrementation_solde(){
        $this->cm->increment_solde_conge();
        $response = array('message' => 'Solde congé incrémenté de 2.5 jours');
        echo json_encode($response);
    }
}


?>