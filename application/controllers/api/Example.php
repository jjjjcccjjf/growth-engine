<?php

class Example extends Crud_controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('crud_model', 'model');
  }

}
