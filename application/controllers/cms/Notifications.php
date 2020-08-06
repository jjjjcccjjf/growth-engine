<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notifications extends Admin_core_controller { # see application/core/MY_Controller.php
  function __construct()
  {
    parent::__construct();
    $this->load->model('cms/notifications_model');
    // $this->load->model('cms/options_model');
    $this->load->model('cms/users_model');
  }

  public function index()
  {
    $data['all_notifs'] = $this->notifications_model->getNotifications($this->session->role);
    $this->users_model->updateLastChecked($this->session->id);
    $this->wrapper('cms/notifications', $data);
  } 
} # end class
