<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_core_tables extends CI_Migration {

  public function create_team_stats()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'team_id' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'stat_key' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'stat_value' => array(
        'type' => 'VARCHAR',
        'constraint' => '15',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('team_stats');
  }
  public function create_player_stats()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'player_id' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'stat_key' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'stat_value' => array(
        'type' => 'VARCHAR',
        'constraint' => '15',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('player_stats');
  }

  public function create_teams()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'image_url' => array(
        'type' => 'TEXT',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('teams');
  }

  public function create_leagues()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('leagues');
  }

  public function create_ladders()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'league_id' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'team_id' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      /**
      * Possible values    away, home
      */
      'court_type' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'matches_played' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'wins' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'draws' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'losses' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'goal_difference' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'points' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),

    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('ladders');
  }

  public function create_players()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'fname' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'lname' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'team_id' => array(
        'type' => 'INTEGER',
        'constraint' => '9',
      ),
      'image_url' => array(
        'type' => 'TEXT',
      ),
      'image_url' => array(
        'type' => 'TEXT',
      ),
      'full_body_image_url' => array(
        'type' => 'TEXT',
      ),
      'position' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'jersey_num' => array(
        'type' => 'VARCHAR',
        'constraint' => '10',
      ),
      'birth_date' => array(
        'type' => 'DATETIME',
      ),
      'birth_place' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'nationality' => array(
        'type' => 'VARCHAR',
        'constraint' => '250',
      ),
      'height' => array(
        'type' => 'VARCHAR',
        'constraint' => '50',
      ),
      'weight' => array(
        'type' => 'VARCHAR',
        'constraint' => '50',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->create_table('players');
  }
  public function up()
  {
    $this->create_teams();
    $this->create_players();
    $this->create_leagues();
    $this->create_ladders();
    $this->create_team_stats();
    $this->create_player_stats();
  }

  public function down()
  {
    $this->dbforge->drop_table('teams', true);
    $this->dbforge->drop_table('players', true);
    $this->dbforge->drop_table('leagues', true);
    $this->dbforge->drop_table('ladders', true);
    $this->dbforge->drop_table('team_stats', true);
    $this->dbforge->drop_table('player_stats', true);
  }
}
