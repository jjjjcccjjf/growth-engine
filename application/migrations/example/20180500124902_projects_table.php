<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_projects_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'title' => array(
        'type' => 'TEXT',
      ),
      'address' => array(
        'type' => 'TEXT',
      ),
      'total_land_area' => array(
        'type' => 'TEXT',
      ),
      'phases' => array(
        'type' => 'TEXT',
      ),
      'status' => array(
        'type' => 'TEXT',
      ),
      'image_url' => array( # logo of the project
        'type' => 'TEXT',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");

    if($this->dbforge->create_table('projects'))
    {
      // $table = 'projects';
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
    $this->dbforge->drop_table('projects');
  }
}
