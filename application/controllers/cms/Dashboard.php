<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/users_model');
    $this->load->model('cms/sales_model');
    $this->load->model('cms/quota_model');
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

    $data['years'] = $this->quota_model->getYears();
    $data['sales_default_quota'] = $this->quota_model->getDefaultQuota($data['years']);
    $data['sales_quota_met'] = $this->quota_model->getQuotaMet($data['years']);

    // var_dump($data); die();

    $this->wrapper('cms/index', $data);
  }
 
}
