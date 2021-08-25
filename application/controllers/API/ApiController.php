<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header("Access-Control-Max-Age", "3600");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Access-Control-Allow-Credentials", "true");

class ApiController extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');	
		$this->load->model('masakan_model','masakan');
		$this->load->model('Meja_model','meja');
		$this->load->model('Kategori_masakan_model','kategori_masakan');
		$this->load->model('Transaksi_model','transaksi');
	}
	public function setProsesPesanan()
	{
		$post = $this->input->post();
		$ordermeja_id = $post['ordermeja_id'];
		$id_masakan = substr($post['id_masakan'], 0,-1);
		$id_masakan = explode(",", $id_masakan);
		$harga = explode(",", $post['harga']);
		$qty = explode(",", $post['qty']);
		$total_harga_bayar = $post['total_harga_bayar'];
		$dataOrderByOrderMeja = $this->transaksi->getDataOrderByOrderMeja($ordermeja_id);
		if($dataOrderByOrderMeja){
			//update transaksi
			$data = [
						'total_harga_bayar' => $total_harga_bayar + (int)$dataOrderByOrderMeja->total_harga_bayar,
						'pesanan_baru' => 1
			];	
			$this->transaksi->update($ordermeja_id,$data);
			$transaksi_id = $dataOrderByOrderMeja->id;
			/*=====================*/
			/*create detail*/
			foreach ($id_masakan as $row => $value) {
				$data_detail = [
							'transaksi_id' =>$transaksi_id,
							'masakan_id' => $value,
							'qty' =>$qty[$row],
							'harga' =>$harga[$row],
				];

				$this->transaksi->create_detail($data_detail);
			}
			/*===================*/
		}else{
			//create transaksi
			$data = [
						'ordermeja_id' => $ordermeja_id,
						'total_harga_bayar' => $total_harga_bayar,
						'tanggal_waktu' => Date('Y-m-d h:i:s'),
			];	
			$transaksi_id = $this->transaksi->create($data);
			/*=====================*/
			/*create detail*/
			foreach ($id_masakan as $row => $value) {
				$data_detail = [
							'transaksi_id' =>$transaksi_id,
							'masakan_id' => $value,
							'qty' =>$qty[$row],
							'harga' =>$harga[$row],
				];

				$this->transaksi->create_detail($data_detail);
			}
			/*===================*/	
		}
		
		$this->setResponse("Pesanan berhasil di proses");
	}

	public function cekStatusTransaksi(){
		$post = $this->input->post();
		$ordermeja_id = $post['ordermeja_id'];
		$data = $this->transaksi->getStatusTransaksi($ordermeja_id);

		if($data){
			$this->setResponse("Transaksi ini sudah selesai anda akan dikeluarkan secara otomatis , terima kasih");
		}else{
			$this->setResponse("",0);
		}
	}
	public function setMeja()
	{
		$post = $this->input->post();
		$data = [
					'nama' => $post['nama'],
					'meja_id' =>$post['id_meja'],
					'token_fm' =>$post['token_fm'],
					'tanggal' =>date("Y-m-d"),
					'keterangan' => 'Order by android'
		];
		$data = $this->meja->setMeja($post['id_meja'],$data);
		
		$this->setResponse($data->id);
	}

	public function getDataOrder()
	{
		$post = $this->input->post();
		$ordermeja_id = $post['ordermeja_id'];
		$data = $this->transaksi->getDataOrder($ordermeja_id);
		$this->setListResponse($data->result());	
	}
	public function getDataMeja()
	{
		$data = $this->meja->getMejaAndroid();
		$this->setListResponse($data->result());
	}

	public function getDataKategoriMasakan()
	{
		$data = $this->kategori_masakan->read();
		$inserted = [[
				'id' => "0",
				'nama' => "All",
		]];
		array_splice( $data, 0, 0, $inserted ); // splice in at position 0
		$this->setListResponse($data);
	}
	public function getDataMasakan()
	{
		$post = $this->input->post();
		$id_kategori_masakan =$post['id_kategori_masakan'];
		$data = $this->masakan->readByKategori($id_kategori_masakan);
		$this->setListResponse($data);
	}
	public function getDataMasakan2()
	{
		$data = $this->masakan->read();
		$this->setListResponse($data);
	}
	public function searchDataMasakan()
	{
		$search = $this->input->post('search');
		$data = $this->masakan->readSearch($search);
		$this->setListResponse($data);
	}
	public function getDetailMasakan($id)
	{
		$data = $this->masakan->readById($id);
		$this->setBasicResponse($data);
	}


	/*RESPONSE TEMPLATE*/
	public function setListResponse($data,$status = 1){
		if($status == 1){
			$success = TRUE;
			$message = "success retreived data";
		} else{
			$success = FALSE;
			$message = "not found";
		}
		$response  = array(
							'success' => $success,
							'message' => $message,
							'data' => $data,
		);
		echo json_encode($response);

	}

	public function setResponse($message,$status = 1){
		if($status == 1){
			$success = TRUE;
		} else{
			$success = FALSE;
			$message = "not found";
		}
		$response  = array(
							'success' => $success,
							'message' => $message
		);
		echo json_encode($response);

	}
	public function setBasicResponse($data,$status = 1){
		if($status == 1){
			$success = TRUE;
		} else{
			$success = FALSE;
		}
		$response  = array(
							'success' => $success,
							'data' => $data
		);
		echo json_encode($response);

	}

	
}

/* End of file Masakan.php */
/* Location: ./application/controllers/Masakan.php */