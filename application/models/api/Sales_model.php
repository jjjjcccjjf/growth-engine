<?php

class Sales_model extends Crud_model
{

  function __construct()
  {
    parent::__construct();
    $this->table = 'sales';

    $this->load->model('api/Invoices_model', 'invoicemodel');
    $this->load->model('api/Clients_model', 'clients_model');
    $this->load->model('api/Users_model', 'users_model');
    
  }

  public function all_invoice(){

    $res = $this->db->get($this->table)->result();
    return $this->formatRes($res);
  }


  public function uncollected_invoice(){

    $res = $this->db->get($this->table)->result();
    return $this->formatRes($res);
  }

  function formatRes($res)
  {
    $data = [];

    foreach ($res as $key => $value) {
      $value->client_name = $this->clients_model->get($value->client_id)->client_name;
      $value->sales_rep = @$this->users_model->get($value->user_id)->name;

      $value->invoice_name = $this->invoicemodel->getInvoiceName($value->id);
      $value->due_date = $this->invoicemodel->getInvoiceDueDate($value->id);
      $value->quickbooks_id = $this->invoicemodel->getInvoiceQuickBooksID($value->id);
      $value->invoice_date_created = $this->invoicemodel->getInvoiceCreateAt($value->id);

      $value->invoice_remaining = $this->invoicemodel->getInvoiceRemaining($value->id);
      $value->amount_left = $this->invoicemodel->getAmountLeft($value->id);
      $value->created_at = date('Y-m-d', strtotime($value->created_at));
      $value->attachments = $this->getAttachments($value->id, 'sales_attachment');
      $value->attachment_count = count($value->attachments);
      $value->is_verified = $this->invoicemodel->getVerifiedStatus($value->id);
      $data[] = $value;
    }
    return $data;
  } 

  function getAttachments($sale_id, $type)
  {
    $res = $this->db->get_where('attachments', ['meta_id' => $sale_id, 'type' => $type])->result();
    foreach ($res as $value) {
      $value->attachment_path = base_url('uploads/attachments/') . $value->attachment_name;
    }
    return $res;
  }

  public function getUniqueClients()
  {
    $this->db->distinct('client_name');
    return $this->db->get('sales')->result();
  }

  // get single sale/invoice

  function getSale($sale_id)
  {
    $res = $this->db->get_where($this->table, ['id' => $sale_id])->result();
    if (!$res) {
      return null;
    }

    return $this->formatRes($res)[0];
  }
 
}
