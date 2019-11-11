<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sample extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata("username")) {
            redirect('Template/login');
        }
        $this->load->model('m_kategori');
        $this->load->model('m_barang');
        $this->load->model('m_transaksi');
        $this->load->helper('url');
    }

//    function eclat_dinamis() {
//        echo '<pre>';
//        //$transaksi = $this->db->select('id_barang')->get('detail_transaksi')->result_array() ;
//        $barang = $this->db->select(' barang.nama_barang , detail_transaksi.id_transaksi   ')->from('detail_transaksi')->join('barang', 'detail_transaksi.id_barang = barang.id_barang', 'LEFT')->get()->result_array();
//
//        echo 'data barang';
//        echo '<br>';
//
//        return print_r($barang);
//    }
//
//    function eclat_dinamis2() {
//        $this->eclat_dinamis();
//
//        echo '<pre>';
//        $id_transaksi = $this->db->select('id_transaksi')
//                ->from('detail_transaksi')
//                ->group_by('id_transaksi')
//                ->get()
//                ->result_array();
//
//        foreach ($id_transaksi as $id_t) {
//            $id_barang = $this->db->select('id_barang')
//                    ->from('detail_transaksi')
//                    ->where('id_transaksi', $id_t['id_transaksi'])
//                    ->get()
//                    ->result_array();
//            $data1[][$id_t['id_transaksi']] = $id_barang;
//        }
//
//        return print_r($data1);
//    }

    function eclat_d() {
        echo '<pre>';
        $barang_data = $this->m_barang->tampil_data();

        foreach ($barang_data as $key => $value) {
            $barang[$value->id_barang]['name'] = $value->nama_barang;
            $barang[$value->id_barang]['id_transaksi'] = array();
//            $barang[$value->id_barang]['total_transaksi'] = count($this->m_transaksi->ambil_data_transaksi($value->id_barang));
        }

//        print_r($barang);


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
        echo '---------------------------------------------------------------------------------------------------';

        echo 'data Transaksi';
        echo '<br>';

        print_r($transaksi);

        foreach ($transaksi as $id_transaksi => $value) {

            foreach ($value['id_barang'] as $key => $id_barang) {

                array_push($barang[$id_barang]['id_transaksi'], $id_transaksi);
            }
        }

        echo '---------------------------------------------------------------------------------------------------';
        echo 'List Item';
        echo '<br>';

        print_r($barang);

        echo '<br>';
        echo '---------------------------------------------------------------------------------------------------';

        echo 'Silang';
        echo '<br>';
//        foreach ($barang as $id_barang1 => $value) {
////              echo '<br>';
////                echo $id_barang;
//            foreach ($barang as $id_barang2 => $value2) {
//                if ($id_barang1 != $id_barang2) {
////                    $silang[$id_barang1][$id_barang2] = array();
////                    
////                     echo '<br>';
////                echo $id_barang1.'*'.$id_barang2;
//                }
//            }
//        }
        print_r($silang);
        $total_transaksi = count($transaksi);


        $max_support['value'] = 0;
        $max_support['id_barang1'] = 0;
        $max_support['id_barang2'] = 0;

        $max_confidence['value'] = 0;
        $max_confidence['id_barang1'] = 0;
        $max_confidence['id_barang2'] = 0;
        echo '<br>';
        foreach ($silang as $id_barang1 => $array1) {
            foreach ($array1 as $id_barang2 => $value) {
                echo '<br>' . $id_barang1 . '=>' . $id_barang2 . ' = ' . count($silang[$id_barang1][$id_barang2]);

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
        echo '<br>';
        echo '---------------------------------------------------------------------------------------------------';

        echo '<br>';
        echo 'Hasil Seleksi';
        echo '<br>';

        print_r($silang_seleksi);
        echo '<br>';
        echo '---------------------------------------------------------------------------------------------------';

        echo '<br>';
        echo '<br>';
        echo 'Total Transaksi';
        echo '<br>';

        print_r($total_transaksi);

        echo '<br>';
        echo '---------------------------------------------------------------------------------------------------';


        echo '<br>';
        echo 'Support';
        echo '<br>';

        print_r($support);

        echo '<br>';
        echo '---------------------------------------------------------------------------------------------------';
        echo '<br>';
        echo 'confidence';
        echo '<br>';
        echo '<br>';
        print_r($confidence);
        echo '<br>';
        echo '---------------------------------------------------------------------------------------------------';
        echo '<br>';
        echo 'Support Terbaik';
        echo '<br>';
        echo '<br>';
        print_r($max_support);
        echo '<br>';
        echo '---------------------------------------------------------------------------------------------------';
        echo '<br>';
        echo 'Confidence Terbaik';
        echo '<br>';
        echo '<br>';
        print_r($max_confidence);
        echo '</pre>';
    }

    function eclat_dk() {
        echo '<pre>';

        $data_kategori = $this->m_kategori->tampil_data();

        foreach ($data_kategori as $key => $value) {
            $kategori[$value->id_kategori]['name'] = $value->nama_kategori;
            $kategori[$value->id_kategori]['id_transaksi'] = array();
        }
        
         print_r($kategori);

//        $barang_data = $this->m_barang->tampil_data();
//
//        foreach ($barang_data as $key => $value) {
//            $barang[$value->id_barang]['name'] = $value->nama_barang;
//            $barang[$value->id_barang]['id_transaksi'] = array();
//        }

//
////        print_r($barang);
//
//
        $data_transaksi = $this->m_transaksi->tampil_data();

        foreach ($data_transaksi as $key => $value) {
            $transaksi[$value->id_transaksi]['id_kategori'] = array();
            $barang_transaksi = $this->m_transaksi->tampil_detail($value->id_transaksi);

            foreach ($barang_transaksi as $key2 => $value2) {
                array_push($transaksi[$value->id_transaksi]['id_kategori'], $value2->id_kategori);
                foreach ($barang_transaksi as $key3 => $value3) {
                    if ($value2->id_kategori != $value3->id_kategori) {
                        if (empty($silang[$value2->id_kategori][$value3->id_kategori])) {
                            $silang[$value2->id_kategori][$value3->id_kategori] = array();
                            array_push($silang[$value2->id_kategori][$value3->id_kategori], $value->id_transaksi);
                        } else {
                            array_push($silang[$value2->id_kategori][$value3->id_kategori], $value->id_transaksi);
                        }
                    }
                }
            }
        }
         echo '<br>';
        echo '---------------------------------------------------------------------------------------------------';

        echo 'data Transaksi';
        echo '<br>';

        print_r($transaksi);
//
//        foreach ($transaksi as $id_transaksi => $value) {
//
//            foreach ($value['id_barang'] as $key => $id_barang) {
//
//                array_push($barang[$id_barang]['id_transaksi'], $id_transaksi);
//            }
//        }
//
//        echo '---------------------------------------------------------------------------------------------------';
//        echo 'List Item';
//        echo '<br>';
//
//        print_r($barang);
//
//        echo '<br>';
//        echo '---------------------------------------------------------------------------------------------------';
//
//        echo 'Silang';
//        echo '<br>';
//        print_r($silang);
//        $total_transaksi = count($transaksi);
//
//
//        $max_support['value'] = 0;
//        $max_support['id_barang1'] = 0;
//        $max_support['id_barang2'] = 0;
//
//        $max_confidence['value'] = 0;
//        $max_confidence['id_barang1'] = 0;
//        $max_confidence['id_barang2'] = 0;
//        echo '<br>';
//        foreach ($silang as $id_barang1 => $array1) {
//            foreach ($array1 as $id_barang2 => $value) {
//                echo '<br>' . $id_barang1 . '=>' . $id_barang2 . ' = ' . count($silang[$id_barang1][$id_barang2]);
//
//                if (count($silang[$id_barang1][$id_barang2]) > 1) {
//                    $silang_seleksi[$id_barang1][$id_barang2] = $value;
//                    $support[$id_barang1][$id_barang2] = count($silang[$id_barang1][$id_barang2]) / $total_transaksi;
//                    $confidence[$id_barang1][$id_barang2] = count($silang[$id_barang1][$id_barang2]) / count($barang[$id_barang1]['id_transaksi']);
//
//                    if ($max_support['value'] < $support[$id_barang1][$id_barang2]) {
//                        $max_support['value'] = $support[$id_barang1][$id_barang2];
//                        $max_support['id_barang1'] = $id_barang1;
//                        $max_support['id_barang2'] = $id_barang2;
//                    }
//
//                    if ($max_confidence['value'] < $confidence[$id_barang1][$id_barang2]) {
//                        $max_confidence['value'] = $confidence[$id_barang1][$id_barang2];
//                        $max_confidence['id_barang1'] = $id_barang1;
//                        $max_confidence['id_barang2'] = $id_barang2;
//                    }
//                }
//            }
//        }
//        echo '<br>';
//        echo '---------------------------------------------------------------------------------------------------';
//
//        echo '<br>';
//        echo 'Hasil Seleksi';
//        echo '<br>';
//
//        print_r($silang_seleksi);
//        echo '<br>';
//        echo '---------------------------------------------------------------------------------------------------';
//
//        echo '<br>';
//        echo '<br>';
//        echo 'Total Transaksi';
//        echo '<br>';
//
//        print_r($total_transaksi);
//
//        echo '<br>';
//        echo '---------------------------------------------------------------------------------------------------';
//
//
//        echo '<br>';
//        echo 'Support';
//        echo '<br>';
//
//        print_r($support);
//
//        echo '<br>';
//        echo '---------------------------------------------------------------------------------------------------';
//        echo '<br>';
//        echo 'confidence';
//        echo '<br>';
//        echo '<br>';
//        print_r($confidence);
//        echo '<br>';
//        echo '---------------------------------------------------------------------------------------------------';
//        echo '<br>';
//        echo 'Support Terbaik';
//        echo '<br>';
//        echo '<br>';
//        print_r($max_support);
//         echo '<br>';
//        echo '---------------------------------------------------------------------------------------------------';
//        echo '<br>';
//        echo 'Confidence Terbaik';
//        echo '<br>';
//        echo '<br>';
//        print_r($max_confidence);
        echo '</pre>';
    }

    function eclat() {


        echo '<pre>';


        $barang[1]['name'] = 'PENSIL HB METALIK KIKO';
        $barang[1]['id_transaksi'] = array();
//        $barang[1]['id_barang'] = 1;

        $barang[2]['name'] = 'LIP/EYE PENSIL';
        $barang[2]['id_transaksi'] = array();

        $barang[3]['name'] = 'CRAYON TITI 12C MINI';
        $barang[3]['id_transaksi'] = array();

        $barang[4]['name'] = 'HVS A4S 80 SIDU';
        $barang[4]['id_transaksi'] = array();

        $barang[5]['name'] = 'PENSIL LCS JAPAN';
        $barang[5]['id_transaksi'] = array();

        $barang[6]['name'] = 'PENSIL INTERFANY 2B';
        $barang[6]['id_transaksi'] = array();

        $barang[7]['name'] = 'MECH PENSIL KENKO MP-808';
        $barang[7]['id_transaksi'] = array();

        $barang[8]['name'] = 'HVS A4S 80 SIDU';
        $barang[8]['id_transaksi'] = array();

        $barang[9]['name'] = 'ISI PENSIL D^BEST 2B';
        $barang[9]['id_transaksi'] = array();

        $barang[10]['name'] = 'MECH.PENSIL BP-899/BP-836';
        $barang[10]['id_transaksi'] = array();

        $barang[11]['name'] = 'CRAYON TITI 12C PUTAR';
        $barang[11]['id_transaksi'] = array();

        $barang[12]['name'] = 'CORR. TAPE JOYKO CT-507';
        $barang[12]['id_transaksi'] = array();

        $barang[13]['name'] = 'HVS A4S 70 E PAPER';
        $barang[13]['id_transaksi'] = array();

        $barang[14]['name'] = 'MECH.PENSIL UNICORN';
        $barang[14]['id_transaksi'] = array();

        $barang[15]['name'] = 'HVS A4 80 SIDU';
        $barang[15]['id_transaksi'] = array();

        $barang[16]['name'] = 'BUKU FOLIO 50 SRITI';
        $barang[16]['id_transaksi'] = array();

        $barang[17]['name'] = 'PENSIL BENSIA DISR';
        $barang[17]['id_transaksi'] = array();

        $barang[18]['name'] = 'SPIDOL 12W PELANGI';
        $barang[18]['id_transaksi'] = array();

        $barang[19]['name'] = 'PENSIL L.TREE 0818-2B';
        $barang[19]['id_transaksi'] = array();

        $barang[20]['name'] = 'BUKU KAS FOLIO 100/3/2 GK';
        $barang[20]['id_transaksi'] = array();

        $barang[21]['name'] = 'PENSIL BENSIA PAEW-M9';
        $barang[21]['id_transaksi'] = array();

        $barang[22]['name'] = 'PENSIL JOYKO GLASS PG200';
        $barang[22]['id_transaksi'] = array();

        $barang[23]['name'] = 'KERTAS HVS 70 F4 SIDU ECER';
        $barang[23]['id_transaksi'] = array();

        $barang[24]['name'] = 'CORR. PEN';
        $barang[24]['id_transaksi'] = array();

        $barang[25]['name'] = 'MECH.PENSIL BP-1070 YIBAI BIYE';
        $barang[25]['id_transaksi'] = array();

        $barang[26]['name'] = 'PENSIL';
        $barang[26]['id_transaksi'] = array();

        $barang[27]['name'] = 'BUKU OKIMURA';
        $barang[27]['id_transaksi'] = array();

        $barang[28]['name'] = 'BLP.JK VENUS';
        $barang[28]['id_transaksi'] = array();

        $barang[29]['name'] = 'MECH.PENSIL BP-1070 YIBAI BIYE';
        $barang[29]['id_transaksi'] = array();

        $barang[30]['name'] = 'MECH.PENSIL';
        $barang[30]['id_transaksi'] = array();

        $barang[31]['name'] = 'JANGKA JOYKO MS-55 PENSIL';
        $barang[31]['id_transaksi'] = array();

        $barang[32]['name'] = 'STANDARD BUKU POHON MC 6200';
        $barang[32]['id_transaksi'] = array();

        $barang[33]['name'] = 'SPIDOL SWMAN MARKER G-12';
        $barang[33]['id_transaksi'] = array();

        $barang[34]['name'] = 'PEMBATAS BUKU';
        $barang[34]['id_transaksi'] = array();

        $barang[35]['name'] = 'BUKU TAMU KENKO';
        $barang[35]['id_transaksi'] = array();

        $barang[36]['name'] = 'BUKU TULIS CAMPUS BOXI (144)';
        $barang[36]['id_transaksi'] = array();

        $barang[37]['name'] = 'BLP+MECH PENSIL';
        $barang[37]['id_transaksi'] = array();

        $barang[38]['name'] = 'PENGHAPUS W/B+2 SPIDOL TF 222';
        $barang[38]['id_transaksi'] = array();

        $barang[39]['name'] = 'PENGGARIS EXCLUSIVE 30 CM';
        $barang[39]['id_transaksi'] = array();


        $barang[40]['name'] = 'PENSIL BENSIA STIP HB';
        $barang[40]['id_transaksi'] = array();

        echo 'data barang';
        echo '<br>';

        print_r($barang);

        $transaksi[1]['id_barang'] = array(1, 2, 40, 11, 20);
        $transaksi[2]['id_barang'] = array(3, 4, 40, 20, 23);
        $transaksi[3]['id_barang'] = array(5, 6, 40, 12, 21);
        $transaksi[4]['id_barang'] = array(7, 8, 11, 20, 30);
        $transaksi[5]['id_barang'] = array(9, 4, 10, 21, 31);
        $transaksi[6]['id_barang'] = array(2, 10, 15, 26, 32);
        $transaksi[7]['id_barang'] = array(11, 12, 13, 22, 30);
        $transaksi[8]['id_barang'] = array(14, 4, 30, 40, 20);
        $transaksi[9]['id_barang'] = array(15, 2, 30, 21, 11);
        $transaksi[10]['id_barang'] = array(16, 2, 5, 10, 30);
        $transaksi[11]['id_barang'] = array(17, 18, 15, 20, 30);
        $transaksi[12]['id_barang'] = array(19, 20, 4, 2, 30);
        $transaksi[13]['id_barang'] = array(21, 22, 34, 36, 2);
        $transaksi[14]['id_barang'] = array(8, 2, 22, 34, 36);
        $transaksi[15]['id_barang'] = array(2, 8, 22, 30, 11);
        $transaksi[16]['id_barang'] = array(2, 9, 19, 39, 20);
        $transaksi[17]['id_barang'] = array(2, 23, 4, 11, 30);
        $transaksi[18]['id_barang'] = array(5, 23, 6, 17, 31);
        $transaksi[19]['id_barang'] = array(24, 25, 9, 13, 22);
        $transaksi[20]['id_barang'] = array(26, 23, 24, 15, 16);
        $transaksi[21]['id_barang'] = array(27, 28, 29, 40, 39, 21);
        $transaksi[22]['id_barang'] = array(30, 31, 13, 21, 38, 1);
        $transaksi[23]['id_barang'] = array(32, 33, 1, 7, 10);
        $transaksi[24]['id_barang'] = array(34, 35, 13, 20, 5);
        $transaksi[25]['id_barang'] = array(36, 37, 1, 10, 12);
        $transaksi[26]['id_barang'] = array(38, 39, 2, 40, 15);
        $transaksi[27]['id_barang'] = array(11, 23, 24, 15, 10);
        $transaksi[28]['id_barang'] = array(25, 27, 18, 11, 5);
        $transaksi[29]['id_barang'] = array(2, 23, 39, 28, 13);
        $transaksi[30]['id_barang'] = array(3, 40, 1, 2, 15);



        echo 'data Transaksi';
        echo '<br>';

        print_r($transaksi);

        foreach ($transaksi as $id_transaksi => $value) {

            foreach ($value['id_barang'] as $key => $id_barang) {

                array_push($barang[$id_barang]['id_transaksi'], $id_transaksi);
            }
        }

        echo 'List Item';
        echo '<br>';

        print_r($barang);


        $silang[1][2] = array(1, 30);
        $silang[1][3] = array(30);
        $silang[1][4] = array();
        $silang[1][5] = array();
        $silang[1][6] = array();
        $silang[1][7] = array(23);
        $silang[1][8] = array();
        $silang[1][9] = array();
        $silang[1][10] = array(23, 25);
        $silang[1][11] = array(1);
        $silang[1][12] = array(25);
        $silang[1][13] = array(22);
        $silang[1][14] = array();
        $silang[1][15] = array(30);
        $silang[1][16] = array();
        $silang[1][17] = array();
        $silang[1][18] = array();
        $silang[1][19] = array();
        $silang[1][20] = array(1);
        $silang[1][21] = array(22);
        $silang[1][22] = array();
        $silang[1][23] = array();
        $silang[1][24] = array();
        $silang[1][25] = array();
        $silang[1][26] = array();
        $silang[1][27] = array();
        $silang[1][28] = array();
        $silang[1][29] = array();
        $silang[1][30] = array(22);
        $silang[1][31] = array(22);
        $silang[1][32] = array(23);
        $silang[1][33] = array(23);
        $silang[1][34] = array();
        $silang[1][35] = array();
        $silang[1][36] = array(25);
        $silang[1][37] = array(25);
        $silang[1][38] = array(22);
        $silang[1][39] = array();
        $silang[1][40] = array(1, 30);

        $silang[2][1] = array(1, 30);
        $silang[2][3] = array(30);
        $silang[2][4] = array(12, 17);
        $silang[2][5] = array(10);
        $silang[2][6] = array();
        $silang[2][7] = array();
        $silang[2][8] = array(14, 15);
        $silang[2][9] = array(16);
        $silang[2][10] = array(10);
        $silang[2][11] = array(1, 15, 17);
        $silang[2][12] = array();
        $silang[2][13] = array();
        $silang[2][14] = array();
        $silang[2][15] = array(6, 9, 26, 30);
        $silang[2][16] = array(10);
        $silang[2][17] = array();
        $silang[2][18] = array();
        $silang[2][19] = array(12, 16);
        $silang[2][20] = array(1, 12, 16);
        $silang[2][21] = array(9, 13);
        $silang[2][22] = array(13, 14, 15);
        $silang[2][23] = array(17, 29);
        $silang[2][24] = array();
        $silang[2][25] = array();
        $silang[2][26] = array(6);
        $silang[2][27] = array(29);
        $silang[2][28] = array();
        $silang[2][29] = array();
        $silang[2][30] = array(9, 10, 12, 15, 17);
        $silang[2][31] = array();
        $silang[2][32] = array(6);
        $silang[2][33] = array();
        $silang[2][34] = array();
        $silang[2][35] = array();
        $silang[2][36] = array(13, 14);
        $silang[2][37] = array();
        $silang[2][38] = array(26);
        $silang[2][39] = array(16, 26, 29);
        $silang[2][40] = array(1, 26, 30);

        $silang[3][1] = array(30);
        $silang[3][2] = array(30);
        $silang[3][4] = array(2);
        $silang[3][5] = array();
        $silang[3][6] = array();
        $silang[3][7] = array();
        $silang[3][8] = array();
        $silang[3][9] = array();
        $silang[3][10] = array();
        $silang[3][11] = array();
        $silang[3][12] = array();
        $silang[3][13] = array();
        $silang[3][14] = array();
        $silang[3][15] = array(30);
        $silang[3][16] = array();
        $silang[3][17] = array();
        $silang[3][18] = array();
        $silang[3][19] = array();
        $silang[3][20] = array(2);
        $silang[3][21] = array();
        $silang[3][22] = array();
        $silang[3][23] = array(2);
        $silang[3][24] = array();
        $silang[3][25] = array();
        $silang[3][26] = array();
        $silang[3][27] = array();
        $silang[3][28] = array();
        $silang[3][29] = array();
        $silang[3][30] = array();
        $silang[3][31] = array();
        $silang[3][32] = array();
        $silang[3][33] = array();
        $silang[3][34] = array();
        $silang[3][35] = array();
        $silang[3][36] = array();
        $silang[3][37] = array();
        $silang[3][38] = array();
        $silang[3][39] = array();
        $silang[3][40] = array(2, 30);

        $silang[4][1] = array();
        $silang[4][2] = array(12, 17);
        $silang[4][3] = array(2);
        $silang[4][5] = array(10);
        $silang[4][6] = array();
        $silang[4][7] = array();
        $silang[4][8] = array();
        $silang[4][9] = array(5);
        $silang[4][10] = array(5);
        $silang[4][11] = array();
        $silang[4][12] = array();
        $silang[4][13] = array();
        $silang[4][14] = array(8);
        $silang[4][15] = array();
        $silang[4][16] = array();
        $silang[4][17] = array();
        $silang[4][18] = array();
        $silang[4][19] = array();
        $silang[4][20] = array(2, 8, 12);
        $silang[4][21] = array(5);
        $silang[4][22] = array();
        $silang[4][23] = array(2, 17);
        $silang[4][24] = array();
        $silang[4][25] = array();
        $silang[4][26] = array();
        $silang[4][27] = array();
        $silang[4][28] = array();
        $silang[4][29] = array();
        $silang[4][30] = array(8, 12, 17);
        $silang[4][31] = array(5);
        $silang[4][32] = array();
        $silang[4][33] = array();
        $silang[4][34] = array();
        $silang[4][35] = array();
        $silang[4][36] = array();
        $silang[4][37] = array();
        $silang[4][38] = array();
        $silang[4][39] = array();
        $silang[4][40] = array(2, 8);

        //(3,10,18,24,28)
        $silang[5][1] = array();
        $silang[5][2] = array(10);
        $silang[5][3] = array();
        $silang[5][4] = array();
        $silang[5][6] = array(3, 18);
        $silang[5][7] = array();
        $silang[5][8] = array();
        $silang[5][9] = array();
        $silang[5][10] = array(10);
        $silang[5][11] = array(17);
        $silang[5][12] = array(3);
        $silang[5][13] = array();
        $silang[5][14] = array();
        $silang[5][15] = array();
        $silang[5][16] = array(10);
        $silang[5][17] = array();
        $silang[5][18] = array();
        $silang[5][19] = array();
        $silang[5][20] = array(24);
        $silang[5][21] = array(3);
        $silang[5][22] = array();
        $silang[5][23] = array(18);
        $silang[5][24] = array();
        $silang[5][25] = array();
        $silang[5][26] = array();
        $silang[5][27] = array(28);
        $silang[5][28] = array();
        $silang[5][29] = array();
        $silang[5][30] = array(10);
        $silang[5][31] = array(18);
        $silang[5][32] = array();
        $silang[5][33] = array();
        $silang[5][34] = array(24);
        $silang[5][35] = array(24);
        $silang[5][36] = array();
        $silang[5][37] = array();
        $silang[5][38] = array();
        $silang[5][39] = array();
        $silang[5][40] = array();

//        (3,18)
        $silang[6][1] = array();
        $silang[6][2] = array();
        $silang[6][3] = array();
        $silang[6][4] = array();
        $silang[6][5] = array(3, 18);
        $silang[6][7] = array();
        $silang[6][8] = array();
        $silang[6][9] = array();
        $silang[6][10] = array();
        $silang[6][11] = array();
        $silang[6][12] = array(3);
        $silang[6][13] = array();
        $silang[6][14] = array();
        $silang[6][15] = array();
        $silang[6][16] = array();
        $silang[6][17] = array(18);
        $silang[6][18] = array();
        $silang[6][19] = array();
        $silang[6][20] = array();
        $silang[6][21] = array(3);
        $silang[6][22] = array();
        $silang[6][23] = array();
        $silang[6][24] = array();
        $silang[6][25] = array();
        $silang[6][26] = array();
        $silang[6][27] = array();
        $silang[6][28] = array();
        $silang[6][29] = array();
        $silang[6][30] = array();
        $silang[6][31] = array();
        $silang[6][32] = array(18);
        $silang[6][33] = array();
        $silang[6][34] = array();
        $silang[6][35] = array();
        $silang[6][36] = array(13, 14);
        $silang[6][37] = array();
        $silang[6][38] = array();
        $silang[6][39] = array();
        $silang[6][40] = array(3);

        //(4,23)
        $silang[7][1] = array(23);
        $silang[7][2] = array();
        $silang[7][3] = array();
        $silang[7][4] = array();
        $silang[7][5] = array();
        $silang[7][6] = array();
        $silang[7][8] = array();
        $silang[7][9] = array();
        $silang[7][10] = array(23);
        $silang[7][11] = array(4);
        $silang[7][12] = array();
        $silang[7][13] = array();
        $silang[7][14] = array();
        $silang[7][15] = array();
        $silang[7][16] = array();
        $silang[7][17] = array();
        $silang[7][18] = array();
        $silang[7][19] = array();
        $silang[7][20] = array(4);
        $silang[7][21] = array();
        $silang[7][22] = array();
        $silang[7][23] = array();
        $silang[7][24] = array();
        $silang[7][25] = array();
        $silang[7][26] = array();
        $silang[7][27] = array();
        $silang[7][28] = array();
        $silang[7][29] = array();
        $silang[7][30] = array(4);
        $silang[7][31] = array();
        $silang[7][32] = array(23);
        $silang[7][33] = array(23);
        $silang[7][34] = array();
        $silang[7][35] = array();
        $silang[7][36] = array();
        $silang[7][37] = array();
        $silang[7][38] = array();
        $silang[7][39] = array();
        $silang[7][40] = array();

        //(4,14,15)
        $silang[8][1] = array();
        $silang[8][2] = array(14);
        $silang[8][3] = array();
        $silang[8][4] = array(10);
        $silang[8][5] = array();
        $silang[8][6] = array();
        $silang[8][7] = array();
        $silang[8][9] = array();
        $silang[8][10] = array();
        $silang[8][11] = array(4);
        $silang[8][12] = array();
        $silang[8][13] = array();
        $silang[8][14] = array();
        $silang[8][15] = array();
        $silang[8][16] = array();
        $silang[8][17] = array();
        $silang[8][18] = array();
        $silang[8][19] = array();
        $silang[8][20] = array(4);
        $silang[8][21] = array();
        $silang[8][22] = array(14, 15);
        $silang[8][23] = array();
        $silang[8][24] = array();
        $silang[8][25] = array();
        $silang[8][26] = array();
        $silang[8][27] = array();
        $silang[8][28] = array();
        $silang[8][29] = array();
        $silang[8][30] = array(14, 15);
        $silang[8][31] = array();
        $silang[8][32] = array();
        $silang[8][33] = array();
        $silang[8][34] = array(14);
        $silang[8][35] = array();
        $silang[8][36] = array(14);
        $silang[8][37] = array();
        $silang[8][38] = array();
        $silang[8][39] = array();
        $silang[8][40] = array();

        //(5,16,19)
        $silang[9][1] = array();
        $silang[9][2] = array(16);
        $silang[9][3] = array();
        $silang[9][4] = array(5);
        $silang[9][5] = array();
        $silang[9][6] = array();
        $silang[9][7] = array();
        $silang[9][8] = array();
        $silang[9][10] = array(5);
        $silang[9][11] = array();
        $silang[9][12] = array();
        $silang[9][13] = array();
        $silang[9][14] = array();
        $silang[9][15] = array();
        $silang[9][16] = array();
        $silang[9][17] = array();
        $silang[9][18] = array();
        $silang[9][19] = array(16);
        $silang[9][20] = array(16);
        $silang[9][21] = array();
        $silang[9][22] = array(19);
        $silang[9][23] = array();
        $silang[9][24] = array(19);
        $silang[9][25] = array(19);
        $silang[9][26] = array();
        $silang[9][27] = array();
        $silang[9][28] = array();
        $silang[9][29] = array();
        $silang[9][30] = array();
        $silang[9][31] = array(5);
        $silang[9][32] = array();
        $silang[9][33] = array();
        $silang[9][34] = array();
        $silang[9][35] = array();
        $silang[9][36] = array();
        $silang[9][37] = array();
        $silang[9][38] = array();
        $silang[9][39] = array();
        $silang[9][40] = array();

        //(5,6,10,23,25,27)
        $silang[10][1] = array(23, 25);
        $silang[10][2] = array(10);
        $silang[10][3] = array();
        $silang[10][4] = array(5);
        $silang[10][5] = array(10);
        $silang[10][6] = array();
        $silang[10][7] = array(23);
        $silang[10][8] = array();
        $silang[10][9] = array(5);
        $silang[10][11] = array(27);
        $silang[10][12] = array(25);
        $silang[10][13] = array();
        $silang[10][14] = array();
        $silang[10][15] = array(6, 27);
        $silang[10][16] = array(10);
        $silang[10][17] = array();
        $silang[10][18] = array();
        $silang[10][19] = array();
        $silang[10][20] = array();
        $silang[10][21] = array(5);
        $silang[10][22] = array();
        $silang[10][23] = array(27);
        $silang[10][24] = array(27);
        $silang[10][25] = array();
        $silang[10][26] = array(6);
        $silang[10][27] = array();
        $silang[10][28] = array();
        $silang[10][29] = array();
        $silang[10][30] = array(10);
        $silang[10][31] = array(5);
        $silang[10][32] = array(23);
        $silang[10][33] = array(23);
        $silang[10][34] = array();
        $silang[10][35] = array();
        $silang[10][36] = array(25);
        $silang[10][37] = array(25);
        $silang[10][38] = array();
        $silang[10][39] = array();
        $silang[10][40] = array(30);

        //(1,4,7,9,15,17,27,28)
        $silang[11][1] = array(1);
        $silang[11][2] = array(1, 9, 15, 17);
        $silang[11][3] = array();
        $silang[11][4] = array(17);
        $silang[11][5] = array(28);
        $silang[11][6] = array();
        $silang[11][7] = array(4);
        $silang[11][8] = array(4, 15);
        $silang[11][9] = array();
        $silang[11][10] = array(27);
        $silang[11][12] = array(7);
        $silang[11][13] = array(7);
        $silang[11][14] = array();
        $silang[11][15] = array(27);
        $silang[11][16] = array();
        $silang[11][17] = array();
        $silang[11][18] = array(28);
        $silang[11][19] = array();
        $silang[11][20] = array(1, 4);
        $silang[11][21] = array(9);
        $silang[11][22] = array(7, 15);
        $silang[11][23] = array(17, 27);
        $silang[11][24] = array(27);
        $silang[11][25] = array(28);
        $silang[11][26] = array();
        $silang[11][27] = array(28);
        $silang[11][28] = array();
        $silang[11][29] = array();
        $silang[11][30] = array(4, 7, 9, 15, 17);   //(1,4,7,9,15,17,27,28)
        $silang[11][31] = array();
        $silang[11][32] = array();
        $silang[11][33] = array();
        $silang[11][34] = array();
        $silang[11][35] = array();
        $silang[11][36] = array();
        $silang[11][37] = array();
        $silang[11][38] = array();
        $silang[11][39] = array();
        $silang[11][40] = array(1);

        //(3,7,25)
        $silang[12][1] = array(25);
        $silang[12][2] = array();
        $silang[12][3] = array();
        $silang[12][4] = array();
        $silang[12][5] = array(3);
        $silang[12][6] = array(3);
        $silang[12][7] = array();
        $silang[12][8] = array();
        $silang[12][9] = array();
        $silang[12][10] = array(25);
        $silang[12][11] = array(7);
        $silang[12][13] = array(7);
        $silang[12][14] = array();
        $silang[12][15] = array();
        $silang[12][16] = array();
        $silang[12][17] = array();
        $silang[12][18] = array();
        $silang[12][19] = array();
        $silang[12][20] = array();
        $silang[12][21] = array(3);
        $silang[12][22] = array(7);
        $silang[12][23] = array();        //(3,7,25)
        $silang[12][24] = array();
        $silang[12][25] = array();
        $silang[12][26] = array();
        $silang[12][27] = array();
        $silang[12][28] = array();
        $silang[12][29] = array();
        $silang[12][30] = array(7);
        $silang[12][31] = array();
        $silang[12][32] = array();
        $silang[12][33] = array();
        $silang[12][34] = array();
        $silang[12][35] = array();
        $silang[12][36] = array(25);
        $silang[12][37] = array(25);
        $silang[12][38] = array();
        $silang[12][39] = array();
        $silang[12][40] = array(3);

        //(7,19,22,24,29)
        $silang[13][1] = array();
        $silang[13][2] = array(29);
        $silang[13][3] = array();
        $silang[13][4] = array();
        $silang[13][5] = array(24);
        $silang[13][6] = array();
        $silang[13][7] = array();
        $silang[13][8] = array();
        $silang[13][9] = array(19);
        $silang[13][10] = array();
        $silang[13][11] = array(7);
        $silang[13][12] = array(7);
        $silang[13][14] = array();
        $silang[13][15] = array();
        $silang[13][16] = array();
        $silang[13][17] = array();
        $silang[13][18] = array();
        $silang[13][19] = array();
        $silang[13][20] = array(24); //(7,19,22,24,29)
        $silang[13][21] = array(22);
        $silang[13][22] = array(7, 19);
        $silang[13][23] = array(29);
        $silang[13][24] = array(19);
        $silang[13][25] = array(19);
        $silang[13][26] = array();
        $silang[13][27] = array();
        $silang[13][28] = array(29);
        $silang[13][29] = array();
        $silang[13][30] = array(7, 22);
        $silang[13][31] = array(22);
        $silang[13][32] = array();
        $silang[13][33] = array();
        $silang[13][34] = array(24);
        $silang[13][35] = array(24);
        $silang[13][36] = array();
        $silang[13][37] = array();
        $silang[13][38] = array(22);
        $silang[13][39] = array(29);
        $silang[13][40] = array();

        //(8)
        $silang[14][1] = array();
        $silang[14][2] = array();
        $silang[14][3] = array();
        $silang[14][4] = array(8);
        $silang[14][5] = array();
        $silang[14][6] = array();
        $silang[14][7] = array();
        $silang[14][8] = array();
        $silang[14][9] = array();
        $silang[14][10] = array();
        $silang[14][11] = array();
        $silang[14][12] = array();
        $silang[14][13] = array();
        $silang[14][15] = array();
        $silang[14][16] = array();
        $silang[14][17] = array();
        $silang[14][18] = array();
        $silang[14][19] = array();
        $silang[14][20] = array(8);
        $silang[14][21] = array();
        $silang[14][22] = array();
        $silang[14][23] = array();
        $silang[14][24] = array();
        $silang[14][25] = array();
        $silang[14][26] = array();
        $silang[14][27] = array();
        $silang[14][28] = array();
        $silang[14][29] = array();
        $silang[14][30] = array(8);
        $silang[14][31] = array();
        $silang[14][32] = array();
        $silang[14][33] = array();
        $silang[14][34] = array();
        $silang[14][35] = array();
        $silang[14][36] = array();
        $silang[14][37] = array();
        $silang[14][38] = array();
        $silang[14][39] = array();
        $silang[14][40] = array();

        //(6,9,11,20,26,27,30)
        $silang[15][1] = array(30);
        $silang[15][2] = array(6, 9, 26, 30);
        $silang[15][3] = array(30);
        $silang[15][4] = array();
        $silang[15][5] = array();
        $silang[15][6] = array();
        $silang[15][7] = array();
        $silang[15][8] = array();
        $silang[15][9] = array();
        $silang[15][10] = array(6, 27);
        $silang[15][11] = array(9, 27);
        $silang[15][12] = array();
        $silang[15][13] = array();
        $silang[15][14] = array();
        $silang[15][16] = array(20);
        $silang[15][17] = array(11);
        $silang[15][18] = array(11);
        $silang[15][19] = array();
        $silang[15][20] = array(11); //(6,9,11,20,26,27,30)
        $silang[15][21] = array(9);
        $silang[15][22] = array();
        $silang[15][23] = array(20, 27);
        $silang[15][24] = array(20, 27);
        $silang[15][25] = array();
        $silang[15][26] = array(6, 20);
        $silang[15][27] = array();
        $silang[15][28] = array();
        $silang[15][29] = array();
        $silang[15][30] = array(9, 11);
        $silang[15][31] = array();
        $silang[15][32] = array(6);
        $silang[15][33] = array();
        $silang[15][34] = array();
        $silang[15][35] = array();
        $silang[15][36] = array();
        $silang[15][37] = array();
        $silang[15][38] = array(26);
        $silang[15][39] = array(26);
        $silang[15][40] = array(26, 30);

        //(10,20)
        $silang[16][1] = array();
        $silang[16][2] = array(10);
        $silang[16][3] = array();
        $silang[16][4] = array();
        $silang[16][5] = array(10);
        $silang[16][6] = array();
        $silang[16][7] = array();
        $silang[16][8] = array();
        $silang[16][9] = array();
        $silang[16][10] = array(10);
        $silang[16][11] = array();
        $silang[16][12] = array();
        $silang[16][13] = array();
        $silang[16][14] = array();
        $silang[16][15] = array(20);
        $silang[16][17] = array();
        $silang[16][18] = array();
        $silang[16][19] = array();
        $silang[16][20] = array();
        $silang[16][21] = array();
        $silang[16][22] = array();
        $silang[16][23] = array(20);
        $silang[16][24] = array(20);
        $silang[16][25] = array();
        $silang[16][26] = array();
        $silang[16][27] = array(20);
        $silang[16][28] = array();
        $silang[16][29] = array();
        $silang[16][30] = array(10);
        $silang[16][31] = array();
        $silang[16][32] = array();
        $silang[16][33] = array();
        $silang[16][34] = array();
        $silang[16][35] = array();
        $silang[16][36] = array();
        $silang[16][37] = array();
        $silang[16][38] = array();
        $silang[16][39] = array();
        $silang[16][40] = array();

//        (11,18)
        $silang[17][1] = array();
        $silang[17][2] = array();
        $silang[17][3] = array();
        $silang[17][4] = array();
        $silang[17][5] = array();
        $silang[17][6] = array(18);
        $silang[17][7] = array(18);
        $silang[17][8] = array();
        $silang[17][9] = array();
        $silang[17][10] = array();
        $silang[17][11] = array();
        $silang[17][12] = array();
        $silang[17][13] = array();
        $silang[17][14] = array();
        $silang[17][15] = array();
        $silang[17][16] = array();
        $silang[17][18] = array(11);
        $silang[17][19] = array();
        $silang[17][20] = array(11);
        $silang[17][21] = array();
        $silang[17][22] = array();
        $silang[17][23] = array(18);
        $silang[17][24] = array();
        $silang[17][25] = array();
        $silang[17][26] = array();
        $silang[17][27] = array();
        $silang[17][28] = array();
        $silang[17][29] = array();
        $silang[17][30] = array(11);
        $silang[17][31] = array();
        $silang[17][32] = array();
        $silang[17][33] = array();
        $silang[17][34] = array();
        $silang[17][35] = array();
        $silang[17][36] = array();
        $silang[17][37] = array();
        $silang[17][38] = array();
        $silang[17][39] = array();
        $silang[17][40] = array();
        //(11,28)
        $silang[18][1] = array();
        $silang[18][2] = array();
        $silang[18][3] = array();
        $silang[18][4] = array();
        $silang[18][5] = array(28);
        $silang[18][6] = array();
        $silang[18][7] = array();
        $silang[18][8] = array();
        $silang[18][9] = array();
        $silang[18][10] = array();
        $silang[18][11] = array();
        $silang[18][12] = array(28);
        $silang[18][13] = array();
        $silang[18][14] = array(11);
        $silang[18][15] = array();
        $silang[18][16] = array(11);
        $silang[18][17] = array();
        $silang[18][19] = array();
        $silang[18][20] = array(11);
        $silang[18][21] = array();
        $silang[18][22] = array();
        $silang[18][23] = array();
        $silang[18][24] = array();
        $silang[18][25] = array();
        $silang[18][26] = array();
        $silang[18][27] = array(28);
        $silang[18][28] = array();
        $silang[18][29] = array();
        $silang[18][30] = array();
        $silang[18][31] = array(11);
        $silang[18][32] = array();
        $silang[18][33] = array();
        $silang[18][34] = array();
        $silang[18][35] = array();
        $silang[18][36] = array();
        $silang[18][37] = array();
        $silang[18][38] = array();
        $silang[18][39] = array();
        $silang[18][40] = array();

        //(12,16)
        $silang[19][1] = array();
        $silang[19][2] = array(16);
        $silang[19][3] = array();
        $silang[19][4] = array(12);
        $silang[19][5] = array();
        $silang[19][6] = array();
        $silang[19][7] = array();
        $silang[19][8] = array();
        $silang[19][9] = array();
        $silang[19][10] = array();
        $silang[19][11] = array();
        $silang[19][12] = array();
        $silang[19][13] = array();
        $silang[19][14] = array();
        $silang[19][15] = array();
        $silang[19][16] = array();
        $silang[19][17] = array();
        $silang[19][18] = array();
        $silang[19][20] = array(12, 16);
        $silang[19][21] = array();
        $silang[19][22] = array();
        $silang[19][23] = array();
        $silang[19][24] = array();
        $silang[19][25] = array();
        $silang[19][26] = array();
        $silang[19][27] = array();
        $silang[19][28] = array();
        $silang[19][29] = array();
        $silang[19][30] = array(12);
        $silang[19][31] = array();
        $silang[19][32] = array();
        $silang[19][33] = array();
        $silang[19][34] = array();
        $silang[19][35] = array();
        $silang[19][36] = array();
        $silang[19][37] = array();
        $silang[19][38] = array();
        $silang[19][39] = array(16);
        $silang[19][40] = array();

        //(1,2,4,8,11,12,16,24)
        $silang[20][1] = array(1);
        $silang[20][2] = array(1, 12, 16);
        $silang[20][3] = array(2);
        $silang[20][4] = array(2, 8, 12);
        $silang[20][5] = array(24);
        $silang[20][6] = array();
        $silang[20][7] = array(4);
        $silang[20][8] = array(4);
        $silang[20][9] = array(16);
        $silang[20][10] = array(); //(1,2,4,8,11,12,16,24)
        $silang[20][11] = array(1, 4);
        $silang[20][12] = array();
        $silang[20][13] = array(24);
        $silang[20][14] = array();
        $silang[20][15] = array(11);
        $silang[20][16] = array();
        $silang[20][17] = array(11);
        $silang[20][18] = array(11);
        $silang[20][19] = array(12, 16);
        $silang[20][21] = array(); //(1,2,4,8,11,12,16,24)
        $silang[20][22] = array();
        $silang[20][23] = array(2);
        $silang[20][24] = array();
        $silang[20][25] = array();
        $silang[20][26] = array();
        $silang[20][27] = array();
        $silang[20][28] = array();
        $silang[20][29] = array();
        $silang[20][30] = array(4, 8, 11, 12);
        $silang[20][31] = array();
        $silang[20][32] = array();
        $silang[20][33] = array();
        $silang[20][34] = array();
        $silang[20][35] = array(24);
        $silang[20][36] = array();
        $silang[20][37] = array();
        $silang[20][38] = array();
        $silang[20][39] = array(16);
        $silang[20][40] = array(1, 2, 8);

        //(3,5,9,13,21,22)
        $silang[21][1] = array(22);
        $silang[21][2] = array(9, 13);
        $silang[21][3] = array();
        $silang[21][4] = array(5);
        $silang[21][5] = array(3);
        $silang[21][6] = array(3);
        $silang[21][7] = array();
        $silang[21][8] = array();
        $silang[21][9] = array(5);
        $silang[21][10] = array(5);
        $silang[21][11] = array(9);
        $silang[21][12] = array(3);
        $silang[21][13] = array(22);
        $silang[21][14] = array();
        $silang[21][15] = array(9);
        $silang[21][16] = array();
        $silang[21][17] = array();
        $silang[21][18] = array();
        $silang[21][19] = array();
        $silang[21][20] = array(); //(3,5,9,13,21,22)
        $silang[21][22] = array();
        $silang[21][23] = array();
        $silang[21][24] = array();
        $silang[21][25] = array();
        $silang[21][26] = array();
        $silang[21][27] = array(21);
        $silang[21][28] = array(21);
        $silang[21][29] = array(21);
        $silang[21][30] = array(9); //(3,5,9,13,21,22)
        $silang[21][31] = array(5, 22);
        $silang[21][32] = array();
        $silang[21][33] = array();
        $silang[21][34] = array(13);
        $silang[21][35] = array();
        $silang[21][36] = array(13);
        $silang[21][37] = array();
        $silang[21][38] = array(22);
        $silang[21][39] = array(21);
        $silang[21][40] = array(3, 21);

        //(7,13,14,15,19)
        $silang[22][1] = array();
        $silang[22][2] = array(13, 14, 15);
        $silang[22][3] = array();
        $silang[22][4] = array();
        $silang[22][5] = array();
        $silang[22][6] = array();
        $silang[22][7] = array();
        $silang[22][8] = array(14, 15);
        $silang[22][9] = array(19);
        $silang[22][10] = array();
        $silang[22][11] = array(7, 15);
        $silang[22][12] = array(7);
        $silang[22][13] = array(7, 19);
        $silang[22][14] = array();
        $silang[22][15] = array();
        $silang[22][16] = array();
        $silang[22][17] = array();
        $silang[22][18] = array();
        $silang[22][19] = array();
        $silang[22][20] = array();
        $silang[22][21] = array(13);
        $silang[22][23] = array();
        $silang[22][24] = array(19);
        $silang[22][25] = array(19);
        $silang[22][26] = array();
        $silang[22][27] = array();
        $silang[22][28] = array();
        $silang[22][29] = array();
        $silang[22][30] = array(7, 15);
        $silang[22][31] = array();
        $silang[22][32] = array();
        $silang[22][33] = array();
        $silang[22][34] = array(13, 14);
        $silang[22][35] = array();
        $silang[22][36] = array(13, 14);
        $silang[22][37] = array();
        $silang[22][38] = array();
        $silang[22][39] = array();
        $silang[22][40] = array();

        //(2,17,18,20,27,29)
        $silang[23][1] = array();
        $silang[23][2] = array(17, 29);
        $silang[23][3] = array(2);
        $silang[23][4] = array(2, 17);
        $silang[23][5] = array(18);
        $silang[23][6] = array(18);
        $silang[23][7] = array();
        $silang[23][8] = array();
        $silang[23][9] = array();
        $silang[23][10] = array(27);  //(2,17,18,20,27,29)
        $silang[23][11] = array(17, 27);
        $silang[23][12] = array();
        $silang[23][13] = array(29);
        $silang[23][14] = array();
        $silang[23][15] = array(20);
        $silang[23][16] = array(20);
        $silang[23][17] = array(18);
        $silang[23][18] = array();
        $silang[23][19] = array();
        $silang[23][20] = array(2); //(2,17,18,20,27,29)
        $silang[23][21] = array();
        $silang[23][22] = array();
        $silang[23][24] = array(20, 27);
        $silang[23][25] = array();
        $silang[23][26] = array();
        $silang[23][27] = array();
        $silang[23][28] = array(29);
        $silang[23][29] = array();
        $silang[23][30] = array(17); //(2,17,18,20,27,29)
        $silang[23][31] = array(18);
        $silang[23][32] = array();
        $silang[23][33] = array();
        $silang[23][34] = array();
        $silang[23][35] = array();
        $silang[23][36] = array();
        $silang[23][37] = array();
        $silang[23][38] = array();
        $silang[23][39] = array(29);
        $silang[23][40] = array(2);

        //(19,20,27)
        $silang[24][1] = array();
        $silang[24][2] = array();
        $silang[24][3] = array();
        $silang[24][4] = array();
        $silang[24][5] = array();
        $silang[24][6] = array();
        $silang[24][7] = array();
        $silang[24][8] = array();
        $silang[24][9] = array(19);
        $silang[24][10] = array(27); //(19,20,27)
        $silang[24][11] = array(27);
        $silang[24][12] = array();
        $silang[24][13] = array(19);
        $silang[24][14] = array();
        $silang[24][15] = array(20);
        $silang[24][16] = array();
        $silang[24][17] = array();
        $silang[24][18] = array();
        $silang[24][19] = array();
        $silang[24][20] = array(5); //(19,20,27)
        $silang[24][21] = array();
        $silang[24][22] = array(19);
        $silang[24][23] = array(20, 27);
        $silang[24][25] = array(19);
        $silang[24][26] = array(20);
        $silang[24][27] = array();
        $silang[24][28] = array();
        $silang[24][29] = array();
        $silang[24][30] = array();   //(19,20,27)
        $silang[24][31] = array();
        $silang[24][32] = array();
        $silang[24][33] = array();
        $silang[24][34] = array();
        $silang[24][35] = array();
        $silang[24][36] = array();
        $silang[24][37] = array();
        $silang[24][38] = array();
        $silang[24][39] = array();
        $silang[24][40] = array();

        //(19,28)
        $silang[25][1] = array();
        $silang[25][2] = array();
        $silang[25][3] = array();
        $silang[25][4] = array();
        $silang[25][5] = array();
        $silang[25][6] = array();
        $silang[25][7] = array();
        $silang[25][8] = array(19);
        $silang[25][9] = array();
        $silang[25][10] = array(); //(19,28)
        $silang[25][11] = array(28);
        $silang[25][12] = array();
        $silang[25][13] = array(19);
        $silang[25][14] = array();
        $silang[25][15] = array();
        $silang[25][16] = array();
        $silang[25][17] = array();
        $silang[25][18] = array(28);
        $silang[25][19] = array();
        $silang[25][20] = array(); //(19,28)
        $silang[25][21] = array();
        $silang[25][22] = array(19);
        $silang[25][23] = array();
        $silang[25][24] = array(19);
        $silang[25][26] = array(19);
        $silang[25][27] = array(28);
        $silang[25][28] = array();
        $silang[25][29] = array();
        $silang[25][30] = array(); //(19,28)
        $silang[25][31] = array();
        $silang[25][32] = array();
        $silang[25][33] = array();
        $silang[25][34] = array();
        $silang[25][35] = array();
        $silang[25][36] = array();
        $silang[25][37] = array();
        $silang[25][38] = array();
        $silang[25][39] = array();
        $silang[25][40] = array();

//        (6,20)
        $silang[26][1] = array();
        $silang[26][2] = array(6);
        $silang[26][3] = array();
        $silang[26][4] = array();
        $silang[26][5] = array();
        $silang[26][6] = array();
        $silang[26][7] = array();
        $silang[26][8] = array();
        $silang[26][9] = array(); //        (6,20)
        $silang[26][10] = array(6);
        $silang[26][11] = array();
        $silang[26][12] = array();
        $silang[26][13] = array();
        $silang[26][14] = array();
        $silang[26][15] = array(6, 20);
        $silang[26][16] = array(20);
        $silang[26][17] = array();
        $silang[26][18] = array();
        $silang[26][19] = array(); //        (6,20)
        $silang[26][20] = array();
        $silang[26][21] = array();
        $silang[26][22] = array();
        $silang[26][23] = array(20);
        $silang[26][24] = array(20);
        $silang[26][25] = array();
        $silang[26][27] = array();
        $silang[26][28] = array();
        $silang[26][29] = array();
        $silang[26][30] = array(); //        (6,20)
        $silang[26][31] = array();
        $silang[26][32] = array(6);
        $silang[26][33] = array();
        $silang[26][34] = array();
        $silang[26][35] = array();
        $silang[26][36] = array();
        $silang[26][37] = array();
        $silang[26][38] = array();
        $silang[26][39] = array();
        $silang[26][40] = array();

        //(21,28)
        $silang[27][1] = array();
        $silang[27][2] = array();
        $silang[27][3] = array();
        $silang[27][4] = array();
        $silang[27][5] = array(28);
        $silang[27][6] = array();
        $silang[27][7] = array();
        $silang[27][8] = array();
        $silang[27][9] = array(); //(21,28)
        $silang[27][10] = array(28);
        $silang[27][11] = array();
        $silang[27][12] = array();
        $silang[27][13] = array();
        $silang[27][14] = array();
        $silang[27][15] = array();
        $silang[27][16] = array();
        $silang[27][17] = array(28);
        $silang[27][18] = array();
        $silang[27][19] = array(); //(21,28)
        $silang[27][20] = array(21);
        $silang[27][21] = array();
        $silang[27][22] = array();
        $silang[27][23] = array();
        $silang[27][24] = array();
        $silang[27][25] = array(28);
        $silang[27][26] = array();
        $silang[27][28] = array(21);
        $silang[27][29] = array(21);
        $silang[27][30] = array(); //(21,28)
        $silang[27][31] = array();
        $silang[27][32] = array();
        $silang[27][33] = array();
        $silang[27][34] = array();
        $silang[27][35] = array();
        $silang[27][36] = array();
        $silang[27][37] = array();
        $silang[27][38] = array();
        $silang[27][39] = array(21);
        $silang[27][40] = array();

        //(21,29)
        $silang[28][1] = array();
        $silang[28][2] = array(29);
        $silang[28][3] = array();
        $silang[28][4] = array();
        $silang[28][5] = array();
        $silang[28][6] = array();
        $silang[28][7] = array();
        $silang[28][8] = array();
        $silang[28][9] = array(); //(21,29)
        $silang[28][10] = array();
        $silang[28][11] = array();
        $silang[28][12] = array();
        $silang[28][13] = array(29);
        $silang[28][14] = array();
        $silang[28][15] = array();
        $silang[28][16] = array();
        $silang[28][17] = array();
        $silang[28][18] = array();
        $silang[28][19] = array(); //(21,29)
        $silang[28][20] = array();
        $silang[28][21] = array(21);
        $silang[28][22] = array();
        $silang[28][23] = array(29);
        $silang[28][24] = array();
        $silang[28][25] = array();
        $silang[28][26] = array();
        $silang[28][27] = array(21);
        $silang[28][29] = array(21);
        $silang[28][30] = array(); //(21,29)
        $silang[28][31] = array();
        $silang[28][32] = array();
        $silang[28][33] = array();
        $silang[28][34] = array();
        $silang[28][35] = array();
        $silang[28][36] = array();
        $silang[28][37] = array();
        $silang[28][38] = array();
        $silang[28][39] = array(21, 29);
        $silang[28][40] = array(21);

        //(21)
        $silang[29][1] = array();
        $silang[29][2] = array();
        $silang[29][3] = array();
        $silang[29][4] = array();
        $silang[29][5] = array();
        $silang[29][6] = array();
        $silang[29][7] = array();
        $silang[29][8] = array();
        $silang[29][9] = array(); //(21)
        $silang[29][10] = array();
        $silang[29][11] = array();
        $silang[29][12] = array();
        $silang[29][13] = array();
        $silang[29][14] = array();
        $silang[29][15] = array();
        $silang[29][16] = array();
        $silang[29][17] = array();
        $silang[29][18] = array();
        $silang[29][19] = array(); //(21)
        $silang[29][20] = array();
        $silang[29][21] = array(21);
        $silang[29][22] = array();
        $silang[29][23] = array();
        $silang[29][24] = array();
        $silang[29][25] = array();
        $silang[29][26] = array();
        $silang[29][27] = array(21);
        $silang[29][28] = array();
        $silang[29][30] = array(); //(21)
        $silang[29][31] = array();
        $silang[29][32] = array();
        $silang[29][33] = array();
        $silang[29][34] = array();
        $silang[29][35] = array();
        $silang[29][36] = array();
        $silang[29][37] = array();
        $silang[29][38] = array();
        $silang[29][39] = array(21);
        $silang[29][40] = array(21);

        //(4,7,8,9,10,11,12,15,17,22)
        $silang[30][1] = array(22);
        $silang[30][2] = array(9, 10, 12, 15, 17);
        $silang[30][3] = array();
        $silang[30][4] = array(8, 12, 17);
        $silang[30][5] = array(10);
        $silang[30][6] = array();
        $silang[30][7] = array(4);
        $silang[30][8] = array(4, 14, 25);
        $silang[30][9] = array();
        $silang[30][10] = array(10); //(4,7,8,9,10,11,12,15,17,22)
        $silang[30][11] = array(4, 7, 9, 15, 17);
        $silang[30][12] = array(7);
        $silang[30][13] = array(7, 22);
        $silang[30][14] = array(8);
        $silang[30][15] = array(9, 11);
        $silang[30][16] = array(10);
        $silang[30][17] = array(11);
        $silang[30][18] = array(11);
        $silang[30][19] = array(12); //(4,7,8,9,10,11,12,15,17,22)
        $silang[30][20] = array(4, 8, 11, 12);
        $silang[30][21] = array(9, 22);
        $silang[30][22] = array(7, 15);
        $silang[30][23] = array(17);
        $silang[30][24] = array();
        $silang[30][25] = array();
        $silang[30][26] = array();
        $silang[30][27] = array();
        $silang[30][28] = array();
        $silang[30][29] = array(7); //(4,7,8,9,10,11,12,15,17,22)
        $silang[30][31] = array(22);
        $silang[30][32] = array();
        $silang[30][33] = array();
        $silang[30][34] = array();
        $silang[30][35] = array();
        $silang[30][36] = array();
        $silang[30][37] = array();
        $silang[30][38] = array(22);
        $silang[30][39] = array();
        $silang[30][40] = array(8);

        //(5,18,22)
        $silang[31][1] = array(22);
        $silang[31][2] = array();
        $silang[31][3] = array();
        $silang[31][4] = array(5);
        $silang[31][5] = array(18);
        $silang[31][6] = array(18);
        $silang[31][7] = array();
        $silang[31][8] = array();
        $silang[31][9] = array(5);
        $silang[31][10] = array(5); //(5,18,22)
        $silang[31][11] = array();
        $silang[31][12] = array(22);
        $silang[31][13] = array();
        $silang[31][14] = array();
        $silang[31][15] = array();
        $silang[31][16] = array(18);
        $silang[31][17] = array();
        $silang[31][18] = array();
        $silang[31][19] = array(); //(5,18,22)
        $silang[31][20] = array(22);
        $silang[31][21] = array(18);
        $silang[31][22] = array();
        $silang[31][23] = array();
        $silang[31][24] = array();
        $silang[31][25] = array();
        $silang[31][26] = array();
        $silang[31][27] = array();
        $silang[31][28] = array();
        $silang[31][29] = array();  //(5,18,22)
        $silang[31][30] = array(22);
        $silang[31][32] = array();
        $silang[31][33] = array();
        $silang[31][34] = array();
        $silang[31][35] = array();
        $silang[31][36] = array();
        $silang[31][37] = array();
        $silang[31][38] = array(22);
        $silang[31][39] = array();
        $silang[31][40] = array();

        //(6,23)
        $silang[32][1] = array(23);
        $silang[32][2] = array(6);
        $silang[32][3] = array();
        $silang[32][4] = array();
        $silang[32][5] = array();
        $silang[32][6] = array();
        $silang[32][7] = array();
        $silang[32][8] = array();
        $silang[32][9] = array();
        $silang[32][10] = array(6, 23); //(6,23)
        $silang[32][11] = array();
        $silang[32][12] = array();
        $silang[32][13] = array();
        $silang[32][14] = array();
        $silang[32][15] = array(6);
        $silang[32][16] = array();
        $silang[32][17] = array();
        $silang[32][18] = array();
        $silang[32][19] = array(); //(6,23)
        $silang[32][20] = array();
        $silang[32][21] = array();
        $silang[32][22] = array();
        $silang[32][23] = array();
        $silang[32][24] = array();
        $silang[32][25] = array();
        $silang[32][26] = array(6);
        $silang[32][27] = array();
        $silang[32][28] = array();
        $silang[32][29] = array(); //(6,23)
        $silang[32][30] = array();
        $silang[32][31] = array();
        $silang[32][33] = array(23);
        $silang[32][34] = array();
        $silang[32][35] = array();
        $silang[32][36] = array();
        $silang[32][37] = array();
        $silang[32][38] = array();
        $silang[32][39] = array();
        $silang[32][40] = array();

        //(23)
        $silang[33][1] = array(23);
        $silang[33][2] = array();
        $silang[33][3] = array();
        $silang[33][4] = array();
        $silang[33][5] = array();
        $silang[33][6] = array();
        $silang[33][7] = array();
        $silang[33][8] = array();
        $silang[33][9] = array();
        $silang[33][10] = array(23); //(23)
        $silang[33][11] = array();
        $silang[33][12] = array();
        $silang[33][13] = array();
        $silang[33][14] = array();
        $silang[33][15] = array();
        $silang[33][16] = array();
        $silang[33][17] = array();
        $silang[33][18] = array();
        $silang[33][19] = array(); //(23)
        $silang[33][20] = array();
        $silang[33][21] = array();
        $silang[33][22] = array();
        $silang[33][23] = array();
        $silang[33][24] = array();
        $silang[33][25] = array();
        $silang[33][26] = array();
        $silang[33][27] = array();
        $silang[33][28] = array();
        $silang[33][29] = array(); //(23)
        $silang[33][30] = array();
        $silang[33][31] = array();
        $silang[33][32] = array(23);
        $silang[33][34] = array();
        $silang[33][35] = array();
        $silang[33][36] = array();
        $silang[33][37] = array();
        $silang[33][38] = array();
        $silang[33][39] = array();
        $silang[33][40] = array();

        //(13,14,24)
        $silang[34][1] = array();
        $silang[34][2] = array(13, 14);
        $silang[34][3] = array();
        $silang[34][4] = array();
        $silang[34][5] = array(24);
        $silang[34][6] = array();
        $silang[34][7] = array();
        $silang[34][8] = array(14);
        $silang[34][9] = array();
        $silang[34][10] = array(); //(13,14,24)
        $silang[34][11] = array();
        $silang[34][12] = array();
        $silang[34][13] = array(24);
        $silang[34][14] = array();
        $silang[34][15] = array();
        $silang[34][16] = array();
        $silang[34][17] = array();
        $silang[34][18] = array();
        $silang[34][19] = array(24); //(13,14,24)
        $silang[34][20] = array(13);
        $silang[34][21] = array(13, 14);
        $silang[34][22] = array();
        $silang[34][23] = array();
        $silang[34][24] = array();
        $silang[34][25] = array();
        $silang[34][26] = array();
        $silang[34][27] = array();
        $silang[34][28] = array();
        $silang[34][29] = array(); //(13,14,24)
        $silang[34][30] = array();
        $silang[34][31] = array();
        $silang[34][32] = array();
        $silang[34][33] = array();
        $silang[34][35] = array();
        $silang[34][36] = array(13, 14);
        $silang[34][37] = array();
        $silang[34][38] = array();
        $silang[34][39] = array();
        $silang[34][40] = array();

        //(24)
        $silang[35][1] = array();
        $silang[35][2] = array();
        $silang[35][3] = array();
        $silang[35][4] = array();
        $silang[35][5] = array(24);
        $silang[35][6] = array();
        $silang[35][7] = array();
        $silang[35][8] = array();
        $silang[35][9] = array();
        $silang[35][10] = array(); //(24)
        $silang[35][11] = array();
        $silang[35][12] = array();
        $silang[35][13] = array(24);
        $silang[35][14] = array();
        $silang[35][15] = array();
        $silang[35][16] = array();
        $silang[35][17] = array();
        $silang[35][18] = array();
        $silang[35][19] = array(24); //(24)
        $silang[35][20] = array();
        $silang[35][21] = array();
        $silang[35][22] = array();
        $silang[35][23] = array();
        $silang[35][24] = array();
        $silang[35][25] = array();
        $silang[35][26] = array();
        $silang[35][27] = array();
        $silang[35][28] = array();
        $silang[35][29] = array(); //(24)
        $silang[35][30] = array();
        $silang[35][31] = array();
        $silang[35][32] = array();
        $silang[35][33] = array();
        $silang[35][34] = array(24);
        $silang[35][36] = array();
        $silang[35][37] = array();
        $silang[35][38] = array();
        $silang[35][39] = array();
        $silang[35][40] = array();

        //(13,14,25)
        $silang[36][1] = array(25);
        $silang[36][2] = array(13, 14);
        $silang[36][3] = array();
        $silang[36][4] = array();
        $silang[36][5] = array();
        $silang[36][6] = array();
        $silang[36][7] = array();
        $silang[36][8] = array(14);
        $silang[36][9] = array();
        $silang[36][10] = array(25); //(13,14,25)
        $silang[36][11] = array();
        $silang[36][12] = array();
        $silang[36][13] = array();
        $silang[36][14] = array();
        $silang[36][15] = array();
        $silang[36][16] = array();
        $silang[36][17] = array();
        $silang[36][18] = array();
        $silang[36][19] = array(); //(13,14,25)
        $silang[36][20] = array(13);
        $silang[36][21] = array(13, 14);
        $silang[36][22] = array();
        $silang[36][23] = array();
        $silang[36][24] = array();
        $silang[36][25] = array();
        $silang[36][26] = array();
        $silang[36][27] = array();
        $silang[36][28] = array();
        $silang[36][29] = array(); //(13,14,25)
        $silang[36][30] = array();
        $silang[36][31] = array();
        $silang[36][32] = array();
        $silang[36][33] = array();
        $silang[36][34] = array(13, 14);
        $silang[36][35] = array();
        $silang[36][37] = array();
        $silang[36][38] = array();
        $silang[36][39] = array();
        $silang[36][40] = array();

        //(25)
        $silang[37][1] = array(25);
        $silang[37][2] = array();
        $silang[37][3] = array();
        $silang[37][4] = array();
        $silang[37][5] = array();
        $silang[37][6] = array();
        $silang[37][7] = array();
        $silang[37][8] = array();
        $silang[37][9] = array();
        $silang[37][10] = array(25); //(25)
        $silang[37][11] = array();
        $silang[37][12] = array();
        $silang[37][13] = array();
        $silang[37][14] = array();
        $silang[37][15] = array();
        $silang[37][16] = array();
        $silang[37][17] = array();
        $silang[37][18] = array();
        $silang[37][19] = array(); //(25)
        $silang[37][20] = array();
        $silang[37][21] = array();
        $silang[37][22] = array();
        $silang[37][23] = array();
        $silang[37][24] = array();
        $silang[37][25] = array();
        $silang[37][26] = array();
        $silang[37][27] = array();
        $silang[37][28] = array();
        $silang[37][29] = array(); //(25)
        $silang[37][30] = array();
        $silang[37][31] = array();
        $silang[37][32] = array();
        $silang[37][33] = array();
        $silang[37][34] = array();
        $silang[37][35] = array();
        $silang[37][36] = array();
        $silang[37][38] = array();
        $silang[37][39] = array();
        $silang[37][40] = array();

        //(22,26)
        $silang[38][1] = array(22);
        $silang[38][2] = array(26);
        $silang[38][3] = array();
        $silang[38][4] = array();
        $silang[38][5] = array();
        $silang[38][6] = array();
        $silang[38][7] = array();
        $silang[38][8] = array();
        $silang[38][9] = array();
        $silang[38][10] = array(); //(22,26)
        $silang[38][11] = array();
        $silang[38][12] = array();
        $silang[38][13] = array(22);
        $silang[38][14] = array();
        $silang[38][15] = array(26);
        $silang[38][16] = array();
        $silang[38][17] = array();
        $silang[38][18] = array();
        $silang[38][19] = array(); //(22,26)
        $silang[38][20] = array(22);
        $silang[38][21] = array();
        $silang[38][22] = array();
        $silang[38][23] = array();
        $silang[38][24] = array();
        $silang[38][25] = array();
        $silang[38][26] = array();
        $silang[38][27] = array();
        $silang[38][28] = array();
        $silang[38][29] = array(22); //(22,26)
        $silang[38][30] = array(22);
        $silang[38][31] = array();
        $silang[38][32] = array();
        $silang[38][33] = array();
        $silang[38][34] = array();
        $silang[38][35] = array();
        $silang[38][36] = array();
        $silang[38][37] = array();
        $silang[38][39] = array(26);
        $silang[38][40] = array(26);

        //(16,21,26,29)
        $silang[39][1] = array();
        $silang[39][2] = array(16, 26, 29);
        $silang[39][3] = array();
        $silang[39][4] = array();
        $silang[39][5] = array();
        $silang[39][6] = array();
        $silang[39][7] = array();
        $silang[39][8] = array();
        $silang[39][9] = array(16);
        $silang[39][10] = array(); //(16,21,26,29)
        $silang[39][11] = array();
        $silang[39][12] = array();
        $silang[39][13] = array(29);
        $silang[39][14] = array();
        $silang[39][15] = array(26);
        $silang[39][16] = array();
        $silang[39][17] = array();
        $silang[39][18] = array();
        $silang[39][19] = array(16); //(16,21,26,29)
        $silang[39][20] = array(16);
        $silang[39][21] = array(21);
        $silang[39][22] = array();
        $silang[39][23] = array(29);
        $silang[39][24] = array();
        $silang[39][25] = array();
        $silang[39][26] = array();
        $silang[39][27] = array(21);
        $silang[39][28] = array(21, 29);
        $silang[39][29] = array(21); //(16,21,26,29)
        $silang[39][30] = array();
        $silang[39][31] = array();
        $silang[39][32] = array();
        $silang[39][33] = array();
        $silang[39][34] = array();
        $silang[39][35] = array();
        $silang[39][36] = array();
        $silang[39][37] = array();
        $silang[39][38] = array(26);
        $silang[39][40] = array(26);

        //(1,2,3,8,21,26,30)
        $silang[40][1] = array(1, 30);
        $silang[40][2] = array(1, 30);
        $silang[40][3] = array(2, 30);
        $silang[40][4] = array(2, 8);
        $silang[40][5] = array(3);
        $silang[40][6] = array(3);
        $silang[40][7] = array();
        $silang[40][8] = array();
        $silang[40][9] = array();
        $silang[40][10] = array(); //(1,2,3,8,21,26,30)
        $silang[40][11] = array(1);
        $silang[40][12] = array(3);
        $silang[40][13] = array();
        $silang[40][14] = array(8);
        $silang[40][15] = array(26, 30);
        $silang[40][16] = array();
        $silang[40][17] = array();
        $silang[40][18] = array();
        $silang[40][19] = array();
        $silang[40][20] = array(1, 2, 8); //(1,2,3,8,21,26,30)
        $silang[40][21] = array(3, 21);
        $silang[40][22] = array();
        $silang[40][23] = array(2);
        $silang[40][24] = array();
        $silang[40][25] = array();
        $silang[40][26] = array();
        $silang[40][27] = array(21);
        $silang[40][28] = array(21);
        $silang[40][29] = array(21);
        $silang[40][30] = array(8);
        $silang[40][31] = array();
        $silang[40][32] = array();
        $silang[40][33] = array();
        $silang[40][34] = array();
        $silang[40][35] = array();
        $silang[40][36] = array();
        $silang[40][37] = array();
        $silang[40][38] = array(26);
        $silang[40][39] = array(21, 26);
        echo 'Peyilangan';
        echo '<br>';

        print_r($silang);
        echo '<br>';
        echo 'Seleksi';
        echo '<br>';
        foreach ($silang as $id_barang1 => $array1) {
            foreach ($array1 as $id_barang2 => $value) {
                echo '<br>' . $id_barang1 . '=>' . $id_barang2 . ' = ' . count($silang[$id_barang1][$id_barang2]);

                if (count($silang[$id_barang1][$id_barang2]) > 1) {
                    $silang_seleksi[$id_barang1][$id_barang2] = $value;
                }
            }
        }
        echo '<br>';
        echo '<br>';
        echo 'Hasil Seleksi';
        echo '<br>';

        print_r($silang_seleksi);

//        echo count($silang[1][2]);
    }

    function fpgrowth() {
        $data['kategori'] = $this->m_kategori->tampil_data();
        $data['konten'] = 'kategori/v_table';
        $this->load->view('template/v_template', $data);
    }

}
