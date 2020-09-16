<?php

class Notifications_model extends Crud_model
{

 function __construct()
  {
    parent::__construct();
    $this->table = 'notification';
    
  }

  function createNotif($meta_id, $type)
  {
    $this->db->insert('notifications', ['type' => $type, 'meta_id' => $meta_id]);
    return $this->db->insert_id;
  }

}
