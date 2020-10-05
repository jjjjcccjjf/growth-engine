<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/users_model');
    $this->load->model('cms/sales_model');
    $this->load->model('cms/finance_model');
    $this->load->model('cms/options_model');
  }

  public function issue_invoice()
  {
    $data['title'] = 'Pending Invoices';
    $data['sales'] = $this->sales_model->allPending();
    $data['categories'] = $this->options_model->getSalesCategories();
    $data['unique_clients'] = $this->sales_model->getUniqueClients();
    $this->wrapper('cms/issue_invoice', $data);
  }

  public function issue_invoice_all()
  {
    $data['title'] = 'List of Sales';
    $data['sales'] = $this->sales_model->all();
    $data['categories'] = $this->options_model->getSalesCategories();
    $data['unique_clients'] = $this->sales_model->getUniqueClients();
    $this->wrapper('cms/issue_invoice', $data);
  }

  public function invoice_management()
  {
    if(@$_GET['show_all']) { # pag naka show all. pag default lang use this WHERE
       $data['title'] = 'All Invoices';    
    } else {
       $data['title'] = 'Uncollected Invoices';
        $this->db->where('MONTH(invoice.due_date) = MONTH(CURRENT_DATE()) AND (invoice.collected_date IS NULL OR invoice.collected_date = "0000-00-00 00:00:00")');
    }
    
    $data['invoices'] = $this->finance_model->getInvoices();
    // var_dump($this->db->last_query()); die();
    $data['categories'] = $this->options_model->getSalesCategories();
    $data['unique_clients'] = $this->sales_model->getUniqueClients();

    $this->wrapper('cms/invoice_management', $data);
  }

  public function invoice_management_collected()
  { 

    $this->db->where('collected_date IS NOT NULL');
    $data['title'] = 'Collected Invoices';
    $data['invoices'] = $this->finance_model->getInvoices();
    // var_dump($this->db->last_query()); die();
    $data['categories'] = $this->options_model->getSalesCategories();
    $data['unique_clients'] = $this->sales_model->getUniqueClients();

    $this->wrapper('cms/invoice_management', $data);
  }

  function view($sale_id)
  {
    $data['res'] = $this->sales_model->getSale($sale_id);
    $data['categories'] = $this->options_model->getSalesCategories();
    $data['unique_clients'] = $this->sales_model->getUniqueClients();
    $this->wrapper('cms/view_sale', $data);
  }

  function view_invoice($invoice_id)
  {
    $data['res'] = $this->finance_model->getSingleInvoice($invoice_id);
    $this->wrapper('cms/view_invoice', $data);
  }

  public function update($sale_id)
  {
    $data = $this->input->post();

    if($this->sales_model->update($sale_id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Sale information updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating sale', 'color' => 'red']);
    }
    redirect('cms/sales/view/' . $id);
  } 

  public function update_invoice($invoice_id)
  {
    $data = $this->input->post();

    if($this->finance_model->updateInvoice($invoice_id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Invoice  updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating invoice', 'color' => 'red']);
    }
    redirect('cms/finance/view_invoice/' . $invoice_id);
  } 

  public function delete_invoice($invoice_id, $from = 'invoice_management')
  {
    if($this->finance_model->deleteInvoice($invoice_id)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Invoice deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting invoice', 'color' => 'red']);
    }

    switch ($from) {
      case 'invoice_management':
        redirect('cms/finance/invoice_management');
        break;
      case 'invoice_management_show_all':
        redirect('cms/finance/invoice_management?show_all=1');
        break;
      
      default:
        redirect('cms/sales/view/' . $from);
        break;
    }
    
  } 

  public function collect()
  {
    $attachments = $this->finance_model->batch_upload($_FILES['attachments']);
    $data = $this->input->post();

    if ($attachments) {
      $attachment_success = $this->finance_model->addAttachments($attachments, $data['id']);
    }

    if($this->finance_model->updateCollect($data) || @$attachment_success){
      $this->session->set_flashdata('flash_msg', ['message' => 'Invoice tagged as collected successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Failed updating collection', 'color' => 'red']);
    }
    redirect('cms/finance/invoice_management');
  } 

  public function deliver()
  {
    $attachments = $this->finance_model->batch_upload($_FILES['attachments']);
    $data = $this->input->post();

    if ($attachments) {
      $attachment_success = $this->finance_model->addAttachments($attachments, $data['id']);
    }

    if($this->finance_model->updateDeliver($data) || @$attachment_success){
      $this->session->set_flashdata('flash_msg', ['message' => 'Invoice tagged as delivered successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Failed updating collection', 'color' => 'red']);
    }
    redirect('cms/finance/invoice_management');
  } 

  public function add()
  {
    $attachments = $this->finance_model->batch_upload($_FILES['attachments']);
    $data = $this->input->post();

    $last_id = $this->finance_model->add($this->input->post());
    if ($attachments) {
      $attachment_success = $this->finance_model->addAttachments($attachments, $last_id);
    }
    if($last_id || @$attachment_success){
      $this->session->set_flashdata('flash_msg', ['message' => 'New invoice added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding invoice.', 'color' => 'red']);
    }
    redirect('cms/finance/issue_invoice');
  }

  public function add_attachments($invoice_id)
  {
    $attachments = $this->finance_model->batch_upload($_FILES['attachments']);

    if ($attachments)
    $add_attachments = $this->finance_model->addAttachments($attachments, $invoice_id);

    if(@$add_attachments){
      $this->session->set_flashdata('flash_msg', ['message' => 'Attachments added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding attachments.', 'color' => 'red']);
    }
    redirect('cms/finance/view_invoice/' . $invoice_id);
  }

  public function add_attachments_from_sale($invoice_id, $sale_id)
  {
    $attachments = $this->finance_model->batch_upload($_FILES['attachments']);
    if($this->finance_model->addAttachments($attachments, $invoice_id)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Attachments added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding attachments.', 'color' => 'red']);
    }
    redirect('cms/sales/view/' . $sale_id);
  }

  // public function attachment_delete($sale_id)
  // {
  //   header('Content-Type: application/json');
  //   if($this->sales_model->deleteAttachment($sale_id)){
  //     echo json_encode(['message' => 'Attachment deleted successfully', 'color' => 'green']);
  //   } else {
  //     echo json_encode('flash_msg', ['message' => 'Error deleting attachment', 'color' => 'red']);
  //   }
  // }
 
}
