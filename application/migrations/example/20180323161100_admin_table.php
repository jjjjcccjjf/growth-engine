<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_admin_table extends CI_Migration {

  public function create_admin()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
        'unique' => TRUE,
      ),
      'password' => array(
        'type' => 'TEXT',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    if($this->dbforge->create_table('admin'))
    {
      $table = 'admin';

      $data = array(
        'name' => 'Admin',
        'email' => 'lsalamante@myoptimind.com',
        'password' => password_hash('password', PASSWORD_DEFAULT)
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Magen',
        'email' => 'lorenzosalamante@gmail.com',
        'password' => password_hash('password', PASSWORD_DEFAULT)
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Sin',
        'email' => 'jjjjcccjjf@yahoo.com',
        'password' => password_hash('password', PASSWORD_DEFAULT)
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Godfrey',
        'email' => 'qlvld@gmail.com',
        'password' => password_hash('password', PASSWORD_DEFAULT)
      );

      $this->db->insert($table, $data);
      $data = array(
        'name' => 'Vane',
        'email' => 'lorenzosalamante@yahoo.com',
        'password' => password_hash('password', PASSWORD_DEFAULT)
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Admin',
        'email' => 'smtpniclm@gmail.com',
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
