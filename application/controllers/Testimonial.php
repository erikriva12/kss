<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Testimonial extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Testimonial';
        $data['sub_title'] = 'Daftar Testimonial';
        $this->template->loadTemplate('template/template', 'testimonial/list', $data);
    }
    public function json()
    {
        $this->datatables->select('id, nama, foto, perusahaan, isi_testimonial, status');
        $this->datatables->from('testimonial');
        // $this->datatables->where('status', 'ENABLE');
        echo $this->datatables->generate();
    }
    public function tambah()
    {
        $data['title'] = 'Testimonial';
        $data['sub_title'] = 'Daftar Testimonial';
        $this->template->loadTemplate('template/template', 'testimonial/add', $data);
    }
    public function upload_file()
    {
        $datapost = $this->input->post();
        $dir = 'uploads/testimonial/';
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
        $data_proses = [
            'nama' => $datapost['nama'],
            'foto' => $datapost['foto'],
            'perusahaan' => $datapost['perusahaan'],
            'isi_testimonial' => $datapost['isi_testimonial'],
            'status' => 'ENABLE',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),
        ];
        $this->db->insert('testimonial', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Insert Kategori',
        ];
        echo json_encode($res);
    }
    public function edit($id)
    {
        $data['title'] = 'Testimonial';
        $data['sub_title'] = 'Daftar Testimonial';
        $data['data'] = $this->ermodel->selectWhere('testimonial', ['id' => $id])->row();
        $this->template->loadTemplate('template/template', 'testimonial/edit', $data);
    }
    public function update()
    {
        $datapost = $this->input->post();

        $data_proses = [
            'nama' => $datapost['nama'],
            'foto' => $datapost['foto'],
            'perusahaan' => $datapost['perusahaan'],
            'isi_testimonial' => $datapost['isi_testimonial'],
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id'),
        ];
        $this->db->where('id', $datapost['id']);
        $this->db->update('testimonial', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Insert Kategori',
        ];
        echo json_encode($res);
    }
    public function hapus()
    {
        $datapost = $this->input->post();
        $data = $this->ermodel->selectWhere('testimonial', ['id' => $datapost['id']])->row();
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
        $this->db->update('testimonial', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Kategori',
        ];
        echo json_encode($res);
    }
}