<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_non_related_tables extends CI_Migration {

  public function create_news()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'title' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'image_url' => array(
        'type' => 'TEXT',
      ),
      'body' => array(
        'type' => 'TEXT',
      ),
      'button_label' => array(
        'type' => 'TEXT',
      ),
    ));
    $this->dbforge->add_field("`is_featured` BOOLEAN NOT NULL");
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('news');
  }

  public function create_videos()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'title' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'duration' => array(
        'type' => 'VARCHAR',
        'constraint' => '80',
      ),
      'url' => array(
        'type' => 'TEXT',
      ),
      'image_url' => array(
        'type' => 'TEXT',
      ),
      'type' => array(
        'type' => 'VARCHAR',
        'constraint' => '150',
      ),
    ));
    $this->dbforge->add_field("`is_featured` BOOLEAN NOT NULL");
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('videos');
  }

  public function create_partners()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'title' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'site_url' => array(
        'type' => 'TEXT',
      ),
      'image_url' => array(
        'type' => 'TEXT',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('partners');
  }
  public function up()
  {
    $this->create_news();
    $this->create_videos();
    $this->create_partners();
  }

  public function down()
  {
    $this->dbforge->drop_table('news', true);
    $this->dbforge->drop_table('videos', true);
    $this->dbforge->drop_table('partners', true);
  }
}
