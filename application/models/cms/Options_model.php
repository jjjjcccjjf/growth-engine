<?php

class Options_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    // $this->table = 'users'; # Replace these properties on children
    // $this->upload_dir = 'users'; # Replace these properties on children
    // $this->per_page = 30;
  }

  public function getRoles(){
    $res = ['superadmin', 'sales', 'finance', 'collection'];
    sort($res);
  	return $res;
  }

  public function getSalesCategories()
  {
    $res = ['SEO', 'Social', 'Online Ads', 'Dev', 'Others', 'Hosting', 'Domain'];
    sort($res);
    return $res;
  }

}
