<?php

class M_barang extends CI_Model {

    function tampil_data() {
        $this->db->join('kategori', 'barang.id_kategori = kategori.id_kategori', 'LEFT');
        $query = $this->db->get('barang');
        return $query->result();
    }

    function input_data($data) {
        $this->db->insert('barang', $data);
        return $this->db->insert_id();
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

}
