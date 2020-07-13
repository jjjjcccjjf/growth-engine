<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_news_table extends CI_Migration {

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
      'image_url' => array(
        'type' => 'TEXT',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('news'))
    {
      $table = 'news';

      $data = array(
        'title' => 'Veroem ipsum adasdasd',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/naee?set=set4',
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'asgqwtqwg',
        'description' => 'Thahahahah hahaha the quick brown fox jumps over the lazy dog hahahah grumpy wizards make toxic brew for queen and jack',
        'image_url' => 'https://robohash.org/nae1e?set=set4',
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'dvsdeqwfqw',
        'description' => 'Thahaha lazy dog hahahah grumpy wizards make toxic brewasdasdasdasdasdasdqueen and jack',
        'image_url' => 'https://robohash.org/nae1easdasd?set=set4',
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('news');
  }
}
