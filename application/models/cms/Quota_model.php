<?php

class Quota_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'quota'; # Replace these properties on children
    $this->upload_dir = 'uploads/quota/'; # Replace these properties on children
    $this->per_page = 30;

  }

  public function all()
  {
    $this->db->order_by('year', 'desc');
    $res = $this->db->get($this->table)->result();
    return $this->formatRes($res);
  }
 
 
  public function add($data)
  {
    if ($this->checkYearExist($data['year'])) {
      return false;  
    } # return false pag nag eexist na ung year

    $this->db->insert($this->table, $data);
    $last_id = $this->db->insert_id();

    return $last_id;
  }

  function checkYearExist($year)
  {
    $this->db->where('year', $year);
    return $this->db->count_all_results('quota');
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
