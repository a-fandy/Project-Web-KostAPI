<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KostView extends CI_Controller {

    var $API ="";
	public function __construct(){
        parent::__construct();
		$this->API="http://localhost/KostAPI/";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
	}

	public function index()
	{
		$data['kost'] = json_decode($this->curl->simple_get($this->API.'/Kost/481f4b73e27afd9fd9'));
		$this->load->view('kost/index',$data);
	}

	public function realtime(){
		$this->load->view('kost/realtime');
	}
}