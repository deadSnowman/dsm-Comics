<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemgmt_model extends CI_Model {
  public function __construct() {
    $this->load->database();
    date_default_timezone_set("America/New_York");
  }

  // todo: make sure only admin can use this
  public function storePage($comic_id=0, $chapter_id=0, $filename="", $cover=0, $user_id=0) {
    if($this->session->userdata('username') != "") {
      if($comic_id === 0) {
        $sql = "INSERT INTO pages (chapter_id, filename, cover) VALUES (?, ?, ?)";
        if($this->db->query($sql, array($chapter_id, $filename, $cover))) {
          return $this->db->insert_id();
        } else {
          return 0;
        }
      } else {
        // update image instead
        if($cover === 0) { // don't do join lookup nonsens if you're not changing the cover.  You won't be updating at all
          $page_id = 0;
        } else {
          $sql1 = "SELECT comics.*, comics.page_id, filename FROM comics LEFT JOIN pages ON comics.page_id = pages.page_id WHERE comics.comic_id = ?";
          $dbResult1 = $this->db->query($sql1, array($comic_id));
          $page_id = $dbResult1->row()->page_id;
        }

        // if there is no data in the pages table, add the image data
        if($page_id == 0) { // === doesn't work.  There's some type juggling going on with the db return
          $sql = "INSERT INTO pages (comic_id, chapter_id, filename, cover) VALUES (?, ?, ?, ?)";
          if($this->db->query($sql, array($comic_id, $chapter_id, $filename, $cover))) {
            $page_id = $this->db->insert_id();
          } else {
            return 0;
          }
        } else {
          // update data in pages table
          $sql = "UPDATE pages SET chapter_id = ?, filename = ?, cover = ? WHERE page_id = ?";
          $dbResult = $this->db->query($sql, array($chapter_id, $filename, $cover, $page_id));
        }

        return $page_id; // controller uses this to save image under new name
      }
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function updateComicIDForPage($page_id=0, $comic_id=0) {
    if($this->session->userdata('username') != "") {
      $sql = "UPDATE pages SET comic_id = ? WHERE page_id = ?";
      $dbResult = $this->db->query($sql, array($comic_id, $page_id));
    } else {
      redirect(base_url() . 'login');
    }
  }

}
