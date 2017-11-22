<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comics_model extends CI_Model {
  public function __construct() {
    $this->load->database();
    date_default_timezone_set("America/New_York");
  }

  public function getComics($user_id=0) {

    $query = "SELECT * FROM comics";
    $dbResult = $this->db->query($query);

    $result = $dbResult->result_array();

    return $result;
  }
}
