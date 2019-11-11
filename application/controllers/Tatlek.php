<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tatlek extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata("username")) {
            redirect('Template/login');
        }
        $this->load->model('m_barang');
        $this->load->model('m_transaksi');
        $this->load->model('m_kategori');
    }

    function index() {
        $data['eclat'] = $this->eclat_d();

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//
//        die();
        $data['konten'] = 'tatlek/v_index';
        $this->load->view('template/v_template', $data);
    }

    function eclat_d() {

        $barang_data = $this->m_barang->tampil_data();

        foreach ($barang_data as $key => $value) {
            $barang[$value->id_barang]['name'] = $value->nama_barang;
            $barang[$value->id_barang]['kode'] = $value->kode_barang;
            $barang[$value->id_barang]['id_transaksi'] = array();
        }



        $data_transaksi = $this->m_transaksi->tampil_data();

        foreach ($data_transaksi as $key => $value) {
            $transaksi[$value->id_transaksi]['id_barang'] = array();
            $barang_transaksi = $this->m_transaksi->tampil_detail($value->id_transaksi);

            foreach ($barang_transaksi as $key2 => $value2) {
                array_push($transaksi[$value->id_transaksi]['id_barang'], $value2->id_barang);
                foreach ($barang_transaksi as $key3 => $value3) {
                    if ($value2->id_barang != $value3->id_barang) {
                        if (empty($silang[$value2->id_barang][$value3->id_barang])) {
                            $silang[$value2->id_barang][$value3->id_barang] = array();
                            array_push($silang[$value2->id_barang][$value3->id_barang], $value->id_transaksi);
                        } else {
                            array_push($silang[$value2->id_barang][$value3->id_barang], $value->id_transaksi);
                        }
                    }
                }
            }
        }


        foreach ($transaksi as $id_transaksi => $value) {

            foreach ($value['id_barang'] as $key => $id_barang) {

                array_push($barang[$id_barang]['id_transaksi'], $id_transaksi);
            }
        }


        $total_transaksi = count($transaksi);


        $max_support['value'] = 0;
        $max_support['id_barang1'] = 0;
        $max_support['id_barang2'] = 0;

        $max_confidence['value'] = 0;
        $max_confidence['id_barang1'] = 0;
        $max_confidence['id_barang2'] = 0;

        foreach ($silang as $id_barang1 => $array1) {
            foreach ($array1 as $id_barang2 => $value) {
//                echo '<br>' . $id_barang1 . '=>' . $id_barang2 . ' = ' . count($silang[$id_barang1][$id_barang2]);

                if (count($silang[$id_barang1][$id_barang2]) > 1) {
                    $silang_seleksi[$id_barang1][$id_barang2] = $value;
                    $support[$id_barang1][$id_barang2] = count($silang[$id_barang1][$id_barang2]) / $total_transaksi;
                    $confidence[$id_barang1][$id_barang2] = count($silang[$id_barang1][$id_barang2]) / count($barang[$id_barang1]['id_transaksi']);

                    if ($max_support['value'] < $support[$id_barang1][$id_barang2]) {
                        $max_support['value'] = $support[$id_barang1][$id_barang2];
                        $max_support['id_barang1'] = $id_barang1;
                        $max_support['id_barang2'] = $id_barang2;
                    }

                    if ($max_confidence['value'] < $confidence[$id_barang1][$id_barang2]) {
                        $max_confidence['value'] = $confidence[$id_barang1][$id_barang2];
                        $max_confidence['id_barang1'] = $id_barang1;
                        $max_confidence['id_barang2'] = $id_barang2;
                    }
                }
            }
        }
//     echo '<pre>';
        $data['barang'] = $barang;
        $data['transaksi'] = $transaksi;
        $data['silang'] = $silang;
        $data['seleksi'] = $silang_seleksi;
        $data['support'] = $support;
        $data['confidence'] = $confidence;


// print_r( $data['support'] );
// die();
        return $data;
    }

    function fpgrowth() {
        echo '<pre>';
        $barang_data = $this->m_barang->tampil_data();

        foreach ($barang_data as $key => $value) {
            $barang[$value->id_barang]['name'] = $value->nama_barang;
//          $barang[$value->id_barang]['id_transaksi'] = array();
            $barang[$value->id_barang]['total_transaksi'] = count($this->m_transaksi->ambil_data_transaksi($value->id_barang));
        }

//        print_r($barang);


        $data_transaksi = $this->m_transaksi->tampil_data();

        foreach ($data_transaksi as $key2 => $value) {
            $transaksi[$value->id_transaksi]['id_barang'] = array();
            $barang_transaksi = $this->m_transaksi->tampil_detail($value->id_transaksi);

            foreach ($barang_transaksi as $key3 => $value2) {
                array_push($transaksi[$value->id_transaksi]['id_barang'], $value2->id_barang);
            }
        }



        foreach ($barang_data as $age => $value) {
            $age = array($barang[$value->id_barang]['name'] => $barang[$value->id_barang]['total_transaksi']);
        }
        arsort($age);

        echo '---------------------------------------------------------------------------------------------------';

        echo 'Data Transaksi';
        echo '<br>';
        print_r($transaksi);



        echo '---------------------------------------------------------------------------------------------------';

        echo 'List Barang';
        echo '<br>';

        print_r($barang);

        echo '---------------------------------------------------------------------------------------------------';

        echo 'Sorting';
        echo '<br>';

        print_r($age);
    }

    function fpgrowthk() {
        echo '<pre>';
        $data_kategori = $this->m_kategori->tampil_data();

        foreach ($data_kategori as $key => $value) {
            $kategori[$value->id_kategori]['name'] = $value->nama_kategori;
            $kategori[$value->id_kategori]['id_transaksi'] = array();
        }


        $data_transaksi = $this->m_transaksi->tampil_data();

        foreach ($data_transaksi as $key => $value) {
            $barang_transaksi = $this->m_transaksi->tampil_detail_kategori($value->id_transaksi);
            if (count($barang_transaksi) >= 2) {
                $transaksi[$value->id_transaksi]['id_kategori'] = array();
                foreach ($barang_transaksi as $key2 => $value2) {
                    array_push($transaksi[$value->id_transaksi]['id_kategori'], $value2->id_kategori);
                    array_push($kategori[$value2->id_kategori]['id_transaksi'], $value->id_transaksi);
                }
            }
        }

        foreach ($kategori as $id_kategori => $value) {
            $kategori_short[$id_kategori] = count($value['id_transaksi']);
        }

        echo '---------------------------------------------------------------------------------------------------';

        echo 'Data Transaksi';
        echo '<br>';
        print_r($transaksi);



        echo '---------------------------------------------------------------------------------------------------';

        echo 'List Barang';
        echo '<br>';
        print_r($kategori);

//        print_r($barang);

        echo '---------------------------------------------------------------------------------------------------';

        echo 'Sorting';
        echo '<br>';
        arsort($kategori_short);
        print_r($kategori_short);

        $no = 1;
        foreach ($kategori_short as $id_kategori => $value) {
            $kategori[$id_kategori]['urutan'] = $no++;
        }

        echo '---------------------------------------------------------------------------------------------------';

        echo 'List Barang Urutan';
        echo '<br>';
        print_r($kategori);

        echo '---------------------------------------------------------------------------------------------------';
        echo '<br>';
        echo 'Kategori Urutan per transaksi';
        echo '<br>';
        foreach ($transaksi as $id_transaksi => $value) {

            foreach ($value['id_kategori'] as $key => $id_kategori) {
                $transaksi[$id_transaksi]['urutan_kategori'][$kategori[$id_kategori]['urutan']] = $id_kategori;
            }
            ksort($transaksi[$id_transaksi]['urutan_kategori']);
        }
        print_r($transaksi);


        $pohon['null'] = array();


        foreach ($transaksi as $id_transaksi => $value) {
            $transaksi[$id_transaksi]['urutan_kategori_text'] = "";

            foreach ($transaksi[$id_transaksi]['urutan_kategori']as $key => $id_kategori) {
             //   array_push($cabang, $id_kategori);
                  $transaksi[$id_transaksi]['urutan_kategori_text'] .= ".".$id_kategori;
            }
           // array_push($pohon, $cabang);
        }
        print_r($transaksi);
    }

}
