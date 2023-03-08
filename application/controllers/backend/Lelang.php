<?php

class Lelang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('lelang_model');
		$this->load->model('auth_model');
		$this->load->model('barang_model');
		$this->load->model('penawaran_model');
		if(!$this->auth_model->current_user()){
			redirect('backend/auth/login');
		}
	}

	public function index()
	{
		$data['title'] = 'List Data Lelang';
        $data['activeUser'] = $this->auth_model->current_user();
        $data['lelang'] = $this->lelang_model->get_all();
		$this->load->view('backend/list_lelang', $data);

	}

	public function delete($id = null)
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $this->lelang_model->delete($id);
		$this->session->set_flashdata('message','Data berhasil dihapus');
		redirect("backend/Lelang");
	}

	public function edit($id = null)
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
		$data['lelang'] = $this->lelang_model->find($id);

		if (!$data['lelang'] || !$id) {
			show_404();
		}

		if ($this->input->method() === 'post') {
			// TODO: lakukan validasi data seblum simpan ke model
			$lelang = [
				'id_lelang' => $id,
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
			];
			$updated = $this->lelang_model->update($lelang);
			if ($updated) {
				$this->session->set_flashdata('message', 'Article was updated');
				redirect('backend/lelang');
			}
		}

		$this->load->view('backend/edit_lelang', $data);
	} 

	public function add()
	{

		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
		$data['lelang'] = $this->barang_model->get_all();
		$lelang = $this->lelang_model;
		$validation = $this->form_validation;
		$validation->set_rules($lelang->rules());
		if ($validation->run()) {
			$lelang->save();
			redirect("backend/Lelang");
		}
		$this->load->view('backend/add_lelang', $data);
	}
	public function new()
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan data dari user login
		$data['lelang'] = $this->barang_model->get_all();
		if ($this->input->method() === 'post') {
				$lelang = [
					'id_barang' => $this->input->post('id_barang'),
					'tgl_mulai' => $this->input->post('tgl_mulai'),
					'tgl_akhir' => $this->input->post('tgl_akhir'),
					'status' => 'open',
					'created_by' => $data['activeUser']->id_user
				];
				$saved = $this->lelang_model->save($lelang);
 
				if ($saved) {
					$this->session->set_flashdata('message', 'Data berhasil disimpan!');
					return redirect('backend/lelang');
				}
		}
		$this->load->view('backend/add_lelang', $data);
	}
	public function cancel($id_lelang = null)
    {
        $data['activeUser'] = $this->auth_model->current_user();
        if ($data['activeUser']->level <> 'Petugas') {
            show_404();
        }
        $data['lelang'] = $this->lelang_model->get_by_id($id_lelang)->row();
        if (!$data['lelang'] || !$id_lelang) {
            show_404();
        }
        $lelang = [
            'id_lelang' => $id_lelang,
           
            'status' => 'Cancel'
        ];
        $update = $this->lelang_model->update($lelang);
        if ($update) {
            $barang = [
                'id_barang' => $data['lelang']->id_barang,
                'status' => 'New'
            ];
            $updt = $this->barang_model->update($barang);
            if ($updt) {
                $this->session->set_flashdata('message', 'Data berhasil dicancel!');
            }
        } else {
            $this->session->set_flashdata('message', 'Data gagal dicancel!');
        }
        redirect('backend/lelang');
    }

    public function close($id_lelang = null)
    {
        $data['activeUser'] = $this->auth_model->current_user();
        if ($data['activeUser']->level <> 'Petugas') {
            show_404();
        }
        $data['lelang'] = $this->lelang_model->get_by_id($id_lelang)->row();
        if (!$data['lelang'] || !$id_lelang) {
            show_404();
        }
        $data['penawaran'] = $this->penawaran_model->get_by_lelang($id_lelang)->row();
        $lelang = [
            'id_lelang' => $id_lelang,
            'id_masyarakat' => $data['penawaran']->id_masyarakat,
            'harga_akhir' => $data['penawaran']->harga_penawaran,
            'status' => 'closed'
        ];
        $update = $this->lelang_model->update($lelang);
        if ($update) {
            $barang = [
                'id_barang' => $data['lelang']->id_barang,
                'status' => 'Sold'
            ];
            $updt = $this->barang_model->update($barang);
            if ($updt) {
                $this->session->set_flashdata('message', 'Data berhasil diclosed!');
            }
        } else {
            $this->session->set_flashdata('message', 'Data gagal diclosed!');
        }
        redirect('backend/lelang');
    }
	public function confirm($id_lelang = null)
    {
        $data['activeUser'] = $this->auth_model->current_user();
        if ($data['activeUser']->level <> 'Petugas') {
            show_404();
        }
        $data['lelang'] = $this->lelang_model->get_by_id($id_lelang)->row();
        if (!$data['lelang'] || !$id_lelang) {
            show_404();
        }
        $lelang = [
            'id_lelang' => $id_lelang,
           
            'status' => 'Confirmed'
        ];
        $update = $this->lelang_model->update($lelang);
        if ($update) {
            $this->session->set_flashdata('message', 'Data berhasil diconfirm!');
        } else {
            $this->session->set_flashdata('message', 'Data gagal diconfirm!');
        }
        redirect('backend/dashboard');
    }
}