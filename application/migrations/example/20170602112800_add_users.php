<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      ),
      'password' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    if($this->dbforge->create_table('users'))
    {
      $table = 'users';

      $data = array(
        'email' => 'billllu',
        'password' => 'Neega'
      );
      $this->db->insert($table, $data);

      $data = array(
        'email' => 'asdasdasdasd',
        'password' => 'qwerryy'
      );
      $this->db->insert($table, $data);
    }
  }

  public function down()
  {
    $this->dbforge->drop_table('users');
  }
}
