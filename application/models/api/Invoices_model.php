<?php

class Invoices_model extends Crud_model
{

  function __construct()
  {
    parent::__construct();
    $this->table = 'invoice';
    
  }

  function getInvoices()
  {
    // return $this->all();
    $res = $this->db->get($this->table)->result();
    return $this->formatInvoiceRes($res);
  }

  function formatInvoiceRes($res)
  {
    $data = [];

    foreach ($res as $key => $value) {
      $value->created_at = date('Y-m-d', strtotime($value->created_at));
      $value->due_date = date('Y-m-d', strtotime($value->due_date));
      $value->collected_date = $value->collected_date ? date('Y-m-d', strtotime($value->collected_date)) : null;
      // $value->attachments = $this->getAttachments($value->id, 'invoice');
      // $value->attachment_count = count($value->attachments);
      $value->project_name = $this->db->get_where('sales', ['id' => $value->sale_id])->row()->project_name;
      $data[] = $value;
    }
    return $data;
  } 


  // public function all_invoice(){

  //   $query = $this->db->query("
  //           SELECT {$this->sales}.id,
  //                 -- {this->sales}.user_id,
  //                 -- {this->sales}.client_id,
  //                 -- {this->invoice}.invoice_name,
  //                 {$this->sales}.project_name,
  //                 {$this->sales}.amount,
  //                 -- {this->invoice}.due_date,
  //                 -- {this->invoice}.quickbooks_id,
  //                 -- {this->sales}.num_of_invoices,
  //                 -- {this->invoice}.created_at,
  //                 {$this->users}.name,
  //                 {$this->clients}.client_name
  //                 FROM {$this->sales}
  //           LEFT JOIN {$this->users} ON {$this->sales}.user_id = {$this->users}.id
  //           LEFT JOIN {$this->clients} ON {$this->sales}.client_id = {$this->clients}.id
  //           -- RIGHT JOIN {this->invoice} ON {this->sales}.id = {this->invoice}.sale_id
  //           "); 
  //   $row = $query->result();

  //   return $row;

  // }

  public function getInvoiceName($sale_id){

    $this->db->where('sale_id', $sale_id);
    $res = $this->db->get('invoice')->result();
    $invoice_name = 0;
    foreach ($res as $value) {
      $invoice_name = $value->invoice_name;
    }

    if (!$invoice_name) {
      return 0;
    }

    return $invoice_name;
  }

  public function getInvoiceDueDate($sale_id){
    
    $this->db->where('sale_id', $sale_id);
    $res = $this->db->get('invoice')->result();
    $due_date = 0;
    foreach ($res as $value) {
      $due_date = $value->due_date;
    }

    if (!$due_date) {
      return 0;
    }

    return $due_date;
  }

  public function getInvoiceQuickBooksID($sale_id){
    
    $this->db->where('sale_id', $sale_id);
    $res = $this->db->get('invoice')->result();
    $quickbooks_id = 0;
    foreach ($res as $value) {
      $quickbooks_id = $value->quickbooks_id;
    }

    if (!$quickbooks_id) {
      return 0;
    }

    return $quickbooks_id;
  }

  public function getInvoiceCreateAt($sale_id){
    
    $this->db->where('sale_id', $sale_id);
    $res = $this->db->get('invoice')->result();
    $created_at = 0;
    foreach ($res as $value) {
      $created_at = $value->created_at;
    }

    if (!$created_at) {
      return 0;
    }

    return $created_at;
  }

  public function getInvoiceRemaining($sale_id){

    $sales = $this->db->get_where('sales', ['id' => $sale_id])->row()->num_of_invoices;
    $this->db->where('sale_id', $sale_id);
    $invoices = $this->db->count_all_results('invoice');

    if (!$sales) {
      return 0;
    }

    return $sales - $invoices;
  }

  public function getAmountLeft($sale_id){

    $this->db->where('sale_id', $sale_id);
    $res = $this->db->get('invoice')->result();
    $total_collected_amount = 0;
    foreach ($res as $value) {
      $total_collected_amount += $value->collected_amount;
    }

    $this->db->where('id', $sale_id);
    $sale = $this->db->get('sales')->row();

    if($sale->vat_percent) {
      $amount_left = $sale->amount * (1 + ($sale->vat_percent / 100));
    } else {
      $amount_left = $sale->amount - $total_collected_amount;
    }

    return $amount_left;


  }

  function getVerifiedStatus($sale_id)
  {
    return $this->countAllCollected($sale_id) ? 1 : 0 ;
  }

  function countAllCollected($sale_id)
  {
    $this->db->where('sale_id', $sale_id);
    $this->db->where('collected_date IS NOT NULL');
    return $this->db->count_all_results('invoice');
  }

