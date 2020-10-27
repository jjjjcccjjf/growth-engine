<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/users_model');
    $this->load->model('cms/sales_model');
    $this->load->model('cms/options_model');
    $this->load->model('cms/clients_model');
    $this->load->model('cms/finance_model');
  }

  public function index()
  {
    $data['user'] = $this->users_model->get($this->session->id);
    $data['sales'] = $this->sales_model->getSales($this->session->id);
    $data['categories'] = $this->options_model->getSalesCategories();
    $data['clients'] = $this->clients_model->all();
    $this->wrapper('cms/sales', $data);
  }

  function view($sale_id)
  {
    $data['res'] = $this->sales_model->getSale($sale_id);
    $data['categories'] = $this->options_model->getSalesCategories();
    $data['clients'] = $this->clients_model->all();
    $data['invoices'] = $this->finance_model->getInvoicesBySale($sale_id);
    $data['verified_status'] = ($data['res']->is_verified) ? '<button class="btn-success btn btn-xs btn-round" title="At least one collection"><i class="fas fa-check"></i> VERIFIED</button>' : '<button class="btn-warning btn btn-xs btn-round"><i class="fas fa-exclamation-triangle"></i> UNVERIFIED</button>';
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
    if ($attachments) {
      $attachment_success = $this->sales_model->addAttachments($attachments, $last_id);
    }
    if($last_id || @$attachment_success){
      $this->session->set_flashdata('flash_msg', ['message' => 'New sale added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding sale.', 'color' => 'red']);
    }
    redirect('cms/sales');
  }

  public function delete()
  {
    if($this->sales_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Sale deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting sale', 'color' => 'red']);
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

  public function export()
  {
    // var_dump($this->session->role); die();

    // output headers so that the file is downloaded rather than displayed
    header('Content-type: text/csv');
    header('Content-Disposition: attachment; filename="' . date('Y-m-d') . '_sales.csv"');
    // do not cache the file
    header('Pragma: no-cache');
    header('Expires: 0');
    // create a file pointer connected to the output stream
    
    $file = fopen('php://output', 'w');
    // send the column headers
    fputcsv($file, array('Date', 'Client', 'Project Name', 'Amount', 'Owner'));
    
    if ($this->session->role == 'sales') {
      $this->db->where('sales.user_id', $this->session->id);
      // $res = $this->sales_model->getSalesForExportThisMonth(true, $this->session->id);
    } else {
      // $res = $this->sales_model->getSalesForExportThisMonth(true);
    }

    $this->db->select('DATE_FORMAT(sales.created_at, "%Y-%m-%d") as _created_at, clients.client_name as _client_name, sales.project_name as _project_name, sales.amount as _amount, users.name as _owner');
    $this->db->join('clients', 'clients.id = sales.client_id', 'left');
    $this->db->join('users', 'users.id = sales.user_id', 'left');
    $this->finance_model->filters();
    if (@$_GET['type'] == 'all') {
        $res = $this->sales_model->all();
    } else if(@$_GET['type'] == 'pending') {
        $res = $this->sales_model->allPending();
    }

    $new_res = [];
    foreach ($res as $key => $value) {
      $new_res[] = array(
        // $value->id,
        $value->_created_at,
        $value->_client_name,
        $value->_project_name,
        $value->_amount,
        $value->_owner
      );
    }
    $data = $new_res;

    foreach ($data as $row)
    {
      fputcsv($file, $row);
    }
    exit();
  }
 
}
