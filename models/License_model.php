<?php
class License_model extends CI_model{
    public function new_license($license){
        $this->db->insert('general_licenses', $license);
    }
    public function get_license($user_id){
          $this->db->select('license_id');
          $this->db->from('general_licenses');
          $this->db->where('license_user_id',$user_id);

          if($query=$this->db->get())
          {
              return $query->row_array();
          }
          else{
            return false;
          }        
    }
}
?>