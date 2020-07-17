<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/users_model');
  }

  public function index()
  {
    $this->login();
  }

  public function login()
  {
    $this->load->view('cms/login');
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('cms/login');
    die();
  }

  public function attempt() # attempt to login
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $res = $this->users_model->getByEmail($email);
    if($res && password_verify($password, $res->password)){
      $this->session->set_userdata(['role' => $res->role_title, 'id' => $res->id, 'name' => $res->name, 'profile_pic_path' => $res->profile_pic_path]);
      redirect('cms/dashboard');
    } else {
      $this->session->set_flashdata('login_msg', ['message' => 'Incorrect email or password', 'color' => 'red']);
      redirect('cms/login');
    }

  }


}
