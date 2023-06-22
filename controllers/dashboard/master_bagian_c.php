<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_bagian_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('master_bagian_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";

		if($this->input->post('simpan')){
			$msg = 1;
			$kode_bagian = addslashes($this->input->post('kode_bagian'));
			$nama_bagian = addslashes($this->input->post('nama_bagian'));
			$keterangan  = addslashes($this->input->post('keterangan'));

			$this->model->simpan_bagian($kode_bagian, $nama_bagian, $keterangan);
			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada menu', 'MASTER BAGIAN', 'dengan Nama Bagian', $nama_bagian);

		} else if($this->input->post('id_hapus')){
			$id_hapus = $this->input->post('id_hapus');
			$nama_bagian = $this->model->get_bagian_by_id($id_hapus)->NAMA;
			$msg = 3;
			$this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada menu', 'MASTER BAGIAN', 'dengan Nama Bagian', $nama_bagian);
			$this->model->hapus_bagian($id_hapus);		

		} else if($this->input->post('edit')){
			$id_edit = $this->input->post('id_bagian_ed');
			$nama_bagian_ed = addslashes($this->input->post('nama_bagian_ed'));			
			$keterangan_ed = addslashes($this->input->post('keterangan_ed'));			
			$msg = 1;
			$this->master_model_m->save_log('Ubah', 'Melakukan ubah data pada menu', 'MASTER BAGIAN', 'dengan Nama Bagian', $nama_bagian_ed);

			$this->model->edit_bagian($id_edit, $nama_bagian_ed, $keterangan_ed);	

		} else if($this->input->post('excel')){
			$this->print_excel();
		} else if($this->input->post('pdf')){
			$this->print_pdf();
		}

		$get_bagian = $this->model->get_bagian_all();

		$data = array(
		  'page' => "dashboard/master_bagian_v",
		  'induk_menu' => "setup_data",
		  'menu' => "master_bagian",
		  'title' => "MASTER BAGIAN",
		  'dt' => $get_bagian,		
		  'post_url' => "dashboard/master_bagian_c",  
		  'msg'  => $msg,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cek_kode(){
		$kode_bagian = $this->input->post('kode_bagian');
		$hasil = 0;

		$cek = $this->model->cek_kode_bagian($kode_bagian);
		if(count($cek) > 0){
			$hasil = 1;
		} else {
			$hasil = 0;
		}

		echo json_encode($hasil);
	}

	function get_data_bagian(){
		$id = $this->input->post('id');
		$data = $this->model->get_bagian_by_id($id);

		echo json_encode($data);
	}

	function print_excel(){

		$get_bagian = $this->model->get_bagian_all();

		$data = array(
		  'dt' => $get_bagian,		
		);
		$this->load->view('dashboard/excel/master_bagian_xls', $data);
	}

	function print_pdf(){
		$get_bagian = $this->model->get_bagian_all();

		$data = array(
		  'dt' => $get_bagian,		
		);
		$this->load->view('dashboard/pdf/master_bagian_pdf', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */