<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GantiPassword extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('hak_akses') != '1') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Anda Belum Login!</strong></div>'); 
				redirect('welcome');
		}
	}

	public function index()
	{
		$data['title'] = "Ganti Password";
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('formGantiPassword', $data);
		$this->load->view('templates_admin/footer');
	}

	public function gantiPasswordAksi()
	{
		$passBaru = $this->input->post('passBaru');
		$ulangPass = $this->input->post('ulangPass');

		$this->form_validation->set_rules('passBaru', 'Password Baru', 'required|matches[ulangPass]');
		$this->form_validation->set_rules('ulangPass', 'Ulang Password', 'required|matches[passBaru]');

		if ($this->form_validation->run() != FALSE) {
			$data = array('password' => md5($passBaru));
			$id   = array('id_pegawai' => $this->session->userdata('id_pegawai'));

			$this->penggajianModel->update_data('data_pegawai', $data, $id);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Password berhasil diubah. Silahkan Login</strong></div>'); 
			redirect('welcome');
		}else{
			$data['title'] = "Ganti Password";
			$this->load->view('templates_admin/header', $data);
			$this->load->view('templates_admin/sidebar');
			$this->load->view('formGantiPassword', $data);
			$this->load->view('templates_admin/footer');
		}
	}

	public function _rules()
	{

	}
}