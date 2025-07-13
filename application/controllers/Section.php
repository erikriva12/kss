<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Section extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Section';
        $data['sub_title'] = 'Daftar Section';
        $this->template->loadTemplate('template/template', 'section/list', $data);
    }

    public function json()
    {
        $this->datatables->select('id, nama_section, kategori_section_nama, status, slug');
        $this->datatables->from('section');
        $this->db->order_by('urutan', 'asc');
        echo $this->datatables->generate();
    }
    public function upload_file()
    {
        $datapost = $this->input->post();
        $dir = 'uploads/section/' . $datapost['section'] . '/';
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
    public function store_section()
    {
        $datapost = $this->input->post();
        $kategori = $this->ermodel->selectWhere('section_kategori', ['slug' => $datapost['slug']])->row();
        $data_proses = [
            'nama_section' => $datapost['nama_section'],
            'slug' => $datapost['slug'],
            'status' => 'ENABLE',
            'kategori_section_id' => $kategori->id,
            'kategori_section_nama' => $kategori->nama,
            'meta' => json_encode($datapost['meta'])

        ];
        if ($datapost['id_section'])
        {
            $data_proses['updated_at'] = date('Y-m-d H:i:s');
            $data_proses['updated_by'] = $this->session->userdata('id');
            $data = $this->ermodel->selectWhere('section', ['id' => $datapost['id_section']])->row();
            $this->db->where('id', $data->id);
            $this->db->update('section', $data_proses);
        }
        else
        {
            $data_proses['created_at'] = date('Y-m-d H:i:s');
            $data_proses['created_by'] = $this->session->userdata('id');
            $this->db->insert('section', $data_proses);
        }
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Section',
        ];
        echo json_encode($res);
    }
    public function tambah($slug = 'banner')
    {

        $data['title'] = 'Section';
        $data['sub_title'] = 'Daftar Section';
        $data['slug'] = $slug;
        $this->template->loadTemplate('template/template', 'section/edit-' . $slug, $data);
    }
    public function edit($slug = 'banner')
    {
        $data['title'] = 'Section';
        $data['data'] = $this->ermodel->selectWhere('section', ['slug' => $slug])->row();
        $data['slug'] = $slug;
        $this->template->loadTemplate('template/template', 'section/edit-' . $slug, $data);
    }
    public function urutan()
    {
        $data['title'] = 'Section';
        $this->db->order_by('urutan', 'asc');
        $data['data'] = $this->ermodel->selectWhere('section', ['status' => 'ENABLE'])->result();

        $this->template->loadTemplate('template/template', 'section/urutan', $data);
    }
    public function store_urutan()
    {
        $datapost = $this->input->post();
        $urutan = 0;
        foreach ($datapost['urutan_id'] as $key => $val)
        {
            $urutan++;
            $this->db->where('id', $val);
            $this->db->update('section', ['urutan' => $urutan]);
        }
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Section',
        ];
        echo json_encode($res);
    }
    public function hapus()
    {
        $datapost = $this->input->post();
        $data = $this->ermodel->selectWhere('section_kategori', ['id' => $datapost['id']])->row();
        if ($data->status == 'ENABLE')
        {
            $data_proses = [
                'status' => 'DISABLE',
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata('id'),
            ];
        }
        else
        {
            $data_proses = [
                'status' => 'ENABLE',
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata('id'),
            ];
        }
        $this->db->where('id', $datapost['id']);
        $this->db->update('section_kategori', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Section',
        ];
        echo json_encode($res);
    }
    // Kategori Section
    public function kategori()
    {
        $data['title'] = 'Section';
        $data['sub_title'] = 'Kategori Section';
        $this->template->loadTemplate('template/template', 'section/kategori/list', $data);
    }
    public function json_kategori()
    {
        $this->datatables->select('id, nama, slug, status');
        $this->datatables->from('section_kategori');
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
        'slug' => $datapost['slug'],

        ];
        $this->db->insert('section_kategori', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Section',
        ];
        echo json_encode($res);
    }
    public function edit_kategori($id_kategori)
    {
        $data['kategori'] = $this->ermodel->selectWhere('section_kategori', ['id' => $id_kategori])->row();
        $this->load->view('section/kategori/edit', $data);
    }
    public function update_kategori()
    {
        $datapost = $this->input->post();
        $data_proses = [
        'nama' => $datapost['nama_kategori'],
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $this->session->userdata('id'),
        'slug' => $datapost['slug'],

        ];
        $this->db->where('id', $datapost['id']);
        $this->db->update('section_kategori', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Section',
        ];
        echo json_encode($res);
    }
    public function hapus_kategori()
    {
        $datapost = $this->input->post();
        $data = $this->ermodel->selectWhere('section_kategori', ['id' => $datapost['id']])->row();
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
        $this->db->update('section_kategori', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Update Section',
        ];
        echo json_encode($res);
    }

}