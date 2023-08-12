<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerMahasiswa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('MahasiswaModel');
        $this->load->library('form_validation');
        $this->load->library('Datatables');
        $this->load->helper(array('form', 'url', 'download', 'file'));
        if (empty($this->session->session_login['username'])) {
            $this->session->set_flashdata("pesan", "Anda harus login terlebih dahulu.");
            redirect(site_url("controllerLogin"));
        }
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->MahasiswaModel->json();
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('mahasiswa/listMahasiswa');
        $this->load->view('footer');
    }

    public function insert_mahasiswa()
    {
        $data = [
            'aksi'          => 'Tambah',
            'action'        => site_url("controllerMahasiswa/insert_mahasiswa_action"),
            'nim'           => set_value("nim"),
            'nama_lengkap'  => set_value("nama_lengkap"),
            'tanggal_lahir' => set_value("tanggal_lahir"),
            'jenis_kelamin' => set_value("jenis_kelamin"),
            'alamat'        => set_value("alamat"),
        ];
        $this->load->view('header');
        $this->load->view('mahasiswa/formMahasiswa', $data);
        $this->load->view('footer');
    }

    public function insert_mahasiswa_action()
    {
        $this->form_validation->set_rules('nim', 'NIM', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama lengkap', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_message('required', '* {field} Harus diisi');

        if ($this->form_validation->run() == FALSE) {
            $this->insert_mahasiswa();
        } else {

            $cek_nim_mahasiswa = $this->MahasiswaModel->get_by_id($this->input->post("nim"));

            if ($cek_nim_mahasiswa) {
                $this->session->set_flashdata("error_message", "Gagal tambah siswa. NIM sudah ada, atas nama " . $cek_nim_mahasiswa->nama_lengkap);
                redirect(site_url("controllerMahasiswa"));
            }

            $data = [
                'nim'             => $this->input->post("nim"),
                'nama_lengkap'    => $this->input->post("nama_lengkap"),
                'tanggal_lahir'   => date('Y-m-d', strtotime($this->input->post("tanggal_lahir"))),
                'jenis_kelamin'   => $this->input->post("jenis_kelamin"),
                'alamat'          => $this->input->post("alamat"),
            ];

            $this->MahasiswaModel->insert_mahasiswa($data);

            $this->session->set_flashdata("flash_message", "Berhasil tambah data mahasiswa.");
            redirect(site_url("controllerMahasiswa"));
        }
    }

    public function edit_mahasiswa($nim)
    {
        $data_mahasiswa = $this->MahasiswaModel->get_by_id($nim);
        $data = [
            'aksi'          => 'Edit',
            'action'        => site_url("controllerMahasiswa/edit_mahasiswa_action"),
            'nim'           => set_value("nim", $data_mahasiswa->nim),
            'nama_lengkap'  => set_value("nama_lengkap", $data_mahasiswa->nama_lengkap),
            'tanggal_lahir' => set_value("tanggal_lahir", $data_mahasiswa->tanggal_lahir),
            'jenis_kelamin' => set_value("jenis_kelamin", $data_mahasiswa->jenis_kelamin),
            'alamat'        => set_value("alamat", $data_mahasiswa->alamat),
        ];
        $this->load->view('header');
        $this->load->view('mahasiswa/formMahasiswa', $data);
        $this->load->view('footer');
    }

    public function edit_mahasiswa_action()
    {
        $nim  = $this->input->post("nim");

        $data = [
            'nama_lengkap'    => $this->input->post("nama_lengkap"),
            'tanggal_lahir'   => date('Y-m-d', strtotime($this->input->post("tanggal_lahir"))),
            'jenis_kelamin'   => $this->input->post("jenis_kelamin"),
            'alamat'          => $this->input->post("alamat"),
        ];

        $this->MahasiswaModel->update_siswa($nim, $data);


        $this->session->set_flashdata("flash_message", "Berhasil update data mahasiswa.");
        redirect(site_url("controllerMahasiswa"));
    }

    public function hapus_siswa($nim)
    {
        $data_mahasiswa = $this->MahasiswaModel->get_by_id($nim);
        if ($data_mahasiswa) {
            $this->MahasiswaModel->delete_siswa($nim);
            $this->session->set_flashdata("flash_message", "Berhasil hapus data mahasiswa.");
            redirect(site_url("controllerMahasiswa"));
        } else {
            $this->session->set_flashdata("error_message", "Gagal hapus data mahasiswa.");
            redirect(site_url("controllerMahasiswa"));
        }
    }
}
