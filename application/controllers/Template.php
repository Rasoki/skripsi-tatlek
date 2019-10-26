<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_login');
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    public function login() {


        if ($this->session->userdata("username")) {
            redirect('Dashboard');
        }
        $this->load->view('template/v_login');
    }

    function aksi_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'username' => $username,
            'password' => md5($password)
        );
        $cek = $this->m_login->cek_login("akun", $where)->row();
        if (count($cek) > 0) {

            $data_session = array(
                'username' => $username,
                'jabatan' => $cek->jabatan
            );

            $this->session->set_userdata($data_session);

            redirect('Dashboard');
        } else {
            echo "Username dan password salah !";
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('Template/login');
    }

//    public function dashboard() {
//        $this->load->view('template/v_dashboard');
//    }
//
//    public function table() {
//        $this->load->view('template/v_table');
//    }
//
//    public function form() {
//        $this->load->view('template/v_form');
//    }
}
