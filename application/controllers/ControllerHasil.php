<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerHasil extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('HasilModel');
        $this->load->model('NormalisasiModel');
        $this->load->model('KlasifikasiModel');
        $this->load->library('form_validation');
        $this->load->library('Datatables');
        $this->load->helper(array('form', 'url', 'download', 'file'));
        if (empty($this->session->session_login['username'])) {
            $this->session->set_flashdata("pesan", "Anda harus login terlebih dahulu.");
            redirect(site_url("controllerLogin"));
        }
    }

    public function json_klasifikasi()
    {
        header('Content-Type: application/json');
        echo $this->HasilModel->json_klasifikasi();
    }

    public function json_normalisasi()
    {
        header('Content-Type: application/json');
        echo $this->HasilModel->json_normalisasi();
    }

    public function json_ranking()
    {
        header('Content-Type: application/json');
        echo $this->HasilModel->json_ranking();
    }

    public function index()
    {
        $data = [
            'listKriteria'  => $this->KlasifikasiModel->get_all_kriteria(),
            'ranking'       => $this->HasilModel->hasil_ranking()
        ];
        $this->load->view('header');
        $this->load->view('hasil/listHasil', $data);
        $this->load->view('footer');
    }
}
