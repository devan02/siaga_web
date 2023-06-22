<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerimaan_operasi_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index(){
		$data = array(
		  'page' 		=> "dashboard/penerimaan_operasi_v",
		  'induk_menu' 	=> "menu_laporan",
		  'menu' 		=> "penerimaan_operasi",
		  'title' 		=> "RENCANA PENERIMAAN OPERASI",
		  'url'			=> base_url().'dashboard/penerimaan_operasi_c/cetak',
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
					JANUARI
				FROM stp_input_pendapatan
				WHERE JENIS_KELOMPOK_PELANGGAN = 'Sosial Umum'
				AND PERIODE = 1
			) z
		";
		$query = $this->db->query($sql)->result();
		$data = array(
			'tahun'	=> $tahun,
			'title' => 'RENCANA PENERIMAAN OPERASI',
			'data'	=> $query,
		);
		$this->load->view('dashboard/pdf/report_penerimaan_operasi_pdf', $data);
	}

	function cetak_pdf_revisi_rkap(){
		$periode = $this->input->post('periode');
		$tahun = $this->input->post('tahun');
		$sql = "
			SELECT * FROM(
				SELECT 
					ID,
					SUM(JANUARI) AS JANUARI
				FROM stp_input_pendapatan
				WHERE JENIS_KELOMPOK_PELANGGAN = 'Sosial Umum'
				AND PERIODE = 2
			) z
		";
		$query = $this->db->query($sql)->result();
		$data = array(
			'tahun'	=> $tahun,
			'title' => 'RENCANA PENERIMAAN NON OPERASI',
			'data'	=> $query,
		);
		$this->load->view('dashboard/pdf/report_penerimaan_operasi_pdf', $data);
	}

}