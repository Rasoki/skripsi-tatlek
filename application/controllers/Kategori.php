<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata("username")) {
            redirect('Template/login');
        }
        $this->load->model('m_kategori');
        $this->load->helper('url');
    }

    function index() {
        $data['kategori'] = $this->m_kategori->tampil_data();
        $data['konten'] = 'kategori/v_table';
        $this->load->view('template/v_template', $data);
    }

    function form() {

        $data['konten'] = 'kategori/v_form';
        $this->load->view('template/v_template', $data);
    }

    function input() {
        $nama_kategori = $this->input->post('NamaKategori');
        $data = array(
            'nama_kategori' => $nama_kategori
        );
        $this->m_kategori->input_data($data, 'kategori');
        redirect('kategori');
    }

    function hapus($id_kategori) {
        $where = array('id_kategori' => $id_kategori);
        $this->m_kategori->hapus_data($where, 'kategori');
        redirect('kategori');
    }

    function edit($id_kategori) {
        $where = array('id_kategori' => $id_kategori);
        $data['kategori'] = $this->m_kategori->edit_data($where, 'kategori')->result();
        $data['konten'] = 'kategori/v_edit';
        $this->load->view('template/v_template', $data);
    }

    function update() {
        $id_kategori = $this->input->post('id_kategori');
        $nama_kategori = $this->input->post('NamaKategori');

        $data = array(
            'nama_kategori' => $nama_kategori,
        );

        $where = array(
            'id_kategori' => $id_kategori
        );

        $this->m_kategori->update_data($where, $data, 'kategori');
        redirect('Kategori');
    }

}
