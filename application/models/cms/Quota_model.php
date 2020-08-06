<?php

class Quota_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'quota'; # Replace these properties on children
    $this->upload_dir = 'uploads/quota/'; # Replace these properties on children
    $this->per_page = 30;

  }

  function getYears()
  {
    $years = [];
    $res = $this->db->get('quota')->result();
    foreach ($res as $value) {
      $years[] = (int)$value->year;
    }

    $years = array_unique($years);
    sort($years);
    return $years;
  }

  public function all()
  {
    $this->db->order_by('year', 'desc');
    $res = $this->db->get($this->table)->result();
    return $this->formatRes($res);
  }
 
 
  public function addQuota($user_id, $data)
  {
    $this->db->where('user_id', $user_id);
    $this->db->delete('quota');

    for ($i = 0; $i < count($data['year']); $i++) {
      $this->db->insert($this->table, [
        'year' => $data['year'][$i],
        'quota_amount' => $data['quota_amount'][$i],
        'user_id' => $user_id
      ]);
    }

    return true;
  } 

  function get($user_id)
  {
    $this->db->where('user_id', $user_id);
    return $this->db->get('quota')->result();
  }


  function getDefaultQuota($years){
    $res = (object)[];
    $sales_people = $this->users_model->getSales();
    if ($years) {

      foreach ($years as $year) {
        $res->{(int)$year} = $this->getSalesAndQuotaByYear($year, $sales_people);
      }

    } // end if years

    return $res;
  }

  function getSalesAndQuotaByYear($year, $sales_people)
  {
    $res = [];

    if ($sales_people) {
      foreach ($sales_people as $value) {

        $this->db->select('quota_amount');
        $this->db->where('user_id', $value->id);
        $this->db->where('year', $year);
        $quota_amount = @$this->db->get('quota')->row()->quota_amount;

        $res[] = [$value->name, (int)$quota_amount];
      }
    }

    return $res; # return all benta for all users for that year 
  }


  // function getDefaultQuota($years){
  //   $res = (object)[];
  //   if ($years) {

  //     foreach ($years as $year) {
  //       $sales_in_that_year = [];
  //       foreach ($this->getSalesAndQuotaByYear($year) as $value) {
  //         $sales_in_that_year[] = [
  //           $value->name,
  //           (int)$value->quota_amount
  //         ];
  //       }
  //       # example 2020
        
  //       $res->{(int)$year} = $sales_in_that_year;
  //     }

  //   } // end if years

  //   return $res;
  // }


  // function getSalesAndQuotaByYear($year)
  // {
  //   $this->db->select('users.name, quota.quota_amount');
  //   $this->db->where('year', $year);
  //   $this->db->join('users', 'quota.user_id = users.id', 'left');
  //   return $this->db->get('quota')->result();
  // }


  function getQuotaMet($years){
    $res = (object)[];
    $sales_people = $this->users_model->getSales();
    if ($years) {

      foreach ($years as $year) {
        $res->{(int)$year} = $this->getTotalSalesByYear($year, $sales_people);
      }

    } // end if years

    return $res;
  }


  # get mga benta for that $year
  function getTotalSalesByYear($year, $sales_people)
  {
    $res = [];

    if ($sales_people) {
      foreach ($sales_people as $value) {
        
        $this->db->select('sales.id');
        $this->db->where("YEAR(sales.created_at) = '{$year}'");
        $this->db->where('sales.user_id', $value->id);
        $sales = $this->db->get('sales')->result();

        $sales_id_array = array_map(function($e) {
            return is_object($e) ? $e->id : $e['id'];
        }, $sales);

        $amount = 0;
        if ($sales_id_array) {
          $this->db->select('SUM(invoice.collected_amount) as amount');
          $this->db->where_in('invoice.sale_id', $sales_id_array);
          $amount = $this->db->get('invoice')->row()->amount;
        } 

        $res[] = [$value->name, (int)$amount];
      }
    }

    return $res; # return all benta for all users for that year
  }
 
  // public function add($data)
  // {
  //   if ($this->checkYearExist($data['year'])) {
  //     return false;  
  //   } # return false pag nag eexist na ung year

  //   $this->db->insert($this->table, $data);
  //   $last_id = $this->db->insert_id();

  //   return $last_id;
  // }

  // function checkYearExist($year)
  // {
  //   $this->db->where('year', $year);
  //   return $this->db->count_all_results('quota');
  // }
 

  // public function update($id, $data)
  // {
  //   $this->db->where('id', $id);
  //   return $this->db->update($this->table, $data);
  // }

  // function formatRes($res)
  // {
  //   $data = [];

  //   foreach ($res as $key => $value) {
  //     $value->created_at = date('Y-m-d', strtotime($value->created_at));
  //     $data[] = $value;
  //   }
  //   return $data;
  // } 
 

}
