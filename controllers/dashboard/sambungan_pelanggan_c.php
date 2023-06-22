<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sambungan_pelanggan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('master_tarif_blok_m','tarif');
		$this->load->model('input_pendapatan_m','model');
	}

	function index(){
		$keyword = "";
		$data = array(
		  'page' 		=> "dashboard/sambungan_pelanggan_v",
		  'induk_menu' 	=> "menu_laporan",
		  'menu' 		=> "sambungan_pelanggan",
		  'title' 		=> "RENCANA PERKEMBANGAN SAMBUNGAN PELANGGAN",
		  'tarif_blok'	=> $this->tarif->get_data_tarif_blok($keyword),
		  'url'			=> base_url().'dashboard/sambungan_pelanggan_c/cetak',
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak(){
		if($this->input->post('pdf')){
			if($this->input->post('periode') == 1){
				$this->cetak_rkap_pdf();
			}else{
				$this->cetak_revisi_pdf();
			}
		}else{

		}
	}

	function cetak_rkap_pdf(){
		$tahun = $this->input->post('tahun');
		$periode = $this->input->post('periode');
		$data = array(
			'tahun'	=> $tahun,
			'title' => 'RENCANA PERKEMBANGAN SAMBUNGAN PELANGGAN',
			'data'	=> $this->model->get_report_sambungan_pelanggan($tahun,$periode),
		);
		$this->load->view('dashboard/pdf/report_sambungan_pelanggan_pdf', $data);
	}

	function cetak_revisi_pdf(){
		$tahun = $this->input->post('tahun');
		$periode = $this->input->post('periode');
		$data = array(
			'tahun'	=> $tahun,
			'title' => 'RENCANA PERKEMBANGAN SAMBUNGAN PELANGGAN',
			'data'	=> $this->model->get_report_sambungan_pelanggan($tahun,$periode),
		);
		$this->load->view('dashboard/pdf/report_sambungan_pelanggan2_pdf', $data);
	}

}