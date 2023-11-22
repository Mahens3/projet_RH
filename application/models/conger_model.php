<?php

class conger_model extends CI_model
{
    public function __construct(){
        parent::__construct();
    }

    // --- solde conger ---
    public function insert_solde_conger($data) {
        // Insérer les données dans la table "solde_conger"
        return $this->db->insert('solde_conger', $data);
    }
    public function get_entries()
    {
        $query = $this->db->get('solde_conger');
        if (count( $query->result() ) > 0) {
            return $query->result();
        }
        else {
            return array(); // ou NULL selon vos besoins
        }
    } 
    public function increment_solde_conge() {
        // Récupérez le solde actuel de la base de données
        $row = $this->get_current_balance(); // Mettez en place cette fonction
        $solde_actuel = $row->solde_actuel;
        $nbj = $row->nbr_jrs;
        // Calculez le nouveau solde
        $nouveau_solde = $solde_actuel + 2.5;
        $nbj = $nbj + 2.5;
        $date_actuelle = date('Y-m-d');

        // Mettez à jour le solde dans la base de données
        $this->update_balance($nouveau_solde,$date_actuelle,$nbj); // Mettez en place cette fonction
    }
    private function get_current_balance() {
        $this->db->select('*');
        $this->db->from('solde_conger'); 
    
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
            ;
        } else {
            return 0; // Valeur par défaut si aucun solde n'est trouvé
        }
    }
    private function update_balance($nouveau_solde,$date_actuelle,$nbj) {
        $data['date_dernier_mise_jrs'] = $date_actuelle; 
        $data['solde_actuel'] = $nouveau_solde;
        $data['nbr_jrs'] = $nbj;
        $this->db->update('solde_conger', $data);
    }


    // type de conger 
    public function insert_type_conger($data){
        return $this->db->insert('type_conger', $data);
    }
    public function get_entries_type(){
        $query = $this->db->get('type_conger');
        if (count( $query->result() ) > 0) {
            return $query->result();
        }
        else {
            return array(); // ou NULL selon vos besoins
        }
    }
    public function delete_entry_type($id){
        // Supprime l'entrée de la table type_conger avec le champ type_id égal à $id
        return $this->db->delete('type_conger', array('type_id' => $id));
    }
    public function edit_entry_type($id){
        $this->db->select('*');
        $this->db->from('type_conger');
        $this->db->where('type_id',$id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
                return $query->row();
        }
    }
    public function update_type_conger($data)
    {
        return $this->db->update('type_conger', $data, array('type_id' => $data['type_id']));
    }



    // demande de conger
    public function insert_conger($data){
         $this->db->insert('demande_conger', $data);

         $last_insert_id = $this->db->insert_id();

        // Return the last inserted ID
        return $last_insert_id;
    }
    public function get_conger(){
        $role = $this->session->userdata('role');
        $code_em = $this->session->userdata('code_em');
    
        // Utilisez la variable $role pour déterminer quelles demandes de congé afficher
        if ($role == 'Employer') {
            // Si l'utilisateur est un employé, affichez uniquement ses propres demandes de congé
            $this->db->select('*');
            $this->db->from('demande_conger');
            $this->db->where('code_em', $code_em);
            $this->db->where('status_conger','Non Traiter');
            $query = $this->db->get();
        } 
        elseif ($role == 'n+1') {
            // Get the department code of the current user
            $this->db->select('departement');
            $this->db->from('personnel');
            $this->db->where('code_em', $code_em);
            $user_query = $this->db->get();
            $user_department = $user_query->row()->departement;
    
            // Get all requests from employees in the same department
            $this->db->select('*');
            $this->db->from('demande_conger');
            $this->db->join('personnel', 'personnel.code_em = demande_conger.code_em');
            $this->db->where('personnel.departement', $user_department);
            $this->db->where('demande_conger.status_conger', 'Non Traiter');
            $query = $this->db->get();
        }else {
            // Si l'utilisateur est un admin, affichez toutes les demandes de congé
            $this->db->select('*');
            $this->db->from('demande_conger');
            $this->db->where('status_conger','Non Traiter');
            $query = $this->db->get();
        }
        if (count( $query->result() ) > 0) {
            return $query->result();
        }
        else {
            return array(); // ou NULL selon vos besoins
        }
    }
    public function delete_entry_conger($id){
        return $this->db->delete('demande_conger', array('id' => $id));
    }
    public function accepter_entry_conger($id, $status) {
        $this->db->set('status_conger', $status);
        $this->db->where('id', $id); // Condition pour mettre à jour le bon enregistrement
        $this->db->update('demande_conger');
        return $this->db->affected_rows() > 0; 
    }
    
    public function rejeter_entry_conger($id,$status) {
        $this->db->set('status_conger',$status);
        $this->db->where('id', $id); // Condition pour mettre à jour le bon enregistrement
        return $this->db->update('demande_conger');    
    }


    /////////////////////////////////////////
    public function get_duree_conger($demande_conge_id) {
        $this->db->select('duree_conger');
        $this->db->from('demande_conger');
        $this->db->where('id', $demande_conge_id);
    
        $query = $this->db->get();
    
        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row->duree_conger;
        } else {
            return false; // Aucune demande de congé trouvée avec cet ID
        }
    }

    public function get_solde_conger($employee_code) {
        $this->db->select('*');
        $this->db->from('solde_conger');
        $this->db->where('code_em', $employee_code); 
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row(); // Utilisez row() pour obtenir le premier résultat
        } else {
            return false; // ou NULL selon vos besoins
        }
    }
    
    public function get_code($code_em) {
        $this->db->select('code_em');
        $this->db->from('demande_conger');
        $this->db->where('id', $code_em); 
    
        $query = $this->db->get();
    
        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row->code_em;
        } else {
            return false; // Aucun employé trouvé avec cet identifiant
        }
    }
    public function get_type($id) {
        $this->db->select('type_conger');
        $this->db->from('demande_conger');
        $this->db->where('id', $id); 
    
        $query = $this->db->get();
    
        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row->type_conger;
        } else {
            return false; // Aucun employé trouvé avec cet identifiant
        }
    }
    public function mettre_a_jour_solde_conger($code_em, $nouveau_solde,$type) {
        // Assurez-vous que $code_em est un identifiant valide et que $nouveau_solde est un nombre valide
    
        $this->db->where('code_em', $code_em); // Utilisez $code_em à la place de $employee_id
        if ($type == 'Avec solde') {
            $data = array('nbr_jrs' => $nouveau_solde, 'date_dernier_mise_jrs' => date('Y-m-d')); // Utilisez 'solde_exeptionnel' comme nom de colonne
        }
        if ($type == 'Exceptionnel') {
            $data = array('solde_exeptionnel' => $nouveau_solde, 'date_dernier_mise_jrs' => date('Y-m-d')); // Utilisez 'solde_exeptionnel' comme nom de colonne
        }
    
        // Mettre à jour le solde de congé dans la base de données
        if ($this->db->update('solde_conger', $data)) {
            return true; // Mise à jour réussie
        } else {
            return false; // Erreur lors de la mise à jour
        }
    }
    
    


    // conger en attente
    public function get_conger_en_cours(){
        $role = $this->session->userdata('role');
        $code_em = $this->session->userdata('code_em');

        // Si l'utilisateur est un admin, affichez toutes les demandes de congé
        $this->db->select('*');
        $this->db->from('demande_conger');
        $this->db->where('status_conger','En attente');
        $query = $this->db->get();
        if (count( $query->result() ) > 0) {
            return $query->result();
        }
        else {
            return array(); // ou NULL selon vos besoins
        }
    }
    // conger gagner
    public function get_conger_gagner(){
        $role = $this->session->userdata('role');
        $code_em = $this->session->userdata('code_em');

            // Utilisez la variable $role pour déterminer quelles demandes de congé afficher
        if ($role == 'Employer') {
            // Si l'utilisateur est un employé, affichez uniquement ses propres demandes de congé
            $this->db->select('*');
            $this->db->from('demande_conger');
            $this->db->where('code_em', $code_em);
            $this->db->where('status_conger','Accepter');
            $query = $this->db->get();
        }
        elseif ($role == 'n+1') {
            // Get the department code of the current user
            $this->db->select('departement');
            $this->db->from('personnel');
            $this->db->where('code_em', $code_em);
            $user_query = $this->db->get();
            $user_department = $user_query->row()->departement;
    
            // Get all requests from employees in the same department
            $this->db->select('*');
            $this->db->from('demande_conger');
            $this->db->join('personnel', 'personnel.code_em = demande_conger.code_em');
            $this->db->where('personnel.departement', $user_department);
            $this->db->where('demande_conger.status_conger', 'Accepter');
            $query = $this->db->get();
        } else {
            // Si l'utilisateur est un admin, affichez toutes les demandes de congé
            $this->db->select('*');
            $this->db->from('demande_conger');
            $this->db->where('status_conger','Accepter');
            $query = $this->db->get();
        }
        if (count( $query->result() ) > 0) {
            return $query->result();
        }
        else {
            return array(); // ou NULL selon vos besoins
        }
    }
    
    // historique conger
    public function get_historique_conger(){
        $role = $this->session->userdata('role');
        $code_em = $this->session->userdata('code_em');

            // Utilisez la variable $role pour déterminer quelles demandes de congé afficher
        if ($role == 'Employer') {
            // Si l'utilisateur est un employé, affichez uniquement ses propres demandes de congé
            $this->db->select('*');
            $this->db->from('demande_conger');
            $this->db->where('code_em', $code_em);
            $this->db->where('status_conger', 'Accepter');
            $this->db->or_where('status_conger', 'Rejeter');
            $query = $this->db->get();
        } 
        elseif ($role == 'n+1') {
            // Get the department code of the current user
            $this->db->select('departement');
            $this->db->from('personnel');
            $this->db->where('code_em', $code_em);
            $user_query = $this->db->get();
            $user_department = $user_query->row()->departement;
    
            // Get all requests from employees in the same department
            $this->db->select('*');
            $this->db->from('demande_conger');
            $this->db->join('personnel', 'personnel.code_em = demande_conger.code_em');
            $this->db->where('personnel.departement', $user_department);
            $this->db->where('demande_conger.status_conger', 'Accepter');
            $query = $this->db->get();
        }else {
            // Si l'utilisateur est un admin, affichez toutes les demandes de congé
            $this->db->select('*');
            $this->db->from('demande_conger');
            $this->db->where('status_conger', 'Accepter');
            $this->db->or_where('status_conger', 'Rejeter');
            $query = $this->db->get();
        }
        if (count( $query->result() ) > 0) {
            return $query->result();
        }
        else {
            return array(); // ou NULL selon vos besoins
        }
    }
}


?>