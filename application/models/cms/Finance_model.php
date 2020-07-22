<?php

class Finance_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'invoice'; # Replace these properties on children
    $this->upload_dir = 'uploads/invoice/'; # Replace these properties on children
    $this->per_page = 30;
  }

  public function all()
  {
    $res = $this->db->get($this->table)->result();
    return $this->formatRes($res);
  }

  // public function get($id)
  // {
  //    $res = $this->db->get_where($this->table, array('id' => $id))->row();
  //    if (!$res) {
  //    	return false;
  //    }
  //    return $this->formatRes([$res])[0];
  // }
  
  
  function getSingleInvoice($id)
  {
    $this->db->where('id', $id);
    $res = $this->db->get('invoice')->row();
    if (!$res) {
      return null;
    }
    return $this->formatInvoiceRes([$res])[0];
  }

  function updateCollection($data)
  {
    $this->db->where('id', $data['id']);
    return $this->db->update('invoice', ['collected_date' => $data['collected_date']]);
  }
  function getInvoices()
  {
    return $this->all();
  }

  // function getByEmail($email)
  // {
  //   $res = $this->db->get_where($this->table, array('email' => $email))->row();
  //    if (!$res) {
  //    	return false;
  //    }
  //    return $this->formatRes([$res])[0];
  // }
  // 
  // 
  public function getInvoiceRemaining($sale_id){
    $sales = $this->db->get_where('sales', ['id' => $sale_id])->row()->num_of_invoices;
    $this->db->where('sale_id', $sale_id);
    $invoices = $this->db->count_all_results('invoice');

    if (!$sales) {
      return 0;
    }

    return $sales - $invoices;
  }

  function getAmountLeft($sale_id)
  {
    $this->db->where('sale_id', $sale_id);
    $res = $this->db->get('invoice')->result();
    $total_collected_amount = 0;
    foreach ($res as $value) {
      $total_collected_amount += $value->collected_amount;
    }

    $this->db->where('id', $sale_id);
    $sale = $this->db->get('sales')->row();
    return $sale->amount - $total_collected_amount;
  }

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

  public function update($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }

  // function getSales($user_id)
  // {
  //   $res = $this->db->get_where($this->table, ['user_id' => $user_id])->result();
  //   if (!$res) {
  //     return [];
  //   }

  //   return $this->formatRes($res);
  // }

  // function getSale($sale_id)
  // {
  //   $res = $this->db->get_where($this->table, ['id' => $sale_id])->result();
  //   if (!$res) {
  //     return null;
  //   }

  //   return $this->formatRes($res)[0];
  // }

  function formatRes($res)
  {
    $data = [];

    foreach ($res as $key => $value) {
      $value->created_at_f = date('F j, Y', strtotime($value->created_at));
      $value->attachments = $this->getAttachments($value->id, 'invoice');
      $value->attachment_count = count($value->attachments);
      $value->project_name = $this->db->get_where('sales', ['id' => $value->sale_id])->row()->project_name;
      $data[] = $value;
    }
    return $data;
  } 

  function formatInvoiceRes($res)
  {
    $data = [];

    foreach ($res as $key => $value) {
      $value->created_at_f = date('F j, Y', strtotime($value->created_at));
      $value->due_date_f = date('F j, Y', strtotime($value->due_date));
      $value->collected_date_f = date('F j, Y', strtotime($value->collected_date));
      $value->attachments = $this->getAttachments($value->id, 'invoice');
      $value->attachment_count = count($value->attachments);
      $value->project_name = $this->db->get_where('sales', ['id' => $value->sale_id])->row()->project_name;
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

  public function add($data)
  {
    $this->db->insert('invoice', $data);
    return $this->db->insert_id();
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

    foreach ($files['name'] as $key => $image) {
      $_FILES[$k]['name'] = $files['name'][$key];
      $_FILES[$k]['type'] = $files['type'][$key];
      $_FILES[$k]['tmp_name'] = $files['tmp_name'][$key];
      $_FILES[$k]['error'] = $files['error'][$key];
      $_FILES[$k]['size'] = $files['size'][$key];

      $filename = time() . "_" . $files['name'][$key]; # Renames the filename into timestamp_filename
      $images[] = $uploaded_files[$k][] = $filename; # Appends all filenames to our return array with the key

      $config['file_name'] = $filename;
      $this->upload->initialize($config);

      $this->upload->do_upload($k);
    }

    return $uploaded_files;
  }

}
