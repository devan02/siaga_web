<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produksi_distribusi_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index(){
		$data = array(
		  'page' 		=> "dashboard/produksi_distribusi_v",
		  'induk_menu' 	=> "menu_laporan",
		  'menu' 		=> "produksi_distribusi",
		  'title' 		=> "RENCANA PRODUKSI, DISTRIBUSI DAN PENJUALAN AIR",
		  'url'			=> base_url().'dashboard/produksi_distribusi_c/cetak',
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
		$query = $this->db->query($sql);
		$view = "";
		$query_data = "";
		if($query->num_rows() > 0){
			$view = "dashboard/pdf/report_produksi_distribusi_penjualan_air2_pdf";
			$query_data = $query->result();
		}else{
			$view = "dashboard/pdf/report_produksi_distribusi_penjualan_air_kosong_pdf";
		}
		$data = array(
			'tahun'	=> $tahun,
			'title' => 'RENCANA PRODUKSI, DISTRIBUSI DAN PENJUALAN AIR',
			'data'	=> $query_data,
		);
		$this->load->view($view,$data);
	}

	function cetak_pdf_revisi_rkap(){
		$periode = $this->input->post('periode');
		$tahun = $this->input->post('tahun');
		$sql = "SELECT * FROM stp_produksi_distribusi WHERE TAHUN = '$tahun' AND PERIODE = '$periode'";
		$query = $this->db->query($sql);
		$view = "";
		$query_data = "";
		if($query->num_rows() > 0){
			$view = "dashboard/pdf/report_produksi_distribusi_penjualan_air_pdf";
			$query_data = $query->result();
		}else{
			$view = "dashboard/pdf/report_produksi_distribusi_penjualan_air_kosong_pdf";
		}
		$data = array(
			'tahun'	=> $tahun,
			'title' => 'RENCANA PRODUKSI, DISTRIBUSI DAN PENJUALAN AIR',
			'data'	=> $query_data,
		);
		$this->load->view($view,$data);
	}

}