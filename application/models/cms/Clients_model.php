<?php

class Clients_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'clients'; # Replace these properties on children
    $this->upload_dir = 'uploads/clients/'; # Replace these properties on children
    $this->per_page = 30;

  }

  public function all()
  {
    $this->db->order_by('client_name', 'asc');
    $res = $this->db->get($this->table)->result();
    return $this->formatRes($res);
  }

  // public function get($id)
  // {
  //    $res = $this->db->get_where($this->table, array('id' => $id))->row();
  //    if (!$res) {
  //    	return false;
  //    }
  //    return $this->formatRes([$res])[0];
  // }

  // function getByEmail($email)
  // {
  //   $res = $this->db->get_where($this->table, array('email' => $email))->row();
  //    if (!$res) {
  //    	return false;
  //    }
  //    return $this->formatRes([$res])[0];
  // }
  // 
 
  public function add($data)
  {
    $this->db->insert($this->table, $data);
    $last_id = $this->db->insert_id();

    return $last_id;
  }
 

  public function update($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }

  function formatRes($res)
  {
    $data = [];

    foreach ($res as $key => $value) {
      $value->created_at = date('Y-m-d', strtotime($value->created_at));
      $data[] = $value;
    }
    return $data;
  } 
 

}
