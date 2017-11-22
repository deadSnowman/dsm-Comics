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
    $data['page'] = "home";

    // load views
    $this->load->view('common/header');
    $this->load->view('common/openbody');
    $this->load->view('common/nav', $data);
    $this->load->view('comic/comic_home', $data);
    $this->load->view('common/footer');
  }

  public function admin() {
    // load models
    $this->load->model('comics_model');

    // get data
    $data['comics'] = $this->comics_model->getComics();
    $data['page'] = "admin";

    // load views
    $this->load->view('common/header');
    $this->load->view('common/openbody');
    $this->load->view('common/nav', $data);
    $this->load->view('admin/comicsadmin', $data);
    $this->load->view('admin/comicsadmin_js.php');
    $this->load->view('common/closebody');
    $this->load->view('common/footer');
  }

  public function loadEditComic() {
    // load models
    $this->load->model('comics_model');

    // get post data
    $comic_id = $this->input->post('comic_id');

    // get data
    $selected_comic = $this->comics_model->getComicByID($comic_id);

    // send back json to ajax success
    echo $selected_comic;
  }
}
