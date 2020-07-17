<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends Admin_core_controller { # see application/core/MY_Controller.php
  function __construct()
  {
    parent::__construct();
    $this->load->model('cms/profile_model');
    $this->load->model('cms/options_model');
    $this->load->model('cms/users_model');
  }

  public function index()
  {
    $data = [];
    $data['user'] = $this->profile_model->get($this->session->id);
    $data['roles'] = $this->options_model->getRoles();

    $this->wrapper('cms/profile', $data);
  }
 
  public function update($id)
  {
    $data = array_merge($this->input->post(), $this->profile_model->upload('profile_pic_filename'));

    if($this->profile_model->update($id, $data)){
      $res = $this->users_model->get($id);
      $this->session->set_userdata('name', $res->name); 
      $this->session->set_userdata('profile_pic_path', $res->profile_pic_path);
      $this->session->set_flashdata('flash_msg', ['message' => 'Profile updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating profile', 'color' => 'red']);
    }
    redirect('cms/profile');
  } 
} # end class
