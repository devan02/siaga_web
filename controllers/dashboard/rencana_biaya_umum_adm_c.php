<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencana_biaya_umum_adm_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('rencana_biaya_umum_adm_m','model');
	}

	function index()
	{

		if($this->input->post('pdf')){
				$this->cetak_pdf();	
		} else  if($this->input->post('excel')){
				$this->cetak_excel();
		}

		$data = array(
		  'page' => "dashboard/rencana_biaya_umum_adm_v",
		  'induk_menu' => "menu_laporan",
		  'menu' => "rbua_adm",
		  'title' => "RENCANA BIAYA UMUM & ADMINISTRASI",	
		  'post_url' => 'dashboard/rencana_biaya_umum_adm_c'  
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
		

		if($output_laporan == "rinci"){		

			$dt    = $this->model->get_condition_rinci($tahun, $periode);

			if($tahun > 2015){
			$dt    = $this->model->get_condition_rinci_new($tahun, $periode);	
			}

			$data = array(
			  'dt'    => $dt,
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			);	
			$this->load->view('dashboard/pdf/report_rencana_biaya_umum_adm_rinci_v', $data);

		} else {

			$dt    = $this->model->get_condition($tahun,  $periode);

			if($tahun > 2015){
			$dt    = $this->model->get_condition_new($tahun,  $periode);	
			}
			
			$data = array(
			  'dt'    => $dt,
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			);
			$this->load->view('dashboard/pdf/report_rencana_biaya_umum_adm_tdk_rinci_v', $data);
		}
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
		
		if($output_laporan == "rinci"){		

			$dt    = $this->model->get_condition_rinci($tahun,  $periode);

			if($tahun > 2015){
			$dt    = $this->model->get_condition_rinci_new($tahun,  $periode);	
			}

			$data = array(
			  'dt'    => $dt,
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			);	
			$this->load->view('dashboard/excel/report_rencana_biaya_umum_adm_rinci_xls', $data);

		} else {

			$dt    = $this->model->get_condition($tahun,  $periode);

			if($tahun > 2015){
			$dt    = $this->model->get_condition_new($tahun,  $periode);	
			}

			$data = array(
			  'dt'    => $dt,
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			);
			$this->load->view('dashboard/excel/report_rencana_biaya_umum_adm_tdk_rinci_xls', $data);
		}


		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */