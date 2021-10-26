<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPegawai extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('hak_akses') != '1') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Anda Belum Login!</div>');
			redirect('welcome');
		}
		//$this->load->helper(array('url'));
		//$this->load->model('penggajianModel');
	}

	public function index()
	{
		$data['title'] = "Data Pegawai";

		// load library 
		$this->load->library('pagination');

		// CONFIG 
		$config['base_url'] = 'http://localhost/penggajian/admin/dataPegawai/index';
		$config['total_rows'] = $this->penggajianModel->countAllPegawai();
		$config['per_page'] = 10;

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
		$data['pegawai'] = $this->penggajianModel->getPegawai($config['per_page'], $data['start']);

		if ($this->input->post('keyword')) {
			$data['pegawai'] = $this->penggajianModel->cariDataPegawai();
		}
		//var_dump($data['pegawai']);
		//die;

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dataPegawai', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambahData()
	{
		$data['title'] = "Tambah Data Pegawai";

		$data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/formTambahPegawai', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambahDataAksi()
	{
		$this->_rules();

		$nik		        = $this->input->post('nik');
		$nama_pegawai		= $this->input->post('nama_pegawai');
		$jenis_kelamin		= $this->input->post('jenis_kelamin');
		$jabatan			= $this->input->post('jabatan');
		$tanggal_masuk		= $this->input->post('tanggal_masuk');
		$status				= $this->input->post('status');
		$hak_akses			= $this->input->post('hak_akses');
		$username			= $this->input->post('username');
		$password			= md5($this->input->post('password'));
		$photo				= $_FILES['photo']['name'];

		if ($photo = '') {
		} else {
			$config['upload_path'] 	= './assets/photo';
			$config['allowed_types']	= 'jpg|jpeg|png|tiff';
			$config['max_size']      	= '2048';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('photo')) {
				echo "Foto gagal untuk diupload";
			} else {
				$photo = $this->upload->data('file_name');
			}


			$data = array(
				'nik'					=> $nik,
				'nama_pegawai'			=> $nama_pegawai,
				'jenis_kelamin'			=> $jenis_kelamin,
				'jabatan'				=> $jabatan,
				'tanggal_masuk'			=> $tanggal_masuk,
				'status'				=> $status,
				'hak_akses'				=> $hak_akses,
				'username'				=> $username,
				'password'				=> $password,
				'photo'					=> $photo
			);
			$this->penggajianModel->insert_data($data, 'data_pegawai');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data baru berhasil ditambahkan!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times </button> </div>');
			redirect('admin/dataPegawai');
		}
	}


	public function updateData($id)
	{
		// $where = array('id_pegawai' => $id);
		$data['title'] = "Update Data Pegawai";
		$data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
		$data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai = '$id'")->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/formUpdatePegawai', $data);
		$this->load->view('templates_admin/footer');
	}

	public function updateDataAksi()
	{
		// echo "disini";
		// die;
		$this->_rule();

		if ($this->form_validation->run() == FALSE) {
			$id = $this->input->post('id_pegawai');
			$this->updateData($id);
		} else {
			$id            = $this->input->post('id_pegawai');
			$nik           = $this->input->post('nik');
			$nama_pegawai  = $this->input->post('nama_pegawai');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$tanggal_masuk = $this->input->post('tanggal_masuk');
			$jabatan       = $this->input->post('jabatan');
			$status        = $this->input->post('status');
			$hak_akses     = $this->input->post('hak_akses');
			$username      = $this->input->post('username');
			$password      = md5($this->input->post('password'));
			$photo         = $_FILES['photo']['name'];
			if ($photo) {
				$config['upload_path'] = './assets/photo';
				$config['allowed_types'] = 'jpg|jpeg|png|tiff';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('photo')) {
					$photo = $this->upload->data('file_name');
					$this->db->set('photo', $photo);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = array(
				'nik'           => $nik,
				'nama_pegawai'  => $nama_pegawai,
				'jenis_kelamin' => $jenis_kelamin,
				'jabatan'       => $jabatan,
				'tanggal_masuk' => $tanggal_masuk,
				'status'        => $status,
				'hak_akses'     => $hak_akses,
				'username'      => $username,
				'password'      => $password,
			);

			$where = array('id_pegawai' => $id);

			$this->penggajianModel->update_data('data_pegawai', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil diupdate</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
			redirect('admin/dataPegawai');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[data_pegawai.nik]', [
			'is_unique' => 'NIK ini telah terdaftar!'
		]);
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('photo', 'Photo', 'required');
		$this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');
	}

	public function _rule()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		$this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');
	}

	public function deleteData($id)
	{
		$where = array('id_pegawai' => $id);
		$this->penggajianModel->delete_data($where, 'data_pegawai');

		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Data  berhasil dihapus!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times </button> </div>');
		redirect('admin/dataPegawai');
	}

	/*	public function page()
	{
		$this->load->database();
		$jumlah_data = $this->penggajianModel->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'index.php/DataPegawai/index/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['pegawai'] = $this->penggajianModel->data($config['per_page'],$from);
		$this->load->view('dataPegawai',$data);
	} */
}
