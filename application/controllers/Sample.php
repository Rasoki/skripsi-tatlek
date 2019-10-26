<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sample extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata("username")) {
            redirect('Template/login');
        }
        $this->load->model('m_kategori');
        $this->load->helper('url');
    }

    function eclat_dinamis() {
        echo '<pre>';
        //$transaksi = $this->db->select('id_barang')->get('detail_transaksi')->result_array() ;
        $this->db->select('detail_transaksi.id_barang, barang.nama_barang   ');
        $this->db->from('detail_transaksi');
        $this->db->join('barang','detail_transaksi.id_barang = barang.id_barang','LEFT');
        $this->db->group_by('detail_transaksi.id_barang');
        $transaksi = $this->db->get()->result_array();
        return print_r($transaksi);
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

//        foreach ($barang as $id_transaksi1 => $value) {
//
//            foreach ($barang as $id_transaksi2 => $value2) {
//                if ($id_transaksi1 != $id_transaksi2) {
//                    $silang[$id_transaksi1][$id_transaksi2] = array();
//                }
//            }
//        }
//        

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

        //(3,18)
//        $silang[6][1] = array(1, 30);
//        $silang[6][2] = array(30);
//        $silang[6][3] = array(12, 17);
//        $silang[6][4] = array(10);
//        $silang[6][5] = array();
//        $silang[6][7] = array();
//        $silang[6][8] = array(14, 15);
//        $silang[6][9] = array(16);
//        $silang[6][10] = array(10);
//        $silang[6][11] = array(1, 15, 17);
//        $silang[6][12] = array();
//        $silang[6][13] = array();
//        $silang[6][14] = array();
//        $silang[6][15] = array(6, 9, 26, 30);
//        $silang[6][16] = array(10);
//        $silang[6][17] = array();
//        $silang[6][18] = array();
//        $silang[6][19] = array(12, 16);
//        $silang[6][20] = array(1, 12, 16);
//        $silang[6][21] = array(9, 13);
//        $silang[6][22] = array(13, 14, 15);
//        $silang[6][23] = array(17, 29);
//        $silang[6][24] = array();
//        $silang[6][25] = array();
//        $silang[6][26] = array(6);
//        $silang[6][27] = array(29);
//        $silang[6][28] = array();
//        $silang[6][29] = array();
//        $silang[6][30] = array(9, 10, 12, 15, 17);
//        $silang[6][31] = array();
//        $silang[6][32] = array(6);
//        $silang[6][33] = array();
//        $silang[6][34] = array();
//        $silang[6][35] = array();
//        $silang[6][36] = array(13, 14);
//        $silang[6][37] = array();
//        $silang[6][38] = array(26);
//        $silang[6][39] = array(16, 26, 29);
//        $silang[6][40] = array(1, 26, 30);
//       
//        //(4,23)
//        $silang[7][1] = array(1, 30);
//        $silang[7][2] = array(30);
//        $silang[7][3] = array(12, 17);
//        $silang[7][4] = array(10);
//        $silang[7][5] = array();
//        $silang[7][6] = array();
//        $silang[7][8] = array(14, 15);
//        $silang[7][9] = array(16);
//        $silang[7][10] = array(10);
//        $silang[7][11] = array(1, 15, 17);
//        $silang[7][12] = array();
//        $silang[7][13] = array();
//        $silang[7][14] = array();
//        $silang[7][15] = array(6, 9, 26, 30);
//        $silang[7][16] = array(10);
//        $silang[7][17] = array();
//        $silang[7][18] = array();
//        $silang[7][19] = array(12, 16);
//        $silang[7][20] = array(1, 12, 16);
//        $silang[7][21] = array(9, 13);
//        $silang[7][22] = array(13, 14, 15);
//        $silang[7][23] = array(17, 29);
//        $silang[7][24] = array();
//        $silang[7][25] = array();
//        $silang[7][26] = array(6);
//        $silang[7][27] = array(29);
//        $silang[7][28] = array();
//        $silang[7][29] = array();
//        $silang[7][30] = array(9, 10, 12, 15, 17);
//        $silang[7][31] = array();
//        $silang[7][32] = array(6);
//        $silang[7][33] = array();
//        $silang[7][34] = array();
//        $silang[7][35] = array();
//        $silang[7][36] = array(13, 14);
//        $silang[7][37] = array();
//        $silang[7][38] = array(26);
//        $silang[7][39] = array(16, 26, 29);
//        $silang[7][40] = array(1, 26, 30);
//        
//        //(4,14,15)
//        $silang[8][1] = array(1, 30);
//        $silang[8][2] = array(30);
//        $silang[8][3] = array(12, 17);
//        $silang[8][4] = array(10);
//        $silang[8][5] = array();
//        $silang[8][6] = array();
//        $silang[8][7] = array(14, 15);
//        $silang[8][9] = array(16);
//        $silang[8][10] = array(10);
//        $silang[8][11] = array(1, 15, 17);
//        $silang[8][12] = array();
//        $silang[8][13] = array();
//        $silang[8][14] = array();
//        $silang[8][15] = array(6, 9, 26, 30);
//        $silang[8][16] = array(10);
//        $silang[8][17] = array();
//        $silang[8][18] = array();
//        $silang[8][19] = array(12, 16);
//        $silang[8][20] = array(1, 12, 16);
//        $silang[8][21] = array(9, 13);
//        $silang[8][22] = array(13, 14, 15);
//        $silang[8][23] = array(17, 29);
//        $silang[8][24] = array();
//        $silang[8][25] = array();
//        $silang[8][26] = array(6);
//        $silang[8][27] = array(29);
//        $silang[8][28] = array();
//        $silang[8][29] = array();
//        $silang[8][30] = array(9, 10, 12, 15, 17);
//        $silang[8][31] = array();
//        $silang[8][32] = array(6);
//        $silang[8][33] = array();
//        $silang[8][34] = array();
//        $silang[8][35] = array();
//        $silang[8][36] = array(13, 14);
//        $silang[8][37] = array();
//        $silang[8][38] = array(26);
//        $silang[8][39] = array(16, 26, 29);
//        $silang[8][40] = array(1, 26, 30);
//        
//        //(5,16,19)
//        $silang[9][1] = array(1, 30);
//        $silang[9][2] = array(30);
//        $silang[9][3] = array(12, 17);
//        $silang[9][4] = array(10);
//        $silang[9][5] = array();
//        $silang[9][6] = array();
//        $silang[9][7] = array(14, 15);
//        $silang[9][8] = array(16);
//        $silang[9][10] = array(10);
//        $silang[9][11] = array(1, 15, 17);
//        $silang[9][12] = array();
//        $silang[9][13] = array();
//        $silang[9][14] = array();
//        $silang[9][15] = array(6, 9, 26, 30);
//        $silang[9][16] = array(10);
//        $silang[9][17] = array();
//        $silang[9][18] = array();
//        $silang[9][19] = array(12, 16);
//        $silang[9][20] = array(1, 12, 16);
//        $silang[9][21] = array(9, 13);
//        $silang[9][22] = array(13, 14, 15);
//        $silang[9][23] = array(17, 29);
//        $silang[9][24] = array();
//        $silang[9][25] = array();
//        $silang[9][26] = array(6);
//        $silang[9][27] = array(29);
//        $silang[9][28] = array();
//        $silang[9][29] = array();
//        $silang[9][30] = array(9, 10, 12, 15, 17);
//        $silang[9][31] = array();
//        $silang[9][32] = array(6);
//        $silang[9][33] = array();
//        $silang[9][34] = array();
//        $silang[9][35] = array();
//        $silang[9][36] = array(13, 14);
//        $silang[9][37] = array();
//        $silang[9][38] = array(26);
//        $silang[9][39] = array(16, 26, 29);
//        $silang[9][40] = array(1, 26, 30);
//        
//        //(5,6,10,23,25,27)
//        $silang[10][1] = array(1, 30);
//        $silang[10][2] = array(30);
//        $silang[10][3] = array(12, 17);
//        $silang[10][4] = array(10);
//        $silang[10][5] = array();
//        $silang[10][7] = array();
//        $silang[10][8] = array(14, 15);
//        $silang[10][9] = array(16);
//        $silang[10][10] = array(10);
//        $silang[10][11] = array(1, 15, 17);
//        $silang[10][12] = array();
//        $silang[10][13] = array();
//        $silang[10][14] = array();
//        $silang[10][15] = array(6, 9, 26, 30);
//        $silang[10][16] = array(10);
//        $silang[10][17] = array();
//        $silang[10][18] = array();
//        $silang[10][19] = array(12, 16);
//        $silang[10][20] = array(1, 12, 16);
//        $silang[10][21] = array(9, 13);
//        $silang[10][22] = array(13, 14, 15);
//        $silang[10][23] = array(17, 29);
//        $silang[10][24] = array();
//        $silang[10][25] = array();
//        $silang[10][26] = array(6);
//        $silang[10][27] = array(29);
//        $silang[10][28] = array();
//        $silang[10][29] = array();
//        $silang[10][30] = array(9, 10, 12, 15, 17);
//        $silang[10][31] = array();
//        $silang[10][32] = array(6);
//        $silang[10][33] = array();
//        $silang[10][34] = array();
//        $silang[10][35] = array();
//        $silang[10][36] = array(13, 14);
//        $silang[10][37] = array();
//        $silang[10][38] = array(26);
//        $silang[10][39] = array(16, 26, 29);
//        $silang[10][40] = array(1, 26, 30);

        echo 'Penyilangan';
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
