<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gambar_model extends CI_Model
{
	private $_table = 'gambar';

	public function insert($gambar) //simpan data gambar
	{
		$this->db->insert($this->_table, $gambar);
		$insert_id = $this->db->insert_id();

		return  $insert_id;
	}
    public function delete($id_barang)
    {
        return $this->db->delete($this->_table, array("id_barang" => $id_barang));
    }
	public function getAll()
    {
        $this->db->from($this->_table);
        $this->db->order_by("urutan", "asc");
        $query = $this->db->get();
        return $query->result();
        //fungsi diatas seperti halnya query 
        //select * from tb_barang order by id_barang desc
    }
	function add_gambar($data)
    {
        $this->db->insert('gambar',$data);
        return $this->db->insert_id();
    }
	public function update($gambar)
	{
		if (!isset($gambar['id_gambar'])) {
			return;
		}

		return $this->db->update($this->_table, $gambar, ['id_gambar' => $gambar['id_gambar']]);
	}
	public function get_by_id($id_gambar)
	{
		$query = $this->db->get_where($this->_table, array('id_gambar' => $id_gambar));
		return $query;
	}
	public function find($id_barang)
	{
		$query = $this->db->get_where($this->_table, array('id_barang' => $id_barang, 'utama'=> 1));
		return $query->row();
	}
    public function get_by_idBarang($id_barang)
	{
		$query = $this->db->get_where($this->_table, array('id_barang' => $id_barang));
		return $query->result();
	}
	function hapus_gambar($id)
    {
        $this->db->where('id_gambar', $id);
        $this->db->delete('gambar');
    }
	public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_gambar" => $id])->row();
        //query diatas seperti halnya query pada mysql 
        //select * from tb_barang where id_barang='$id'
    }
}