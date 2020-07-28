<?php

class Notifications_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'notifications'; # Replace these properties on children
    $this->upload_dir = 'uploads/notifications/'; # Replace these properties on children
    $this->per_page = 30;
  }

  public function getNotifications($role)
  {
     $res = $this->delegateNotifs($role);
     $res = $this->formatNotifs($res);
     if (!$res) {
     	return [];
     }
     return $res;
  }

  function createNotif($meta_id, $type)
  {
    $this->db->insert('notifications', ['type' => $type, 'meta_id' => $meta_id]);
    return $this->db->insert_id;
  }
 
  function delegateNotifs($role)
  {
    switch ($role) {
      case 'finance': # pag finance ako, kunin lahat ng sales notif
        $this->db->where('type', 'sales');
        $res = $this->db->get('notifications')->result();
        break;

      case 'sales': 
      case 'collection': 
        $this->db->where('type', 'invoice');
        $res = $this->db->get('notifications')->result();
        break;
      
      default:
      case 'superadmin':
        $res = $this->db->get('notifications')->result();
        break;

    }
    return $res;
  }

  function formatNotifs($data)
  {
    $res = [];
    if (!$data) {
      return $res;
    }
    foreach ($data as $value) {
      switch ($value->type) {
        case 'sales': # pag may sales na gumawa ng bagong sale
          $value->header = 'New sale';
          $value->body = $this->db->get_Where('sales', ['id' => $value->meta_id])->row()->project_name . " has been created";
          $value->icon = 'fas fa-dollar-sign';
          $value->created_at_f = date('Y-m-d H:i:s', strtotime($value->created_at));
          $value->link = base_url('cms/finance/issue_invoice');
          $res[] = $value;
          break;

        case 'invoice': # pag may invoice na nagawa
          $value->header = 'New invoice';
          $value->body = $this->db->get_Where('invoices', ['id' => $value->meta_id])->row()->invoice_name . " has been created";
          $value->icon = 'fas fa-file-invoice-dollar';
          $value->created_at_f = date('Y-m-d H:i:s', strtotime($value->created_at));
          $value->link = base_url('cms/finance/invoice_management');
          $res[] = $value;
          break;
        
        default:
          // code...
          break;
      }
    }

    return $res;
  }

  function countUnreadNotifs($last_checked_notif_at, $role)
  {
    if ($last_checked_notif_at){
      $this->db->where("created_at > '$last_checked_notif_at'");
    }

    switch ($role) {
      case 'finance':
      $this->db->where('type', 'sales');
        break;
      
      case 'sales': 
      case 'collection': 
        $this->db->where('type', 'invoice');
        break;

      default:
      case 'superadmin':
        // code...
        break;
    }
    
    return $this->db->count_all_results('notifications');
  }

}
