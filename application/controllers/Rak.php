<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rak extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_rak');
        $this->load->model('m_barang');
        $this->load->helper('url');
    }

    function index() {
        $data['rak'] = $this->m_rak->tampil_data();
        $data['konten'] = 'rak/v_table';
        $this->load->view('template/v_template', $data);
    }

    function form() {
        $data['barang'] = $this->m_barang->tampil_data();
        $data['konten'] = 'rak/v_form';
        $this->load->view('template/v_template', $data);
    }

    function input() {
        $no_rak = $this->input->post('NoRak');
        $lokasi = $this->input->post('Lokasi');
        $id_barang = $this->input->post('id_barang');

        $data = array(
            'no_rak' => $no_rak,
            'lokasi' => $lokasi,
            'id_barang' => $id_barang
        );
        $this->m_rak->input_data($data, 'rak');
        redirect('rak');
    }

    function hapus($id_rak) {
        $where = array('id_rak' => $id_rak);
        $this->m_rak->hapus_data($where, 'rak');
        redirect('rak');
    }

    function edit($id_rak) {
        $where = array('id_rak' => $id_rak);
        $data['rak'] = $this->m_rak->edit_data($where, 'rak')->result();
        $data['barang'] = $this->m_barang->tampil_data();
        $data['konten'] = 'rak/v_edit';
        $this->load->view('template/v_template', $data);
    }

    function update() {
        $id_rak = $this->input->post('id_rak');
        $id_barang = $this->input->post('id_barang');
        $no_rak = $this->input->post('NoRak');
        $lokasi = $this->input->post('Lokasi');

        $data = array(
            'no_rak' => $no_rak,
            'lokasi' => $lokasi,
            'id_barang' => $id_barang
        );
        $where = array(
            'id_rak' => $id_rak
        );
        $this->m_rak->update_data($where, $data, 'rak');
        redirect('Rak');
    }

}
