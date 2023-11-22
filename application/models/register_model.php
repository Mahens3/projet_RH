<?php

class register_model extends CI_Model
{
    public function save_utilisateur($data){
        $query = $this->db->insert('login',$data);
        return $query;
    }
    public function register_email($email){
        $query = $this->db->where(['email'=>$email])
                          ->get('login');
        return $query;
    }

    // get liste inscription
    public function get_utilisateur($limit,$offset){
        $query = $this->db->limit($limit,$offset)->get('login');
        return $query;
    }

    
    function get_rows($table){
        $query = $this->db->get($table);
        return $query->num_rows();
}
}


?>