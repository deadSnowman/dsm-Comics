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

    // get db row
    $selected_comic = $this->comics_model->getComicByID($comic_id);

    // send back json to ajax success
    echo $selected_comic;
  }

  public function updateAddComic() {
    // load models
    $this->load->model('comics_model');

    // get post data
    $comic_id = (INT) $this->input->post('comic_id');
    $title = $this->input->post('title');
    $genre = $this->input->post('genre');
    $artist = $this->input->post('artist');
    $description = $this->input->post('description');
    $cover_image = $this->input->post('cover_image');

    // update or add comic to db
    $result = $this->comics_model->updateAddComic($comic_id, $title, $genre, $artist, $description, $cover_image);

    // send back db response to ajax success
    echo $result;
  }

  public function delComic() {
    // load models
    $this->load->model('comics_model');

    // get post data
    $comic_id = (INT) $this->input->post('comic_id');

    // run delete
    $isdeleted = $this->comics_model->delComic($comic_id);

    // send back db response to ajax success
    echo $isdeleted;
  }
}
