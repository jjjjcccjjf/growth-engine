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

  function updateCollect($data)
  {
    $this->db->where('id', $data['id']);
    $update =  $this->db->update('invoice', ['collected_date' => $data['collected_date'], 'collected_amount' => $data['collected_amount']]);

    if ($update) {
      $this->notifications_model->createNotif($data['id'], 'collection');
    }
    return $update;
  }

  function updateDeliver($data)
  {
    $this->db->where('id', $data['id']);
    $update =  $this->db->update('invoice', ['sent_date' => $data['sent_date'], 'received_by' => $data['received_by']]);

    if ($update) {
      $this->notifications_model->createNotif($data['id'], 'delivery');
    }
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

  function getInvoicesBySale($sale_id)
  {
    $this->db->where('sale_id', $sale_id);
    $res = $this->db->get('invoice')->result();
    return $this->formatRes($res);
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

  function deleteInvoice($id)
  {
    # Delete attachments on invoice
    $this->db->where('meta_id', $id);
    $this->db->where('type', 'invoice');
    $a = $this->db->get('attachments')->result();
    foreach ($a as $value) {
      $this->deleteAttachment($value->id);
    }

    # / Delete attachments on invoice
    
    # Delete notif invoice
    $this->db->where('meta_id', $id);
    $this->db->where('type', 'invoice');
    $this->db->delete('notifications');
    # /Delete notif invoice

    $this->db->where('id', $id);
    return $this->db->delete('invoice');
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

  function getBentaArray($user_id)
  {
    $this->db->select('id');
    $this->db->where('user_id', $user_id);
    $sales = $this->db->get('sales')->result();

    $sales = array_map(function($e) {
        return is_object($e) ? $e->id : $e['id'];
    }, $sales);

    return $sales;
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

  function getTotalCollection($role, $id, $current_month = true, $invoice_amount_instead = false)
  {
    switch ($role) {
      case 'sales':
      $sale_ids = $this->getBentaArray($id);
      $this->db->reset_query();
      ###
      if ($sale_ids) {
        $this->db->where_in('sale_id', $sale_ids);
      } else {
        $this->db->where("0");
      }
      break;
      
      case 'finance':
      case 'superadmin':
      default:
      break;
    }

    if ($current_month) {
      $this->db->where('MONTH(collected_date) = MONTH(CURRENT_DATE())');
    }
    if ($invoice_amount_instead) {
      $this->db->select_sum('invoice_amount', 'collected_amount');
    } else {
      $this->db->select_sum('collected_amount', 'collected_amount');
    }
    return $this->db->get('invoice')->row()->collected_amount;
  }

  function getTotalUncollected($role, $id) {
      return $this->getTotalInvoiceAmount($role, $id) - $this->getTotalCollection($role, $id, false, true);
  }

  /**
   * sum of all values ng sales without invoice
   * @param  [type] $role [description]
   * @param  [type] $id   [description]
   * @return [type]       [description]
   */
  function getTotalUninvoiced($role, $id) {
      switch ($role) {
        case 'sales':
        $this->db->where('sales.user_id', $id);
        break;
        
        case 'finance':
        case 'superadmin':
        default:
        break;
      }

      $this->db->select_sum('sales.amount', 'amount');
      $this->db->where('invoice_amount IS NULL');
      $this->db->join('invoice', 'invoice.sale_id = sales.id', 'left');
      return $this->db->get('sales')->row()->amount;
  }

  function getTotalSalesInvoicedAmount($role, $id)
  {
      switch ($role) {
        case 'sales':
        $sale_ids = $this->getBentaArray($id);
        $this->db->reset_query();
        ###
        if ($sale_ids) {
          $this->db->where_in('sale_id', $sale_ids);
        } else {
          $this->db->where("1");
        }
        break;
        
        case 'finance':
        case 'superadmin':
        default:
        break;
      }

      // $this->db->select_sum('invoice.invoice_amount', 'amount');
      $this->db->where('invoice.collected_date IS NULL OR invoice.collected_date = 0');

      $this->db->select('id, sale_id, invoice_amount');
      $res = $this->db->get('invoice')->result();

      $unique_sale_ids = [];
      foreach ($res as $value) {
        $unique_sale_ids[$value->sale_id] = 0;
      }

      foreach ($unique_sale_ids as $key => $value) {
          foreach ($res as $res_q) {
            if ($key == $res_q->sale_id) {
                $unique_sale_ids[$key] += $res_q->invoice_amount;
            }          
          }        
      }

      if (@$sale_ids) {
          $this->db->where_in('id', $sale_ids);
      }
      $sales = $this->db->get('sales')->result();

      $amount_remaining_sum = 0;
      foreach ($sales as $value) {
        if (@$unique_sale_ids[$value->id]) {
          $amount_remaining_sum += $value->amount - $unique_sale_ids[$value->id];
        }
      }
      return $amount_remaining_sum;
  }

  function getTotalInvoiceAmount($role, $id)
  {
    switch ($role) {
      case 'sales':
      $sale_ids = $this->getBentaArray($id);
      $this->db->reset_query();
      ###
      if ($sale_ids) {
        $this->db->where_in('sale_id', $sale_ids);
      } else {
        $this->db->where("0");
      }
      break;
      
      case 'finance':
      case 'superadmin':
      default:
      break;
    }

    $this->db->select_sum('invoice_amount', 'invoice_amount');
    return $this->db->get('invoice')->row()->invoice_amount;
  }

  function formatInvoiceRes($res)
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
    $last_id = $this->db->insert_id();
    
    if ($last_id) {
      $this->notifications_model->createNotif($last_id, 'invoice');
    }

    return $last_id;
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

}
