<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'login') {
			redirect('/');
		}
		$this->load->model('masakan_model');
		$this->load->model('meja_model');
	}

	public function masakan()
	{
		$getMasakan = $this->masakan_model->getMasakan();
		$getMeja = $this->meja_model->getOrder();
		$data = array(
			'masakan' => $getMasakan->num_rows() > 0 ? $getMasakan->result() : 'kosong' ,
			'meja' => $getMeja->num_rows() > 0 ? $getMeja->result() : 'kosong' 
		);
		$this->load->view('order/masakan', $data);
	}

	public function meja()
	{
		$getMeja = $this->meja_model->getMeja();
		$getOrder = $this->meja_model->getOrder();
		$data = array(
			'meja' => $getMeja->num_rows() > 0 ? $getMeja->result() : 'kosong' ,
			'order' => $getOrder->num_rows() > 0 ? $getOrder->result() : 'kosong'
		);
		$this->load->view('order/meja', $data);
	}

	public function add()
	{
		if ($meja_id = $this->input->post('meja_id')) {
			$tanggal_masuk = $this->input->post('tanggal')." ".$this->input->post('jam_masuk');
			$tanggal_keluar = $this->input->post('tanggal')." ".$this->input->post('jam_keluar');
			
			$cekOrderMejaExist = $this->meja_model->cekOrderMejaExist($tanggal_masuk,$tanggal_keluar,$meja_id);
			
			if(!$cekOrderMejaExist){
				$this->session->set_flashdata('sukses','tambah');
				$keterangan = $this->input->post('keterangan');
				$data = array(
					'meja_id' => $meja_id,
					'nama' => $this->input->post('nama'),
					'tanggal' => $this->input->post('tanggal'),
					'jam_masuk' => $this->input->post('jam_masuk'),
					'jam_keluar' => $this->input->post('jam_keluar'),
					'tanggal_masuk' => $tanggal_masuk,
					'tanggal_keluar' => $tanggal_keluar,
					'keterangan' => $keterangan === '' ? 'Tidak Ada' : $this->input->post('keterangan'),
					'status' => 2
				);	
				if ($this->meja_model->orderMeja($meja_id,$data)) {
					redirect('order/meja');
				}
			}else{
				$this->session->set_flashdata('meja_exist', 'sukses');
			}
		}

		redirect('order/meja');
		
	}

	public function hapus()
	{
		if ($this->input->get('id') && $this->input->get('meja_id')) {
			$id = $id = $this->input->get('id');
			$id_meja = $this->input->get('meja_id');
			$this->meja_model->hapusOrderMeja($id,$id_meja);
			$this->session->set_flashdata('sukses','hapus');
			redirect('order/meja');
		} else {
			redirect('order/meja');
		}
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */