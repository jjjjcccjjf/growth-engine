<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends Crud_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/Invoices_model', 'invoice_model');
    $this->load->model('api/Sales_model', 'sales_model');
    
  }

  public function all_invoice_get(){
    $res = array();
    $message = "Error can't load invoices.";
    $status  = "400";
    $code = "error";
    $res = $this->sales_model->all_invoice();
    if($res):
        $message = "Successfuly load invoices !";
        $status = "200";
        $code = "OK";
    endif;
 
    $r_return = (object)[
        'data' => $res,
        'meta' => (object)[ 
            'message' => $message,
            'code' => $code,
            'status' => $status
        ]
    ];
    $this->response($r_return, $status);
  }

  public function uncollected_invoice_get(){
    $res = array();
    $message = "Error loading uncollected invoice.";
    $status  = "400";
    $code = "error";

    $this->db->where('MONTH(invoice.due_date) = MONTH(CURRENT_DATE()) AND (invoice.collected_date IS NULL OR invoice.collected_date = "0000-00-00 00:00:00")');

    $res = $this->invoice_model->getInvoices();
    if($res):
        $message = "Successfuly load uncollected invoice !";
        $status = "200";
        $code = "OK";
    endif;
 
    $r_return = (object)[
        'data' => $res,
        'meta' => (object)[ 
            'message' => $message,
            'code' => $code,
            'status' => $status
        ]
    ];
    $this->response($r_return, $status);
  }

  public function collected_invoice_get(){
    $res = array();
    $message = "Error loading collected invoice.";
    $status  = "400";
    $code = "error";

    $this->db->where('collected_date IS NOT NULL');

    $res = $this->invoice_model->getInvoices();
    if($res):
        $message = "Successfuly load collected invoice !";
        $status = "200";
        $code = "OK";
    endif;
 
    $r_return = (object)[
        'data' => $res,
        'meta' => (object)[ 
            'message' => $message,
            'code' => $code,
            'status' => $status
        ]
    ];
    $this->response($r_return, $status);
  }

  function view_get($sale_id)
  {
    
    $res = array();
    $message = "Error getting invoice.";
    $status  = "400";
    $code = "error";
    $res = $this->sales_model->getSale($sale_id);
    if($res):
        $message = "Successfuly view invoice !";
        $status = "200";
        $code = "OK";
    endif;
 
    $r_return = (object)[
        'data' => $res,
        'meta' => (object)[ 
            'message' => $message,
            'code' => $code,
            'status' => $status
        ]
    ];
    $this->response($r_return, $status);

  }

  function view_invoice_get($invoice_id)
  {
    
    $res = array();
    $message = "Error getting invoice.";
    $status  = "400";
    $code = "error";
    $res = $this->invoice_model->getSingleInvoice($invoice_id);
    if($res):
        $message = "Successfuly view invoice !";
        $status = "200";
        $code = "OK";
    endif;
 
    $r_return = (object)[
        'data' => $res,
        'meta' => (object)[ 
            'message' => $message,
            'code' => $code,
            'status' => $status
        ]
    ];
    $this->response($r_return, $status);

  }

  public function collect_post(){
    $res = array();
    $message = "Failed updating collection.";
    $status  = "400";
    $code = "error";


    $attachments = $this->invoice_model->batch_upload($_FILES['attachment_name']);
    $data = $this->input->post();
    $data['meta_id'] = $this->post('id');

    if ($attachments) {
      $attachment_success = $this->invoice_model->addAttachments($attachments, $data['id']);
    }

    $res = $this->invoice_model->updateCollection($data);

    if($res || @$attachment_success):
        $message = "Invoice tagged as collected successfully.";
        $status = "200";
        $code = "OK";
    endif;
 
    $r_return = (object)[
        'data' => $res,
        'meta' => (object)[ 
            'message' => $message,
            'code' => $code,
            'status' => $status
        ]
    ];
    $this->response($r_return, $status);
  }

  public function deliver_post(){
    $res = array();
    $message = "Failed updating collection.";
    $status  = "400";
    $code = "error";

    $attachments = $this->invoice_model->batch_upload($_FILES['attachment_name']);
    $data = $this->input->post();
    $data['meta_id'] = $this->post('id');

    if ($attachments) {
      $attachment_success = $this->invoice_model->addAttachments($attachments, $data['id']);
    }

    $res = $this->invoice_model->updateCollectionDeliver($data);

    if($res || @$attachment_success):
        $message = "Invoice tagged as delivered successfully.";
        $status = "200";
        $code = "OK";
    endif;
 
    $r_return = (object)[
        'data' => $res,
        'meta' => (object)[ 
            'message' => $message,
            'code' => $code,
            'status' => $status
        ]
    ];
    $this->response($r_return, $status);
  }

  function update_invoice_post($invoice_id){

    $res = array();
    $message = "Error updating invoice.";
    $status  = "400";
    $code = "error";
    $post = $this->post();
    $res = $this->invoice_model->updateInvoice($invoice_id, $post);
    if($res):
        $message = "Successfuly updated invoice !";
        $status = "200";
        $code = "OK";
    endif;
 
    $r_return = (object)[
        'data' => $res,
        'meta' => (object)[ 
            'message' => $message,
            'code' => $code,
            'status' => $status
        ]
    ];
    $this->response($r_return, $status);
  }

  public function add_attachment_post($invoice_id){

    $message = "Error adding attachment.";
    $status  = "400";
    $code = "error";


    $attachments = $this->invoice_model->batch_upload($_FILES['attachment_name']);

    if ($attachments)
    $add_attachments = $this->invoice_model->addAttachments($attachments, $invoice_id);

    if(@$add_attachments):
        $message = "Successfuly added attachment !";
        $status = "200";
        $code = "OK";
    endif;
 
    $r_return = (object)[
        'data' => $attachments,
        'meta' => (object)[ 
            'message' => $message,
            'code' => $code,
            'status' => $status
        ]
    ];
    $this->response($r_return, $status);

    
  }

  public function delete_attachment_post($invoice_id){

    $message = "Error deleting attachment.";
    $status  = "400";
    $code = "error";
    
    $res = $this->invoice_model->deleteAttachment($invoice_id);

    if($res):
        $message = "Successfuly deleted attachment !";
        $status = "200";
        $code = "OK";
    endif;

    $r_return = (object)[
        'data' => $res,
        'meta' => (object)[ 
            'message' => $message,
            'code' => $code,
            'status' => $status
        ]
    ];
    $this->response($r_return, $status);
  }
 
}
