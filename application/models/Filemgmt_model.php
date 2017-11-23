<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemgmt_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form', 'url'));

    //$this->load->database();
    date_default_timezone_set("America/New_York");
  }

  public function index() {
    //$this->load->view('upload_form', array('error' => ' ' ));
    //$this->load->view('admin/comicsadmin', $data);
    //$this->load->view('admin/comicsadmin', array('error' => ' ' ));
  }

  public function do_upload($cover_image="") {
    $config['upload_path']          = './uploads/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 100;
    $config['max_width']            = 1024;
    $config['max_height']           = 768;

    $this->load->library('upload', $config);



    /*
    //if ( ! $this->upload->do_upload('userfile')) {
    if ( ! $this->upload->do_upload($cover_image)) {
      $error = array('error' => $this->upload->display_errors());
      return $error;
      //$this->load->view('upload_form', $error);
    }
    else {
      $data = array('upload_data' => $this->upload->data());
      return $data;
      //$this->load->view('upload_success', $data);
    }
    */
  }


}
