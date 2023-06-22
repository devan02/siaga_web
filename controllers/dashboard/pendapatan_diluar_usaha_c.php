<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendapatan_diluar_usaha_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index(){
		$data = array(
		  'page' 		=> "dashboard/pendapatan_diluar_usaha_v",
		  'induk_menu' 	=> "menu_laporan",
		  'menu' 		=> "pendapatan_diluar_usaha",
		  'title' 		=> "RENCANA PENDAPATAN DILUAR USAHA",
		  'url'			=> base_url().'dashboard/pendapatan_diluar_usaha_c/cetak',
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
				FROM stp_pendapatan_diluar_usaha
				WHERE PERIODE = '$periode' AND TAHUN = '$tahun'
				ORDER BY KODE_PERKIRAAN ASC
			) z
		";
		$query = $this->db->query($sql)->result();
		$data = array(
			'tahun'	=> $tahun,
			'title' => "RENCANA PENDAPATAN DILUAR USAHA",
			'data'	=> $query,
		);
		$this->load->view('dashboard/pdf/pendapatan_diluar_usaha_pdf', $data);
	}

	function cetak_pdf_revisi_rkap(){
		$periode = $this->input->post('periode');
		$tahun = $this->input->post('tahun');
		$sql = "
			SELECT * FROM(
				SELECT
					*
				FROM stp_pendapatan_diluar_usaha
				WHERE PERIODE = '$periode' AND TAHUN = '$tahun'
			) z
		";
		$query = $this->db->query($sql)->result();
		$data = array(
			'tahun'	=> $tahun,
			'title' => "RENCANA PENDAPATAN DILUAR USAHA (REVISI)",
			'data'	=> $query,
		);
		$this->load->view('dashboard/pdf/pendapatan_diluar_usaha_pdf', $data);
	}

}