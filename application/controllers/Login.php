<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();

    //$this->load->helper('url');
    $this->load->helper(array('form', 'url', 'file', 'html'));
  }

  public function index() {
    // load models
    $this->load->model('comics_model');

    // get data
    //$data['comics'] = $this->comics_model->getComics();
    $data['page'] = "login";

    $data['csrf'] = array(
      'name' => $this->security->get_csrf_token_name(),
      'hash' => $this->security->get_csrf_hash()
    );

    // load views
    $this->load->view('common/header');
    $this->load->view('common/openbody');
    $this->load->view('common/nav', $data);
    //$this->load->view('comic/comic_home', $data);
    $this->load->view('common/login', $data);
    $this->load->view('common/js.php');
    $this->load->view('common/footer');
  }

}
