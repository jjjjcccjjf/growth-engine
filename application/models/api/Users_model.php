<?php

class Users_model extends Crud_model
{

  function __construct()
  {
    parent::__construct();
    $this->table = 'users';
    
  }

  public function login($data){

    $this->db->where("email", $data['email']);
        $res = $this->db->get($this->table)->row();
        if ($res) {
          if(password_verify($data['password'], $res->password)){
                $this->db->where("email", $data['email']);
                $res = $this->db->get($this->table)->row();
                unset($res->password);
          }else{
            $res = array();
          }
        }else{
          $res = array();
        }

        return $res;

    // $email = $data['email'];
    // $password = $data['password'];

    // $query = $this->db->query("SELECT * FROM users WHERE email = '{$email}' ");
    // $return = $query->row();
    // if ($return) {
    //   if (password_verify($password, $return->password)) {
    //       // unset mo yung $row->password para di masama sa return
    //       $return = $this->db->get($this->table)->row();
    //       unset($return->password);
    //     }else{
    //       //blank array
    //       $return = array();
    //     }
    //   }else{
    //     $return = array();
    // }
    // return $return;

  }

  public function all()
  {
    $res = $this->db->get($this->table)->result();
    return $this->formatRes($res);
  }

  public function getSales()
  {
    $this->db->where('role_title', 'sales');
    $res = $this->db->get($this->table)->result();
    return $this->formatRes($res);
  }

  public function get($id)
  {
     $res = $this->db->get_where($this->table, array('id' => $id))->row();
     if (!$res) {
      return false;
     }
     return $this->formatRes([$res])[0];
  }


  function formatRes($res)
  {
    $data = [];

    foreach ($res as $key => $value) {
      $value->profile_pic_path = base_url() . $this->upload_dir . $value->profile_pic_filename;
      $data[] = $value;
    }
    return $data;
  }

 
}
