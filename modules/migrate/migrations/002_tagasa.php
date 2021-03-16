<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tagasa extends CI_Migration
{
	public function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
	}

	public function up()
	{
		$this->dbforge->drop_table('amg_dusun', TRUE);
		// Table structure for table 'amg_dusun'
		$this->dbforge->add_field([
			'id' => [
				'type'          => 'INT',
				'constraint'    => 5,
				'unsigned'      => TRUE,
				'auto_increment' => TRUE
			],
			'nama' => [
				'type'          => 'VARCHAR',
				'constraint'    => 100,
				'null'			=> FALSE
			],
			'create_at' => [
				'type' 			=> 'DATETIME'
			],
			'update_at' => [
				'type' 			=> 'DATETIME',
				'null' 			=> TRUE,
			]
		]);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('amg_dusun');

		$this->dbforge->drop_table('amg_peta', TRUE);
		// Table structure for table 'amg_peta'
		$this->dbforge->add_field([
			'id' => [
				'type'          => 'INT',
				'constraint'    => 8,
				'unsigned'      => TRUE,
				'auto_increment' => TRUE
			],
			'id_dusun' => [
				'type' 			=> 'INT',
				'constraint' 	=> 5
			],
			'rw' => [
				'type' 			=> 'INT',
				'constraint' 	=> 5,
				'null' 			=> TRUE,
			],
			'rt' => [
				'type' 			=> 'INT',
				'constraint' 	=> 5,
				'null' 			=> TRUE,
			],
			'peta_img' => [
				'type'          => 'TEXT',
				'null'			=> FALSE
			],
			'peta_title' => [
				'type' 			=> 'VARCHAR',
				'constraint'    => 100,
				'null' 			=> TRUE,
			],
			'create_at' => [
				'type' 			=> 'DATETIME'
			],
			'update_at' => [
				'type' 			=> 'DATETIME',
				'null' 			=> TRUE,
			]
		]);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('amg_peta');

		$this->dbforge->drop_table('amg_keluarga', TRUE);
		// Table structure for table 'amg_peta'
		$this->dbforge->add_field([
			'id' => [
				'type'          => 'INT',
				'constraint'    => 8,
				'unsigned'      => TRUE,
				'auto_increment' => TRUE
			],
			'id_peta' => [
				'type' 			=> 'INT',
				'constraint' 	=> 5
			],
			'no_kk' => [
				'type' 			=> 'INT',
				'constraint' 	=> 5,
				'null' 			=> TRUE,
			],
			'no_rumah' => [
				'type' 			=> 'INT',
				'constraint' 	=> 5,
				'null' 			=> TRUE,
			],
			'nama_kk' => [
				'type'          => 'VARCHAR',
				'constraint'    => 100,
				'null'			=> FALSE
			],
			'create_at' => [
				'type' 			=> 'DATETIME'
			],
			'update_at' => [
				'type' 			=> 'DATETIME',
				'null' 			=> TRUE,
			]
		]);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('amg_keluarga');
	}

	public function down()
	{
		$this->dbforge->drop_table('amg_dusun', TRUE);
		$this->dbforge->drop_table('amg_peta', TRUE);
		$this->dbforge->drop_table('amg_keluarga', TRUE);
	}
}
