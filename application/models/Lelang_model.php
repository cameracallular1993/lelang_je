<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
class Lelang_model extends CI_Model
{
    private $_table = 'lelang',
            $_vDetailLelang = 'detail_lelang',
            $_vLelangBerlangsung = 'lelang_berlangsung',
            $_vPemenangLelang = 'pemenang_lelang',
            $_maxPenawaran = 'get_max_penawaran';

    public function rules()
    {
        return [
            [
                'field' => 'tgl_mulai',  //samakan dengan atribute name pada tags input
                'label' => 'tgl_muali',  // label yang kan ditampilkan pada pesan error
                'rules' => 'trim|required' //rules validasi
            ],
            [
                'field' => 'tgl_akhir',
                'label' => 'tgl_akhir',
                'rules' => 'trim|required'
            ],
        ];
    }
    
    public function get_all() //menampilkan list all data lelang
            
    {
        $query = $this->db->get_where($this->_vDetailLelang);
        return $query->result();
    }

    public function get_LelangBerlangsung() //menampilkan list data lelang berlangsung
    {
        $query = $this->db->get_where($this->_vLelangBerlangsung);
        return $query->result();
    }
    public function get_pemenangLelangdash() //menampilkan list pemenang lelang
    {
        $query = $this->db->get_where($this->_vPemenangLelang, array('status' => 'Unconfirmed'));
        return $query->result();
    }
    public function get_pemenangLelang() //menampilkan list pemenang lelang
    {
        $query = $this->db->get_where($this->_vPemenangLelang, array('status' => 'Confirmed'));
        return $query->result();
    }
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_lelang" => $id));
    }

    public function save($data){//menyimpan data user
        {
            return $this->db->insert($this->_table, $data);
        } 

    }

    public function find($id_lelang)
	{
		if (!$id_lelang) {
			return;
		}

		$query = $this->db->get_where($this->_vDetailLelang, array('id_lelang' => $id_lelang));
		return $query->row();
	}
    public function get_pemenang($id_masyarakat)
    {
        $this->db->order_by('tgl_akhir', 'desc');
        $query = $this->db->get_where($this->_vPemenangLelang, array('id_masyarakat' => $id_masyarakat));
        return $query->result();
    }
    public function update($lelang)
	{
		if (!isset($lelang['id_lelang'])) {
			return;
		}

		return $this->db->update($this->_table, $lelang, ['id_lelang' => $lelang['id_lelang']]);
	}
    public function get_pepet()
    {
        $query = $this->db->get_where($this->_vDetailLelang, array('status' =>'open'));
        return $query->result();
    }
    function update_lelang($where, $data)
    {
        $this->db->update('lelang', $data, $where);
        return $this->db->affected_rows();
    }
    public function berlangsung_by_id($id_lelang)
    {
        $query = $this->db->get_where($this->_vLelangBerlangsung, array('id_lelang' => $id_lelang));
        return $query;
    }
    public function get_lelangLangsung()
    {
        $query = $this->db->get_where($this->_vLelangBerlangsung);
        return $query->result();
    }
    public function search($keyword)
    {
        if (!$keyword) {
            return null;
        }
        $this->db->like('nama_barang', $keyword);
        $query = $this->db->get($this->_vLelangBerlangsung);
        return $query->result();
    }
    public function get_by_id($id_lelang)
    {
        $query = $this->db->get_where($this->_table, array('id_lelang' => $id_lelang));
        return $query;
    }

    
}
