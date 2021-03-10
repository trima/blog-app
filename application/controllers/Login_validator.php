<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_validator extends CI_Controller {

	//TODO add remeber me support
	//TODO add password crypt
	//TODO relire quand est-ce qu'il faut metrte les load dans le constructeur
	public function __construct() {
    	parent::__construct();
        $this->load->model('entities_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><p>','</p></div>');
        
        if ($this->session->logged_in) {
			redirect($this->session->username);
		}
    }
	
	public function index() {
		$this->_init_validation_rules();

        if ($this->form_validation->run() == FALSE) {
        	$data['title'] = 'Login page';
			$this->load->view('templates/header', $data);
			$this->load->view('login/index');
			$this->load->view('templates/footer');
        } else {
         	redirect($this->session->username);
        }  
	}
	
	private function _init_validation_rules(){
		
		$this->form_validation->set_rules(
			'email', 'Email', 
			'trim|required|valid_email', 
		    array(
		    	'required'		=> 'You must provide an %s.',
		    	'valid_email' 	=> 'the email you provided is invalid'
		    )
        );
        
        $this->form_validation->set_rules(
		    'password', 'Password', 
		    'trim|required|min_length[5]|max_length[12]|callback_check_credentials'
        );
	}
	
	public function check_credentials($password) {
        $email = $this->input->post('email');
        $entity = $this->entities_model->login($email, $password);
        
        if(isset($entity)) {
        //TODO we have the entity informations here,
        // no need to reget it from the database when redirecting to 
        //the entity view
        
		    $session_data = array(
				'username'  => $entity['username'],
				'email'     => $entity['email'],
				'logged_in' => TRUE
			);
			//save session values
			$this->session->set_userdata($session_data);
			
			//check if remeberme is clicked
			//$remember_user = $this->input->post('remember');
			//if($remember_user) {
				
			//}
	
        	return TRUE;
        } else {
        
        //TODO add tags for bootstrap messages
        	$this->form_validation->set_message('check_credentials', 'Invalid Email / Password combination !');
        	return FALSE;
        }
    }
}
