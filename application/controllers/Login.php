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
    //$this->load->model('comics_model');

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
    $this->load->view('common/login', $data);
    $this->load->view('common/js.php');
    $this->load->view('common/footer');
  }

  /*
    Login code from this guy
    https://www.youtube.com/watch?v=pG1rOs8vz1Q
    http://www.webslesson.info/2016/10/codeigniter-simple-login-form-with-sessions.html
  */
  public function login_validation(/*$username="", $password=""*/) {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if($this->form_validation->run()) {
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $this->load->model('login_model');
      if($this->login_model->can_login($username, $password)) {
        $session_data = array(
          'username'  =>  $username
        );
        $this->session->set_userdata($session_data);
        redirect(base_url() . 'login/enter');
      } else {
        $this->session->set_flashdata('error', 'Invalid Username and Password');
        redirect(base_url() . 'login');
      }
    } else {
      $this->index();
    }
  }

  function enter() {
    if($this->session->userdata('username') != "") {
      redirect(base_url() . 'comic/admin');
      //echo '<h2>Welcome - '.$this->session->userdata('username').'</h2>';
      //echo '<a href="'.base_url().'login/logout">Logout</a>';
    } else {
      redirect(base_url() . 'login');
    }
  }

  function logout() {
    $this->session->unset_userdata('username');
    redirect(base_url() . 'login');
  }

}
