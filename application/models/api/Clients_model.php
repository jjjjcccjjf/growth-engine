<?php

class Clients_model extends Crud_model
{

  function __construct()
  {
    parent::__construct();
    $this->table = 'clients';
    
  }

  public function all(){

    $res = $this->db->get($this->table)->result();
    return $res;
  }

 
}
