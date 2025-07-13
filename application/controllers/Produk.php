<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function index()
    {

        $data['title'] = 'Produk';
        $data['sub_title'] = 'Daftar Produk';
        $this->template->loadTemplate('template/template', 'produk/list', $data);
    }
    public function json()
    {
        $this->datatables->select('id, nama, status, created_at, updated_at, updated_by, created_by, foto_json, foto_utama, kategori_produk_id, kategori_produk_nama
        ');
        $this->datatables->from('produk');
        // $this->datatables->where('status', 'ENABLE');
        echo $this->datatables->generate();
    }
    public function tambah()
    {

        $data['title'] = 'Produk';
        $data['sub_title'] = 'Daftar Produk';
        $data['kategori'] = $this->ermodel->selectWhere('produk_kategori', ['status' => 'ENABLE'])->result();
        $this->template->loadTemplate('template/template', 'produk/add', $data);
    }
    public function upload_file()
    {
        $datapost = $this->input->post();
        $dir = 'uploads/produk/';
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
    public function store_produk()
    {
        $datapost = $this->input->post();
        $kategori = $this->ermodel->selectWhere('produk_kategori', ['id' => $datapost['kategori_id']])->row();
        $data_proses = [
            'nama' => $datapost['nama'],
            'informasi' => $datapost['informasi'],
            'status' => 'ENABLE',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),
            'foto_json' => json_encode($datapost['foto']),
            'foto_utama' => @$datapost['foto'][0],
            'kategori_produk_id' => $datapost['kategori_id'],
            'kategori_produk_nama' => $kategori->nama,
            'meta' => json_encode($datapost['meta']),

        ];
        $this->db->insert('produk', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Insert Kategori',
        ];
        echo json_encode($res);
    }
    public function edit($id)
    {

        $data['title'] = 'Produk';
        $data['sub_title'] = 'Daftar Produk';
        $data['kategori'] = $this->ermodel->selectWhere('produk_kategori', ['status' => 'ENABLE'])->result();
        $data['data'] = $this->ermodel->selectWhere('produk', ['id' => $id])->row();
        $this->template->loadTemplate('template/template', 'produk/edit', $data);
    }
    public function update_produk()
    {
        $datapost = $this->input->post();
        $kategori = $this->ermodel->selectWhere('produk_kategori', ['id' => $datapost['kategori_id']])->row();
        $data_proses = [
            'nama' => $datapost['nama'],
            'informasi' => $datapost['informasi'],
            'status' => 'ENABLE',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),
            'foto_json' => json_encode($datapost['foto']),
            'foto_utama' => @$datapost['foto'][0],
            'kategori_produk_id' => $datapost['kategori_id'],
            'kategori_produk_nama' => $kategori->nama,
            'meta' => json_encode($datapost['meta']),

        ];
        $this->db->where('id', $datapost['id']);
        $this->db->update('produk', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Insert Kategori',
        ];
        echo json_encode($res);
    }
    public function hapus()
    {
        $datapost = $this->input->post();
        $data = $this->ermodel->selectWhere('produk', ['id' => $datapost['id']])->row();
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
        $this->db->update('produk', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Kategori',
        ];
        echo json_encode($res);
    }


    // Kategori Produk
    public function kategori()
    {
        $data['title'] = 'Produk';
        $data['sub_title'] = 'Kategori Produk';
        $this->template->loadTemplate('template/template', 'produk/kategori/list', $data);
    }
    public function json_kategori()
    {
        $this->datatables->select('id, nama, status');
        $this->datatables->from('produk_kategori');
        // $this->datatables->where('status', 'ENABLE');
        echo $this->datatables->generate();
    }
    public function store_kategori()
    {
        $datapost = $this->input->post();
        $data_proses = [

            'nama' => $datapost['nama_kategori'],
            'status' => 'ENABLE',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),

        ];
        $this->db->insert('produk_kategori', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Insert Kategori',
        ];
        echo json_encode($res);
    }
    public function edit_kategori($id_kategori)
    {
        $data['kategori'] = $this->ermodel->selectWhere('produk_kategori', ['id' => $id_kategori])->row();
        $this->load->view('produk/kategori/edit', $data);
    }
    public function update_kategori()
    {
        $datapost = $this->input->post();
        $data_proses = [
        'nama' => $datapost['nama_kategori'],
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $this->session->userdata('id'),


        ];
        $this->db->where('id', $datapost['id']);
        $this->db->update('produk_kategori', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Kategori',
        ];
        echo json_encode($res);
    }
    public function hapus_kategori()
    {
        $datapost = $this->input->post();
        $data = $this->ermodel->selectWhere('produk_kategori', ['id' => $datapost['id']])->row();
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
        $this->db->update('produk_kategori', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Kategori',
        ];
        echo json_encode($res);
    }
}