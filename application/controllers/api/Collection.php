<?php

class Collection extends Crud_controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('cms/finance_model');
  }

  function index_get()
  {
    $this->db->where('MONTH(invoice.due_date) = MONTH(CURRENT_DATE()) AND (invoice.collected_date IS NULL OR invoice.collected_date = "0000-00-00 00:00:00")');
    
    $res['data'] = $this->finance_model->getInvoices();
    $res['meta'] = (object)[
    	'status' => 200,
    	'code' => 'ok',
    	'message' => 'Got all data.'
    ];
    $this->response($res, 200);
  }

}
