<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata("username")) {
            redirect('Template/login');
        }
    }

    function index() {

        $data['konten'] = 'dashboard/v_index';
        $this->load->view('template/v_template', $data);
    }

}
