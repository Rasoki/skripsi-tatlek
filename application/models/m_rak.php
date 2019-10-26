<?php

class M_rak extends CI_Model {

    function tampil_data() {
        $this->db->join('barang', 'barang.id_barang = rak.id_barang', 'LEFT');
        $query = $this->db->get('rak');
        return $query->result();
    }

    function input_data($data, $table) {
        $this->db->insert($table, $data);
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
