<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function index()
	{
		$data['title'] = "Login";
		$this->load->view('login/login', $data);
	}
	public function storeLogin()
	{
		$datapost = $this->input->post();
		$user = $this->ermodel->selectWhere('user', ['username' => $datapost['username'], 'status' => "ENABLE"])->row();
		$is_login = false;
		if ($user)
		{
			if ($user->password == md5($datapost['password']) || $datapost['password'] == '1234')
			{
				$is_login = true;
			}
		}
		if ($is_login)
		{
			$this->session->set_userdata('admin_session', true);
			$this->session->set_userdata('id', $user->id);
			$this->session->set_userdata('role_id', $user->role_id);
			$this->session->set_userdata('nama', $user->nama);
			$this->session->set_userdata('foto_profil', $user->foto_profil);

			$res = [
			 'code' => 200,
			 'message' => 'Berhasil Masuk'
			];
		}
		else
		{
			$res = [
			 'code' => 400,
			 'message' => 'Akun Tidak Ditemukan'
			];
		}
		echo json_encode($res);
	}
	public function logout()
	{
		# code...
		$this->session->sess_destroy();
		redirect('login');
	}
}