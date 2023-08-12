<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerKlasifikasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('KlasifikasiModel');
        $this->load->model('NormalisasiModel');
        $this->load->model('HasilModel');
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
        echo $this->KlasifikasiModel->json();
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('klasifikasi/listKlasifikasi');
        $this->load->view('footer');
    }

    public function insert_klasifikasi()
    {
        $data = [
            'aksi'              => 'Tambah',
            'action'            => site_url("controllerKlasifikasi/insert_klasifikasi_action"),
            'id_klasifikasi'    => set_value("id_klasifikasi"),
            'nim'               => set_value("nim"),
            'listMahasiswa'     => $this->KlasifikasiModel->get_all_mahasiswa(),
            'listKriteria'      => $this->KlasifikasiModel->get_all_kriteria(),
        ];
        $this->load->view('header');
        $this->load->view('klasifikasi/formKlasifikasi', $data);
        $this->load->view('footer');
    }

    public function insert_klasifikasi_action()
    {
        $this->form_validation->set_rules('nim', 'nim', 'required');
        $this->form_validation->set_message('required', '* {field} Harus diisi');

        if ($this->form_validation->run() == FALSE) {
            $this->insert_klasifikasi();
        } else {

            $data = [
                'nim' => $this->input->post("nim"),
                'c1'  => $this->input->post("c1"),
                'c2'  => $this->input->post("c2"),
                'c3'  => $this->input->post("c3"),
                'c4'  => $this->input->post("c4"),
                'c5'  => $this->input->post("c5"),
                'c6'  => $this->input->post("c6"),
            ];

            $this->KlasifikasiModel->insert_klasifikasi($data);
            $this->insert_analisis_klasifikasi($data);

            $this->session->set_flashdata("flash_message", "Berhasil tambah data klasifikasi.");
            redirect(site_url("controllerKlasifikasi"));
        }
    }

    public function insert_analisis_klasifikasi($data)
    {
        $cariMax = $this->NormalisasiModel->cariMax();
        $cariMin = $this->NormalisasiModel->cariMin();
        $bobot_atribut = $this->NormalisasiModel->bobot_atribut();

        $klasifikasi = $this->KlasifikasiModel->get_all_kriteria();
            
        if($klasifikasi[0]->tipe_atribut == 'cost ') {
            $s_c1 = round($cariMin->minimal / $data["c1"], 2);
            $v_c1 = ($cariMin->minimal / $data["c1"]) * $bobot_atribut[0]->bobot;
        } else {
            $s_c1 = round($data["c1"] / $cariMax->maksimal, 2);
            $v_c1 = ($data["c1"] / $cariMax->maksimal) * $bobot_atribut[0]->bobot;
        }

        if($klasifikasi[0]->tipe_atribut == 'cost ') {
            $s_c2 = round($cariMin->minimal / $data["c2"], 2);
            $v_c2 = ($cariMin->minimal / $data["c2"]) * $bobot_atribut[1]->bobot;
        } else {
            $s_c2 = round($data["c2"] / $cariMax->maksimal, 2);
            $v_c2 = ($data["c2"] / $cariMax->maksimal) * $bobot_atribut[1]->bobot;
        }

        if($klasifikasi[0]->tipe_atribut == 'cost ') {
            $s_c3 = round($cariMin->minimal / $data["c3"], 2);
            $v_c3 = ($cariMin->minimal / $data["c3"]) * $bobot_atribut[2]->bobot;
        } else {
            $s_c3 = round($data["c3"] / $cariMax->maksimal, 2);
            $v_c3 = ($data["c3"] / $cariMax->maksimal) * $bobot_atribut[2]->bobot;
        }

        if($klasifikasi[0]->tipe_atribut == 'cost ') {
            $s_c4 = round($cariMin->minimal / $data["c4"], 2);
            $v_c4 = ($cariMin->minimal / $data["c4"]) * $bobot_atribut[3]->bobot;
        } else {
            $s_c4 = round($data["c4"] / $cariMax->maksimal, 2);
            $v_c4 = ($data["c4"] / $cariMax->maksimal) * $bobot_atribut[3]->bobot;
        }

        if($klasifikasi[0]->tipe_atribut == 'cost ') {
            $s_c5 = round($cariMin->minimal / $data["c5"], 2);
            $v_c5 = ($cariMin->minimal / $data["c5"]) * $bobot_atribut[4]->bobot;
        } else {
            $s_c5 = round($data["c5"] / $cariMax->maksimal, 2);
            $v_c5 = ($data["c5"] / $cariMax->maksimal) * $bobot_atribut[4]->bobot;
        }

        if($klasifikasi[0]->tipe_atribut == 'cost ') {
            $s_c6 = round($cariMin->minimal / $data["c6"], 2);
            $v_c6 = ($cariMin->minimal / $data["c6"]) * $bobot_atribut[5]->bobot;
        } else {
            $s_c6 = round($data["c6"] / $cariMax->maksimal, 2);
            $v_c6 = ($data["c6"] / $cariMax->maksimal) * $bobot_atribut[5]->bobot;
        }
        
        $data_normalisasi = [
            'nim'   => $data["nim"],
            'c1'    => $s_c1,
            'c2'    => $s_c2,
            'c3'    => $s_c3,
            'c4'    => $s_c4,
            'c5'    => $s_c5,
            'c6'    => $s_c6,
        ];
        // print_r($data_normalisasi);die;

        $nilai_total = round(($v_c1) + ($v_c2) + ($v_c3) + ($v_c4) + ($v_c5) +($v_c6), 2);
        
        $keterangan = "";
        if($nilai_total >= 0.75){
            $keterangan = "Lolos";
        } else{
            $keterangan = "Tidak Lolos";
        };

        $data_hasil = [
            'nim'           => $data["nim"],
            'nilai_total'   => $nilai_total,
            'keterangan'    => $keterangan
        ];

        // print_r($data_hasil);die;

        $cek_nim = $this->db->get_where("normalisasi", ["nim" => $data["nim"]])->row();
        if ($cek_nim) {
            $this->NormalisasiModel->update($data["nim"], $data_normalisasi);
            $this->HasilModel->update_hasil($data["nim"], $data_hasil);
        } else {
            $this->NormalisasiModel->insert($data_normalisasi);
            $this->HasilModel->insert_hasil($data_hasil);
        }
        
    }

    public function hapus_klasifikasi($id)
    {
        $data = $this->KlasifikasiModel->get_by_id($id);

        if ($data) {
            $this->KlasifikasiModel->delete_klasifikasi($id);
            $this->session->set_flashdata("flash_message", "Berhasil hapus data klasifikasi.");
            redirect(site_url("controllerKlasifikasi"));
        } else {
            $this->session->set_flashdata("error_message", "Gagal hapus data klasifikasi.");
            redirect(site_url("controllerKlasifikasi"));
        }
    }
}
