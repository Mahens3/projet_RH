<?php

class Notification_model extends CI_Model
{
    public function insertNotification($data) {
        return $this->db->insert('notification', $data);
    }

    public function getCongeNotifications() {
        $code_em = $this->session->userdata('code_em');

        if ($this->session->userdata('role') == 'n+1') {

            // Get the department code of the current user
            $this->db->select('departement');
            $this->db->from('personnel');
            $this->db->where('code_em', $code_em);
            $user_query = $this->db->get();
            $user_department = $user_query->row()->departement;
    
            // Get all requests from employees in the same department
            $this->db->select('*');
            $this->db->join('personnel', 'personnel.code_em = notification.code_em');
            $this->db->where('personnel.departement', $user_department);
            $this->db->where('notification.status_conger', 'Non traiter');
        }
        elseif ($this->session->userdata('role') == 'Admin') {
            $this->db->select('*');
            $this->db->where('status_conger','En attente');
        }
        elseif ($this->session->userdata('role') == 'Employer') {
            $this->db->select('*');
            $this->db->where('status_conger', 'Accepter');
            $this->db->or_where('status_conger', 'Rejeter');
        }        
        else {
            $this->db->select('*');
        }
        $this->db->from('notification');
        // Ajoutez des conditions supplémentaires si nécessaire
        $this->db->order_by('date_notification', 'desc');
        $query = $this->db->get();
        if (count( $query->result() ) > 0) {
            return $query->result_array();
        }
        else {
            return array(); // ou NULL selon vos besoins
        }
          
    }
    public function status_modifier($id_conger,$status){
        $this->db->set('status_conger',$status);
        $this->db->where('id_conger', $id_conger); // Condition pour mettre à jour le bon enregistrement
        $this->db->update('notification');
        return $this->db->affected_rows() > 0;
    }
}




?>