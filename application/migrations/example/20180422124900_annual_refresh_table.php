<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_annual_refresh_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'last_year_updated' => array(
        'type' => 'YEAR',
      ),
    ));

    # Table date defaults
    // $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    // $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('annual_refresh'))
    {
      $table = 'annual_refresh';

      $data = array(
        'last_year_updated' => '2018',
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('annual_refresh');
  }
}
