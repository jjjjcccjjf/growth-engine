<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_match_reports_table extends CI_Migration {

  public function create_match_reports()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'fixture_id' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
        'unique' => TRUE,
      ),
      'title' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'body' => array(
        'type' => 'TEXT',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('match_reports');
  }

  public function up()
  {
    $this->create_match_reports();
  }

  public function down()
  {
    $this->dbforge->drop_table('match_reports', true);
  }
}
