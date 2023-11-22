<?php

class personnel_model extends CI_Model {

        // --------------- Personnel -----------------
        public function insert_personnel($data){
                return $this->db->insert('personnel', $data);
        }
        public function get_entries(){
                $query = $this->db->get('personnel');
                if (count( $query->result() ) > 0) {
                        return $query->result();
                }
                else {
                        return array(); // ou NULL selon vos besoins
                }
        }
        public function delete_entry($id){
                return $this->db->delete('personnel', array('id' => $id));
        }
        public function edit_entry($id){
                $this->db->select('*');
                $this->db->from('personnel');
                $this->db->where('id',$id);
                $query = $this->db->get();
                if (count($query->result()) > 0) {
                        return $query->row();
                }
        }
        public function update_personnel($data){
                return $this->db->update('personnel', $data, array('id' => $data['id']));
        }
        public function getNomPrenomByCodeEm($code_em) {
                $this->db->select('nom, prenom');
                $this->db->where('code_em', $code_em);
                $query = $this->db->get('personnel');
        
                return $query->row_array();
        }

            

        // ------------- Post -------------
        public function insert_post($data){
                return $this->db->insert('post', $data);
        }
        public function get_entries_post(){
                $query = $this->db->get('post');
                if (count( $query->result() ) > 0) {
                        return $query->result();
                }
                else {
                        return array(); // ou NULL selon vos besoins
                }
        }
        public function delete_post($id){
                return $this->db->delete('post', array('id_post' => $id));
        }
        public function edit_post($id){
                $this->db->select('*');
                $this->db->from('post');
                $this->db->where('id_post',$id);
                $query = $this->db->get();
                if (count($query->result()) > 0) {
                        return $query->row();
                }
        }
        public function update_post($data){
                return $this->db->update('post', $data, array('id_post' => $data['id_post']));

        }


        // ------------- Departement -------------
        public function insert_departement($data){      
                return $this->db->insert('departement', $data);
        }
        public function get_departement(){
                $query = $this->db->get('departement');
                if (count( $query->result() ) > 0) {
                        return $query->result();
                }
                else {
                        return array(); // ou NULL selon vos besoins
                }
        }
        public function delete_departement($id){
                return $this->db->delete('departement', array('id_dep' => $id));
        }
        public function edit_departement($id){
                $this->db->select('*');
                $this->db->from('departement');
                $this->db->where('id_dep',$id);
                $query = $this->db->get();
                if (count($query->result()) > 0) {
                        return $query->row();
                }
        }
        public function update_departement($data){
                return $this->db->update('departement', $data, array('id_dep' => $data['id_dep']));

        }
}


?>