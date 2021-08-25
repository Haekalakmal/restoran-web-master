<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		parent::__construct();
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->model('Transaksi_model','transaksi');
		$this->load->model('Meja_model','meja');
	}

	public function index()
	{
		$transaksi = $this->transaksi->read();
		$data['title'] = "Transaksi";
		$data['transaksi'] = $transaksi->result();
		$data['history'] = FALSE;
		$this->load->view('transaksi/data_transaksi',$data);
	}
	public function history()
	{
		$transaksi = $this->transaksi->read(0);
		$data['title'] = "History Transaksi";
		$data['transaksi'] = $transaksi->result();
		$data['history'] = TRUE;
		$this->load->view('transaksi/data_transaksi',$data);
	}
	public function gagal()
	{
		$transaksi = $this->transaksi->read_cancel();
		$data['title'] = "Transaksi Gagal";
		$data['transaksi'] = $transaksi->result();
		$data['history'] = TRUE;
		$this->load->view('transaksi/data_transaksi',$data);
	}


	public function proses()
	{		
		$data_post = $this->input->post();
		$ordermeja_id = $data_post['ordermeja_id'];
		$total_harga_bayar = $data_post['total_harga_bayar'];
		$data_transaksi = [
			'ordermeja_id' => $ordermeja_id,
			'total_harga_bayar' =>$total_harga_bayar,

			'tanggal_waktu' => Date('Y-m-d h:i:s'),
		];

		$dataOrderByOrderMeja = $this->transaksi->getDataOrderByOrderMeja($ordermeja_id);
		$id_masakan = $data_post['masakan_id'];
		$qty = $data_post['qty'];
		$harga = $data_post['harga'];
		
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
			$data_transaksi['pesanan_baru'] = 1;
			$data_transaksi['status'] = 1;
			$transaksi_id = $this->transaksi->create($data_transaksi);
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
		$this->session->set_flashdata('order_masakan', 'sukses');
		redirect('transaksi/history');
	
	}
	public function print_pdf($ordermeja_id)
	{
		$transaksi_data = $this->transaksi->getDataOrder($ordermeja_id)->result();
		$this->transaksi->unsetPembayaran($ordermeja_id);
		$this->meja->unsetOrderMeja($ordermeja_id);
        $this->load->library('Pdf');
        $html = $this->load->view('pdf_view', ['data'=>$transaksi_data], true);
        $this->pdf->createPDF($html, 'mypdf', false);
	}
	public function print_pdf_history($ordermeja_id)
	{
		$this->load->library('pdf');
		$transaksi_data = $this->transaksi->getDataOrder($ordermeja_id)->result();
		$this->transaksi->unsetPembayaran($ordermeja_id);
		$this->meja->unsetOrderMeja($ordermeja_id);
        
        $html = $this->load->view('pdf_view', ['data'=>$transaksi_data], true);
        $this->pdf->createPDF($html, 'mypdf', false);
	}

	public function getDetailTransaksi($ordermeja_id)
	{
		$transaksi_data = $this->transaksi->getDataOrder($ordermeja_id)->result();
		$this->transaksi->unsetPesananBaru($ordermeja_id);
		echo json_encode($transaksi_data);
	}
	public function setProsesMasakan($ordermeja_id)
	{
		$data = $this->transaksi->setProsesMasakan($ordermeja_id);
		$res = $this->send_push_notifikasi($data->token_fm,"Pesanan sedang disiapkan mohon menunggu");
		$this->session->set_flashdata('push_notifikasi', 'sukses');
		redirect('transaksi');
	}
	public function setKonfirmasiMasakan($ordermeja_id)
	{
		$data = $this->transaksi->setKonfirmasiMasakan($ordermeja_id);
		$res = $this->send_push_notifikasi($data->token_fm,"Makanan anda siap diantarkan");
		$this->session->set_flashdata('push_notifikasi', 'sukses');
		redirect('transaksi');
	}
	public function detail( $id = NULL )
	{
		if ($id) {
			$data = array(
				'pesanan' => $this->transaksi->detail($id),
			);
			$this->load->view('transaksi/detail', $data);
		} else {
			redirect('transaksi');
		}
	}

	public function hapus( $id = NULL,$ordermeja_id,$message )
	{
		if ($id) {
			$message = str_replace("_"," ",$message);
			$data = $this->transaksi->setKonfirmasiMasakan($ordermeja_id);
			$res = $this->send_push_notifikasi($data->token_fm,$message);
			$this->session->set_flashdata('hapus', 'sukses');
			$this->transaksi->delete($id,$message);
			$this->meja->unsetOrderMeja($ordermeja_id);
			redirect('transaksi');
		} else {
			redirect('transaksi');
		}
	}
	public function hapus_data( $id = NULL)
	{
		if ($id) {
			$this->transaksi->delete_data($id,$message);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function send_push_notifikasi($to,$message){
		$data=array(
		    'title'=>'Info',
		    'body'=> $message
		);
	    $api_key="AAAAQ82s7oE:APA91bEGAuevAsQzZZ27pkGVHRLQ0qAFclFWqpL0gbtGfyJoJQ5j8zPiiR2PH5XIDCOjWzyjo3f0H8yC0uoZ2dw3-A92Ps0r1X1FN0gJ9Dc2rkBaW-Cw5qeAq2hQIJyINyBOaJ23Q0Tr";
	    $url="https://fcm.googleapis.com/fcm/send";
	    $fields=json_encode(array('to'=>$to,'notification'=>$data));

	    // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, ($fields));

	    $headers = array();
	    $headers[] = 'Authorization: key ='.$api_key;
	    $headers[] = 'Content-Type: application/json';
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	    $result = curl_exec($ch);
	    if (curl_errno($ch)) {
	        echo 'Error:' . curl_error($ch);
	    }
	    curl_close($ch);
	    return $result;
	}


}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */