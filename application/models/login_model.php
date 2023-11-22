<?php

class login_model extends CI_model
{
    public function __construct(){
        parent::__construct();
    }
    public function admin_login($table,$where){
        return $this->db->get_where($table,$where);
    }
}


?>