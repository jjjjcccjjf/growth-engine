<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_projects_downloadables_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'project_id' => array(
        'type' => 'INT',
      ),
      'title' => array(
        'type' => 'TEXT',
      ),
      'file_url' => array(
        'type' => 'TEXT',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");

    if($this->dbforge->create_table('projects_downloadables'))
    {
      // $table = 'projects_downloadables';
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
    $this->dbforge->drop_table('projects_downloadables');
  }
}
