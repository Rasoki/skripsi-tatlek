<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tatlek extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {

        $data['konten'] = 'tatlek/v_index';
        $this->load->view('template/v_template', $data);
    }

}
