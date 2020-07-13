<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_about_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'title' => array(
        'type' => 'TEXT',
      ),
      'description' => array(
        'type' => 'TEXT',
      ),
      'iframe_code' => array(
        'type' => 'TEXT',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('about'))
    {
      $table = 'about';

      $data = array(
        'title' => 'About Us',
        'description' => 'We started in Cebu with a vision to provide better homes for the average Filipino worker. Today, with 46 developments from Visayas to Mindanao, our real estate experience will be spent on continuously being masters of one thing - and that is to serve you.',
        'iframe_code' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/xQdlO2evZFg" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>',
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('about');
  }
}
