<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerLogin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->model('LoginModel');
    }

    public function index()
    {
        if (empty($this->session->userdata("username"))) {
            $this->load->view("viewLogin");
        } else {
            redirect("ControllerHome");
        }
    }

    public function cekStatusLogin()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_message('required', '* {field} Harus diisi');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $username = $this->input->post("username", TRUE);
            $password = md5($this->input->post("password", TRUE));

            $where = ["username" => $username];
            $cek = $this->LoginModel->validasi("user", $where)->row_array();
            $username_db = $cek['username'];
            $password_db = $cek['password'];
            if ($username == $username && $password == $password_db) {

                $data_session = [
                    'username' => $username_db,
                    'level'    => $cek['level'],
                ];

                $this->session->set_userdata("session_login", $data_session);
                redirect(site_url("controllerHome"));
            } else {
                $this->session->set_flashdata("pesan", "Username atau Password salah.");
                redirect("ControllerLogin");
            }
        }
    }

    public function ubahPasssword()
    {
        $this->load->view("admin/header");
        $this->load->view('admin/formUbahPassword');
        $this->load->view("admin/footer");
    }

    public function ubahPasssword_action()
    {
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_message('required', '* {field} Harus diisi');

        if ($this->form_validation->run() == FALSE) {
            $this->ubahPasssword();
        } else {
            $username_lama  = $this->input->post("username_lama");
            $username       = $this->input->post("username");
            $password       = md5($this->input->post("password"));

            $data = [
                "username"  => $username,
                "password"  => $password
            ];
            $this->LoginModel->updateUser($username_lama, $data);
            $this->session->set_flashdata("success", "Berhasil ubah password");
            redirect("controllerHome");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect("controllerLogin");
    }
}
