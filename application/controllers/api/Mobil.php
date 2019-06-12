<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mobil extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Mobil_model', 'mobil');
	}

	public function index_get()
	{
		$id = $this->get('id');
		if ($id === null) {
			$mobil = $this->mobil->getMobil();
		}else{
			$mobil = $this->mobil->getMobil($id);
		}
		
		if ($mobil) {
			$this->response([
                    'status' => true,
                    'data' => $mobil
                ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id');

		if ($id === null) {
			$this->response([
                    'status' => false,
                    'message' => 'provide an id'
                ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			if ( $this->mobil->deleteMobil($id) > 0) {
			//berhasil	
				$this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted.'
                ], REST_Controller::HTTP_OK);
			}else{
			//gagal
				$this->response([
                    'status' => false,
					'id' => $id,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	public function index_post()
	{
		$data = [
			'no_kerangka' => $this->post('no_kerangka'),
			'no_polisi' => $this->post('no_polisi'),
			'merek' => $this->post('merek'),
			'tipe' => $this->post('tipe'),
			'tahun' => $this->post('tahun')
		];

		if ($this->mobil->createMobil($data) > 0) {
			$this->response([
                    'status' => true,
                    'message' => 'New Mobil.'
                ], REST_Controller::HTTP_CREATED);
		}else{
			$this->response([
                    'status' => false,
                    'message' => 'gagal'
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put()
	{
		$id = $this->put('id');
		$data = [
			'no_kerangka' => $this->put('no_kerangka'),
			'no_polisi' => $this->put('no_polisi'),
			'merek' => $this->put('merek'),
			'tipe' => $this->put('tipe'),
			'tahun' => $this->put('tahun')
		];

	if ($this->mobil->updateMobil($data, $id) > 0) {
			$this->response([
					'status' => true,
					'id' => $id,
                    'message' => 'Berhasil Update'
                ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
					'status' => false,
					'id' => $id,
                    'message' => 'Gagal Update'
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}