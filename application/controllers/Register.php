<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//TODO extraire une autre class comme pour login validator pour que le callback ne puisse pas être appelé ? ou bien faire une route pour le callback

//TODO tester si step précédente a été validé avant de faire l'acutelle
//TODO comment sont faite les protecttion contre les injection sql ou autre dans le processus de validation
//des fields : security xss form validation
class Register extends CI_Controller {
	public function __construct() {
    	parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
		//	$this->load->library('image_lib');
			$this->load->model('entities_model');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><p>','</p></div>');

			//check if loggedin, doit être dans le constructeur
			//pour être checké pour toutes les méthodes
			if ($this->session->logged_in) {
				redirect($this->session->username);
		}
	}

	public function index(){
		$this->_init_registration_rules();

		if ($this->form_validation->run() == FALSE) {
			//load the registration form
			$data['title'] = 'Registration page';

			$this->load->view('templates/header', $data);
			$this->load->view('register/clearfix_header');
			$this->load->view('register/index');
			$this->load->view('templates/footer');
		} else {
			//data is valid, store it locally
			//TODO store it in a session and repopulate the form with the data stored in the session
			//if the user is back to the form a second time

			$this->session->set_userdata('step1', $this->input->post());
			redirect('register/picture');
		}
	}


	//TODO voir validation rules pour tester sur le tableau des steps que chaque valeur est set
	//voir comment remplacer le $_post par le tableau en question dans le user_guide

	public function username(){
		$this->_init_username_rules();

		if ($this->form_validation->run() == FALSE) {
			//load the username form
			$data['title'] = 'Registration - Username';

			//TODO implémenter les propositions
			//$data['propositions'] = $this->entities_model->get_username_propositions();
			$data['propositions'] = 'aa, test2, test3';
			$this->load->view('templates/header', $data);
			$this->load->view('register/clearfix_header');
			$this->load->view('register/username');
			$this->load->view('templates/footer');

		} else {
			//data is valid, store it in the session
			$this->session->set_userdata('step3', $this->input->post());
			redirect('register/password');
		}
	}

	public function picture() {

		$this->_init_picture_rules();
		//print_r($this->session);

		if ($this->form_validation->run() == FALSE) {
			//load the picture form
			$data['title'] = 'Registration - Picture';
			$this->load->view('templates/header', $data);
			$this->load->view('register/clearfix_header');
			$this->load->view('register/picture');
			$this->load->view('templates/footer');
		} else {
			//data is stored in the sessiosn in the validation rules
			//thumbnail is also created their
			//see profile_picture_uploaded below
			redirect('register/username');
		}
	}

	//*
	public function password() {
		$this->_init_password_rules();

		//print_r($this->session);

		if ($this->form_validation->run() == FALSE) {
			//load the form
			//TODO here we suppose step 1, 2 are validated
			$data['title'] = 'Registration - Preferences';
			$data['image_name'] = 'uploads/' . $this->session->image_name;

			$data['profile_name'] = $this->session->step1['profile_name'];
			$this->load->view('templates/header', $data);
			$this->load->view('register/clearfix_header');
			$this->load->view('register/password');
			$this->load->view('templates/footer');
		} else {

			//register new user
			//TODO penser au cas où toutes les données ne sont pas dispos par ce que il a sauté une étape
			//du formulaire
			//TODO rajouter les informations sur la photo de profile dans la table
			$password = $this->input->post('password');

			$user_data = array (
				'name' => $this->session->step1['profile_name'],
				'email' => $this->session->step1['email'],
				'password' => $this->input->post('password'),
				'username' => strtolower(preg_replace('/\s+/', '', $this->session->step1['profile_name'])) . '123',
				'picture' => $this->session->step2['image_name'],
				'description' => $this->session->step1['description'],
			);

			print_r($user_data);

			$new_user_created = $this->entities_model->new_user($user_data);
			if($new_user_created) {
			//clear all session data
			//TODO est-ce qu'il faut vraiment que je destroy session ?
			//qu'est-ce qui se passe si je la garde ?
			session_destroy();

			redirect('register/success');

			} else {
				//inform the user that the register process failed
				echo '<p> There was a problem in the registration, please try again !</p>';
			}
		}
	}

	public function success(){
		$data['title'] = 'Registration - Success';
		$this->load->view('templates/header', $data);
		$this->load->view('register/clearfix_header');
		$this->load->view('register/success');
		$this->load->view('templates/footer');
	}

	private function _init_username_rules(){
		$this->form_validation->set_rules(
		    'username', 'Username',
		    'trim|required|is_unique[entities.username]',
		    array('is_unique' => 'The Username you specified is already taken, please choose another one !')
        );
	}

	//*/
	private function _init_password_rules(){
		$this->form_validation->set_rules(
		    'password', 'Password',
		    'trim|required|min_length[5]|max_length[12]'
        );

        $this->form_validation->set_rules(
		    'pwdconf', 'Confirmation password',
		    'trim|matches[password]'
        );
	}

	private function _init_picture_rules(){

	//penser à ajouter une validation comme quoi la première étape a
	//été faite
        $this->form_validation->set_rules(
        	'profile_picture', 'Profile picture',
        	'callback_profile_picture_uploaded'
        );
	}

	private function _init_registration_rules(){

		$this->form_validation->set_rules(
			'email', 'Email',
			'trim|required|valid_email|is_unique[entities.email]',
			array(
			'is_unique' => 'There is already a user with that Email, '
			. anchor('auth/login','login instead', 'class="alert-link"')
			)
        );

        $this->form_validation->set_rules(
			'profile_name', 'Profile Name',
			'trim|required|min_length[3]'
        );

        $this->form_validation->set_rules(
        	'description','Description',
        	'trim|required|min_length[20]'
        );
	}

	//upload profile picture if any
	//TODO rechercher si existe set_value pour file upload
	// sauvegarder le formulaire dns uen session ou base de donnée
	public function profile_picture_uploaded(){

		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_picture')) {
        	$this->form_validation->set_message('profile_picture_uploaded', $this->upload->display_errors('',''));
        	return FALSE;
        } else {
        	$step2 = array(
        		"image_name" => $this->upload->data('file_name')
        	);

           	$this->session->set_userdata('step2', $step2);

           	//TODO uncomment this and add thumbnail to session
           	/*
           	$image_name = $this->upload->data('raw_name');
           	$image_ext = $this->upload->data('file_ext');

           	if($this->_create_thumbnail($image_name, $image_ext))
           		return TRUE;
           	else {
           		$this->form_validation->set_message('profile_picture_uploaded', "there was a problem creating your profile picture, try again !");
           		return FALSE;
           	}

           	*/

           	return TRUE;
        }
	}

	private function _create_thumbnail($image_name, $image_ext){

		//create a thumbnail
		$thumb['image_library'] 	= 'gd2';
		$thumb['source_image'] 		= 'uploads/'. $image_name . $image_ext;
		$thumb['create_thumb'] 		= TRUE;
		$thumb['maintain_ratio'] 	= TRUE;
		$thumb['width']         	= 225;
		$thumb['height']       		= 150;

		echo $thumb['source_image'];
		$this->image_lib->initialize($thumb);

		if (!$this->image_lib->resize()){
			echo $this->image_lib->display_errors();
			return FALSE;
		} else return TRUE;
	}
}
