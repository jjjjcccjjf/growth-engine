<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_crud_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'some_varchar_field' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'some_text_field' => array(
        'type' => 'TEXT',
      ),
      'image_url' => array(
        'type' => 'TEXT',
      ),
      'some_int_field' => array(
        'type' => 'INT',
      ),
      'some_datetime_field' => array(
        'type' => 'DATETIME',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('crud'))
    {
      $table = 'crud';

      $data = array(
        'some_varchar_field' => 'Veroem ipsum adasdasd',
        'some_text_field' => 'Hooooh',
        'some_int_field' => '123',
        'some_datetime_field' => ''
      );
      $this->db->insert($table, $data);


      $data = array(
        'some_varchar_field' => 'Ahahahah ipsum adasdasd',
        'some_text_field' => 'Hohhhhheeeeoh',
        'some_int_field' => '131323',
        'some_datetime_field' => '2017-06-04'
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('crud');
  }
}
