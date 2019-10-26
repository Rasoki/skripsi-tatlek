<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata("username")) {
            redirect('Template/login');
        }
        $this->load->model('m_transaksi');
        $this->load->model('m_barang');
        $this->load->helper('url');
    }

    function index() {
        $data['konten'] = 'transaksi/v_table';
//                $data['konten'] = 'transaksi/v_form_detail';

        $data['transaksi'] = $this->m_transaksi->tampil_data();
        $this->load->view('template/v_template', $data);
    }

    function form() {
        //$data['konten'] = 'transaksi/v_table';
//        $data['transaksi'] = $this->m_transaksi->view_barang();
        $data['konten'] = 'transaksi/v_form';

//        var_dump($data); die;
        $this->load->view('template/v_template', $data);
    }

    function form_detail($id_transaksi) {
        $data['id_transaksi'] = $id_transaksi;
        $data['detail_transaksi'] = $this->m_transaksi->tampil_detail($id_transaksi);
        $data['barang'] = $this->m_barang->tampil_data();
        $data['konten'] = 'transaksi/v_form_detail';

        //var_dump($data); die;
        $this->load->view('template/v_template', $data);
    }

    function input() {

        $tgl = $this->input->post('Tanggal');
        $no_transaksi = $this->input->post('NoTransaksi');
        $dataTransaksi = array(
            'tanggal' => $tgl,
            'no_transaksi' => $no_transaksi
        );


        $id_transaksi = $this->m_transaksi->insert($dataTransaksi);

        redirect('transaksi/form_detail/' . $id_transaksi);
//        echo $id_transaksi;
//        die();
        //var_dump($sql->); die;
//
//        $transaksi = $this->m_transaksi->view_transaksi();
//        $query = $this->db->get('transaksi');
//
//
//        $counttransaksi = $query->num_rows();
//        $idtransaksi = ($transaksi[$counttransaksi - 1]->id_transaksi);
        // var_dump($idtransaksi); die;
        // end transaksi
        // detail transaksi
//        $total = $this->input->post('Total');
//        $total_harga = $this->input->post('TotalHarga');
//        $id_barang = $this->input->post('transaksi');
//
//        $datadetailTransaksi = array(
//            'total_harga' => $total_harga,
//            'total' => $total,
//            'id_transaksi' => intval($idtransaksi),
//            'id_barang' => $id_barang
//        );
//
//        $this->m_transaksi->input_data($datadetailTransaksi, 'detail_transaksi');
        // $this->db->insert('detail_transaksi', $datadetailTransaksi); 
        // end detail transaksi
//        $no_transaksi = $this->input->post('NoTransaksi');
//        $tanggal = $this->input->post('Tanggal');
//        $nama_barang = $this->input->post('NamaBarang');
//        $total = $this->input->post('Total');
//        $total_harga = $this->input->post('TotalHarga');
//
//        $data = array(
//            'no_transaksi' => $no_transaksi,
//            'tanggal' => $tanggal,
//            'nama_barang' => $nama_barang,
//            'total' => $total,
//            'total_harga' => $total_harga
//        );
//
//        $this->m_transaksi->input_data($data, 'transaksi');
        // redirect('transaksi');
    }

    function input_detail() {

        //ambil data harga barang

        $id_transaksi = $this->input->post('id_transaksi');
        $id_barang = $this->input->post('id_barang');
        $jumlah = $this->input->post('jumlah');


        $dataTransaksi = array(
            'id_transaksi' => $id_transaksi,
            'id_barang' => $id_barang,
            'jumlah' => $jumlah
        );

        $this->m_transaksi->insert_detail($dataTransaksi);

        redirect('transaksi/form_detail/' . $id_transaksi);

//        var_dump($id_detail); die;
    }

    function hapus($id_transaksi) {

        $where = array('id_transaksi' => $id_transaksi);
        $this->m_transaksi->hapus_data($where, 'transaksi');
        redirect('transaksi');
    }

    function hapus_detail($id_detail_transaksi, $id_transaksi) {

        $where = array('id_detail_transaksi' => $id_detail_transaksi);
        $this->m_transaksi->hapus_data($where, 'detail_transaksi');
        redirect('transaksi/form_detail/' . $id_transaksi);
    }

    function edit($id_transaksi) {
        $where = array('id_transaksi' => $id_transaksi);
        $data['transaksi'] = $this->m_transaksi->edit_data($where, 'transaksi')->result();
        $data['konten'] = 'transaksi/v_edit';
        $this->load->view('template/v_template', $data);
    }

    function update() {
        $id_transaksi = $this->input->post('id_transaksi');
        $no_transaksi = $this->input->post('no_transaksi');
        $tanggal = $this->input->post('tanggal');


        $data = array(
            'no_transaksi' => $no_transaksi,
            'tanggal' => $tanggal
        );
        $where = array(
            'id_transaksi' => $id_transaksi
        );
        $this->m_transaksi->update_data($where, $data, 'transaksi');
        redirect('Transaksi');
    }

    function edit_detail($id_detail_transaksi) {
        $where = array('id_detail_transaksi' => $id_detail_transaksi);
        $data['detail_transaksi'] = $this->m_transaksi->edit_data($where, 'detail_transaksi')->row();
        $data['barang'] = $this->m_barang->tampil_data();

//        print_r($data);
//        die();
        $data['konten'] = 'transaksi/v_edit_detail';
        $this->load->view('template/v_template', $data);
    }

    function update_detail() {

//        die();
        $id_transaksi = $this->input->post('id_transaksi');
        $id_detail_transaksi = $this->input->post('id_detail_transaksi');
        $id_barang = $this->input->post('id_barang');
        $jumlah = $this->input->post('jumlah');

        $data = array(
            'id_barang' => $id_barang,
            'jumlah' => $jumlah
        );
        $where = array(
            'id_detail_transaksi' => $id_detail_transaksi
        );
        $this->m_transaksi->update_data($where, $data, 'detail_transaksi');

        redirect('transaksi/form_detail/' . $id_transaksi);
    }

}
