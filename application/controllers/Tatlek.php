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
//        $data['eclat2'] = $this->eclat_d();
        $data['eclat'] = $this->eclat_dk();
        $data['growth'] = $this->fpgrowthk();
//
//        echo '<pre>';
//        print_r($data['growth']);
//        echo '</pre>';
////
//        die();
        $data['konten'] = 'tatlek/v_index_detail';
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

    function eclat_dk() {
//        echo '<pre>';

        $data_kategori = $this->m_kategori->tampil_data();

        foreach ($data_kategori as $key => $value) {
            $kategori[$value->id_kategori]['name'] = $value->nama_kategori;
            $kategori[$value->id_kategori]['id_transaksi'] = array();
        }
//echo '<pre>';
//        print_r($kategori);
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
//        echo '<br>';
//        echo '---------------------------------------------------------------------------------------------------';
//
//        echo 'data Transaksi';
//        echo '<br>';
//
//        print_r($transaksi);

        foreach ($transaksi as $id_transaksi => $value) {

            foreach ($value['id_kategori'] as $key => $id_kategori) {

                array_push($kategori[$id_kategori]['id_transaksi'], $id_transaksi);
            }
        }
        
//        print_r($kategori);

//        echo '---------------------------------------------------------------------------------------------------';
//        echo 'List Item';
//        echo '<br>';
//
//        print_r($kategori);
//
//        echo '<br>';
//        echo '---------------------------------------------------------------------------------------------------';
//
//        echo 'Silang';
//        echo '<br>';
//        print_r($silang);
        $total_transaksi = count($transaksi);


        $max_support['value'] = 0;
        $max_support['id_kategori1'] = 0;
        $max_support['id_kategori2'] = 0;

        $max_confidence['value'] = 0;
        $max_confidence['id_kategori1'] = 0;
        $max_confidence['id_kategori2'] = 0;
//        echo '<br>';
        foreach ($silang as $id_kategori1 => $array1) {
            foreach ($array1 as $id_kategori2 => $value) {
//              echo '<br>' . $id_kategori1 . '=>' . $id_kategori2 . ' = ' . count($silang[$id_kategori1][$id_kategori2]);

                if (count($silang[$id_kategori1][$id_kategori2]) > 1) {
                    $silang_seleksi[$id_kategori1][$id_kategori2] = $value;
                    $support[$id_kategori1][$id_kategori2] = count($silang[$id_kategori1][$id_kategori2]) / $total_transaksi;
                    $confidence[$id_kategori1][$id_kategori2] = count($silang[$id_kategori1][$id_kategori2]) / count($kategori[$id_kategori1]['id_transaksi']);
                    
//                    echo '<pre>';
//                    print_r(count($kategori[$id_kategori1]['id_transaksi']));
                    
                    if ($max_support['value'] < $support[$id_kategori1][$id_kategori2]) {
                        $max_support['value'] = $support[$id_kategori1][$id_kategori2];
                        $max_support['id_kategori1'] = $id_kategori1;
                        $max_support['id_kategori2'] = $id_kategori2;
                    }

                    if ($max_confidence['value'] < $confidence[$id_kategori1][$id_kategori2]) {
                        $max_confidence['value'] = $confidence[$id_kategori1][$id_kategori2];
                        $max_confidence['id_kategori1'] = $id_kategori1;
                        $max_confidence['id_kategori2'] = $id_kategori2;
                    }
                }
            }
        }
//        print_r($silang);
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


        $data['kategori'] = $kategori;
        $data['transaksi'] = $transaksi;
        $data['silang'] = $silang;
        $data['seleksi'] = $silang_seleksi;
        $data['support'] = $support;
        $data['confidence'] = $confidence;

//        echo '</pre>';

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
//        echo '<pre>';
        $data_kategori = $this->m_kategori->tampil_data();

        foreach ($data_kategori as $key => $value) {
            $kategori[$value->id_kategori]['name'] = $value->nama_kategori;
            $kategori[$value->id_kategori]['id_transaksi'] = array();
            $kategori[$value->id_kategori]['cpb'] = array();
            $kategori[$value->id_kategori]['cfpt'] = array();
            $kategori[$value->id_kategori]['fpg'] = array();
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
            $kategori_sort[$id_kategori] = count($value['id_transaksi']);
        }
        
//    echo '<pre>';
////    print_r($kategori_sort);
//    print_r($value['id_transaksi']);
        
        $data['kategori'] = $kategori;

//        print_r($kategori);
        $data['kategori_count'] = $kategori_sort;
        
    
//        print_r( $data['kategori_count']);
//
//        echo '---------------------------------------------------------------------------------------------------';
//        echo '<br>';
//
//        echo 'Data Transaksi -OK';
//        echo '<br>';
//        print_r($transaksi);
//        echo '---------------------------------------------------------------------------------------------------';
//
//        echo 'List Kategori -OK';
//        echo '<br>';
//        pri nt_r($kategori_sort);
//        echo '---------------------------------------------------------------------------------------------------';
////
//        echo 'Sorting -OK';
//        echo '<br>';
        arsort($kategori_sort);

        $data['kategori_sort'] = $kategori_sort;
//        print_r($kategori_sort);



        $no = 1;
        foreach ($kategori_sort as $id_kategori => $value) {

            $kategori[$id_kategori]['urutan'] = $no++;
            $pcb[$id_kategori] = array();
            $cfpt[$id_kategori] = array();
        }

//        echo '---------------------------------------------------------------------------------------------------';
//        echo 'List Kategori Urutan';
//        echo '<br>';
//        print_r($kategori);
//                die();
//        echo '---------------------------------------------------------------------------------------------------';
//        echo '<br>';
//        echo 'Kategori Urutan per transaksi';
//        echo '<br>';
        foreach ($transaksi as $id_transaksi => $value) {

            foreach ($value['id_kategori'] as $key => $id_kategori) {
                $transaksi[$id_transaksi]['urutan_kategori'][$kategori[$id_kategori]['urutan']] = $id_kategori;
            }
            ksort($transaksi[$id_transaksi]['urutan_kategori']);
        }
//        print_r($transaksi);
//        die();
//        echo '<pre>';
        $pohon['null'] = array();
//        print_r( $pohon['null']);
//        $pohon['null'][1][2][3] = array();
//        $pohon['null'][1][3]['total'] = array();
//        $pohon['null'][2][3] = array();
//        print_r($pohon);
//        die();
        foreach ($transaksi as $id_transaksi => $value) {
            $transaksi[$id_transaksi]['urutan_kategori_text'] = array();

            foreach ($transaksi[$id_transaksi]['urutan_kategori']as $key => $id_kategori) {
                array_push($transaksi[$id_transaksi]['urutan_kategori_text'], $id_kategori);
//                $transaksi[$id_transaksi]['urutan_kategori_text'] .= "." . $id_kategori;
            }
            // array_push($pohon, $cabang);
        }
//        print_r($transaksi);
//die();
        foreach ($transaksi as $id_transaksi => $value) {

            foreach ($transaksi[$id_transaksi]['urutan_kategori_text']as $key => $id_kategori) {
                //array_push($transaksi[$id_transaksi]['urutan_kategori_text'], $id_kategori);
                if ($key == 0) {
                    
                    if (empty($pohon['null'][$id_kategori])) {
                        $pohon['null'][$id_kategori] = array();
                        $pohon['null'][$id_kategori]['count'] = 0;
                        $pohon2[$id_kategori . '.'] = 0;
                    }
                    $pohon['null'][$id_kategori]['count'] += 1;
                    $pohon2[$id_kategori . '.'] += 1;
                } else if ($key == 1) {

                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$id_kategori] = array();
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    if (empty($cfpt2[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cfpt2[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 0;
                    }

                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$id_kategori]['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $id_kategori . '.'] += 1;
                } else if ($key == 2) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] [$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $id_kategori . '.'] = 0;


                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    if (empty($cfpt2[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cfpt2[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 0;
                    }

                    if (empty($cfpt2[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]])) {
                        $cfpt2[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]] = 0;
                    }
                    $pohon['null'][$transaksi [$id_transaksi]['urutan_kategori_text'] [0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$id_kategori]['count'] += 1;

                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $id_kategori . '.'] += 1;
                } else if ($key == 3) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2]));
                    }
                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }




                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'] [1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$id_kategori]['count'] += 1;

                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $id_kategori . '.'] += 1;
                } else if ($key == 4) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$id_kategori])) {

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'] [2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$id_kategori]['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $id_kategori . '.'] += 1;
                } else if ($key == 5) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$id_kategori])) {

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$id_kategori] = array();
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]] [$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$id_kategori] ['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }
//                    array_push($cfpt[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][4]], $transaksi[$id_transaksi]['urutan_kategori_text'][0]);
                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$id_kategori] ['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $id_kategori . '.'] += 1;
                } else if ($key == 6) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]] [$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$id_kategori] ['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }

                    $pohon['null'][$transaksi [$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'] [4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$id_kategori] ['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $id_kategori . '.'] += 1;
                } else if ($key == 7) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$id_kategori] = array();
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]] [$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$id_kategori] ['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5], $transaksi[$id_transaksi]['urutan_kategori_text'][6]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi [$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'] [5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$id_kategori] ['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $id_kategori . '.'] += 1;
                } else if ($key == 8) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$id_kategori] = array();
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5], $transaksi[$id_transaksi]['urutan_kategori_text'][6], $transaksi[$id_transaksi]['urutan_kategori_text'][7]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi [$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'] [6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$id_kategori]['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $id_kategori . '.'] += 1;
                } else if ($key == 9) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$id_kategori] ['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5], $transaksi[$id_transaksi]['urutan_kategori_text'][6], $transaksi[$id_transaksi]['urutan_kategori_text'][7], $transaksi[$id_transaksi]['urutan_kategori_text'][8]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }
//                    array_push($cfpt[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][8]], $transaksi[$id_transaksi]['urutan_kategori_text'][0]);

                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi [$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'] [7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$id_kategori] ['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $id_kategori . '.'] += 1;
                } else if ($key == 10) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5], $transaksi[$id_transaksi]['urutan_kategori_text'][6], $transaksi[$id_transaksi]['urutan_kategori_text'][7], $transaksi[$id_transaksi]['urutan_kategori_text'][8], $transaksi[$id_transaksi]['urutan_kategori_text'][9]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi [$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'] [8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$id_kategori]['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $id_kategori . '.'] += 1;
                } else if ($key == 11) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]] [$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5], $transaksi[$id_transaksi]['urutan_kategori_text'][6], $transaksi[$id_transaksi]['urutan_kategori_text'][7], $transaksi[$id_transaksi]['urutan_kategori_text'][8], $transaksi[$id_transaksi]['urutan_kategori_text'][9], $transaksi[$id_transaksi]['urutan_kategori_text'][10]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$id_kategori]['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.' . $id_kategori . '.'] += 1;
                 } else if ($key == 12) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]] [$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.'. $transaksi[$id_transaksi]['urutan_kategori_text'][11] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5], $transaksi[$id_transaksi]['urutan_kategori_text'][6], $transaksi[$id_transaksi]['urutan_kategori_text'][7], $transaksi[$id_transaksi]['urutan_kategori_text'][8], $transaksi[$id_transaksi]['urutan_kategori_text'][9], $transaksi[$id_transaksi]['urutan_kategori_text'][10], $transaksi[$id_transaksi]['urutan_kategori_text'][11]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$id_kategori]['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][11] . '.' . $id_kategori . '.'] += 1;
                    }  else if ($key == 13) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]] [$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.'. $transaksi[$id_transaksi]['urutan_kategori_text'][11] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][12] . '.' . $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5], $transaksi[$id_transaksi]['urutan_kategori_text'][6], $transaksi[$id_transaksi]['urutan_kategori_text'][7], $transaksi[$id_transaksi]['urutan_kategori_text'][8], $transaksi[$id_transaksi]['urutan_kategori_text'][9], $transaksi[$id_transaksi]['urutan_kategori_text'][10], $transaksi[$id_transaksi]['urutan_kategori_text'][11], $transaksi[$id_transaksi]['urutan_kategori_text'][12]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$id_kategori]['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][11] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][12] . '.' . $id_kategori . '.'] += 1;
                    }  else if ($key == 14) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]] [$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.'. $transaksi[$id_transaksi]['urutan_kategori_text'][11] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][12] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][13] . '.' .  $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5], $transaksi[$id_transaksi]['urutan_kategori_text'][6], $transaksi[$id_transaksi]['urutan_kategori_text'][7], $transaksi[$id_transaksi]['urutan_kategori_text'][8], $transaksi[$id_transaksi]['urutan_kategori_text'][9], $transaksi[$id_transaksi]['urutan_kategori_text'][10], $transaksi[$id_transaksi]['urutan_kategori_text'][11], $transaksi[$id_transaksi]['urutan_kategori_text'][12], $transaksi[$id_transaksi]['urutan_kategori_text'][13]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$id_kategori]['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][11] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][12] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][13] . '.' . $id_kategori . '.'] += 1;
                    }  else if ($key == 15) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$transaksi[$id_transaksi]['urutan_kategori_text'][14]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$transaksi[$id_transaksi]['urutan_kategori_text'][14]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]] [$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$transaksi[$id_transaksi]['urutan_kategori_text'][14]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.'. $transaksi[$id_transaksi]['urutan_kategori_text'][11] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][12] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][13] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][14] . '.' .  $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5], $transaksi[$id_transaksi]['urutan_kategori_text'][6], $transaksi[$id_transaksi]['urutan_kategori_text'][7], $transaksi[$id_transaksi]['urutan_kategori_text'][8], $transaksi[$id_transaksi]['urutan_kategori_text'][9], $transaksi[$id_transaksi]['urutan_kategori_text'][10], $transaksi[$id_transaksi]['urutan_kategori_text'][11], $transaksi[$id_transaksi]['urutan_kategori_text'][12], $transaksi[$id_transaksi]['urutan_kategori_text'][13], $transaksi[$id_transaksi]['urutan_kategori_text'][14]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$transaksi[$id_transaksi]['urutan_kategori_text'][14]][$id_kategori]['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][11] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][12] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][13] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][14] . '.' . $id_kategori . '.'] += 1;
                    }  else if ($key == 16) {
                    if (empty($pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$transaksi[$id_transaksi]['urutan_kategori_text'][14]][$transaksi[$id_transaksi]['urutan_kategori_text'][15]][$id_kategori])) {
                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$transaksi[$id_transaksi]['urutan_kategori_text'][14]][$transaksi[$id_transaksi]['urutan_kategori_text'][15]][$id_kategori] = array();

                        $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]] [$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$transaksi[$id_transaksi]['urutan_kategori_text'][14]][$transaksi[$id_transaksi]['urutan_kategori_text'][15]][$id_kategori]['count'] = 0;
                        $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.'. $transaksi[$id_transaksi]['urutan_kategori_text'][11] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][12] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][13] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][14] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][15] . '.' .  $id_kategori . '.'] = 0;

                        array_push($pcb[$id_kategori], array($transaksi[$id_transaksi]['urutan_kategori_text'][0], $transaksi[$id_transaksi]['urutan_kategori_text'][1], $transaksi[$id_transaksi]['urutan_kategori_text'][2], $transaksi[$id_transaksi]['urutan_kategori_text'][3], $transaksi[$id_transaksi]['urutan_kategori_text'][4], $transaksi[$id_transaksi]['urutan_kategori_text'][5], $transaksi[$id_transaksi]['urutan_kategori_text'][6], $transaksi[$id_transaksi]['urutan_kategori_text'][7], $transaksi[$id_transaksi]['urutan_kategori_text'][8], $transaksi[$id_transaksi]['urutan_kategori_text'][9], $transaksi[$id_transaksi]['urutan_kategori_text'][10], $transaksi[$id_transaksi]['urutan_kategori_text'][11], $transaksi[$id_transaksi]['urutan_kategori_text'][12], $transaksi[$id_transaksi]['urutan_kategori_text'][13], $transaksi[$id_transaksi]['urutan_kategori_text'][14], $transaksi[$id_transaksi]['urutan_kategori_text'][15]));
                    }

                    if (empty($cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]])) {
                        $cabang[$id_kategori][$transaksi[$id_transaksi]['urutan_kategori_text'][0]] = 1;
                    }


                    $pohon['null'][$transaksi[$id_transaksi]['urutan_kategori_text'][0]][$transaksi[$id_transaksi]['urutan_kategori_text'][1]][$transaksi[$id_transaksi]['urutan_kategori_text'][2]][$transaksi[$id_transaksi]['urutan_kategori_text'][3]][$transaksi[$id_transaksi]['urutan_kategori_text'][4]][$transaksi[$id_transaksi]['urutan_kategori_text'][5]][$transaksi[$id_transaksi]['urutan_kategori_text'][6]][$transaksi[$id_transaksi]['urutan_kategori_text'][7]][$transaksi[$id_transaksi]['urutan_kategori_text'][8]][$transaksi[$id_transaksi]['urutan_kategori_text'][9]][$transaksi[$id_transaksi]['urutan_kategori_text'][10]][$transaksi[$id_transaksi]['urutan_kategori_text'][11]][$transaksi[$id_transaksi]['urutan_kategori_text'][12]][$transaksi[$id_transaksi]['urutan_kategori_text'][13]][$transaksi[$id_transaksi]['urutan_kategori_text'][14]][$transaksi[$id_transaksi]['urutan_kategori_text'][15]][$id_kategori]['count'] += 1;
                    $pohon2[$transaksi[$id_transaksi]['urutan_kategori_text'][0] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][1] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][2] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][3] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][4] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][5] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][6] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][7] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][8] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][9] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][10] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][11] . '.' . $transaksi[$id_transaksi]['urutan_kategori_text'][12] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][13] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][14] . '.' .$transaksi[$id_transaksi]['urutan_kategori_text'][15] . '.' . $id_kategori . '.'] += 1;
                    } else {
                    echo '1.';
                }
            }
        }

