<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cetak_biaya_luar_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('biaya_luar_m','model');
	}

	function index(){
		$keyword = "";
		$data = array(
		  'page' 		=> "dashboard/cetak_biaya_luar_v",
		  'induk_menu' 	=> "input_biaya",
		  'menu' 		=> "cetak_biaya_luar",
		  'title' 		=> "CETAK PENGGUNAAN BIAYA DILUAR ANGGARAN",
		  'no_surat'	=> $this->model->get_no_surat($keyword),
		  'url'			=> base_url()."dashboard/cetak_biaya_luar_c/cetak",
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak(){
		$id_surat = $this->input->post('id_surat');
		$surat_atas = $this->model->get_surat_id($id_surat);

		$data = array(
		  'title' 		=> "IZIN PENGGUNAAN BIAYA DI LUAR ANGGARAN",
		  'surat_atas' 	=> $surat_atas,
		);

		$this->load->view('dashboard/pdf/report_biaya_luar_anggaran_pdf', $data);
	}

	function get_surat_id(){
		$id_surat = $this->input->post('id_surat');
		$data = $this->model->get_surat_id($id_surat);
		echo json_encode($data);
	}

	function cari_surat(){
		$keyword = $this->input->post('keyword');
		$data = $this->model->get_no_surat($keyword);
		echo json_encode($data); 
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */