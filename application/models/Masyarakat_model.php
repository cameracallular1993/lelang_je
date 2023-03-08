<?php
defined('BASEPATH') or exit ('no direct script acces allowed');
class Masyarakat_model extends CI_Model
{
    private $_table = 'masyarakat';

    public function get_all() //Menampilkan list semua data masyarakat
    {
        $query = $this ->db->get_where($this->_table); //data diambil dari table masayarakat
        return $query->result();
    }

    public function get_by_user($email)
    {
        $query = $this->db->get_where($this->_table, array('email' => $email));
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert($this->_table, $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->_table, array('id_masyarakat' => $id));
        return $query->row();
    }
    public function update($data)
    {
        if (!isset($data['id_masyarakat'])) {
            return;
        }
        return $this->db->update($this->_table, $data, ['id_masyarakat' => $data['id_masyarakat']]);
    }
    public function verify($email, $password)
    {
        $this->db->where('email', $email);
        $query = $this->db->get($this->_table);
        $data = $query->row();
        if (!password_verify($password, $data->password)) {
            return FALSE;
        }
        return true;
    }
}