//        die();

        $data['pohon'] = $pohon;
        $data['count_cpb'] = $pohon2;

//        echo '<br>';
//        echo 'Honpo OK';
//        echo '<br>';
//     echo '<pre>';
//                print_r($pohon);
        
       
//        print_r($pohon2);
//        die();
//        echo '<br>';
//        echo 'CPB OK';
//        echo '<br>';
//        print_r($pcb);
//        die();
        $data['pcb'] = $pcb;
        $data['cfpt'] = $cfpt2;

//        echo '<br>';
//        echo 'CFPT';
//        echo '<br>';
//      print_r($cfpt2);
//      die();
//        foreach ($cfpt2 as $key => $value) {
//            echo '<br>';
//            echo '<br>';
//            echo $key . ' =>';
//            foreach ($value as $key2 => $value2) {
//                echo '<br>';
//                echo $key2;
//                echo '-> <br>';
//                foreach ($value2 as $key3 => $value3) {
//                    echo '<br>';
//                    echo $key3;
//                    echo ' === ';
//                    if ($key2 == $key3) {
//                        print_r($pohon['null'][$key2][$key]);
//                    } else {
//                        print_r($pohon['null'][$key2][$key3][$key]);
//                    }
//                
//                }
//            }
//        }
//
//        echo '<br>';
//        echo 'CFPT Kelompok';
//        echo '<br>';
//
//        print_r($cfpt2);
//        foreach ($pcb as $id_kategori => $value) {
////              echo '<br><br>'.$id_kategori.':';
////              $cabang[$id_kategori]=array();
//            foreach ($value as $key => $value2) {
////                echo '<br>'.$value2[0];
//                if (empty($cabang[$id_kategori][$value2[0]])) {
//                    $cabang[$id_kategori][$value2[0]] = 1;
////                    array_push($cfpt, $pohon)
//                }
//            }
////            
//        }
//        print_r($cabang);
//        $data[]


