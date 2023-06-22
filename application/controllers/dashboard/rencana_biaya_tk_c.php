<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencana_biaya_tk_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('rencana_biaya_tk_m','model');
	}

	function index()
	{

		if($this->input->post('pdf')){
				$this->cetak_pdf();	
		} else  if($this->input->post('excel')){
				$this->cetak_excel();
		}

		$data = array(
		  'page' => "dashboard/rencana_biaya_tk_v",
		  'induk_menu' => "menu_laporan",
		  'menu' => "rencana_tenaga_kerja",
		  'title' => "RENCANA PENGELUARAN BIAYA TENAGA KERJA",	
		  'post_url' => 'dashboard/rencana_biaya_tk_c'  
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak_pdf(){
		$tahun = $this->input->post('tahun');
		$jenis_laporan = $this->input->post('jenis_laporan');

		$periode = $this->input->post('periode');
		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}

		$dt    = $this->model->get_data_biaya_tenaga_kerja($tahun,  $periode);
		$sts_lap = "";

		if($jenis_laporan == "pegawai"){
			$dt    = $this->model->get_data_biaya_tenaga_kerja_peg($tahun,  $periode);
			$sts_lap = "(PEGAWAI)";
		} else if($jenis_laporan == "tkk"){
			$dt    = $this->model->get_data_biaya_tenaga_kerja_tkk($tahun,  $periode);
			$sts_lap = "(TKK)";
		}
		
		$data = array(
		  'dt'    => $dt,
		  'thn'   => $tahun,
		  'ket_periode' => $ket_periode,
		  'sts_lap' => $sts_lap,
		);
		$this->load->view('dashboard/pdf/report_rencana_biaya_tenaga_kerja_v', $data);

	}

	function cetak_excel(){
		
		$tahun = $this->input->post('tahun');
		$jenis_laporan = $this->input->post('jenis_laporan');

		$periode = $this->input->post('periode');
		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}

		$dt    = $this->model->get_data_biaya_tenaga_kerja($tahun,  $periode);
		$sts_lap = "";

		if($jenis_laporan == "pegawai"){
			$dt    = $this->model->get_data_biaya_tenaga_kerja_peg($tahun,  $periode);
			$sts_lap = "(PEGAWAI)";
		} else if($jenis_laporan == "tkk"){
			$dt    = $this->model->get_data_biaya_tenaga_kerja_tkk($tahun,  $periode);
			$sts_lap = "(TKK)";
		}
		
		$data = array(
		  'dt'    => $dt,
		  'thn'   => $tahun,
		  'ket_periode' => $ket_periode,
		  'sts_lap' => $sts_lap,
		);
		$this->load->view('dashboard/excel/report_rencana_biaya_tenaga_kerja_xls', $data);
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */