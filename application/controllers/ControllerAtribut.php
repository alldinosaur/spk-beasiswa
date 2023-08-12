<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerAtribut extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('AtributModel');
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
        echo $this->AtributModel->json();
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('atribut/listAtribut');
        $this->load->view('footer');
    }

    public function insert_atribut()
    {
        $data = [
            'aksi'            => 'tambah',
            'action'          => site_url("controllerAtribut/insert_atribut_action"),
            'id_atribut'      => set_value("id_atribut"),
            'kode'            => set_value("kode"),
            'nama_atribut'    => set_value("nama_atribut"),
            'tipe_atribut'    => set_value("tipe_atribut"),
            'bobot'           => set_value("bobot"),
        ];
        $this->load->view('header');
        $this->load->view('atribut/formAtribut', $data);
        $this->load->view('footer');
    }

    public function insert_atribut_action()
    {
        $this->form_validation->set_rules('kode', 'kode', 'required');
        $this->form_validation->set_rules('nama_atribut', 'nama_atribut', 'required');
        $this->form_validation->set_rules('tipe_atribut', 'tipe_atribut', 'required');
        $this->form_validation->set_rules('bobot', 'bobot', 'required');
        $this->form_validation->set_message('required', '* {field} Harus diisi');

        $total_bobot = $this->AtributModel->get_total_bobot();
        $total_bobot = (float)$total_bobot->bobot;
        $selisih_bobot = round((1.0 - $total_bobot), 2);

        if ($this->form_validation->run() == FALSE) {
            $this->insert_atribut();
        } else {

            $data = [
                'kode'  => $this->input->post("kode"),
                'nama_atribut'  => $this->input->post("nama_atribut"),
                'tipe_atribut'   => $this->input->post("tipe_atribut"),
                'bobot'   => $this->input->post("bobot"),
            ];

            if($total_bobot >= 1.0){
                $this->session->set_flashdata("flash_message", "Total bobot melebihi batas.");
                redirect(site_url("controllerAtribut"));
            }
            if($data["bobot"] > $selisih_bobot ){
                $this->session->set_flashdata("flash_message", "Total bobot melebihi batas.");
                redirect(site_url("controllerAtribut"));
            }

            $this->AtributModel->insert_atribut($data);

            $this->session->set_flashdata("flash_message", "Berhasil tambah data atribut.");
            redirect(site_url("controllerAtribut"));

            
        }
    }

    public function edit_atribut($id)
    {
        $data_atribut = $this->AtributModel->get_by_id($id);
        $data = [
            'action'          => site_url("controllerAtribut/edit_atribut_action"),
            'id_atribut'      => set_value("id_atribut", $data_atribut->id_atribut),
            'kode'            => set_value("kode", $data_atribut->kode),
            'nama_atribut'    => set_value("nama_atribut", $data_atribut->nama_atribut),
            'tipe_atribut'    => set_value("tipe_atribut", $data_atribut->tipe_atribut),
            'bobot'           => set_value("bobot", $data_atribut->bobot),
        ];
        $this->load->view('header');
        $this->load->view('atribut/formAtribut', $data);
        $this->load->view('footer');
    }

    public function edit_atribut_action()
    {
        $id_atribut  = $this->input->post("id_atribut");
        $total_bobot = $this->AtributModel->get_total_bobot();
        
        $total_bobot = (float)$total_bobot->bobot;
        $selisih_bobot = round((1.0 - $total_bobot), 2);

        $data = [
            'kode'  => $this->input->post("kode"),
            'nama_atribut'  => $this->input->post("nama_atribut"),
            'tipe_atribut'   => $this->input->post("tipe_atribut"),
            'bobot'  => $this->input->post("bobot"),
        ];

        $this->AtributModel->update_atribut($id_atribut, $data);

        $this->session->set_flashdata("flash_message", "Berhasil update data atribut.");
        redirect(site_url("controllerAtribut"));
    }

    public function hapus_atribut($id)
    {
        $data_atribut = $this->AtributModel->get_by_id($id);

        if ($data_atribut) {
            $this->AtributModel->delete_atribut($id);
            $this->session->set_flashdata("flash_message", "Berhasil hapus data atribut.");
            redirect(site_url("controllerAtribut"));

        } else {
            $this->session->set_flashdata("error_message", "Gagal hapus data atribut.");
            redirect(site_url("controllerAtribut"));

        }
    }
}
