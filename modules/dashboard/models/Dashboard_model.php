<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    var $table = 'amg_peta';
    var $tkel = 'amg_keluarga';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }

    // Peta
    public function get_all()
    {
        $this->db->select('amg_peta.*, amg_dusun.nama as dusun');
        $this->db->from($this->table);
        $this->db->join('amg_dusun', 'amg_peta.id_dusun = amg_dusun.id');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('amg_peta.*, amg_dusun.nama as dusun');
        $this->db->from($this->table);
        $this->db->join('amg_dusun', 'amg_peta.id_dusun = amg_dusun.id');
        $this->db->where('amg_peta.id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    // Dusun
    public function dusun()
    {
        $this->db->select(['id', 'nama']);
        $query = $this->db->get('amg_dusun');
        $result = $query->result_array();

        return $result;
    }

    public function saveDusun($dusun)
    {
        $this->db->where('nama', $dusun);

        $query = $this->db->get('amg_dusun');

        $count_row = $query->num_rows();

        if ($count_row > 0) {
            return FALSE;
        } else {
            $data = array(
                'nama' => $dusun,
                'create_at' => mdate("%Y-%m-%d %H:%i:%s"),
            );
            $this->db->insert('amg_dusun', $data);
            return $this->db->insert_id();
        }
    }

    // Keluarga
    public function get_all_kel($id)
    {
        $this->db->from($this->tkel);
        $this->db->where('id_peta', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_by_id_kel($id)
    {
        $this->db->from($this->tkel);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save_kel($data)
    {
        $this->db->insert($this->tkel, $data);
        return $this->db->insert_id();
    }

    public function update_kel($where, $data)
    {
        $this->db->update($this->tkel, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id_kel($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->tkel);
    }
}
