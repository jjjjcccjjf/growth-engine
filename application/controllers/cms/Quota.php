<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quota extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/quota_model');
  }

  public function index()
  {
    $data['res'] = $this->quota_model->all(); 
    $this->wrapper('cms/quota', $data);
  }

  // public function update()
  // {
  //   $id = $this->input->post('id');
  //   $data = $this->input->post();
  //   unset($data['id']);

  //   if($this->quota_model->update($id, $data)){
  //     $this->session->set_flashdata('flash_msg', ['message' => 'Client information updated successfully', 'color' => 'green']);
  //   } else {
  //     $this->session->set_flashdata('flash_msg', ['message' => 'Error updating client', 'color' => 'red']);
  //   }
  //   redirect('cms/quota');
  // }

  public function add()
  {
    $last_id = $this->quota_model->addQuota($this->input->post('user_id'), $this->input->post());
    if($last_id){
      $this->session->set_flashdata('flash_msg', ['message' => 'Quota updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating quota. Year already exists.', 'color' => 'red']);
    }
    redirect('cms/users/quota/' . $this->input->post('user_id'));
  }

 
}
