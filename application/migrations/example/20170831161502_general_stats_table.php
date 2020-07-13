<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_general_stats_table extends CI_Migration {

  public function create_general_stats()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'player_id' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'team_id' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'stat_key' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'stat_value' => array(
        'type' => 'VARCHAR',
        'constraint' => '15',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('general_stats');
  }

  public function up()
  {
    $this->create_general_stats();
  }

  public function down()
  {
    $this->dbforge->drop_table('general_stats', true);
  }
}
