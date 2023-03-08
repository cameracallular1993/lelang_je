<?php
defined('BASEPATH') or exit('no direct script acces allowed');
class Barang_model extends CI_Model
{
    private $_table = 'barang',
            $_view = 'detail_barang';
    public function rules()
    {
        return [
            [
                'field' => 'nama_barang',  //samakan dengan atribute name pada tags input
                'label' => 'nama_barang',  // label yang kan ditampilkan pada pesan error
                'rules' => 'trim|required' //rules validasi
            ],
            [
                'field' => 'deskripsi',
                'label' => 'deskripsi',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'harga_awal',
                'label' => 'harga_awal',
                'rules' => 'trim|required'
            ],
        ];
    }
    public function get_all() //Menampilkan list semua data users
    {
        $query = $this->db->get_where($this->_view); //data diambil dari table users
        return $query->result();
    }
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_barang" => $id));
    }
    
    public function save()
    { {
            $data = array(
                "nama_barang" => $this->input->post('nama_barang'),
                "deskripsi" => $this->input->post('deskripsi'),
                "harga_awal" => $this->input->post('harga_awal'),
            );
            return $this->db->insert($this->_table, $data);
        }
    }
 
    public function insert($barang) //simpan data barang
    {
        $this->db->insert($this->_table, $barang);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function find($id_barang)
	{
		if (!$id_barang) {
			return;
		}

		$query = $this->db->get_where($this->_table, array('id_barang' => $id_barang));
		return $query->row();
	}

    public function update($barang)
	{
		if (!isset($barang['id_barang'])) {
			return;
		}

		return $this->db->update($this->_table, $barang, ['id_barang' => $barang['id_barang']]);
	}
    public function findbarang ($id_barang)
	{
		if (!$id_barang) {
			return;
		}

		$query = $this->db->get_where($this->_table, array('id_barang' => $id_barang));
		return $query->row();
	}
    
	public function getById($id)
    {
		$query = $this->db->get_where($this->_table, array('id_barang' => $id));
        return $query->row();

    }
    

    function getByGambar($id)
    {
        $this->db->select('gambar');
        $this->db->from('gambar');
        $this->db->where('id_gambar',$id);
        $query=$this->db->get();
        return $query;
    }
}
?>