//        $max_support['value'] = 0;
//        $max_support['id_kategori1'] = 0;
//        $max_support['id_kategori2'] = 0;
//
//        $max_confidence['value'] = 0;
//        $max_confidence['id_kategori1'] = 0;
//        $max_confidence['id_kategori2'] = 0;
////        echo '<br>';
//        foreach ($growth as $id_kategori1 => $array1) {
//            foreach ($array1 as $id_kategori2 => $value) {
////              echo '<br>' . $id_kategori1 . '=>' . $id_kategori2 . ' = ' . count($silang[$id_kategori1][$id_kategori2]);
//                if (count($growth['kategori_count']) > 1) {
//                    $growth[$id_kategori1][$id_kategori2] = $value;
//                    $support[$id_kategori1][$id_kategori2] = count($growth[$id_kategori1][$id_kategori2]) / $total_transaksi;
//                    $confidence[$id_kategori1][$id_kategori2] = count($growth[$id_kategori1][$id_kategori2]) / count($kategori[$id_kategori1]['id_transaksi']);
//
//                    if ($max_support['value'] < $support[$id_kategori1][$id_kategori2]) {
//                        $max_support['value'] = $support[$id_kategori1][$id_kategori2];
//                        $max_support['id_kategori1'] = $id_kategori1;
//                        $max_support['id_kategori2'] = $id_kategori2;
//                    }
//
//                    if ($max_confidence['value'] < $confidence[$id_kategori1][$id_kategori2]) {
//                        $max_confidence['value'] = $confidence[$id_kategori1][$id_kategori2];
//                        $max_confidence['id_kategori1'] = $id_kategori1;
//                        $max_confidence['id_kategori2'] = $id_kategori2;
//                    }
//                }
//            }
//        }
//
//        $data['kategori'] = $kategori;
//        $data['transaksi'] = $transaksi;
//        $data['support'] = $support;
//        $data['confidence'] = $confidence;
        
