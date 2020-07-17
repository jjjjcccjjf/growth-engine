<?php

class Login_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'users'; # Replace these properties on children
    $this->upload_dir = 'users'; # Replace these properties on children
    $this->per_page = 15;
  }

  public function getByEmail($email)
  {
  }

}
