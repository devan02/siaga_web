<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencana_biaya_diluar_usaha_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('rencana_biaya_diluar_usaha_m','model');
	}

	function index()
	{

		if($this->input->post('pdf')){
				$this->cetak_pdf();	
		} else  if($this->input->post('excel')){
				$this->cetak_excel();
		}

		$data = array(
		  'page' => "dashboard/rencana_biaya_diluar_usaha_v",
		  'induk_menu' => "menu_laporan",
		  'menu' => "rb_luar_usaha",
		  'title' => "RENCANA BIAYA DILUAR USAHA",	
		  'post_url' => 'dashboard/rencana_biaya_diluar_usaha_c'  
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak_pdf(){
		$tahun = $this->input->post('tahun');
		//$output_laporan = $this->input->post('output_laporan');

		$periode = $this->input->post('periode');
		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}

			$dt = "";

			if($tahun > 2015){
			$dt    = $this->model->get_condition_rinci_new($tahun, $periode);	
			} else {
			$dt    = $this->model->get_condition_rinci($tahun, $periode);
			}

			$data = array(
			  'dt'    => $dt,
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			);	
			$this->load->view('dashboard/pdf/report_rencana_biaya_luar_usaha_pdf', $data);

	}

	function cetak_excel(){
		$tahun = $this->input->post('tahun');
		//$output_laporan = $this->input->post('output_laporan');

		$periode = $this->input->post('periode');
		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}		

			$dt = "";

			if($tahun > 2015){
			$dt    = $this->model->get_condition_rinci_new($tahun, $periode);	
			} else {
			$dt    = $this->model->get_condition_rinci($tahun, $periode);
			}

			$data = array(
			  'dt'    => $dt,
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			);	
			$this->load->view('dashboard/excel/report_rencana_biaya_luar_usaha_xls', $data);
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */