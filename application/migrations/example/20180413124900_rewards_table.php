<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rewards_table extends CI_Migration {

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
      'cost' => array(
        'type' => 'INT',
      ),
      # 0 - classic, 1 - gold, 2 - platinum
      'class_available' => array(
        'type' => 'INT'
      ),
      'total_winners_allowed' => array(
        'type' => 'INT',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('rewards'))
    {
      $table = 'rewards';

      $data = array(
        'title' => 'Lemonade',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/gasg?set=set3',
        'cost' => 5,
        'class_available' => 0,
        'total_winners_allowed' => 10,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Some really nice cake',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/nae22e?set=set3',
        'cost' => 3,
        'class_available' => 0,
        'total_winners_allowed' => 10,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Butter',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/na41ee?set=set3',
        'cost' => 4,
        'class_available' => 0,
        'total_winners_allowed' => 10,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Cheese',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/na11ee?set=set3',
        'cost' => 1,
        'class_available' => 0,
        'total_winners_allowed' => 11,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Silver cheese',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/na1xxx1ee?set=set3',
        'cost' => 1,
        'class_available' => 1,
        'total_winners_allowed' => 10,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Golden cheese',
        'description' => 'qwiehoqweh',
        'image_url' => 'https://robohash.org/na11e111e?set=set3',
        'cost' => 1,
        'class_available' => 1,
        'total_winners_allowed' => 10,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'All cheese',
        'description' => 'hhihuhuahsud',
        'image_url' => 'https://robohash.org/hello111?set=set3',
        'cost' => 1,
        'class_available' => 2,
        'total_winners_allowed' => 10,
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('rewards');
  }
}
