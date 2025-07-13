<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Website extends CI_Controller
{
    public function index()
    {
        $data = array(
         'title' => "Theme"
        );
        $data['produk'] = $this->ermodel->selectWhere('produk', ['status' => 'ENABLE'])->result();
        $data['testimonial'] = $this->ermodel->selectWhere('testimonial', ['status' => 'ENABLE'])->result();
        $this->db->order_by('urutan', 'asc');
        $data['section'] = $this->ermodel->selectWhere('section', ['status' => 'ENABLE'])->result();
        $this->addVisitor();
        $this->template->loadWebsite('website/template/template', 'website/index', $data);
    }
    public function addVisitor()
    {
        $ip = $this->input->ip_address();
        // insert visitor ip
        $visitor_ip = $this->ermodel->selectWhere('visitor_ip', ['DATE(tanggal)' => date('Y-m-d')])->row();
        if (!$visitor_ip)
        {
            $data_proses = [
                'tahun' => date('Y'), 'bulan_nomor' => date('m'),
                'bulan_nama' => $this->template->getBulan(date('m')),
                'ip' => @$ip,
                'nama' => 'Anonym',
                'tanggal' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('visitor_ip', $data_proses);
            // insert cunting visitor
            $visitor = $this->ermodel->selectWhere('visitor', ['tahun' => date('Y'), 'bulan_nomor' => date('m')])->row();
            if ($visitor)
            {

                $data_proses = [
                 'jumlah' => $visitor->jumlah + 1
                ];
                $this->db->where('id', $visitor->id);
                $this->db->update('visitor', $data_proses);
            }
            else
            {
                $getbulan = $this->template->getBulan();
                foreach ($getbulan as $key => $val_bulan)
                {
                    $jumlah = 0;
                    if ($key == date('m'))
                    {
                        $jumlah = 1;
                    }
                    $data_proses = [
                     'tahun' => date('Y'), 'bulan_nomor' => $key,
                     'bulan_nama' => $val_bulan,
                     'jumlah' => $jumlah
                    ];
                    $this->db->insert('visitor', $data_proses);
                }
            }
        }
        return 'oke';
    }
    public function get_client_ip()
    {
        $ipaddress = $ip = $this->input->ip_address();

        return $ipaddress;
    }
    public function send_pesan_kontak()
    {
        $datapost = $this->input->post();
        $data_proses = [
            'nama' => $datapost['nama'],
            'email' => $datapost['email'],
            'subject' => $datapost['subject'],
            'pesan' => $datapost['pesan'],
            'tanggal' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('pesan_kontak', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Disimpan',
        ];
        echo json_encode($res);
    }
    public function store_subs()
    {
        $datapost = $this->input->post();
        $data_proses = [
            'email' => $datapost['email'],
            'subscribe_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('subscriber', $data_proses);
        $res = [
            'code' => 200,
            'message' => 'Berhasil Disimpan',
        ];
        echo json_encode($res);
    }
    public function detail_produk($id)
    {
        $data = array(
            'title' => "Theme"
           );
        $data['produk'] = $this->ermodel->selectWhere('produk', ['status' => 'ENABLE', 'id' => $id])->row();
        $this->template->loadWebsite('website/template/template', 'website/detail-produk', $data);
    }
}