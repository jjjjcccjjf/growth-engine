<?php

class Login_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'admin'; # Replace these properties on children
    $this->upload_dir = 'admin'; # Replace these properties on children
    $this->per_page = 15;
  }

  public function getByEmail($email)
  {
    return $this->db->get_where($this->table, array('email' => $email))->row();
  }

}