//        echo '</pre>';
        return $data;
    }

    function itemset()
    {
        $support = $this->input->post('support');
        $confidence = $this->input->post('confidence');
        $item = $this->input->post('item');
    
        $no = 0;
        foreach ($item as $key => $value) {
            $cek = 0;

            foreach ($value as $key2 => $value2) {
                if ($cek == 0) {
                    foreach ($value2 as $key3 => $value3) {
                        if ($item[$key][0][$key3] >= $support && $item[$key][1][$key3] >= $confidence) {
                            $no++;
                        }
                    }
                    $cek++;
                }
            }
        }

        $a_itemset [] = $no;

        echo json_encode(['nilai'=>$no]);
    }

    function itemset2()
    {
        $total = $this->input->post('total');
        $fpg_value = $this->input->post('fpg_value');
        $data_growth = $this->input->post('data_growth');

        $support1 = $this->input->post('support');
        $confidence1 = $this->input->post('confidence');

        $no = 0;
                                    foreach ($fpg_value as $key => $value) {

                                        $support = $value / $total;
                                        $confidence = $value / $data_growth[$key][1];

                                        if ($support >= $support1 && $confidence >= $confidence1) {
                                            $no++;
                                        }

                                    }
                                    $a_itemset [] = $no;
                                    echo json_encode(['nilai'=>$no]);
    }

    function detail_eclat()
    {
        $eclat = $this->session->userdata("eclat");
        $support = $this->uri->segment(3);
        $confidence = $this->uri->segment(4); 
        // $this->session->unset_userdata('eclat');

        $data['eclat'] = $eclat;
        $data['support'] = $support;
        $data['confidence'] = $confidence;
        $data['konten'] = 'tatlek/detail_eclat';
        $this->load->view('template/v_template', $data);
    }

}
