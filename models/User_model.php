<?php
class User_model extends CI_model{
    public function register_user($user){
        $this->db->insert('general_users', $user);
    }

    public function login_user($email,$pass){
          $this->db->select('*');
          $this->db->from('general_users');
          $this->db->where('user_email',$email);
          $this->db->where('user_password',$pass);

          if($query=$this->db->get())
          {
              return $query->row_array();
          }
          else{
            return false;
          }
    }
    public function check_user_password($email){
          $this->db->select('*');
          $this->db->from('general_users');
          $this->db->where('user_email',$email);

          if($query=$this->db->get())
          {
              return $query->row_array();
          }
          else{
            return false;
          }        
    }
    public function email_check($email){
      $this->db->select('*');
      $this->db->from('general_users');
      $this->db->where('user_email',$email);
      $query=$this->db->get();

      if($query->num_rows()>0){
        return false;
      }else{
        return true;
      }

    }
    public function get_user_id($email){
          $this->db->select('user_id');
          $this->db->from('general_users');
          $this->db->where('user_email',$email);

          if($query=$this->db->get())
          {
              return $query->row_array();
          }
          else{
            return false;
          }        
    }
    public function link_license_to_user($user_id,$license_id){
        $this->db->set('user_license_id', $license_id);
        $this->db->where('user_id', $user_id);
        $this->db->update('general_users'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
    }
}
?>