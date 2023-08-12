<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerKriteria extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('KriteriaModel');
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
        echo $this->KriteriaModel->json();
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('kriteria/listKriteria');
        $this->load->view('footer');
    }

    public function insert_kriteria()
    {
        $data = [
            'aksi'          => 'tambah',
            'action'        => site_url("controllerKriteria/insert_kriteria_action"),
            'id_kriteria'   => set_value("id_kriteria"),
            'id_atribut'    => set_value("id_atribut"),
            'range_nilai'   => set_value("range_nilai"),
            'id_bobot'      => set_value("bobot"),
            'listAtribut'   => $this->KriteriaModel->get_all_atribut(),
        ];
        $this->load->view('header');
        $this->load->view('kriteria/formKriteria', $data);
        $this->load->view('footer');
    }

    public function insert_kriteria_action()
    {
        $this->form_validation->set_rules('id_atribut', 'id_atribut', 'required');
        $this->form_validation->set_rules('range_nilai', 'range_nilai', 'required');
        $this->form_validation->set_rules('bobot', 'bobot', 'required');
        $this->form_validation->set_message('required', '* {field} Harus diisi');

        if ($this->form_validation->run() == FALSE) {
            $this->insert_kriteria();
        } else {

            $data = [
                'id_atribut'    => $this->input->post("id_atribut"),
                'range_nilai'   => $this->input->post("range_nilai"),
                'id_bobot'      => $this->input->post("bobot"),
            ];
            // print_r($data);die;

            $this->KriteriaModel->insert_kriteria($data);

            $this->session->set_flashdata("flash_message", "Berhasil tambah data kriteria.");
            redirect(site_url("controllerKriteria"));
        }
    }

    public function edit_kriteria($id)
    {
        $data_kriteria = $this->KriteriaModel->get_by_id($id);
        $data = [
            'action'       => site_url("controllerKriteria/edit_kriteria_action"),
            'id_kriteria'  => set_value("id_kriteria", $data_kriteria->id_kriteria),
            'id_atribut'   => set_value("nama_kriteria", $data_kriteria->id_atribut),
            'range_nilai'  => set_value("tipe_atribut", $data_kriteria->range_nilai),
            'id_bobot'         => set_value("bobot", $data_kriteria->id_bobot),
            'listAtribut'   => $this->KriteriaModel->get_all_atribut(),
        ];

        $this->load->view('header');
        $this->load->view('kriteria/formKriteria', $data);
        $this->load->view('footer');
    }

    public function edit_kriteria_action()
    {
        $id_kriteria  = $this->input->post("id_kriteria");

        $data = [
            'id_atribut'    => $this->input->post("id_atribut"),
            'range_nilai'   => $this->input->post("range_nilai"),
            'id_bobot'      => $this->input->post("bobot"),
        ];

        $this->KriteriaModel->update_kriteria($id_kriteria, $data);

        $this->session->set_flashdata("flash_message", "Berhasil update data kriteria.");
        redirect(site_url("controllerKriteria"));
    }

    public function hapus_kriteria($id)
    {
        $data_kriteria = $this->KriteriaModel->get_by_id($id);

        if ($data_kriteria) {
            $this->KriteriaModel->delete_kriteria($id);
            $this->session->set_flashdata("flash_message", "Berhasil hapus data kriteria.");
            redirect(site_url("controllerKriteria"));

        } else {
            $this->session->set_flashdata("error_message", "Gagal hapus data kriteria.");
            redirect(site_url("controllerKriteria"));

        }
    }
}
