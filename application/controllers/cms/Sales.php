<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/users_model');
    $this->load->model('cms/sales_model');
    $this->load->model('cms/options_model');
  }

  public function index()
  {
    $data['user'] = $this->users_model->get($this->session->id);
    $data['sales'] = $this->sales_model->getSales($this->session->id);
    $data['categories'] = $this->options_model->getSalesCategories();
    $data['unique_clients'] = $this->sales_model->getUniqueClients();
    $this->wrapper('cms/sales', $data);
  }

  function view($sale_id)
  {
    $data['res'] = $this->sales_model->getSale($sale_id);
    $data['categories'] = $this->options_model->getSalesCategories();
    $data['unique_clients'] = $this->sales_model->getUniqueClients();
    $this->wrapper('cms/view_sale', $data);
  }

  public function update($sale_id)
  {
    $data = $this->input->post();

    if($this->sales_model->update($sale_id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Sale information updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating sale', 'color' => 'red']);
    }
    redirect('cms/sales/view/' . $sale_id);
  }

  public function add()
  {
    $attachments = $this->sales_model->batch_upload($_FILES['attachments']);
    $data = $this->input->post();

    $last_id = $this->sales_model->add($this->input->post());
    if($last_id && $this->sales_model->addAttachments($attachments, $last_id)){
      $this->session->set_flashdata('flash_msg', ['message' => 'New sale added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding sale.', 'color' => 'red']);
    }
    redirect('cms/sales');
  }

  public function add_attachments($sale_id)
  {
    $attachments = $this->sales_model->batch_upload($_FILES['attachments']);
    if($this->sales_model->addAttachments($attachments, $sale_id)){
      $this->session->set_flashdata('flash_msg', ['message' => 'New sale added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding sale.', 'color' => 'red']);
    }
    redirect('cms/sales/view/' . $sale_id);
  }

  public function attachment_delete($sale_id)
  {
    header('Content-Type: application/json');
    if($this->sales_model->deleteAttachment($sale_id)){
      echo json_encode(['message' => 'Attachment deleted successfully', 'color' => 'green']);
    } else {
      echo json_encode('flash_msg', ['message' => 'Error deleting attachment', 'color' => 'red']);
    }
  }
 
}
