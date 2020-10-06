<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
 
    public function __construct()
    {
	    parent::__construct();

	    $this->load->model('cms/users_model');
    }

	public function index()
	{
		redirect('cms/dashboard');
	}

	function forgot_password()
	{
		$this->load->view('forgot_password');
	}

	function send_reset_link()
	{
	    $email = $this->input->post('email');
	    $res = $this->users_model->sendResetLink($email);

	    if($res){
	      $this->session->set_flashdata('login_msg', ['message' => 'Password reset link was sent to ' . $email, 'color' => 'green']);
	      redirect('forgot_password');
	    } else {
	      $this->session->set_flashdata('login_msg', ['message' => 'Sorry, ' . $this->input->post('email') . ' doesn\'t', 'color' => 'red']);
	      redirect('forgot_password');
	    }
	}

	function reset_password($hash)
	{
		$hashy = base64_decode(urldecode($hash));
		$data['email'] =  $hashy;

		$this->load->view('reset_password', $data);
	}


	function change_password()
	{
		$new_pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$this->db->where('email', $this->input->post('email'));
		$res = $this->db->update('users', ['password' => $new_pass]);

	   if($res){
	      $this->session->set_flashdata('login_msg', ['message' => 'Password was reset successfully', 'color' => 'green']);
	      redirect('cms/login');
	    } else {
	      $this->session->set_flashdata('login_msg', ['message' => 'Failed updating password', 'color' => 'red']);
	      redirect('cms/login');
	    }
	}
}
