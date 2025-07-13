<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {

        $data['title'] = 'Master';
        $data['sub_title'] = 'Master User';
        $this->template->loadTemplate('template/template', 'user/list', $data);
    }
    public function json()
    {
        $this->datatables->select('
        id,
        username,
        nama,
        email,
        password,
        role_id,
        role_name,
        status,
        created_at,
        updated_at,
        created_by,
        updated_by,
        foto_profil

        ');
        $this->datatables->from('user');
        // $this->datatables->where('status', 'ENABLE');
        echo $this->datatables->generate();
    }
    public function tambah()
    {

        $data['title'] = 'Master';
        $data['sub_title'] = 'Master User';
        $data['kategori'] = $this->ermodel->selectWhere('produk_kategori', ['status' => 'ENABLE'])->result();
        $this->template->loadTemplate('template/template', 'user/add', $data);
    }
    public function upload_file()
    {
        $datapost = $this->input->post();
        $dir = 'uploads/user/';
        if (!is_dir($dir))
        {
            mkdir($dir, 0777, true);
        }

        ini_set('max_execution_time', 30000);
        $config['upload_path'] = $dir;
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file'))
        {
            $res = [
                'code' => 401,
                'message' => 'Gagal Upload File',
                'error' => $this->upload->display_errors()
            ];
        }
        else
        {
            $file = $this->upload->data();
            $res = [
                'code' => 200,
                'message' => 'Berhasil Upload File',
                'url' => $dir . $file['file_name'],
                'data' => $file
            ];

        }
        echo json_encode($res);
    }
    public function store()
    {
        $datapost = $this->input->post();
        if ($datapost['konfirmasi_password'] != $datapost['password'])
        {
            $res = [
                'code' => 401,
                'message' => 'Konfirmasi Password Tidak Sesuai',
            ];
        }
        else
        {


            $data_proses = [
                'username' => $datapost['username'],
                'nama' => $datapost['nama'],
                'email' => $datapost['email'],
                'password' => md5($datapost['password']),
                'role_id' => '1',
                'role_name' => 'Admin',
                'foto_profil' => $datapost['foto_profil'],

                'status' => 'ENABLE',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id'),

            ];
            $this->db->insert('user', $data_proses);
            $res = [
                'code' => 200,
                'message' => 'Berhasil Insert Kategori',
            ];
        }
        echo json_encode($res);
    }
    public function edit($id)
    {

        $data['title'] = 'Master';
        $data['sub_title'] = 'Master User';
        $data['data'] = $this->ermodel->selectWhere('user', ['id' => $id])->row();
        $this->template->loadTemplate('template/template', 'user/edit', $data);
    }
    public function update()
    {
        $datapost = $this->input->post();
        if ($datapost['password'] && ($datapost['konfirmasi_password'] != $datapost['password']))
        {
            $res = [
                'code' => 401,
                'message' => 'Konfirmasi Password Tidak Sesuai',
            ];
        }
        else
        {
            $data_proses = [
                'username' => $datapost['username'],
                'nama' => $datapost['nama'],
                'email' => $datapost['email'],
                'password' => md5($datapost['password']),
                'role_id' => '1',
                'role_name' => 'Admin',
                'foto_profil' => $datapost['foto_profil'],
                'status' => 'ENABLE',
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata('id'),

            ];
            $this->db->where('id', $datapost['id']);
            $this->db->update('user', $data_proses);
            if ($datapost['id'] == $this->session->userdata('id'))
            {
                $user = $this->ermodel->selectWhere('user', ['id' => $this->session->userdata('id')])->row();
                $this->session->set_userdata('id', $user->id);
                $this->session->set_userdata('role_id', $user->role_id);
                $this->session->set_userdata('nama', $user->nama);
                $this->session->set_userdata('foto_profil', $user->foto_profil);
            }
            $res = [
                'code' => 200,
                'message' => 'Berhasil Update User',
            ];
        }
        echo json_encode($res);
    }
    public function hapus()
    {
        $datapost = $this->input->post();
        $data = $this->ermodel->selectWhere('user', ['id' => $datapost['id']])->row();
        if ($data->status == 'ENABLE')
        {
            $data_proses = [
                'status' => 'DISABLE',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id'),
            ];
        }
        else
        {
            $data_proses = [
                'status' => 'ENABLE',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id'),
            ];
        }
        $this->db->where('id', $datapost['id']);
        $this->db->update('user', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Kategori',
        ];
        echo json_encode($res);
    }
    public function profile()
    {
        $data['title'] = 'Master';
        $data['sub_title'] = 'Master User';
        $data['data'] = $this->ermodel->selectWhere('user', ['id' => $this->session->userdata('id')])->row();
        $this->template->loadTemplate('template/template', 'user/profile', $data);
    }
}