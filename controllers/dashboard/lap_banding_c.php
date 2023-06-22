<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_banding_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('lap_banding_m','model');
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index(){
		$data = array(
		  'page' 		=> "dashboard/lap_banding_v",
		  'induk_menu'	=> "menu_laporan",
		  'menu' 		=> "lap_banding",
		  'title' 		=> "LAPORAN PERBANDINGAN",
		  'url'	  		=> base_url().'dashboard/lap_banding_c/cetak',
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak(){
		$jenis_laporan = $this->input->post('jenis_laporan');
		if($this->input->post('pdf')){
			if($jenis_laporan == "perbandingan_rkap_revisi"){
				$this->cetak_perbandingan_rkap_revisi();
			}else if($jenis_laporan == "perbandingan_uraian_rkap_revisi"){
				$this->cetak_perbandingan_rkap_revisi_uraian();
			}
		}else{
			if($jenis_laporan == "perbandingan_rkap_revisi"){
				$this->cetak_perbandingan_rkap_revisi_excel();
			}else if($jenis_laporan == "perbandingan_uraian_rkap_revisi"){
				$this->cetak_perbandingan_rkap_revisi_uraian_excel();
			}
		}
	}

	function cetak_perbandingan_rkap_revisi(){
		$tahun = $this->input->post('tahun');
		$view = "dashboard/pdf/report_perbandingan_rkap_revisi_pdf";
		
		$data = array(
			'tahun'			=> $tahun,
			'title' 		=> 'LAPORAN PERBANDINGAN REALISASI RKAP REVISI',
			'title2'		=> 'SEMUA BAGIAN',
			'kd_perkiraan'	=> $this->model->get_kode_perkiraan_new($tahun),
		);
		$this->load->view($view,$data);
	}

	function cetak_perbandingan_rkap_revisi_uraian(){
		$tahun = $this->input->post('tahun');
		$view = "dashboard/pdf/report_perbandingan_rkap_revisi__uraian_pdf";
		
		$data = array(
			'tahun'			=> $tahun,
			'title' 		=> 'LAPORAN PERBANDINGAN REALISASI RKAP REVISI',
			'title2'		=> 'SEMUA BAGIAN',
			'kd_perkiraan'	=> $this->model->get_kode_perkiraan_new($tahun),
		);
		$this->load->view($view,$data);
	}

	function cetak_perbandingan_rkap_revisi_excel(){
		$tahun = $this->input->post('tahun');
		$view = "dashboard/excel/report_perbandingan_rkap_revisi_xls";
		
		$data = array(
			'tahun'			=> $tahun,
			'title' 		=> 'LAPORAN PERBANDINGAN REALISASI RKAP REVISI',
			'title2'		=> 'SEMUA BAGIAN',
			'kd_perkiraan'	=> $this->model->get_kode_perkiraan_new($tahun),
		);
		$this->load->view($view,$data);
	}

	function cetak_perbandingan_rkap_revisi_uraian_excel(){
		$tahun = $this->input->post('tahun');
		$view = "dashboard/excel/report_perbandingan_rkap_revisi_uraian_xls";
		
		$data = array(
			'tahun'			=> $tahun,
			'title' 		=> 'LAPORAN PERBANDINGAN REALISASI RKAP REVISI',
			'title2'		=> 'SEMUA BAGIAN',
			'kd_perkiraan'	=> $this->model->get_kode_perkiraan_new($tahun),
		);
		$this->load->view($view,$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */