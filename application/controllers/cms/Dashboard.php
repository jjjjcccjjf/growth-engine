<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/admin_model', 'admin_model');
  }

  public function index()
  {
    $this->dashboard();
  }

  public function dashboard()
  {
    // $res = $this->admin_model->all();

    $data['res'] = null;
    $this->wrapper('cms/index', $data);
  }
}
