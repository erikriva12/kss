<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $data = array(
         'title' => "Dashboard"
        );
        $this->template->loadTemplate('template/template', 'template/index', $data);
    }
    public function getPesanKontak()
    {
        $this->datatables->select('
        id,
        nama,
        email,
        subject,
        pesan,
        tanggal,
        ');
        $this->datatables->from('pesan_kontak');
        echo $this->datatables->generate();
    }
    public function getDetailPesan($id)
    {
        $data['pesan'] = $this->ermodel->selectWhere('pesan_kontak', ['id' => $id])->row();
        $this->load->view('template/detail-pesan', $data);
    }

    public function getEmailSubs()
    {
        $this->datatables->select('
        id,
        email,
        subscribe_at
        ');
        $this->datatables->from('subscriber');
        echo $this->datatables->generate();
    }
    public function getDaftarVisitor()
    {
        $datapost = $this->input->post();
        $this->datatables->select('
        id,
        ip,
        tanggal
        ');
        $this->datatables->where('tahun', date('Y'));
        if ($datapost['bulan'] != 0)
        {

            $this->datatables->where('bulan_nomor', $datapost['bulan']);
        }
        $this->datatables->from('visitor_ip');
        echo $this->datatables->generate();
    }

}