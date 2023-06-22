<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerimaan_non_operasi_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index(){
		$data = array(
		  'page' 		=> "dashboard/penerimaan_non_operasi_v",
		  'induk_menu' 	=> "menu_laporan",
		  'menu' 		=> "penerimaan_non_operasi",
		  'title' 		=> "RENCANA PENERIMAAN NON OPERASI",
		  'url'			=> base_url().'dashboard/penerimaan_non_operasi_c/cetak',
		);
		$this->load->view('dashboard/beranda_v', $data);
	}
	
	function cetak(){
		$periode = $this->input->post('periode');
		if($periode == 1){
			$this->cetak_pdf_rkap();
		}else{
			$this->cetak_pdf_revisi_rkap();
		}
	}

	function cetak_pdf_rkap(){
		$periode = $this->input->post('periode');
		$tahun = $this->input->post('tahun');
		$sql = "SELECT * FROM stp_produksi_distribusi WHERE TAHUN = '$tahun' AND PERIODE = '$periode'";
		$query = $this->db->query($sql)->result();
		$data = array(
			'tahun'	=> $tahun,
			'title' => 'RENCANA PRODUKSI, DISTRIBUSI DAN PENJUALAN AIR',
			'data'	=> $query,
		);
		$this->load->view('dashboard/pdf/report_produksi_distribusi_penjualan_air2_pdf', $data);
	}

	function cetak_pdf_revisi_rkap(){
		$periode = $this->input->post('periode');
		$tahun = $this->input->post('tahun');
		$sql = "SELECT * FROM stp_penerimaan_non_operasi WHERE TAHUN = '$tahun' AND PERIODE = '$periode'";
		$query = $this->db->query($sql)->result();
		$data = array(
			'tahun'	=> $tahun,
			'title' => 'RENCANA PENERIMAAN NON OPERASI',
			'data'	=> $query,
		);
		$this->load->view('dashboard/pdf/report_penerimaan_non_operasi_revisi_pdf', $data);
	}

}