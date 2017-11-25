<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
  public function __construct() {
    $this->load->database();
    date_default_timezone_set("America/New_York");
  }

  function can_login($username, $password) {
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    $this->db->where('role', 'admin');
    $query = $this->db->get('users');

    if($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

}
