<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comic extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->helper('url');
  }

  public function index() {
    // load models
    $this->load->model('comics_model');

    // get data
    $data['comics'] = $this->comics_model->getComics();

    // load views
    $this->load->view('common/header');
    $this->load->view('common/openbody');
    $this->load->view('common/nav');
    $this->load->view('comic/comic_home', $data);
    $this->load->view('common/footer');
  }

  public function admin() {
    // load models
    $this->load->model('comics_model');

    // get data
    $data['comics'] = $this->comics_model->getComics();

    // load views
    $this->load->view('common/header');
    $this->load->view('common/openbody');
    $this->load->view('common/nav');
    $this->load->view('admin/comicadmin', $data);
    $this->load->view('common/footer');
  }
}
