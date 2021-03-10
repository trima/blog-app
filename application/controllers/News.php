<?php
class News extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {

		if ($this->session->logged_in) {
			$data['title'] = "Posts list";
			$data['username'] = $this->session->username;
 			$data['news'] = $this->news_model->get_news();
			$this->load->view('templates/header', $data);
			$this->load->view('posts/logout');
        	$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
        } else {
        	show_404();
        }
        }

        public function view($slug = NULL)
        {
                $data['news_item'] = $this->news_model->get_news($slug);

        if (empty($data['news_item']))
        {
                show_404();
        }
		if ($this->session->logged_in) {
		    $data['title'] = $data['news_item']['title'];
			$data['username'] = $this->session->username;
		    $this->load->view('templates/header', $data);
			$this->load->view('posts/logout');
		    $this->load->view('posts/view', $data);
		    $this->load->view('templates/footer');
        }
		}
	
	public function create() {
		if ($this->session->logged_in) {
			$this->load->helper('form');
			$this->load->library('form_validation');

			$data['title'] = 'Create a new post';
			$data['username'] = $this->session->username;

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('text', 'Text', 'required');

			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('posts/create');
				$this->load->view('templates/footer');
			} else {
				$this->news_model->set_news();
				$this->load->view('posts/success');
			}
		} else {
			show_404();
		}
	}
}
