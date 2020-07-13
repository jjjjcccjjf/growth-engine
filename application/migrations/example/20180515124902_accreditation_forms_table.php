<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_accreditation_forms_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'full_name' => array(
        'type' => 'TEXT',
      ),
      'form_url' => array(
        'type' => 'TEXT',
      ),
      'image_url' => array(
        'type' => 'TEXT',
      ),
      'is_marked' => array(
        'type' => 'INT'
      )
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");

    if($this->dbforge->create_table('accreditation_forms'))
    {
      // $table = 'accreditation_forms';
      //
      // $data = array(
      //   'title' => 'All cheese',
      //   'description' => 'hhihuhuahsud',
      //   'image_url' => 'https://robohash.org/hello111?set=set3',
      //   'cost' => 1,
      //   'class_available' => 2,
      //   'total_winners_allowed' => 10,
      // );
      // $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('accreditation_forms');
  }
}
