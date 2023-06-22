<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencana_pengeluaran_non_operasi_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('rencana_pengeluaran_non_operasi_m','model');
	}

	function index()
	{

		if($this->input->post('pdf')){
				$this->cetak_pdf();	
		} else  if($this->input->post('excel')){
				$this->cetak_excel();
		}

		$data = array(
		  'page' => "dashboard/rencana_pengeluaran_non_operasi_v",
		  'induk_menu' => "menu_laporan",
		  'menu' => "rencana_non_opr",
		  'title' => "RENCANA PENGELUARAN NON OPERASI",	
		  'post_url' => 'dashboard/rencana_pengeluaran_non_operasi_c'  
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak_pdf(){
		$tahun = $this->input->post('tahun');
		$output_laporan = $this->input->post('output_laporan');

		$periode = $this->input->post('periode');
		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}		

			$biaya_luar_ush    = $this->model->get_biaya_luar_usaha($tahun, $periode);	
			$dana_pdam         = $this->model->get_dana_pdam($tahun, $periode);	
			$laba_rugi         = $this->model->get_laba_rugi($tahun, $periode);

			$data = array(
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			  'biaya_luar_ush'  => $biaya_luar_ush ,
			  'dana_pdam'  => $dana_pdam,
			  'laba_rugi'  => $laba_rugi,
			);	
		$this->load->view('dashboard/pdf/report_pengeluaran_non_operasi_v', $data);

	}

	function cetak_excel(){
		$tahun = $this->input->post('tahun');
		$output_laporan = $this->input->post('output_laporan');

		$periode = $this->input->post('periode');
		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}


			$biaya_luar_ush    = $this->model->get_biaya_luar_usaha($tahun, $periode);	
			$dana_pdam         = $this->model->get_dana_pdam($tahun, $periode);	
			$laba_rugi         = $this->model->get_laba_rugi($tahun, $periode);

			$data = array(
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			  'biaya_luar_ush'  => $biaya_luar_ush ,
			  'dana_pdam'  => $dana_pdam,
			  'laba_rugi'  => $laba_rugi,
			);	
				
			$this->load->view('dashboard/excel/report_pengeluaran_non_operasi_xls', $data);

		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */