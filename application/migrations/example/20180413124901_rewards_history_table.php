<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rewards_history_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'seller_id' => array(
        'type' => 'INT',
      ),
      'reward_id' => array(
        'type' => 'INT',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('rewards_history'))
    {
      $table = 'rewards_history';

      $data = array(
        'seller_id' => 1,
        'reward_id' => 1,
      );
      $this->db->insert($table, $data);

      $data = array(
        'seller_id' => 1,
        'reward_id' => 1,
      );
      $this->db->insert($table, $data);

      $data = array(
        'seller_id' => 2,
        'reward_id' => 1,
      );
      $this->db->insert($table, $data);

      $data = array(
        'seller_id' => 1,
        'reward_id' => 2,
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('rewards_history');
  }
}
