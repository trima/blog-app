<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct() {
    	parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	public function login() {
		//ne rien mettre ici, elle est gardée parce qu'il y a une redirection
		//vers Login_validator	
		// normalement elle n'est jamais utilisé
	}
	
	public function logout(){
		$this->session->unset_userdata('logged_in');
   		session_destroy();
   		
   		redirect('auth/login');
	}
		
	public function process(){
		//ne rien mettre ici, elle est gardée parce qu'il y a une redirection
		//vers Login_validator		
		// normalement elle n'est jamais utilisé
	}
}
