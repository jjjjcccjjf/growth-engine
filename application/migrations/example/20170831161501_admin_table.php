<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_admin_table extends CI_Migration {

  public function create_admin()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'username' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
        'unique' => TRUE,
      ),
      'password' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    if($this->dbforge->create_table('admin'))
    {
      $table = 'admin';

      $data = array(
        'username' => 'admin',
        'password' => password_hash('password', PASSWORD_DEFAULT)
      );
      $this->db->insert($table, $data);
    }
  }

  public function up()
  {
    $this->create_admin();
  }

  public function down()
  {
    $this->dbforge->drop_table('admin', true);
  }
}
