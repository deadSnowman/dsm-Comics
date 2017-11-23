<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comics_model extends CI_Model {
  public function __construct() {
    $this->load->database();
    date_default_timezone_set("America/New_York");
  }

  public function getComics() {
    $sql = "SELECT * FROM comics";
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

  public function getCover($comic_id=0) {
    if($comic_id != 0) {
      //...
    } else {
      return false;
    }
  }

  /*public function getComicInfo($comic_id=0) {
    if($comic_id != 0) {
      $sql = "SELECT comic_id, title, genre, artist, description, comics.page_id, filename FROM comics INNER JOIN pages ON comics.page_id = pages.page_id WHERE comic_id = ?";
      $dbResult = $this->db->query($sql, array($comic_id));
      $row = $dbResult->result(); // array
      return json_encode($row[0]);
    } else {
      return false;
    }
  }*/

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

  // todo: make sure only admin can use this
  public function updateAddComic($comic_id=0, $title="", $genre="", $artist="", $description="", $page_id=0, $user_id=0) {
    if($comic_id === 0) {
      $sql = "INSERT INTO comics (title, genre, artist, description, page_id) VALUES (?, ?, ?, ?, ?)";
      $dbResult = $this->db->query($sql, array($title, $genre, $artist, $description, $page_id));
      return $this->db->insert_id();
    } else {
      $sql = "UPDATE comics SET title = ?, genre = ?, artist = ?, description = ?, page_id = ?  WHERE comic_id = ?";
      $dbResult = $this->db->query($sql, array($title, $genre, $artist, $description, $page_id, $comic_id));
      return $dbResult;
    }
  }

  // todo: make sure only admin can use this
  public function delComic($comic_id=0){
    $sql = "DELETE FROM comics WHERE comic_id = ?";
    $dbResult = $this->db->query($sql, array($comic_id));
    return $dbResult;
  }
}
