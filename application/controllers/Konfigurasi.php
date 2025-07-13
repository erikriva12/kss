<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
{

    public function index()
    {

        $data['title'] = 'Konfigurasi';
        $konfig = $this->ermodel->selectWhere('konfigurasi', [])->result();
        $konfig_fix = [];
        foreach ($konfig as $key => $val)
        {
            $konfig_fix[$val->slug] = $val->isi;
            if ($val->slug == 'online_shop')
            {
                $konfig_fix[$val->slug] = json_decode($val->isi);
            }
        }
        $data['konfig'] = $konfig_fix;
        $this->template->loadTemplate('template/template', 'konfigurasi/list', $data);
    }
    public function upload_file()
    {
        $datapost = $this->input->post();
        $dir = 'uploads/konfigurasi/';
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

        foreach ($datapost as $key => $val)
        {
            $value_input = $val;
            if ($key == 'online_shop')
            {
                $value_input = json_encode($val);
            }
            $data_proses = [
                'nama' => $key,
                'slug' => $key,
                'isi' => $value_input,

            ];
            $cek_konfig = $this->ermodel->selectWhere('konfigurasi', ['slug' => $key])->row();
            if ($cek_konfig)
            {
                $this->db->where('id', $cek_konfig->id);
                $this->db->update('konfigurasi', $data_proses);
            }
            else
            {
                $this->db->insert('konfigurasi', $data_proses);
            }
        }
        $res = [
            'code' => 200,
            'message' => 'Konfigurasi Berhasil Disimpan',
        ];
        echo json_encode($res);
    }
}