<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/users_model');
    $this->load->model('cms/sales_model');
  }

  public function index()
  {
    $this->dashboard();
  }

  public function dashboard()
  {
    // $res = $this->admin_model->all();
    $data['sales_unverified_array'] = $this->sales_model->getSaleCountPerSaleForGraph();
    $data['sales_verified_array'] = $this->sales_model->getVerifiedSaleCountPerSaleForGraph();
    $data['sales_array'] = $this->sales_model->getSalesArrayForGraph();
    $this->wrapper('cms/index', $data);
  }
 
}
