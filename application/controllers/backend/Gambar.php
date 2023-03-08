<?php
 
class Gambar extends CI_Controller
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
    public function index($id = null )
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $barangedit = $this->barang_model;
        $getId['barang'] = $barangedit->getById($id);
        $data['gambar'] = $this->gambar_model->getAll(); //menampilkan data
        $apa = array_merge($data, $getId);
        $this->load->view('backend/list_gambar', $apa);
    }
    public function add_gambar($id = null)
    {
        $data['barang'] = $this->barang_model->getByGambar($id)->row(); //ambil data barang berdasarkan id
        $data['gambar'] = $this->gambar_model->getById($id); //ambil data gambar berdasarkan id barang
        $ori_name       = $_FILES["gambar"]["name"]; //nama asli gambar yang di upload
        $file_name                   = uniqid('', true);
        $config['upload_path']       = FCPATH . '/upload/barang/';
        $config['allowed_types']     = 'jpg|png|jpeg';
        $config['file_name']         = str_replace('.', '', $file_name);
        $config['overwrite']         = true;
        $config['max_size']          = 10240; // 1MB
        $config['max_width']         = 12000;
        $config['max_height']        = 12000;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('gambar')) { //upload yg ada di dalam field gambar (ui)
            //jika tidak berhasil upload
            $data['error'] = $this->upload->display_errors(); //masukan error ke parameter
            $error = preg_replace('/[^a-zA-Z0-9-_\.]/', ' ', strip_tags($data['error'])); //jika ada karakter spesial di error yg keluar maka di ubah jadi spasi
        } else {
        $uploaded_data = $this->upload->data();
           //memasukan ke array
           $data = array(
               'id_barang' => $id,
               'nama_gambar' => $ori_name,
               'gambar' => $uploaded_data['file_name'],
               'utama' => 0
            );
        }
            //tambahkan barang ke database
            $this->gambar_model->add_gambar($data);
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">
                Data Barang Telah ditambahkan!
              </div>');
            redirect('backend/gambar/index/'. $id);
    }
    public function hapus_gambar($id_gambar = null)
    {
        $data['gambar'] = $this->gambar_model->get_by_id($id_gambar)->row();
        $id_barang = $data['gambar']->id_barang;
        $oriImg = $data['gambar']->gambar;
        $ori_file_name      = substr($oriImg, 0, strpos($oriImg, ".")); 
        array_map('unlink', glob(FCPATH . "./assets/img/barang/$ori_file_name.*"));
        $id = $this->uri->segment(4);
        $hapus = $this->gambar_model->hapus_gambar($id);
        $this->session->set_flashdata('gagal', '<div class="alert alert-success" role="alert">
            Gambar Telah Dihapus!
          </div>');
        redirect('backend/gambar/index/'. $id_barang);
    }
}