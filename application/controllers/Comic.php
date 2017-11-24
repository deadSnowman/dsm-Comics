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
    $this->load->view('common/js.php');
    $this->load->view('common/footer');
  }

  public function admin($comic_id=0) {
    // load models
    $this->load->model('comics_model');

    if($comic_id === 0) {
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
    } else {
      // get data
      $data['page'] = "admin";

      // load views
      $this->load->view('common/header');
      $this->load->view('common/openbody');
      $this->load->view('common/nav', $data);
      $this->load->view('admin/pagesadmin', $data);
      $this->load->view('admin/comicsadmin_js.php');
      $this->load->view('common/closebody');
      $this->load->view('common/footer');
    }
  }

  public function comic_view($comic_id=0) {
    // load models
    $this->load->model('comics_model');

    // get data
    $data['pages'] = $this->comics_model->getPages($comic_id);
    $data['comic_title'] = json_decode($this->comics_model->getComicByID($comic_id), true)['title'];
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
    $this->load->model('filemgmt_model');

    // get post data
    $comic_id = (INT) $this->input->post('comic_id');
    $title = $this->input->post('inputTitle');
    $genre = $this->input->post('inputGenre');
    $artist = $this->input->post('inputArtist');
    $description = $this->input->post('inputDescription');

    // write page info to db
    $page_id = 0;
    if(isset($_FILES['inputCover']['name'])) {
      if($_FILES['inputCover']['name'] != "") {
        $fname = $_FILES['inputCover']['name'];
        $page_id = $this->filemgmt_model->storePage($comic_id, 0, $fname, 1, 0);
      }
    }

    // write page to filesystem
    if(isset($_FILES['inputCover']['name'])) { // reachces when posting empy file data anyway
      if($_FILES['inputCover']['size'] != 0) {
        $config['file_name']            = $page_id;
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['overwrite']            = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('inputCover')) {
          $error = array('error' => $this->upload->display_errors());
          //echo json_encode($error);
        }
        else {
          // upload file, and take out the file extension
          $data = array('upload_data' => $this->upload->data()); //echo json_encode($data);
          $img_data= $data['upload_data'];
          $new_imgname=$page_id;
          $new_imgpath=$img_data['file_path'].$new_imgname;
          rename($img_data['full_path'], $new_imgpath);

        }
      } else {
        //echo "nope";
      }
    }

    // add comic info to db
    $result = $this->comics_model->updateAddComic($comic_id, $title, $genre, $artist, $description, $page_id);

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
