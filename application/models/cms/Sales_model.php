<?php

class Sales_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'sales'; # Replace these properties on children
    $this->upload_dir = 'uploads/sales/'; # Replace these properties on children
    $this->per_page = 30;

    $this->load->model('cms/finance_model');
    $this->load->model('cms/clients_model');
    $this->load->model('cms/notifications_model');
  }

  public function all()
  {
    $this->db->order_by('sales.created_at', 'desc');
    $res = $this->db->get($this->table)->result();
    return $this->formatRes($res);
  }

  function getUniqueOwners()
  {
    $this->db->where('role_title', 'sales');
    $res = $this->db->get('users')->result();
    return $res;
  }

  function haveSales()
  {
    if ($this->input->get('u')) {
      $this->db->where('user_id', $this->input->get('u'));
    }
    return $this->db->count_all_results('sales');
  }

  public function allPending()
  {
    $res = $this->db->get($this->table)->result();
    $data = $this->formatRes($res);
    $new_res = [];
    foreach ($data as $value) {
      # Dito nagaganap ang determine kung pending ba o hinde
      if ($value->amount_left > 0) { # pag may invoice pa
        $new_res[] = $value; # sama natin sa $res
      }
    }
    // var_dump($new_res); die();

    return $new_res;
  }

  function getSalesOrdered()
  {
    $this->db->order_by('name', 'desc');
    return $this->db->get_where('users', ['role_title' => 'sales'])->result();
  }

  function getSaleCountPerSaleForGraph()
  {
    $sales = $this->getSalesOrdered();

    $res = [];

    foreach ($sales as $value) {
      $res[] = [
        $value->name,
        $this->getSalesCount($value->id)
      ];
    }

    return $res;
  }

  function getSaleById($id)
  {
    $sale = $this->db->get_where('sales', ['id' => $id])->row();
    if (!$sale) {
      return false;
    }

    return $this->formatRes([$sale])[0];
  }

  function getVerifiedSaleCountPerSaleForGraph()
  {
    $sales = $this->getSalesOrdered();

    $res = [];

    foreach ($sales as $value) {
      $res[] = [
        $value->name,
        $this->getSalesCountVerified($value->id)
      ];
    }

    return $res;
  }

  // public function get($id)
  // {
  //    $res = $this->db->get_where($this->table, array('id' => $id))->row();
  //    if (!$res) {
  //    	return false;
  //    }
  //    return $this->formatRes([$res])[0];
  // }

  // function getByEmail($email)
  // {
  //   $res = $this->db->get_where($this->table, array('email' => $email))->row();
  //    if (!$res) {
  //    	return false;
  //    }
  //    return $this->formatRes([$res])[0];
  // }
  //
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


  public function add($data)
  {
    $this->db->insert($this->table, $data);
    $last_id = $this->db->insert_id();

    if ($last_id) {
      $this->notifications_model->createNotif($last_id, 'sales');
    }

    return $last_id;
  }

  public function delete($id)
  {
    $this->db->where('sale_id', $id);
    $invoices = $this->db->get('invoice')->result();

    if ($invoices) {
      foreach ($invoices as $value) {
        $this->db->where('meta_id', $value->id);
        $this->db->where('type', 'invoice');
        $this->db->delete('attachments');
      }
    }

    $this->db->where('sale_id', $id);
    $this->db->delete('invoice');

    $this->db->where('meta_id', $id);
    $this->db->where('type', 'sales');
    $this->db->delete('notifications'); # delete associated notification

    $this->db->where('meta_id', $id);
    $this->db->where('type', 'sales_attachment');
    $this->db->delete('attachments');

    $this->db->where('id', $id);
    return $this->db->delete('sales');
  }

  public function getUniqueClients()
  {
    $this->db->distinct('client_name');
    return $this->db->get('sales')->result();
  }

  public function getUniqueClientsObject()
  {
    $this->db->order_by('client_name', 'asc');
    return $this->db->get('clients')->result();
  }

  public function addAttachments($data, $meta_id)
  {
    if (!$data) {
      return false;
    }

    $res = [];
    foreach ($data['name'] as $value) {
      $res[] = ['attachment_name' => $value, 'meta_id' => $meta_id, 'type' => 'sales_attachment'];
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

      $filename = time() . "_" . preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $files['name'][$key]); # Renames the filename into timestamp_filename
      $images[] = $uploaded_files[$k][] = $filename; # Appends all filenames to our return array with the key

      $config['file_name'] = $filename;
      $this->upload->initialize($config);

      $this->upload->do_upload($k);
    }

    return $uploaded_files;
  }

  public function update($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }


  function getSalesForExportThisMonth ($this_month = true, $user_id = false) {
    if ($user_id) {
      $this->db->where('sales.user_id', $user_id);
    }
    if ($this_month) {
      $this->db->where('MONTH(sales.created_at) = MONTH(CURRENT_DATE())');
    }
    $this->db->select('DATE_FORMAT(sales.created_at, "%Y-%m-%d") as created_at, clients.client_name, sales.project_name, sales.amount, users.name as owner');
    $this->db->join('clients', 'clients.id = sales.client_id', 'left');
    $this->db->join('users', 'users.id = sales.user_id', 'left');
    return $this->db->get('sales')->result();
  }

  function getSales($user_id)
  {
    $res = $this->db->get_where($this->table, ['user_id' => $user_id])->result();
    if (!$res) {
      return [];
    }

    return $this->formatRes($res);
  }

  function getSalesCount($user_id)
  {
    return count($this->getSales($user_id));
  }

  function getSalesCountVerified($user_id)
  {
    $verified_count = 0;
    $sales = $this->getSales($user_id);
    if ($sales) {
      foreach ($sales as $value) {
        if ($value->is_verified) {
          $verified_count = $verified_count + 1;
        }
      }
    }

    return $verified_count;
  }

  function getSalesArrayForGraph()
  {
    $sales = $this->getSalesOrdered();
    $res = [];
    if ($sales) {
      foreach ($sales as $value) {
        $res[] = (object)['name' => $value->name, 'flag' => $value->name];
      }
    }
    return $res;
  }

  function getSale($sale_id)
  {
    $res = $this->db->get_where($this->table, ['id' => $sale_id])->result();
    if (!$res) {
      return null;
    }

    return $this->formatRes($res)[0];
  }

  function formatRes($res)
  {
    $data = [];

    foreach ($res as $key => $value) {
      $value->client_name = $this->clients_model->get($value->client_id)->client_name;
      $value->sales_rep = @$this->users_model->get($value->user_id)->name;
      $value->invoice_remaining = $this->finance_model->getInvoiceRemaining($value->id);
      $value->amount_with_vat = round($value->amount * (((double)$value->vat_percent / 100) + 1), 2);
      $value->amount_with_vat_f = number_format($value->amount_with_vat, 2);


      $value->amount_left = number_format(round($value->amount_with_vat - round($this->finance_model->getTotalInvoicedAmount($value->id), 2), 2), 2);
      $value->amount_left_nf = round($value->amount_with_vat - round($this->finance_model->getTotalInvoicedAmount($value->id), 2), 2);

      # OLD do not delete
      #$value->amount_left = number_format(round($value->amount_with_vat - round($this->finance_model->getTotalCollectedWithTax($value->id), 2), 2), 2);
      #$value->amount_left_nf = round($value->amount_with_vat - round($this->finance_model->getTotalCollectedWithTax($value->id), 2), 2);
      # / OLD do not delete

      // if ($value->vat_percent > 0) {
      //   $value->amount_left = $this->finance_model->getAmountLeft($value->id) * ((int)$value->vat_percent / 100) + 1;
      // } else {
      //   $value->amount_left = $this->finance_model->getAmountLeft($value->id);
      // }
      $value->created_at = date('Y-m-d', strtotime($value->created_at));
      $value->attachments = $this->getAttachments($value->id, 'sales_attachment');
      $value->attachment_count = count($value->attachments);
      $value->is_verified = $this->finance_model->getVerifiedStatus($value->id);
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

  function getSalesPersonLabel($user_id)
  {
    $name = @$this->db->get_where('users', ['id' => $user_id])->row()->name;
    if ($name) {
      return $name;
    } else {
      return 'All';
    }
  }

  public function sumKey($sales, $key)
  {
    if (!$sales) {
      return 0;
    }

    $res = array_reduce($sales, function($carry, $item) use ($key)
    {
      return $carry + $item->$key;
    });

    return $res;
  }

}
