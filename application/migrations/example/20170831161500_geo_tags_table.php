<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_geo_tags_table extends CI_Migration {

  public function create_geo_tags()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'device_id' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
        'unique' => TRUE,
      ),
      'longitude' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'latitude' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('geo_tags');
  }

  public function up()
  {
    $this->create_geo_tags();
  }

  public function down()
  {
    $this->dbforge->drop_table('geo_tags', true);
  }
}
