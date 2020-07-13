<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_events_table extends CI_Migration {

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
      'read_more_url' => array(
        'type' => 'TEXT',
        'null' => true,
      ),
      'read_more_label' => array(
        'type' => 'TEXT',
        'null' => true,
      ),
      'date' => array(
        'type' => 'DATE',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('events'))
    {
      $table = 'events';

      $data = array(
        'title' => 'Some event',
        'description' => 'Grumpy wizards make toxic brew for evil queen and jack, Grumpy wizards make toxic brew for evil queen and jack ,Grumpy wizards make toxic brew for evil queen and jack ',
        'image_url' => 'https://robohash.org/bruh?set=set4',
        'read_more_url' => 'http://english.stackexchange.com',
        'read_more_label' => 'Read more...',
        'date' => '2018-04-28',
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Some event2',
        'description' => 'Hey there delilah the quick brown fox jumps over the lazy dogg there delilah the quick brown fox jumps over the lazy dogg there delilah the quick brown fox jumps over the lazy dogg',
        'read_more_url' => 'http://english.stackexchange.com',
        'read_more_label' => 'Read more...',
        'image_url' => 'https://robohash.org/nee?set=set4',
        'date' => '2018-04-28',
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Birthday of Obama',
        'description' => 'Toxic brew for evil queen and jack the quick brown fox jumps over hte lay dog ',
        'read_more_url' => 'http://english.stackexchange.com',
        'read_more_label' => 'Read more here?...',
        'image_url' => 'https://robohash.org/newe?set=set4',
        'date' => '2018-04-25',
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Hello of world',
        'description' => 'Toxic brew for evil queen and jack the quick brown fox jumps over hte lay dog ',
        'read_more_url' => 'http://english.stackexchange.com',
        'read_more_label' => 'Read more here?...',
        'image_url' => 'https://robohash.org/afqgh?set=set4',
        'date' => '2018-06-25',
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Extinction of dinosaurs',
        'description' => 'Toxic brew for evil queen and jack the quick brown fox jumps over hte lay dog ',
        'read_more_url' => 'http://english.stackexchange.com',
        'read_more_label' => 'Read more here?...',
        'image_url' => 'https://robohash.org/asdaq?set=set4',
        'date' => '2018-05-25',
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('events');
  }
}
