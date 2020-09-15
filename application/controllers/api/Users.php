<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Crud_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/Users_model', 'model');
  }

  public function login_post(){

    $res = array();
    
    $message = "Invalid Username/Password.";
    $status  = "400";
    $code = "error";
    $post = $this->post();

    $res = $this->model->login($post);
    
    if($res)
    {
        $message = "User logged-in successfully";
        $status = "200";
        $code = "OK";
    }

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
