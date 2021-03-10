<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Entities extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
                $this->load->model('entities_model');
				$this->load->library('form_validation');
                $this->load->helper('url_helper');
        }

	public function index() {
		if (!$this->session->logged_in) {
			$data['title'] = 'Ntics';
		    $this->load->view('templates/header', $data);
		    $this->load->view('entities/index');
		    $this->load->view('templates/footer');
        } else {
        	redirect($this->session->username);
        }
	}

	public function view($username = NULL) {

		$data = $this->entities_model->get_entities($username);

	    if (empty($data)) {
	    	echo 'aucun username - depuis entities';
	    	//aucun username trouvé
	    	show_404();
		}

		$data['title'] = $data['name'];
		$data['username'] = $this->session->username;
		$this->load->view('templates/header', $data);
		if ($this->session->logged_in) {
        	$this->load->view('entities/logout');
        } else {
        	$this->load->view('entities/clearfix_header');
        }
		$this->load->view('entities/view', $data);
		$this->load->view('templates/footer');
	}

	public function contacts(){

		if ($this->session->logged_in) {
			$data['title'] = "Contacts";
			$data['username'] = $this->session->username;
			$this->load->view('templates/header', $data);
        	$this->load->view('entities/contacts', $data);
			$this->load->view('templates/footer');
        } else {
        	show_404();
        }
	}
}
