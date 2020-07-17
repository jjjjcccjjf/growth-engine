<?php

class Profile_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'users';  # Replace these properties on children
    $this->upload_dir = 'uploads/users/'; # Replace these properties on children
    $this->per_page = 15;
  }

  public function get($id)
  {

     $res = $this->db->get_where($this->table, array('id' => $id))->row();
     return $this->formatRes($res);
  }

  public function update($id, $data)
  {
    if (!$data['password']) {
      unset($data['password']);
    } else {
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }
    
    if ($this->session->id == $id) {
      if ($_FILES['profile_pic_filename']['size']) {
          $this->session->set_userdata('profile_pic_filename', base_url().  $this->upload_dir . $data['profile_pic_filename']);
      }
      $this->session->set_userdata('name', $data['name']);
    }
    
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }

  function formatRes($res)
  {
    $res->profile_pic_path = base_url() . $this->upload_dir . $res->profile_pic_filename;
    return $res;
  }
}
