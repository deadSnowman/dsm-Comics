<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comics_model extends CI_Model {
  public function __construct() {
    $this->load->database();
    date_default_timezone_set("America/New_York");
  }

  // used in comic_home
  public function getComics() {
    //$sql = "SELECT * FROM comics";
    $sql = "SELECT comics.*, comics.page_id, filename FROM comics LEFT JOIN pages ON comics.page_id = pages.page_id ORDER BY comic_display_order";
    $dbResult = $this->db->query($sql);
    $result = $dbResult->result_array();
    return $result;
  }

  public function getPageByID($page_id=0) {
    if($page_id != 0) {
      $sql = "SELECT * FROM pages WHERE page_id = ?";
      $dbResult = $this->db->query($sql, array($page_id));
      $row = $dbResult->result(); // array
      return json_encode($row[0]);
    } else {
      return false;
    }
  }

  // used in comic_view and pages admin
  public function getPages($comic_id=0, $cover=0) {
    if($cover == 0) { // get all non cover pages for pages admin
      $sql = "SELECT * FROM pages WHERE comic_id = ? AND cover=0 ORDER BY page_display_order";
      $dbResult = $this->db->query($sql, array($comic_id));
      $result = $dbResult->result_array();
      return $result;
    } else {
      // this is probably broken or not used.  fix it or remove it for comic_view
      /*if($comic_id != 0) {
        $sql = "SELECT comics.*, comics.page_id, filename FROM comics INNER JOIN pages ON comics.page_id = pages.page_id WHERE comics.comic_id = ? AND cover = 0";
        $dbResult = $this->db->query($sql, array($comic_id));
        $result = $dbResult->result_array();
        return $result;
      } else {
        return false;
      }*/
    }
  }

  public function getCover($comic_id=0) {
    if($comic_id != 0) {
      //...
    } else {
      return false;
    }
  }

  // used to fill out Edit Comic section in comic admin
  public function getComicByID($comic_id=0) {
    if($comic_id != 0) {
      $sql = "SELECT * FROM comics WHERE comic_id = ?";
      $dbResult = $this->db->query($sql, array($comic_id));
      $row = $dbResult->result(); // array
      return json_encode($row[0]);
    } else {
      return false;
    }
  }

  public function updateAddComic($comic_id=0, $title="", $genre="", $artist="", $description="", $page_id=0, $user_id=0) {
    if($this->session->userdata('username') != "") {
      if($comic_id === 0) {
        $sql = "INSERT INTO comics (title, genre, artist, description, page_id) VALUES (?, ?, ?, ?, ?)";
        $dbResult = $this->db->query($sql, array($title, $genre, $artist, $description, $page_id));
        return $this->db->insert_id();
      } else {
        if($page_id === 0) {
          $sql = "UPDATE comics SET title = ?, genre = ?, artist = ?, description = ?  WHERE comic_id = ?";
          $dbResult = $this->db->query($sql, array($title, $genre, $artist, $description, $comic_id));
          return $comic_id;
        } else {
          //print_r("here: " . $page_id);
          $sql = "UPDATE comics SET title = ?, genre = ?, artist = ?, description = ?, page_id = ?  WHERE comic_id = ?";
          $dbResult = $this->db->query($sql, array($title, $genre, $artist, $description, $page_id, $comic_id));
          return $comic_id;
        }
      }
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function delPage($page_id=0) {
    if($this->session->userdata('username') != "") {
      // delete comic
      $sql = "DELETE FROM pages WHERE page_id = ?";
      $dbResult = $this->db->query($sql, array($page_id));

      // delete associated page (in filesystem)
      if(isset($page_id)) {
        if(file_exists('uploads/'. $page_id)) unlink('uploads/'. $page_id);
      }

      // delete cover link
      $sql2 = "UPDATE comics SET page_id = 0 WHERE page_id = ?";
      $dbResult2 = $this->db->query($sql2, array($page_id));

      return $dbResult;
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function delComic($comic_id=0) {
    if($this->session->userdata('username') != "") {
      // delete comic
      $sql = "DELETE FROM comics WHERE comic_id = ?";
      $dbResult = $this->db->query($sql, array($comic_id));

      // delete associated chapters (I may not end up having the chapters table)
      // ...

      // delete associated pages (in filesystem)
      $sql_files = "SELECT page_id FROM pages WHERE comic_id = ?";
      $dbResult_files = $this->db->query($sql_files, array($comic_id));
      foreach ($dbResult_files->result_array() as $row) {
        if(isset($row['page_id'])) unlink('uploads/'. $row['page_id']);
      }
      //unlink("uploads/84"); //works

      // delete associated pages
      $sql3 = "DELETE FROM pages WHERE comic_id = ?";
      $dbResult3 = $this->db->query($sql3, array($comic_id));

      return $dbResult;
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function pinPages($display_order_arr) {
    if($this->session->userdata('username') != "") {
      foreach ($display_order_arr as $key => $value) {
        $sql = "UPDATE pages SET page_display_order = ?  WHERE page_id = ?";
        $dbResult = $this->db->query($sql, array($key, $value));
      }
      return true; // this always succeeds, yup yup
    } else {
      redirect(base_url() . 'login');
    }
  }

  public function pinComics($display_order_arr) {
    if($this->session->userdata('username') != "") {
      foreach ($display_order_arr as $key => $value) {
        $sql = "UPDATE comics SET comic_display_order = ?  WHERE comic_id = ?";
        $dbResult = $this->db->query($sql, array($key, $value));
      }
      return true; // this always succeeds, yup yup
    } else {
      redirect(base_url() . 'login');
    }
  }
}
