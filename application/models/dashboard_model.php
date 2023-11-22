<?php
class dashboard_model extends CI_model
{
    public function Getsolde_conger($code_em)
    {
          $this->db->select('*');
          $this->db->from('solde_conger');
          $this->db->where('code_em',$code_em);
          $query = $this->db->get();
          if (count($query->result()) > 0) {
                  return $query->row();
          }
    }
}

?>