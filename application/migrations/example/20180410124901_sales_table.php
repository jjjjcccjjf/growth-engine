<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_sales_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'project_name' => array(
        'type' => 'TEXT',
      ),
      # fk
      'seller_id' => array(
        'type' => 'INT',
      ),
      'sales_amount' => array(
        'type' => 'DOUBLE',
        'constraint' => '20,2',
      ),
      'date' => array(
        'type' => 'DATE',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('sales'))
    {
      $table = 'sales';

      $this->db->insert_batch($table, [
        array(
          'project_name' => 'Test project 1',
          'date' => '2018-04-13',
          'seller_id' => 1,
          'sales_amount' => 9000000,
        ),
        array(
          'project_name' => 'Test project 2',
          'date' => '2018-04-13',
          'seller_id' => 1,
          'sales_amount' => 8800000,
        ),
        array(
          'project_name' => 'Test project 3',
          'date' => '2018-04-13',
          'seller_id' => 1,
          'sales_amount' => 2200000,
        )
      ]
    );

      $this->db->insert_batch($table, [
        array(
          'project_name' => 'Test project 1',
          'date' => '2018-04-13',
          'seller_id' => 2,
          'sales_amount' => 3612000,
        ),
        array(
          'project_name' => 'Test project 2',
          'date' => '2018-04-13',
          'seller_id' => 2,
          'sales_amount' => 7820000,
        ),
        array(
          'project_name' => 'Test project 3',
          'date' => '2018-04-13',
          'seller_id' => 2,
          'sales_amount' => 78112.90,
        )
      ]
    );

      $this->db->insert_batch($table, [
        array(
          'project_name' => 'Test project 1',
          'date' => '2018-04-13',
          'seller_id' => 3,
          'sales_amount' => 3821200,
        ),
        array(
          'project_name' => 'Test project 2',
          'date' => '2018-04-13',
          'seller_id' => 3,
          'sales_amount' => 1182000,
        ),
        array(
          'project_name' => 'Test project 3',
          'date' => '2018-04-13',
          'seller_id' => 3,
          'sales_amount' => 2424111,
        )
      ]
    );

      $this->db->insert_batch($table, [
        array(
          'project_name' => 'Test project 1',
          'date' => '2018-04-13',
          'seller_id' => 4,
          'sales_amount' => 722726,
        ),
        array(
          'project_name' => 'Test project 2',
          'date' => '2018-04-13',
          'seller_id' => 4,
          'sales_amount' => 212329,
        ),
        array(
          'project_name' => 'Test project 3',
          'date' => '2018-04-13',
          'seller_id' => 4,
          'sales_amount' => 824900,
        )
      ]
    );

      $this->db->insert_batch($table, [
        array(
          'project_name' => 'Test project 1',
          'date' => '2018-04-13',
          'seller_id' => 5,
          'sales_amount' => 7249333,
        ),
        array(
          'project_name' => 'Test project 2',
          'date' => '2018-04-13',
          'seller_id' => 5,
          'sales_amount' => 1525126,
        ),
        array(
          'project_name' => 'Test project 3',
          'date' => '2018-04-13',
          'seller_id' => 5,
          'sales_amount' => 1262238,
        )
      ]
    );

      $this->db->insert_batch($table, [
        array(
          'project_name' => 'Test project 1',
          'date' => '2018-04-13',
          'seller_id' => 6,
          'sales_amount' => 811927,
        ),
        array(
          'project_name' => 'Test project 2',
          'date' => '2018-04-13',
          'seller_id' => 6,
          'sales_amount' => 2109280,
        ),
        array(
          'project_name' => 'Test project 3',
          'date' => '2018-04-13',
          'seller_id' => 6,
          'sales_amount' => 9010828,
        )
      ]
    );

      $this->db->insert_batch($table, [
        array(
          'project_name' => 'Test project 1',
          'date' => '2018-04-13',
          'seller_id' => 7,
          'sales_amount' => 1521778,
        ),
        array(
          'project_name' => 'Test project 2',
          'date' => '2018-04-13',
          'seller_id' => 7,
          'sales_amount' => 9503456,
        ),
        array(
          'project_name' => 'Test project 3',
          'date' => '2018-04-13',
          'seller_id' => 7,
          'sales_amount' => 4733930,
        )
      ]
    );

      $this->db->insert_batch($table, [
        array(
          'project_name' => 'Test project 1',
          'date' => '2018-04-13',
          'seller_id' => 8,
          'sales_amount' => 1631627,
        ),
        array(
          'project_name' => 'Test project 2',
          'date' => '2018-04-13',
          'seller_id' => 8,
          'sales_amount' => 4680000,
        ),
        array(
          'project_name' => 'Test project 3',
          'date' => '2018-04-13',
          'seller_id' => 8,
          'sales_amount' => 56686900,
        )
      ]
    );

  }
}

public function down()
{
  $this->dbforge->drop_table('sales');
}
}
