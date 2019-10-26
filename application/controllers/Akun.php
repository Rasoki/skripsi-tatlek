<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata("username")) {
            redirect('Template/login');
        }

        $this->load->model('m_akun');
        $this->load->helper('url');
    }

    function index() {
        $data['akun'] = $this->m_akun->tampil_data()->result();
        $data['konten'] = 'akun/v_table';
        $this->load->view('template/v_template', $data);
    }

    function form() {

        $data['konten'] = 'akun/v_form';
        $this->load->view('template/v_template', $data);
    }

    function input() {
        $username = $this->input->post('Username');
        $password = $this->input->post('Password');
        $jabatan = $this->input->post('Jabatan');

        $data = array(
            'username' => $username,
            'password' => $password,
            'jabatan' => $jabatan
        );
        $this->m_akun->input_data($data, 'akun');
        redirect('akun');
    }

    function hapus($id_akun) {
        $where = array('id_akun' => $id_akun);
        $this->m_akun->hapus_data($where, 'akun');
        redirect('akun');
    }

    function edit($id_akun) {
        $where = array('id_akun' => $id_akun);
        $data['akun'] = $this->m_akun->edit_data($where, 'akun')->result();
        $data['konten'] = 'akun/v_edit';
        $this->load->view('template/v_template', $data);
    }

    function update() {
        $id_akun = $this->input->post('id_akun');
        $username = $this->input->post('Username');
        $password = $this->input->post('Password');
        $jabatan = $this->input->post('Jabatan');

        $data = array(
            'Username' => $username,
            'Password' => $password,
            'Jabatan' => $jabatan
        );
        $where = array(
            'id_akun' => $id_akun
        );
        $this->m_akun->update_data($where, $data, 'akun');
        redirect('Akun');
    }

}
