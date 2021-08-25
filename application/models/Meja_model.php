<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja_model extends CI_Model {

	protected $table = 'meja';

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		return $this->db->get($this->table)->result();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function getMeja()
	{
		//$this->db->where('status', '0');
		return $this->db->get($this->table);
	}
	public function getMejaAndroid()
	{
		$this->db->where('status', '0');
		return $this->db->get($this->table);
	}

	public function getOrderMeja()
	{
		$this->db->select('meja_id');
		$this->db->where('status', '1');
		return $this->db->get($this->table);
	}

	public function unsetOrderMeja($id)
	{
		$data = $this->db->where('id',$id)->get('ordermeja')->row_object();
		if($data->status == 1){
			$meja_id = $data->meja_id; 
			$this->db->where('id',$meja_id);
			$this->db->update('meja',['status'=>0]);
		}
		$this->db->where('id',$id);
		$this->db->update('ordermeja',['status'=>0]);


	}


	public function getOrder()
	{
		$this->db->select('ordermeja.id,ordermeja.nama, meja.no_meja as id_meja, DATE_FORMAT(ordermeja.tanggal, "%d %M %Y") as tanggal, ordermeja.keterangan, meja.no_meja,ordermeja.jam_masuk,ordermeja.jam_keluar');
		$this->db->where('ordermeja.status', 2);
		$this->db->from('ordermeja');
		$this->db->join('meja', 'meja.id = ordermeja.meja_id');
		return $this->db->get();
	}
	public function cekOrderMejaExist($datetime,$datetime2,$meja_id)
	{
		return $this->db->query("SELECT * FROM `ordermeja` where meja_id = ".$meja_id." and tanggal_masuk between '".$datetime."' and '".$datetime2."' or tanggal_keluar between '".$datetime."' and '".$datetime2."'")->row_object();
	}

	public function orderMeja($no_meja,$data)
	{
		$this->db->where('id', $no_meja);
		$this->db->set('status', '1');
		if ($this->db->update($this->table)) {
			return $this->db->insert('ordermeja', $data);
		}
	}
	public function setMeja($id_meja,$data)
	{
		$this->db->where('id', $id_meja);
		$this->db->set('status', '1');
		if ($this->db->update($this->table)) {
			$this->db->insert('ordermeja', $data);
			return $this->db->order_by('id','desc')->get('ordermeja')->row_object();
		}
	}

	public function hapusOrderMeja($id,$id_meja)
	{
		$this->db->where('id', $id_meja);
		$this->db->set('status', '0');
		if ($this->db->update($this->table)) {
			$this->db->where('id', $id);
			return $this->db->delete('ordermeja');
		}
	}


}

/* End of file Meja_model.php */
/* Location: ./application/models/Meja_model.php */