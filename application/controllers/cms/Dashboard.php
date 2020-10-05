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

    $salesperson_id = $this->input->get('u');

    $data['sales_people'] = $this->users_model->getSales();
    $data['have_sales'] = $this->sales_model->haveSales();
    
    $total_collection = $this->finance_model->getTotalCollection($this->session->role, $this->session->id);
    $total_uncollected = $this->finance_model->getTotalUncollected($this->session->role, $this->session->id);
    $uninvoiced = $this->finance_model->getTotalUninvoiced($this->session->role, $this->session->id);
    $amount_sales_invoice_remaining = $this->finance_model->getTotalSalesInvoicedAmount($this->session->role, $this->session->id);
    $total_uninvoiced = $uninvoiced + ($amount_sales_invoice_remaining);

    $data['total_collection'] = number_format($total_collection, 2);
    $data['total_uncollected'] = number_format($total_uncollected, 2);
    $data['total_uninvoiced'] = number_format($total_uninvoiced, 2);

    $data['quarters_array'] = $this->quota_model->getQuartersArrayForGraph(); # should always be included

    $data['years_for_verified'] = $this->quota_model->getYearsFromSales(); 

    $data['for_user'] = $this->sales_model->getSalesPersonLabel($salesperson_id);

    $data['sales_default_quota'] = $this->quota_model->getDefaultQuota($data['years_for_verified']);
    $data['sales_quota_met'] = $this->quota_model->getQuotaMet($data['years_for_verified']);
    $data['sales_quota_met_verified'] = $this->quota_model->getQuotaMetVerified($data['years_for_verified']);
    // var_dump($data); die();


    $this->wrapper('cms/index', $data);
  }

  public function old_dashboard_2()
  {

    $salesperson_id = $this->input->get('u');

    $data['sales_people'] = $this->users_model->getSales();
    $data['quarters_array'] = $this->quota_model->getQuartersArrayForGraph(); # should always be included

    $data['years_for_verified'] = $this->quota_model->getYearsFromSales();
    $data['total_sales'] = $this->quota_model->getTotalSales($data['years_for_verified']);
    $data['total_verified_sales'] = $this->quota_model->getVerifiedSales($data['years_for_verified']);

    $data['for_user'] = $this->sales_model->getSalesPersonLabel($salesperson_id);

    $data['sales_default_quota'] = $this->quota_model->getDefaultQuota($data['years_for_verified']);
    $data['sales_quota_met'] = $this->quota_model->getQuotaMet($data['years_for_verified']);
    // var_dump($data); die();


    $this->wrapper('cms/index', $data);
  }

  public function old_dashboard()
  {

    $data['sales_people'] = $this->users_model->getSales();
    $data['sales_unverified_array'] = $this->sales_model->getSaleCountPerSaleForGraph();
    $data['sales_verified_array'] = $this->sales_model->getVerifiedSaleCountPerSaleForGraph();
    $data['sales_array'] = $this->sales_model->getSalesArrayForGraph();

    $data['years'] = $this->quota_model->getYears();
    $data['sales_default_quota'] = $this->quota_model->getDefaultQuota($data['years']);
    $data['sales_quota_met'] = $this->quota_model->getQuotaMet($data['years']);

    $this->wrapper('cms/index', $data);
  }
 
}
