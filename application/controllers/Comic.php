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
    if($this->session->userdata('username') != "") {
      // load models
      $this->load->model('comics_model');

      // security data
      $data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );

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
        $data['pages'] = $this->comics_model->getPages($comic_id, 0); // get covers
        //$data['comic_title'] = json_decode($this->comics_model->getComicByID($comic_id), true)['title'];
        $data['comic_id'] = $comic_id;
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
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function comic_view($comic_id=0) {
    // load models
    $this->load->model('comics_model');

    // get data
    $data['pages'] = $this->comics_model->getPages($comic_id, 0); // get non covers?
    $data['comic_title'] = json_decode($this->comics_model->getComicByID($comic_id), true)['title'];
    $data['page'] = "comic_view";

    // load views
    $this->load->view('common/header');
    $this->load->view('common/openbody');
    $this->load->view('common/nav', $data);
    $this->load->view('comic/comic_view', $data);
    $this->load->view('comic/comic_view_js.php');
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

  private function set_upload_options($page_id) {
      //upload an image options
      $config['file_name']            = $page_id;
      $config['upload_path']          = './uploads/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['overwrite']            = TRUE;
      //$config['max_size'] = '500000000000000';

      return $config;
  }

  public function updateAddPages() {
    if($this->session->userdata('username') != "") {
      // load models
      $this->load->model('comics_model'); // also contains page stuff
      $this->load->model('filemgmt_model'); // for writing to filesystem

      // get post data
      $comic_id = (INT) $this->input->post('comic_id');

      // make return array
      $return_arr['added_page_ids'] = array();

      $return_arr['ofiles'] = $_FILES; //$ofiles = $_FILES;
      $files = $_FILES;
      $cpt = count($_FILES['inputPages']['name']);
      for($i=0; $i<$cpt; $i++) {
        $_FILES['inputPages']['name']= $files['inputPages']['name'][$i];
        $_FILES['inputPages']['type']= $files['inputPages']['type'][$i];
        $_FILES['inputPages']['tmp_name']= $files['inputPages']['tmp_name'][$i];
        $_FILES['inputPages']['error']= $files['inputPages']['error'][$i];
        $_FILES['inputPages']['size']= $files['inputPages']['size'][$i];

        // db first
        $page_id = 0;
        if(isset($_FILES['inputPages']['name'])) {
          if($_FILES['inputPages']['name'] != "") {
            $fname = $_FILES['inputPages']['name'];
            $page_id = $this->filemgmt_model->storePage($comic_id, 0, $fname, 0, 0);
          }
        }

        $config = $this->set_upload_options($page_id);
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // then write pages to fs
        if (!$this->upload->do_upload('inputPages')) {
          $error = array('error' => $this->upload->display_errors());
          //echo json_encode($error);
          $return_arr['alert_bar'] = $error;
          $return_arr['status'] = "w";
          $isdeleted = $this->comics_model->delPage($page_id);
        }
        else {
          // upload file, and take out the file extension
          $data = array('upload_data' => $this->upload->data()); //echo json_encode($data);
          $img_data= $data['upload_data'];
          $new_imgname=$page_id;
          $new_imgpath=$img_data['file_path'].$new_imgname;
          rename($img_data['full_path'], $new_imgpath);
          //array_push($added_page_ids, $page_id
          array_push($return_arr['added_page_ids'], $page_id);
        }
      }

      // return to ajax success (returns an array of page_id's, and also the json representation of the posted files)
      //echo json_encode($ofiles['inputPages']); //json_encode($added_page_ids);
      echo json_encode($return_arr);
      //echo json_encode($_FILES); // dbug: look at what files were sent - alert this in success function before html appending and replacing

    } else {
      redirect(base_url() . 'login');
    }
  }

  public function updateAddComic() {
    if($this->session->userdata('username') != "") {
      // load models
      $this->load->model('comics_model');
      $this->load->model('filemgmt_model');

      // get post data
      $comic_id = (INT) $this->input->post('comic_id');
      $title = $this->input->post('inputTitle');
      $genre = $this->input->post('inputGenre');
      $artist = $this->input->post('inputArtist');
      $description = $this->input->post('inputDescription');

      $return_arr['alert_bar'] = "";
      if($title == "") {
        $return_arr['status'] = "w";
        $return_arr['alert_bar'] = "Please add a title";
        echo json_encode($return_arr);
        //echo $return_arr;
      } else {

        $return_arr['status'] = "s";
        $return_arr['alert_bar'] = "Comic added";

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
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
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
        } else {
          redirect(base_url() . 'login');
        }


        // add comic info to db
        $comic_id = $this->comics_model->updateAddComic($comic_id, $title, $genre, $artist, $description, $page_id);

        // add the comic_id to the pages table if a file was posted
        if(isset($_FILES['inputCover']['name'])) {
          if($_FILES['inputCover']['name'] != "") {
            $this->filemgmt_model->updateComicIDForPage($page_id, $comic_id);
          }
        }

        // send back db response to ajax success
        $return_arr['comic_id'] = $comic_id;
        $return_arr['page_id'] = $page_id;
        echo json_encode($return_arr);
      }
    }
  }

  public function delPage() {
    if($this->session->userdata('username') != "") {
      // load models
      $this->load->model('comics_model');

      // get post data
      $page_id = (INT) $this->input->post('page_id');

      // run delete
      $isdeleted = $this->comics_model->delPage($page_id);

      // send back db response to ajax success
      echo $isdeleted;
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function delComic() {
    if($this->session->userdata('username') != "") {
      // load models
      $this->load->model('comics_model');

      // get post data
      $comic_id = (INT) $this->input->post('comic_id');

      // run delete
      $isdeleted = $this->comics_model->delComic($comic_id);

      // send back db response to ajax success
      echo $isdeleted;
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function pinPages() {
    if($this->session->userdata('username') != "") {
      // load models
      $this->load->model('comics_model');

      // get post data
      $display_order_arr = $this->input->post('page_display_order');

      // store new display order
      $result = $this->comics_model->pinPages($display_order_arr);

      // send back (t/f) to ajax success
      echo $result;
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function pinComics() {
    if($this->session->userdata('username') != "") {
      // load models
      $this->load->model('comics_model');

      // get post data
      $display_order_arr = $this->input->post('comic_display_order');

      // store new display order
      $result = $this->comics_model->pinComics($display_order_arr);

      // send back (t/f) to ajax success
      echo $result;
    } else {
      redirect(base_url() . 'login');
    }
  }
}
