<?php

class M_transaksi extends CI_Model {

    function tampil_data() {
//        SUM(barang.harga_barang*detail_transaksi.jumlah) as harga
        $this->db->select('transaksi.*, ');
        $this->db->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi', 'LEFT');
        $this->db->join('barang', 'barang.id_barang = detail_transaksi.id_barang', 'LEFT');
        $this->db->limit(2000, 0);
        $this->db->group_by('transaksi.id_transaksi');
        $query = $this->db->get('transaksi');
        return $query->result();
    }

//    function view_transaksi() {
//        $query = $this->db->query("SELECT * FROM transaksi");
//        return $query->result();
//    }

    function tampil_detail($id_transaksi) {
        $this->db->join('barang', 'barang.id_barang = detail_transaksi.id_barang', 'LEFT');
        $this->db->where('detail_transaksi.id_transaksi', $id_transaksi);
        $query = $this->db->get('detail_transaksi');
        return $query->result();
    }
    
     function tampil_detail_kategori($id_transaksi) {
        $this->db->join('barang', 'barang.id_barang = detail_transaksi.id_barang', 'LEFT');
        $this->db->where('detail_transaksi.id_transaksi', $id_transaksi);
        $this->db->group_by('barang.id_kategori');
        $query = $this->db->get('detail_transaksi');
        return $query->result();
    }

    function hapus_data($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function edit_data($where, $table) {
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $data, $table) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function insert($data) {
        $this->db->insert('transaksi', $data);
        return $this->db->insert_id();
    }

    function insert_detail($data) {
        $this->db->insert('detail_transaksi', $data);
        return $this->db->insert_id();
    }

    function ambil_data_transaksi($id_barang) {
        $this->db->where('detail_transaksi.id_barang', $id_barang);
        $query = $this->db->get('detail_transaksi');
        return $query->result();
    }

}
