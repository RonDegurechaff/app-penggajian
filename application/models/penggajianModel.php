<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenggajianModel extends CI_Model
{

	public function getPegawai($limit, $start)
	{
		return $this->db->get('data_pegawai', $limit, $start)->result_array();
	}

	public function countAllPegawai()
	{
		return $this->db->get('data_pegawai')->num_rows();
	}

	public function getJabatan($limit, $start)
	{
		return $this->db->get('data_jabatan', $limit, $start)->result_array();
	}

	public function countAllJabatan()
	{
		return $this->db->get('data_jabatan')->num_rows();
	}

	public function cariDataJabatan()
	{
		$keyword = $this->input->post('keyword', true);
		$this->db->like('nama_jabatan', $keyword);
		return $this->db->get('data_jabatan')->result_array();
	}

	public function cariDataPegawai()
	{
		$keyword = $this->input->post('keyword', true);
		$this->db->like('nama_pegawai', $keyword);
		$this->db->or_like('nik', $keyword);
		$this->db->or_like('jabatan', $keyword);
		$this->db->or_like('status', $keyword);
		return $this->db->get('data_pegawai')->result_array();
	}

	public function get_data($table)
	{
		return $this->db->get($table);
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function update_data($table, $data, $where)
	{
		$this->db->update($table, $data, $where);
	}

	public function delete_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function insert_batch($table = null, $data = array())
	{
		$jumlah = count($data);
		if ($jumlah > 0) {
			$this->db->insert_batch($table, $data);
		}
	}

	public function cek_login()
	{
		$username	= set_value('username');
		$password	= set_value('password');

		$result		= $this->db->where('username', $username)
			->where('password', md5($password))
			->limit(1)
			->get('data_pegawai');

		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return FALSE;
		}
	}

	/*	function data($number,$offset){
		return $query = $this->db->get('data_pegawai',$number,$offset)->result();		
	}
 
	function jumlah_data(){
		return $this->db->get('data_pegawai')->num_rows();
	} */
}
