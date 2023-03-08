<?php
 
class Barang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('barang_model');
		$this->load->model('gambar_model');
		$this->load->model('auth_model');
		if (!$this->auth_model->current_user()) {
			redirect('backend/auth/login');
		}
	}
 
	public function index()
	{
		$data['title'] = 'List Data Barang';
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
		$data['barang'] = $this->barang_model->get_all(); //menampilkan data
 
		$this->load->view('backend/list_barang', $data);
	}
	public function hapus_gambar($id_gambar = null)
    {
        $data['gambar'] = $this->modelkenapa->get_by_id($id_gambar)->row();
        $id_barang = $data['gambar']->id_barang;
        $oriImg = $data['gambar']->gambar;
        $ori_file_name      = substr($oriImg, 0, strpos($oriImg, ".")); 
        array_map('unlink', glob(FCPATH . "./assets/img/barang/$ori_file_name.*"));
        $id = $this->uri->segment(4);
        $hapus = $this->modelkenapa->hapus_gambar($id);
        $this->session->set_flashdata('gagal', '<div class="alert alert-success" role="alert">
            Gambar Telah Dihapus!
          </div>');
        redirect('backend/user/gambar/'. $id_barang);
    }
	public function delete($id = null)
	{
		$data['title'] = 'List Data Barang';
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
		$this->gambar_model->delete($id);
		$this->barang_model->delete($id);
		$this->session->set_flashdata('message', 'Data berhasil dihapus');
		redirect("backend/Barang");
	}
 
	public function add()
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
		$barang = $this->barang_model;
		$validation = $this->form_validation;
		$validation->set_rules($barang->rules());
		if ($validation->run()) {
			$barang->save();
			redirect("backend/Barang");
		}
		$this->load->view('backend/componens/add_barang', $data);
	}
	public function new()
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan data dari user login
		if ($this->input->method() === 'post') {
			$ori_name						= $_FILES["gambar"]["name"];
			$file_name						= uniqid('', true);
			$config['upload_path']			= FCPATH . '/upload/barang/';
			$config['allowed_types']		= 'gif|jpg|png|jpeg';
			$config['file_name']			= str_replace('.', '', $file_name);
			$config['overwrite']			= true;
			$config['max_size']				= 1024; //1mb
			$config['max_width']			= 1080;
			$config['max_height']			= 1080;
			$this->load->library('upload', $config);
 
 
			if (!$this->upload->do_upload('gambar')) {
				$data['error'] = $this->upload->display_errors();
				$this->session->set_flashdata('message', $data['error']);
			} else {
				$barang = [
					'nama_barang' => $this->input->post('nama_barang'),
					'deskripsi' => $this->input->post('deskripsi'),
					'harga_awal' => $this->input->post('harga_awal')
				];
				$saved = $this->barang_model->insert($barang);
 
				if ($saved) {
					$uploaded_data = $this->upload->data();
					$gambar = [
						'id_barang' => $saved,
						'gambar' => $uploaded_data['file_name'],
						'nama_gambar' => $ori_name,
						'utama' => 1,
						'urutan' => 0
					];
					$savedGambar = $this->gambar_model->insert($gambar);
 
					if ($savedGambar) {
						$this->session->set_flashdata('message', 'Data berhasil disimpan!');
						return redirect('backend/barang');
					} else {
						$this->session->set_flashdata('message', 'Data gagal disimpan!');
					}
				}
			}
		}
		$this->load->view('backend/componens/add_barang', $data);
	}
	public function edit($id_barang = null)
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
		if ($data['activeUser']->level <> 'Petugas') {
            show_404();
        } 
		$data['barang'] = $this->barang_model->findBarang($id_barang);
		$data['gambar'] = $this->gambar_model->find($id_barang);
		if (!$data['barang'] || !$id_barang) {
			show_404();
		}

		if ($this->input->method() === 'post') {
			$oriImg = $data['barang']->gambar;
            $newImg = $_FILES['gambar']['name'];

            if (!empty($newImg)) {
                // $file_name                   = substr($oriImg, 0, strpos($oriImg, "."));
                $file_name                   = uniqid('', true);
                $config['upload_path']       = FCPATH . '/upload/barang/';
                $config['allowed_types']     = 'jpg|png|jpeg';
                $config['file_name']         = str_replace('.', '', $file_name);
                $config['overwrite']         = true;
                $config['max_size']          = 1024; // 1MB
                $config['max_width']         = 1200;
                $config['max_height']        = 1200;

                $this->load->library('upload', $config);

                $uploaded = $this->upload->do_upload('gambar');

				if (!$uploaded) {
                    $data['error'] = $this->upload->display_errors();
                    $error = preg_replace('/[^a-zA-Z0-9-_\.]/', ' ', strip_tags($data['error']));
                    $this->session->set_flashdata('message', $error);
                } else {
                    $ori_file_name      = substr($oriImg, 0, strpos($oriImg, "."));
                    //hapus data gambar yang ada di folder /upload/barang/
                    
					
					array_map('unlink', glob(FCPATH . "/upload/barang/$ori_file_name.*"));
                }
			}
			// TODO: lakukan validasi data seblum simpan ke model
			$barang = [
				'id_barang' => $id_barang,
				'nama_barang' => $this->input->post('nama_barang'),
                'deskripsi' => $this->input->post('deskripsi'),
				'status' => $this->input->post('status'),
                'harga_awal' => $this->input->post('harga_awal')
			];

			$updated = $this->barang_model->update($barang);

			if ($updated && !empty($newImg)) {
                $uploaded_data = $this->upload->data();

                $gambar = [
                    'id_gambar' => $data['gambar']->id_gambar,
                    'id_barang' => $id_barang,
                    'gambar' => $uploaded_data['file_name'],
                    'nama_gambar' => $newImg,
                    'utama' => 1
                ];
                $updateGambar = $this->gambar_model->update($gambar);

                if (!$updateGambar) {
                    $this->session->set_flashdata('message', 'Gambar gagal diubah!');
                }
            }

			if ($updated) {
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				redirect('backend/barang');
			}else {
                $this->session->set_flashdata('message', 'Data gagal diubah!');
            }
		}

		$this->load->view('backend/edit_barang', $data);
	}
	public function addImage($id_barang = null)
    {
        $data['activeUser'] = $this->auth_model->current_user();
        if ($data['activeUser']->level <> 'Petugas') {
            show_404();
        }
        $data['barang'] = $this->barang_model->get_by_id($id_barang)->row();
        $data['gambar'] = $this->gambar_model->get_by_barang($id_barang);
        if ($this->input->method() === 'post') {
            $ori_name                       = $_FILES["gambar"]["name"];
            $file_name                      = uniqid('', true);
            $config['upload_path']          = FCPATH . '/upload/barang/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['file_name']            = str_replace('.', '', $file_name);
            $config['overwrite']            = true;
            $config['max_size']             = 1024;
            $config['max_width']            = 1300;
            $config['max_height']           = 1300;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                $data['error'] = $this->upload->display_errors();
                $error = preg_replace('/[^a-zA-Z0-9-_\.]/', ' ', strip_tags($data['error']));
                $this->session->set_flashdata('message', $error);
            } else {
                $uploaded_data = $this->upload->data();
                $gambar = [
                    'id_barang' => $id_barang,
                    'gambar' => $uploaded_data['file_name'],
                    'nama_gambar' => $ori_name,
                    'utama' => 0
                ];
                $savedGambar = $this->gambar_model->insert($gambar);
                if ($savedGambar) {
                    $this->session->set_flashdata('message', 'Gambar berhasil diupload!');
                    return redirect($this->uri->uri_string());
                } else {
                    $this->session->set_flashdata('message', 'Gambar gagal diupload!');
                }
            }
        }
        $this->load->view('backend/componens/add_image', $data);
    }

    public function deleteImage($id_gambar = null)
    {
        $data['activeUser'] = $this->auth_model->current_user();
        if ($data['activeUser']->level <> 'Petugas') {
            show_404();
        }
        if (!$id_gambar) {
            show_404();
        }
        $data['gmbr']    = $this->gambar_model->get_by_id($id_gambar)->row();
        $id_barang       = $data['gmbr']->id_barang;
        $deletedGambar   = $this->gambar_model->delete($id_gambar);
        if ($deletedGambar) {
            $img_name       = $data['gmbr']->gambar;
            $file_name      = substr($img_name, 0, strpos($img_name, "."));
            array_map('unlink', glob(FCPATH . "/upload/barang/$file_name.*"));
            $this->session->set_flashdata('message', 'Gambar berhasil dihapus!');
        } else {
            $this->session->set_flashdata('message', 'Gambar gagal dihapus!');
        }
        return redirect("backend/barang/");
    }
}