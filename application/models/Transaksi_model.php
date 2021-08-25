<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	protected $table = 'transaksi';

	public function create($data)
	{
		$this->db->insert($this->table, $data);
		return $insert_id = $this->db->insert_id();;
	}

	public function update($ordermeja_id,$data)
	{
		$this->db->where('transaksi.ordermeja_id',$ordermeja_id);
		$this->db->update($this->table, $data);
	}
	public function create_detail($data)
	{
		$this->db->insert($this->table."_detail", $data);
	}
	public function getStatusTransaksi($ordermeja_id){
		$this->db->where('transaksi.ordermeja_id',$ordermeja_id);
		$this->db->where('transaksi.status',0);
		
		return $this->db->get($this->table)->row();

	}

	public function getDataOrderByOrderMeja($ordermeja_id)
	{
		return $this->db->where('ordermeja_id',$ordermeja_id)->get('transaksi')->row();
	}
	public function getDataOrder($ordermeja_id)
	{
		$this->db->select('transaksi.*,meja.no_meja,ordermeja.nama,masakan.id as id_masakan,masakan.nama as nama_masakan,masakan.harga,transaksi_detail.qty,masakan.gambar,transaksi_detail.pesanan_baru_detail');
		$this->db->where('transaksi.ordermeja_id',$ordermeja_id);
		$this->db->from('transaksi');
		$this->db->join('transaksi_detail', 'transaksi.id = transaksi_detail.transaksi_id');
		$this->db->join('masakan', 'transaksi_detail.masakan_id = masakan.id');
		$this->db->join('ordermeja', 'ordermeja.id = transaksi.ordermeja_id');
		$this->db->join('meja', 'ordermeja.meja_id = meja.id');
		return $this->db->get();
	}
	public function unsetPesananBaru($ordermeja_id)
	{
		$this->db->where('transaksi.ordermeja_id',$ordermeja_id);
		$this->db->update('transaksi',['pesanan_baru'=>0]);

		$dataOrderByOrderMeja = $this->getDataOrderByOrderMeja($ordermeja_id);
		$this->db->where('transaksi_detail.transaksi_id',$dataOrderByOrderMeja->id);
		$this->db->update('transaksi_detail',['pesanan_baru_detail'=>0]);
	}
	public function unsetPembayaran($ordermeja_id)
	{
		$this->db->where('transaksi.ordermeja_id',$ordermeja_id);
		$this->db->update('transaksi',['status'=>0]);
	}
	public function setProsesMasakan($ordermeja_id)
	{
		$this->db->where('ordermeja_id',$ordermeja_id);
		$this->db->update('transaksi',['status'=>2]);

		$this->db->where('id',$ordermeja_id);
		return $this->db->get('ordermeja')->row();
	}
	public function setKonfirmasiMasakan($ordermeja_id)
	{
		$this->db->where('transaksi.ordermeja_id',$ordermeja_id);
		$this->db->update('transaksi',['status'=>0]);

		$this->db->where('id',$ordermeja_id);
		return $this->db->get('ordermeja')->row();
	}

	public function read($status = 1)
	{
		$this->db->select('transaksi.*,meja.no_meja,ordermeja.nama');
		$this->db->where('transaksi.status',$status);
		$this->db->where('transaksi.is_deleted',0);
		if($status == 1){
			$this->db->or_where('transaksi.status >=',2);
		}
		$this->db->from('transaksi');
		$this->db->join('ordermeja', 'ordermeja.id = transaksi.ordermeja_id');
		$this->db->join('meja', 'ordermeja.meja_id = meja.id');
		return $this->db->get();
		
	}
	public function read_cancel()
	{
		$this->db->select('transaksi.*,meja.no_meja,ordermeja.nama');
		$this->db->where('transaksi.is_deleted',1);
		$this->db->from('transaksi');
		$this->db->join('ordermeja', 'ordermeja.id = transaksi.ordermeja_id');
		$this->db->join('meja', 'ordermeja.meja_id = meja.id');
		return $this->db->get();
		
	}

	public function delete($id,$message)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table,['is_deleted' => 1,'status'=>0,'reason_deleted'=>$message]);
	}
	public function delete_data($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('transaksi');
	}

	public function proses($masakan,$total)
	{
		foreach ($masakan as $key => $id) {
			$data[] = $this->db->query("SELECT nama, harga, harga * ".$total[$key]." as total FROM `masakan` WHERE id = ".$id)->row();
			$data[$key]->qty = $total[$key];
		}
		return $data;
	}

	public function detail($id)
	{
		$this->db->select('id, masakan, total, no_meja, date_format(tanggal,"%d %M %Y") as tanggal, harga');
		$this->db->where('id', $id);
		$table = $this->db->get($this->table)->row();
		$table->masakan = explode(',', $table->masakan);
		$table->total = explode(',', $table->total);
		$table->harga = explode(',', $table->harga);
		return $table;
	}

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */