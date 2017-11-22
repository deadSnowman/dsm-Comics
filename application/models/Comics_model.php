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

  public function getComicByID($comic_id=0) {
    if($comic_id != 0) {
      $sql = "SELECT * FROM comics WHERE comic_id = ?";
      $dbResult = $this->db->query($sql, array($comic_id));
      $row = $dbResult->result(); // array
      return json_encode($row[0]);
    } else {
      return "nope";
    }
  }
}
