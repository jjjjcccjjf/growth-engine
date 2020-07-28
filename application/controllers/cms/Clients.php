<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/clients_model');
  }

  public function index()
  {
    $data['res'] = $this->clients_model->all(); 
    $this->wrapper('cms/clients', $data);
  }

  function view($sale_id)
  {
    $data['res'] = $this->clients_model->all();
    $this->wrapper('cms/clients', $data);
  }

  public function update()
  {
    $client_id = $this->input->post('id');
    $data = $this->input->post();
    unset($data['id']);

    if($this->clients_model->update($client_id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Client information updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating client', 'color' => 'red']);
    }
    redirect('cms/clients');
  }

  public function add()
  {
    $last_id = $this->clients_model->add($this->input->post());
    if($last_id){
      $this->session->set_flashdata('flash_msg', ['message' => 'New client added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding client.', 'color' => 'red']);
    }
    redirect('cms/clients');
  }

 
}
