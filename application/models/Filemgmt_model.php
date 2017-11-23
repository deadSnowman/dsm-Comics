<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemgmt_model extends CI_Model {
  public function __construct() {
    $this->load->database();
    date_default_timezone_set("America/New_York");
  }

  // todo: make sure only admin can use this
  public function storePage($comic_id=0, $chapter_id=0, $filename="", $cover=0, $user_id=0) {
    if($comic_id === 0) {
      $sql = "INSERT INTO pages (chapter_id, filename, cover) VALUES (?, ?, ?)";
      if($this->db->query($sql, array($chapter_id, $filename, $cover))) {
        return $this->db->insert_id();
      } else {
        return 0;
      }
    } else {
      // update image instead
    }
  }

}
