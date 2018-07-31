<?php
 
class User extends CI_Controller {
    public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('date');
            $this->load->model('user_model');
            $this->load->model('license_model');
            $this->load->library('session');
    }
    public function index()
    {
        $this->load->view("register.php");
    }
    public function register_user(){
        $cost = 10; //check php site and see if cost can be higher on real server! TODO http://nl1.php.net/manual/en/function.password-hash.php
          $user=array(
              'user_first_name'=>$this->input->post('user_first_name'),
              'user_last_name'=>$this->input->post('user_last_name'),
              'user_company_name'=>$this->input->post('user_company_name'),
              'user_email'=>$this->input->post('user_email'),
              'user_password'=>password_hash($this->input->post('user_password'), PASSWORD_BCRYPT, ["cost" => $cost]),
              'user_phone'=>$this->input->post('user_phone')              
            );
            print_r($user);
        $license_type = $this->input->post('license_type');
        $email_check=$this->user_model->email_check($user['user_email']);

        if($email_check){
          $this->user_model->register_user($user);

          $user_id = $this->user_model->get_user_id($user['user_email']);
              if($user_id){
                  $today = new DateTime(); 
                  $today_string = date_format($today, 'Y-m-d');

                  if($license_type=="trail"){
                      $license_paid = '0001-01-01';
                      //license only works in trail mode for 3 months
                      $today->modify('+3 months');
                      $end_date = date_format($today, 'Y-m-d');
                  }
                  else{
                      //+ aantal betaalde maanden
                      $license_paid = $today;
                      $today->modify('+'.$duration.' months');
                      $end_date = date_format($today, 'Y-m-d');
                  }
                  $license=array(
                      'license_account_type'=>$license_type,
                      'license_paid'=>$license_paid,
                      'license_start_date'=>$today_string,
                      'license_end_date'=>$end_date,
                      'license_user_id'=>$user_id['user_id']
                    );                
                $this->license_model->new_license($license);
                $license_id = $this->license_model->get_license($user_id['user_id']);
                $this->user_model->link_license_to_user($user_id['user_id'],$license_id['license_id']);
              }
              else{
                $this->session->set_flashdata('error_msg', 'Something went wrong creating the license. Please contact driesgoossens93@gmail.com .');
                redirect('user/index');          
              }
            
          $this->session->set_flashdata('success_msg', 'Registered successfully. You can now login to your account.');
          redirect('user/login_view');

        }
        else{

          $this->session->set_flashdata('error_msg', 'Your email is already in use.');
          redirect('user/index');


        }
    } 
    public function login_view(){
        $this->load->view("login.php");
    }
    function login_user(){
      $user_login=array(
      'user_email'=>$this->input->post('user_email'),
      'user_password'=>$this->input->post('user_password')
        );

         $data=$this->user_model->check_user_password($user_login['user_email']);
         if($data){
             if (password_verify($user_login['user_password'], $data['user_password'])) {
                $this->session->set_userdata('user_id',$data['user_id']);
                $this->session->set_userdata('user_email',$data['user_email']);
                $this->session->set_userdata('user_first_name',$data['user_first_name']);
                $this->session->set_userdata('user_last_name',$data['user_last_name']);
                $this->session->set_userdata('user_phone',$data['user_phone']);

                $this->load->view('user_profile.php');
            } else {
                echo 'Invalid password.';
            }
         }
         else{
            $this->session->set_flashdata('error_msg', 'Password incorrect.');
            $this->load->view("login.php");

          }
     }   
    function user_profile(){
        $this->load->view('user_profile.php');
    }    
    public function user_logout(){
      $this->session->sess_destroy();
      redirect('user/login_view', 'refresh');
    }    
    
}
?>