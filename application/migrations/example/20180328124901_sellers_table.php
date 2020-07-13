<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_sellers_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'full_name' => array(
        'type' => 'VARCHAR',
        'constraint' => '140',
      ),
      'birth_date' => array(
        'type' => 'DATE',
      ),
      'password' => array(
        'type' => 'TEXT',
      ),
      'gender' => array(
        'type' => 'VARCHAR',
        'constraint' => '50',
      ),
      'civil_status' => array(
        'type' => 'VARCHAR',
        'constraint' => '140',
      ),
      'home_address' => array(
        'type' => 'TEXT',
      ),
      'office_address' => array(
        'type' => 'TEXT',
      ),
      'mobile_num' => array(
        'type' => 'VARCHAR',
        'constraint' => '140',
      ),
      'office_fax' => array(
        'type' => 'VARCHAR',
        'constraint' => '140',
      ),
      'home_num' => array(
        'type' => 'VARCHAR',
        'constraint' => '140',
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '140',
        'unique' => true
      ),
      # 'Broker' or 'Agent'
      'real_estate_record_type' => array(
        'type' => 'VARCHAR',
        'constraint' => '140',
      ),
      # JSON string
      'real_estate_record_payload' => array(
        'type' => 'VARCHAR',
        'constraint' => '10000',
        'default' => '{}'
        ),
        'forgot_token' => array(
          'type' => 'TEXT',
          'null' => true,
        ),
        'position' => array(
          'type' => 'VARCHAR',
          'constraint' => '140',
          'null' => true
        ),
        'division' => array(
          'type' => 'VARCHAR',
          'constraint' => '140',
          'null' => true
        ),
        'image_url' => array(
          'type' => 'TEXT',
        ),
        'accumulated_points' => array(
          'type' => 'INT',
          'default' => 0,
        ),
        # Pending edits are saved here
        'pending_payload' => array(
          'type' => 'VARCHAR',
          'constraint' => '10000',
          'default' => '[{},{}]'
          ),
          'imported_csv' => array(
            'type' => 'TEXT',
            'null' => true
          ),
        ));

        # Table date defaults
        $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


        if($this->dbforge->create_table('sellers'))
        {
          $table = 'sellers';

          $data = array(
            'full_name' => 'Magen Attraglaitz',
            'birth_date' => '2018-01-01',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'gender' => 'Male',
            'civil_status' => 'Single',
            'home_address' => 'Royal Capital, Luspierheil, Attraglaitz Royal Castle',
            'office_address' => 'Strangaz',
            'division' => 'Some division',
            'position' => 'Some position',
            'mobile_num' => '09451494315',
            'office_fax' => 'Hello',
            'home_num' => '22299222',
            'email' => 'lsalamante@myoptimind.com',
            'real_estate_record_type' => 'Broker',
            'real_estate_record_payload' => '{}',
              'image_url' => 'https://robohash.org/Magen Attraglaitz?set=set4' ,
            );
            $this->db->insert($table, $data);

            $data = array(
              'full_name' => 'Vane',
              'birth_date' => '2018-01-01',
              'password' => password_hash('password', PASSWORD_DEFAULT),
              'gender' => 'Male',
              'civil_status' => 'Single',
              'home_address' => 'Unknown',
              'office_address' => 'Strangaz',
              'division' => 'Some divisionvsa',
              'position' => 'Some positionasd',
              'mobile_num' => '09451494311',
              'office_fax' => 'Hello',
              'home_num' => '22299222',
              'email' => 'est@esty.com',
              'real_estate_record_type' => 'Agent',
              'real_estate_record_payload' => '{}',
                'image_url' => 'https://robohash.org/Vane?set=set4' ,
              );
              $this->db->insert($table, $data);

              $data = array(
                'full_name' => 'Godfrey',
                'birth_date' => '1994-01-01',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'gender' => 'Male',
                'civil_status' => 'Single',
                'home_address' => 'Unknown',
                'office_address' => 'Strangaz',
                'division' => 'S1 division',
                'position' => 'S42 position',
                'mobile_num' => '09451494371',
                'office_fax' => 'Hello',
                'home_num' => '22299222',
                'email' => 'g@strangaz.com',
                'real_estate_record_type' => 'Agent',
                'real_estate_record_payload' => '{}',
                  'image_url' => 'https://robohash.org/Godfrey?set=set4' ,
                );
                $this->db->insert($table, $data);

                $data = array(
                  'full_name' => 'Sin',
                  'birth_date' => '1994-01-01',
                  'password' => password_hash('password', PASSWORD_DEFAULT),
                  'gender' => 'Male',
                  'civil_status' => 'Single',
                  'home_address' => 'Unknown',
                  'office_address' => 'Strangaz',
                  'division' => 'Someaaa division',
                  'position' => 'Someaad position',
                  'mobile_num' => '09451494371',
                  'office_fax' => 'Hello',
                  'home_num' => '22299222',
                  'email' => 's@strangaz.com',
                  'real_estate_record_type' => 'Agent',
                  'real_estate_record_payload' => '{}',
                    'image_url' => 'https://robohash.org/Sin?set=set4' ,
                  );
                  $this->db->insert($table, $data);

                  $data = array(
                    'full_name' => 'Sid Attraglaitz',
                    'birth_date' => '1994-01-01',
                    'password' => password_hash('password', PASSWORD_DEFAULT),
                    'gender' => 'Male',
                    'civil_status' => 'Single',
                    'home_address' => 'Unknown',
                    'office_address' => 'Strangaz',
                    'division' => 'Some11 division',
                    'position' => 'Some11 position',
                    'mobile_num' => '09451494371',
                    'office_fax' => 'Hello',
                    'home_num' => '22299222',
                    'email' => 'sid@strangaz.com',
                    'real_estate_record_type' => 'Agent',
                    'real_estate_record_payload' => '{}',
                      'image_url' => 'https://robohash.org/Sid?set=set4' ,
                    );
                    $this->db->insert($table, $data);

                    $data = array(
                      'full_name' => 'Alec D\'Angelo',
                      'birth_date' => '1994-01-01',
                      'password' => password_hash('password', PASSWORD_DEFAULT),
                      'gender' => 'Male',
                      'civil_status' => 'Single',
                      'home_address' => 'Unknown',
                      'office_address' => 'Strangaz',
                      'division' => 'Som51e division',
                      'position' => 'So125me position',
                      'mobile_num' => '09451494371',
                      'office_fax' => 'Hello',
                      'home_num' => '22299222',
                      'email' => 'alec@strangaz.com',
                      'real_estate_record_type' => 'Agent',
                      'real_estate_record_payload' => '{}',
                        'image_url' => 'https://robohash.org/Alec-d-angelo?set=set4' ,
                      );
                      $this->db->insert($table, $data);

                      $data = array(
                        'full_name' => 'Rigel Attraglaitz',
                        'birth_date' => '1994-01-01',
                        'password' => password_hash('password', PASSWORD_DEFAULT),
                        'gender' => 'Male',
                        'civil_status' => 'Single',
                        'home_address' => 'Unknown',
                        'office_address' => 'Strangaz',
                        'division' => 'Some qwe',
                        'position' => 'Some posiqweqwetion',
                        'mobile_num' => '09451494371',
                        'office_fax' => 'Hello',
                        'home_num' => '22299222',
                        'email' => 'rigel@strangaz.com',
                        'real_estate_record_type' => 'Agent',
                        'real_estate_record_payload' => '{}',
                          'image_url' => 'https://robohash.org/Rigel Attraglaitz?set=set4' ,
                        );
                        $this->db->insert($table, $data);

                        $data = array(
                          'full_name' => 'Book Attraglaitz',
                          'birth_date' => '1994-01-01',
                          'password' => password_hash('password', PASSWORD_DEFAULT),
                          'gender' => 'Male',
                          'civil_status' => 'Single',
                          'home_address' => 'Unknown',
                          'office_address' => 'Strangaz',
                          'division' => '1 qqwe',
                          'position' => '215 25',
                          'mobile_num' => '09451494371',
                          'office_fax' => 'Hello',
                          'home_num' => '22299222',
                          'email' => 'book@strangaz.com',
                          'real_estate_record_type' => 'Agent',
                          'real_estate_record_payload' => '{}',
                            'image_url' => 'https://robohash.org/Book Attraglaitz?set=set4' ,
                          );
                          $this->db->insert($table, $data);

                        }
                      }

                      public function down()
                      {
                        $this->dbforge->drop_table('sellers');
                      }
                    }
