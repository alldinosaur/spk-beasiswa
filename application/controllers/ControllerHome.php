<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerHome extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        // $this->load->model('HomeModel');
        $this->load->library('form_validation');
        $this->load->library('upload');
        if (empty($this->session->session_login['username'])) {
            $this->session->set_flashdata("pesan", "Anda harus login terlebih dahulu.");
            redirect(site_url("controllerLogin"));
        }
    }

    public function index()
    {     
        $this->load->view("header");
        $this->load->view("dashboard");
        $this->load->view("footer");
    }

}
