<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan_air_dan_unsur_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index(){
		$data = array(
		  'page' 		=> "dashboard/penjualan_air_dan_unsur_v",
		  'induk_menu' 	=> "menu_laporan",
		  'menu' 		=> "penjualan_air_dan_unsur",
		  'title' 		=> "RENCANA PENJUALAN AIR DAN UNSUR - UNSURNYA",
		  'url'			=> base_url().'dashboard/penjualan_air_dan_unsur_c/cetak',
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
		$sql = "
			SELECT * FROM(
				SELECT 
					*
				FROM stp_input_pendapatan
				WHERE PERIODE = '$periode' AND TAHUN = '$tahun'
			) z
		";
		$query = $this->db->query($sql)->result();
		$data = array(
			'tahun'	=> $tahun,
			'title' => 'RENCANA PENJUALAN AIR DAN UNSUR - UNSURNYA',
			'data'	=> $query,
		);
		$this->load->view('dashboard/pdf/penjualan_air_dan_unsur_rkap_pdf', $data);
	}

	function cetak_pdf_revisi_rkap(){
		$periode = $this->input->post('periode');
		$tahun = $this->input->post('tahun');
		$sql = "
			SELECT * FROM(
				SELECT
					*
				FROM stp_input_pendapatan
				WHERE PERIODE = '$periode' AND TAHUN = '$tahun'
			) z
		";
		$query = $this->db->query($sql)->result();
		$data = array(
			'tahun'	=> $tahun,
			'title' => 'RENCANA PENJUALAN AIR DAN UNSUR - UNSURNYA (REVISI)',
			'data'	=> $query,
		);
		$this->load->view('dashboard/pdf/penjualan_air_dan_unsur_revisi_pdf', $data);
	}

}