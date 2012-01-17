<?php
class Example extends CI_Controller {

    public $data = array('subview' => 'Oops, forgot to set a subview');
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }

    public function listing() {
        $this->data['subview'] = 'listing';
        $this->load->view('layouts/layout', $this->data);
    }
    
    public function detail() {
        $this->data['subview'] = 'detail';
        $this->load->view('layouts/layout', $this->data);
    }
}