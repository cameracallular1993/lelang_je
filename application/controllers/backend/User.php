<?php

class User extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('backend/auth/login');
		}
	}
	
    public function index()
    {
        $data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $data['users'] = $this->user_model->get_all(); //menampilkan data

        $this->load->view('backend/list_user', $data);

    }
	public function delete($id = null)
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $this->user_model->delete($id);
		redirect("backend/user");
	}
	
	public function new()
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
		$user = $this->user_model;
		$validation = $this->form_validation;
        $validation->set_rules($user->rules());
		if ($validation->run()) {
            $user->save();
			redirect("backend/User");
		}
		$this->load->view('backend/add_user', $data);

	}

	public function edit($id = null)
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
		$data['users'] = $this->user_model->find($id);

		if (!$data['users'] || !$id) {
			show_404();
		}

		if ($this->input->method() === 'post') {
			// TODO: lakukan validasi data seblum simpan ke model
			$user = [
				'id_user' => $id,
                'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
                'email' => $this->input->post('email'),
                'no_kontak' => $this->input->post('no_kontak'),
                'level' => $this->input->post('level') 
			];
			$updated = $this->user_model->update($user);
			if ($updated) {
				$this->session->set_flashdata('message', 'Article was updated');
				redirect('backend/user');
			}
		}

		$this->load->view('backend/edit_user', $data);
	}
	public function hapus()
    {
        $id = $this->uri->segment(3);
        $data = array('status'  => '0');
        $update = $this->modelsaya->update_admin(array('id_user' => $id), $data);
        $this->session->set_flashdata('gagal', '<div class="alert alert-success" role="alert">
            Data Petugas Telah Dinon-aktif!
          </div>');
        redirect('backend/user');
    }
    public function aktifkan()
    {
        $id = $this->uri->segment(3);
        $data = array('status'  => '1');
        $update = $this->modelsaya->update_admin(array('id_user' => $id), $data);
        $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">
            Data Petugas Telah Di-aktifkan kembali!
          </div>');
        redirect('backend/user');
    }
	public function blokir()
    {
        $id = $this->uri->segment(4);
        $data = array('status'  => '0');
        $update = $this->user_model->update_user(array('id_user' => $id), $data);
        $this->session->set_flashdata('gagal', '<div class="alert alert-success" role="alert">
            Data Petugas Telah Dinon-aktif!
          </div>');
        redirect('backend/user');
    }
	public function change($id_user = null)
    {
        $data['activeUser'] = $this->auth_model->current_user();
        $data['user'] = $this->user_model->get_by_id($id_user);
        if ($data['activeUser']->level <> 'Admin' && $data['activeUser']->username <> $data['user']->username) {
            show_404();
        }
        if ($this->input->method() === 'post') {
            $current = $this->input->post('current');
            $verify = $this->user_model->verify($data['user']->username, $current);
            if (!$verify) {
                $this->session->set_flashdata('message', 'Current password salah!');
            } else {
                $user = [
                    'id_user'   => $id_user,
                    'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
                ];
                $update = $this->user_model->update($user);
                if ($update) {
                    $this->session->set_flashdata('message', 'Password berhasil diubah!');
                    if ($data['activeUser']->username == $data['user']->username) {
                        $this->auth_model->logout();
                        redirect('backend');
                    }
                    redirect('backend/user');
                } else {
                    $this->session->set_flashdata('message', 'Password gagal diubah!');
                }
            }
        }
        $this->load->view('backend/change_password', $data);
    }
	public function block($id_user = null)
    {
        $data['activeUser'] = $this->auth_model->current_user();
        if ($data['activeUser']->level <> 'Admin') {
            show_404();
        }
        $data['user'] = $this->user_model->get_by_id($id_user);
        if (!$data['user'] || !$id_user) {
            show_404();
        }
        $user = [
            'id_user' => $id_user,
            'status' => 0
        ];
        $update = $this->user_model->update($user);
        if ($update) {
            $this->session->set_flashdata('message', 'Data berhasil diblokir!');
        } else {
            $this->session->set_flashdata('message', 'Data gagal diblokir!');
        }
        redirect('backend/user');
    }

}

	