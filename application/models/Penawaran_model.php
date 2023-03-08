<?php
defined('BASEPATH') or exit ('no direct script acces allowed');
class Penawaran_model extends CI_Model
{
    private $_table = 'penawaran',
            $_view = 'detail_penawaran',
            $_viewMax = 'get_max_penawaran';

    public function get_all() //Menampilkan list semua data users
    {
        $query = $this ->db->get_where($this->_view); //data diambil dari table users
        return $query->result();
    }
    public function get_by_penawar($id_masyarakat)
    {
        $this->db->order_by('tgl_penawaran', 'desc');
        $query = $this->db->get_where($this->_view, array('id_masyarakat' => $id_masyarakat));
        return $query->result();
    }
    public function get_tawar_lelang($id_lelang)
    {
        $this->db->order_by('harga_penawaran', 'desc');
        $query = $this->db->get_where($this->_view, array('id_lelang' => $id_lelang));
        return $query->result();
    }
    public function get_by_id($id_penawaran)
    {
        $query = $this->db->get_where($this->_view, array('id_penawaran' => $id_penawaran));
        return $query;
    }
    public function delete($id)
    {
        if (!$id) {
            return;
        }
        return $this->db->delete($this->_table, ['id_penawaran' => $id]);
    }
    public function insert($data)
    {
        $this->db->insert($this->_table, $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function get_by_lelang($id_lelang)
    {
        $query = $this->db->get_where($this->_viewMax, array('id_lelang' => $id_lelang));
        $this->db->limit(1);
        return $query;
    }
}