  function getSingleInvoice($id)
  {
    $this->db->where('id', $id);
    $res = $this->db->get('invoice')->row();
    if (!$res) {
      return null;
    }
    return $this->formatSingleInvoiceRes([$res])[0];
  }

  function formatSingleInvoiceRes($res)
  {
    $data = [];

    foreach ($res as $key => $value) {
      $value->created_at = date('Y-m-d', strtotime($value->created_at));
      $value->due_date = date('Y-m-d', strtotime($value->due_date));
      $value->collected_date = $value->collected_date ? date('Y-m-d', strtotime($value->collected_date)) : null;
      $value->attachments = $this->getAttachments($value->id, 'invoice');
      $value->attachment_count = count($value->attachments);
      $value->project_name = $this->db->get_where('sales', ['id' => $value->sale_id])->row()->project_name;
      $data[] = $value;
    }
    return $data;
  }

  // update invoice

  function updateCollection($data)
  {
    $this->db->where('id', $data['id']);
    $update =  $this->db->update('invoice', ['collected_date' => $data['collected_date'], 'received_by' => NULL, 'sent_date' => NULL]);

    // if ($update) {
    //   $this->notifications_model->createNotif($data['id'], 'collection');
    // }

    return $update;
  }

  function updateCollectionDeliver($data)
  {
    $this->db->where('id', $data['id']);
    $update =  $this->db->update('invoice', ['received_by' => $data['received_by'], 'sent_date' => $data['sent_date']]);

    // if ($update) {
    //   $this->notifications_model->createNotif($data['id'], 'collection');
    // }
    
    return $update;
  }

  function updateInvoice($invoice_id, $data)
  { 
    if (!$data['collected_date']) {
      unset($data['collected_date']);
    }

    $this->db->where('id', $invoice_id);
    return $this->db->update('invoice', $data);
  }

  function getAttachments($sale_id, $type)
  {

    $res = $this->db->get_where('attachments', ['meta_id' => $sale_id, 'type' => $type])->result();
    foreach ($res as $value) {
      $value->attachment_path = base_url('uploads/attachments/') . $value->attachment_name;
    }
    return $res;
  }

  public function addAttachments($data, $meta_id)
  {
    $res = [];
    foreach ($data['name'] as $value) {
      $res[] = ['attachment_name' => $value, 'meta_id' => $meta_id, 'type' => 'invoice'];
    }
    return $this->db->insert_batch('attachments', $res);
  }

   /**
  * Batch upload of the given $_FILES[key] multiple upload input
  * TODO: Refactor this to accept the key only
  * @param  array   $files   example value is $_FILES[key]
  * @return array           returns a multidimensional array in this structure array[key] => [0 => 'file1', 1 => 'file2']
  */
  public function batch_upload($files = [])
  {

    if($files == [] || $files == null ) return []; # Immediately returns an empty array if a parameter is not provided or key is not existing with the help of @ operator. Example @$_FILES['nonexistent_key']

    # Defaults
    $k = key($files); # Gets the `key` of the uplaoded thing on your form

    $uploaded_files = []; # Initialize empty return array
    $upload_path = 'uploads/attachments'; # Your upload path starting from the `root folder`. NOTE: Change this as needed

    # Configs
    $config['upload_path'] = $upload_path; # Set upload path
    $config['allowed_types'] = '*'; # NOTE: Change this as needed

    # Folder creation
    if (!is_dir($upload_path) && !mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true)){
      mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true); # You can set DEFAULT_FOLDER_PERMISSIONS constant in application/config/constants.php
    }

    if ($files['name'][0] != "") {
      foreach ($files['name'] as $key => $image) {
        $_FILES[$k]['name'] = $files['name'][$key];
        $_FILES[$k]['type'] = $files['type'][$key];
        $_FILES[$k]['tmp_name'] = $files['tmp_name'][$key];
        $_FILES[$k]['error'] = $files['error'][$key];
        $_FILES[$k]['size'] = $files['size'][$key];

        $filename = time() . "_" . preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $files['name'][$key]); # Renames the filename into timestamp_filename
        $images[] = $uploaded_files[$k][] = $filename; # Appends all filenames to our return array with the key

        $config['file_name'] = $filename;
        $this->upload->initialize($config);

        $this->upload->do_upload($k);
      }
    }



    return $uploaded_files;
  }

  // delete attachment 

  public function deleteUploadedMedia($id)
  {
    $this->db->where('id', $id);
    $path = "uploads/attachments/" . $this->db->get('attachments')->row()->attachment_name;

    $file_deleted = false;

    try {
      @unlink($file_deleted);
      $file_deleted =  true;
    } catch (\Exception $e) {
      $file_deleted = false;
    }

    return $file_deleted;
  }

  public function deleteAttachment($id)
  {
    $this->deleteUploadedMedia($id);

    $this->db->reset_query();
    $this->db->where('id', $id);
    return $this->db->delete('attachments');
  }


 
}
