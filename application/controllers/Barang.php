<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata("username")) {
            redirect('Template/login');
        }
        $this->load->model('m_barang');
        $this->load->model('m_kategori');
        $this->load->helper('url');
    }

    function index() {
        $data['konten'] = 'barang/v_table';
        $data['barang'] = $this->m_barang->tampil_data();

        $this->load->view('template/v_template', $data);
    }

    function form() {
        $data['kategori'] = $this->m_kategori->tampil_data();
        $data['konten'] = 'barang/v_form';
        $this->load->view('template/v_template', $data);
//        var_dump($data);        die();
    }

    function input() {
        $id_kategori = $this->input->post('id_kategori');
        $kode_barang = $this->input->post('KodeBarang');
        $nama_barang = $this->input->post('NamaBarang');
        $jum_barang = $this->input->post('JumlahBarang');
        $harga_barang = $this->input->post('HargaBarang');
        $data = array(
            'id_kategori' => $id_kategori,
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang,
            'jum_barang' => $jum_barang,
            'harga_barang' => $harga_barang
        );
        $this->m_barang->input_data($data);
        redirect('barang');
    }

    function hapus($id_barang) {
        $where = array('id_barang' => $id_barang);
        $this->m_barang->hapus_data($where, 'barang');
        redirect('barang');
    }

    function edit($id_barang) {
        $where = array('id_barang' => $id_barang);
        $data['barang'] = $this->m_barang->edit_data($where, 'barang')->result();
        $data['kategori'] = $this->m_kategori->tampil_data();
        $data['konten'] = 'barang/v_edit';
        $this->load->view('template/v_template', $data);
    }

    function update() {
        $id_barang = $this->input->post('id_barang');
        $id_kategori = $this->input->post('id_kategori');
        $kode_barang = $this->input->post('KodeBarang');
        $nama_barang = $this->input->post('NamaBarang');
        $jum_barang = $this->input->post('JumlahBarang');

        $harga_barang = $this->input->post('HargaBarang');
        $data = array(
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang,
            'jum_barang' => $jum_barang,
            'id_kategori' => $id_kategori,
            'harga_barang' => $harga_barang
        );
        $where = array(
            'id_barang' => $id_barang
        );
        $this->m_barang->update_data($where, $data, 'barang');
        redirect('Barang');
    }

}
