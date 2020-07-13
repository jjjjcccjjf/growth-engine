<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_members_table extends CI_Migration {

  public function create_members()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'fname' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      ),
      'mname' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      ),
      'lname' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      ),
      'birth_date' => array(
        'type' => 'DATE',
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      ),
      'address' => array(
        'type' => 'TEXT',
      ),
      'mobile' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      ),
      'facebook_link' => array(
        'type' => 'TEXT',
      ),
      'twitter_link' => array(
        'type' => 'TEXT',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('members');
  }

  public function up()
  {
    $this->create_members();
  }

  public function down()
  {
    $this->dbforge->drop_table('members', true);
  }
}
