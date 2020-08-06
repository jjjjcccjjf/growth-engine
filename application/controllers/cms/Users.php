<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/users_model');
    $this->load->model('cms/options_model');
  }

  public function index()
  {
    $data['res'] = $this->users_model->all();
    $data['roles'] = $this->options_model->getRoles();
    $this->wrapper('cms/users', $data);
  }

  public function update($id)
  {
    $data = array_merge($this->input->post(), $this->users_model->upload('profile_pic_filename'));

    if($this->users_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'User updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating user', 'color' => 'red']);
    }
    redirect('cms/users');
  }
  public function add()
  {
    $data = array_merge($this->input->post(), $this->users_model->upload('profile_pic_filename'));

    if($this->users_model->add($this->input->post())){
      $this->session->set_flashdata('flash_msg', ['message' => 'User added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding user. Email already exists.', 'color' => 'red']);
    }
    redirect('cms/users');
  }
  public function delete()
  {
    if($this->users_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'User deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting user', 'color' => 'red']);
    }
    redirect('cms/users');
  }
 
}
