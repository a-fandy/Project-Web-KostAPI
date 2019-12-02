<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kost extends REST_Controller {
	private $key='481f4b73e27afd9fd9';

	function __construct() {
        parent::__construct();
		
		$this->load->model('Kost_model');
    }
	
	public function cekKey($key){
		if($this->key==$key){
			return true;
		}
		return false;
	}

	public function index_get($key='') {
		header("Access-Control-Allow-Origin: *");
		if($this->cekKey($key)){
			$idKost = $this->input->get('idKost');
			if ($idKost == '') {
				$kost = $this->Kost_model->get_all_kost();
			} 
			else {
				$this->db->where('idKost', $idKost);
				$kost = $this->Kost_model->get_kost($idKost);
			}
			$this->response($kost, 200);
		}
        $this->response(array('status' => 'Key Not Valid', 502));
	}
	
	
	function index_post($key)
    {   
        $params = array(
			'tersedia' => $this->input->post('tersedia'),
			'namaKost' => $this->input->post('namaKost'),
			'alamat' => $this->input->post('alamat'),
			'noTelp' => $this->input->post('noTelp'),
			'namaPemilik' => $this->input->post('namaPemilik'),
			'ukuran' => $this->input->post('ukuran'),
			'jenis' => $this->input->post('jenis'),
			'harga' => $this->input->post('harga'),
			'gambar' => $this->input->post('gambar'),
			'deskripsi' => $this->input->post('deskripsi'),
        );		   
		
		$kost_id = $this->Kost_model->add_kost($params);
        if ($kost_id) {
			$this->response($params, 200);
		} 
		else {
			$this->response(array('status' => 'fail', 502));
		}
	}
	
	function index_delete($key) {
        $idKost = $this->delete('idKost');
		$delete = $this->Kost_model->delete_kost($idKost);
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
