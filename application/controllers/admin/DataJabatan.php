<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataJabatan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('hak_akses') != '1') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Anda Belum Login!</div>');
			redirect('welcome');
		}
	}

	public function index()
	{
		$data['title'] = "Data Jabatan";

		// load library 
		$this->load->library('pagination');

		// CONFIG 
		$config['base_url'] = 'http://localhost/penggajian/admin/datajabatan/index';
		$config['total_rows'] = $this->penggajianModel->countAllJabatan();
		$config['per_page'] = 12;

		//styling
		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		//INITIALIZE
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$data['jabatan'] = $this->penggajianModel->getJabatan($config['per_page'], $data['start']);

		if ($this->input->post('keyword')) {
			$data['jabatan'] = $this->penggajianModel->cariDataJabatan();
		}

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dataJabatan', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambahData()
	{
		$data['title'] = "Tambah Data Jabatan";

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/tambahDataJabatan', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambahDataAksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambahData();
		} else {
			$nama_jabatan	= $this->input->post('nama_jabatan');
			$gaji_pokok		= $this->input->post('gaji_pokok');
			$tj_transport	= $this->input->post('tj_transport');
			$uang_makan		= $this->input->post('uang_makan');

			$data = array(
				'nama_jabatan'	=> $nama_jabatan,
				'gaji_pokok'	=> $gaji_pokok,
				'tj_transport'	=> $tj_transport,
				'uang_makan'	=> $uang_makan
			);
			$this->penggajianModel->insert_data($data, 'data_jabatan');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data baru berhasil ditambahkan!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times </button> </div>');
			redirect('admin/dataJabatan');
		}
	}

	//
	public function updateData($id)
	{
		$where = array(
			'id_jabatan' => $id
		);
		$data['jabatan'] = $this->db->query("SELECT * FROM data_jabatan WHERE id_jabatan = '$id' ")->result();

		$data['title'] = "Update Data Jabatan";

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/updateDataJabatan', $data);
		$this->load->view('templates_admin/footer');
	}

	public function updateDataAksi()
	{

		$this->_rules();

		$id 			= $this->input->post('id_jabatan');
		$nama_jabatan	= $this->input->post('nama_jabatan');
		$gaji_pokok		= $this->input->post('gaji_pokok');
		$tj_transport	= $this->input->post('tj_transport');
		$uang_makan		= $this->input->post('uang_makan');

		$data = array(
			'nama_jabatan'	=> $nama_jabatan,
			'gaji_pokok'	=> $gaji_pokok,
			'tj_transport'	=> $tj_transport,
			'uang_makan'	=> $uang_makan
		);

		$where = array(
			'id_jabatan' => $id
		);

		$this->penggajianModel->update_data('data_jabatan', $data, $where);

		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data  berhasil diupdate!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times </button> </div>');
		redirect('admin/dataJabatan');
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
		$this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required');
		$this->form_validation->set_rules('tj_transport', 'Tunjangan Transport', 'required');
		$this->form_validation->set_rules('uang_makan', 'Uang Makan', 'required');
	}

	public function deleteData($id)
	{
		$where = array('id_jabatan' => $id);
		$this->penggajianModel->delete_data($where, 'data_jabatan');

		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data  berhasil dihapus!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times </button> </div>');
		redirect('admin/dataJabatan');
	}
}
