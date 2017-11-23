<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comic extends CI_Controller {

  public function __construct() {
    parent::__construct();

    //$this->load->helper('url');
    $this->load->helper(array('form', 'url', 'file', 'html'));
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

  public function comic_view() {
    // load models
    $this->load->model('comics_model');

    // get data
    $data['comics'] = $this->comics_model->getComics();
    $data['page'] = "comic_view";

    // load views
    $this->load->view('common/header');
    $this->load->view('common/openbody');
    $this->load->view('common/nav', $data);
    $this->load->view('comic/comic_view', $data);
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
    //$this->load->model('filemgmt_model');

    if(isset($_FILES['inputCover']['name'])) { // reachces when posting empy file data anyway
      $config['upload_path']          = './uploads/';
      $config['allowed_types']        = 'gif|jpg|png';

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      //echo $this->upload->do_upload('inputCover');
      //echo json_encode($this->upload->data());

      //echo var_dump($_FILES['inputCover']);
      //return false;

      if (!$this->upload->do_upload('inputCover')) {
        $error = array('error' => $this->upload->display_errors());
        //echo json_encode($error);
      }
      else {
        $data = array('upload_data' => $this->upload->data());
        //echo json_encode($data);
      }
    } else {
      //echo "nope";
    }

    // get post data
    $comic_id = (INT) $this->input->post('comic_id');
    $title = $this->input->post('inputTitle');
    $genre = $this->input->post('inputGenre');
    $artist = $this->input->post('inputArtist');
    $description = $this->input->post('inputDescription');
    //$cover_image = $this->input->post('cover_image');

    // update or add comic to db
    $result = $this->comics_model->updateAddComic($comic_id, $title, $genre, $artist, $description);

    // send back db response to ajax success
    //$result = "posted";
    echo $result;


    // get post data
    /*$comic_id = (INT) $this->input->post('comic_id');
    $title = $this->input->post('title');
    $genre = $this->input->post('genre');
    $artist = $this->input->post('artist');
    $description = $this->input->post('description');
    $cover_image = $this->input->post('cover_image');

    // ----------------
    $config['upload_path']          = './uploads/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 100;
    $config['max_width']            = 1024;
    $config['max_height']           = 768;

    $this->load->library('upload', $config);

    //if ( ! $this->upload->do_upload('userfile')) {
    if ( ! $this->upload->do_upload('inputCover')) {
      $error = array('error' => $this->upload->display_errors());
      echo json_encode($error);
      //$this->load->view('upload_form', $error);
    }
    else {
      $data = array('upload_data' => $this->upload->data());
      echo json_encode($data);
      //$this->load->view('upload_success', $data);
    }
    // ----------------*/

    // update or add comic to db
    //$cover_id = $this->filemgmt_model->do_upload($cover_image);
    //if($cover_id != 0) $result = $this->comics_model->updateAddComic($comic_id, $title, $genre, $artist, $description, $cover_id);
    //$result = json_encode($cover_id);

    // send back db response to ajax success
    //echo $result;
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
