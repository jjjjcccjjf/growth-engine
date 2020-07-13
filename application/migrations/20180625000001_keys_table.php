<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_keys_table extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'user_id' => array(
        'type' => 'INT',
        'null' => false
      ),
      'key' => array(
        'type' => 'VARCHAR',
        'constraint' => '40',
        'null' => false
      ),
      'level' => array(
        'type' => 'INT',
        'constraint' => '2',
        'null' => false
      ),
      'ignore_limits' => array(
        'type' => 'TINYINT',
        'constraint' => '1',
        'default' => 0,
        'null' => false
      ),
      'is_private_key' => array(
        'type' => 'TINYINT',
        'constraint' => '1',
        'default' => 0,
        'null' => false
      ),
      'ip_addresses' => array(
        'type' => 'TEXT',
        'constraint' => '2',
        'default' => null
      ),
      'date_created' => array(
        'type' => 'INT',
        'null' => false
      ),
    ));
    $this->dbforge->create_table('keys');
  }

  public function down()
  {
    $this->dbforge->drop_table('keys', true);
  }
}
