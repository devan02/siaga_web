<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencana_pengeluaran_opr_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('rencana_pengeluaran_opr_m','model');
	}

	function index()
	{

		if($this->input->post('pdf')){
				$this->cetak_pdf();	
		} else  if($this->input->post('excel')){
				$this->cetak_excel();
		}

		$data = array(
		  'page' => "dashboard/rencana_pengeluaran_opr_v",
		  'induk_menu' => "menu_laporan",
		  'menu' => "rencana_opr_lain",
		  'title' => "RENCANA PENGELUARAN OPERASI LAINNYA",	
		  'post_url' => 'dashboard/rencana_pengeluaran_opr_c'  
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
		

			$biaya_opr    = $this->model->get_biaya_opr($tahun, $periode);	
			$biaya_adm    = $this->model->get_rencana_adm($tahun, $periode);	
			$biaya_luar   = $this->model->get_biaya_luar($tahun, $periode);	

			$rencana_beli = $this->model->get_rencana_beli($tahun, $periode);	
			$susut_lalu   = $this->model->get_penyusutan_lalu($tahun, $periode);	
			$susut_lalu2   = $this->model->get_penyusutan_lalu2($tahun, $periode);	
			$susut_now    = $this->model->get_penyusutan_now($tahun, $periode);	


			$data = array(
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			  'biaya_opr'  => $biaya_opr ,
			  'biaya_adm'  => $biaya_adm ,
			  'biaya_luar' => $biaya_luar,
			  'rencana_beli' => $rencana_beli,
			  'susut_lalu' => $susut_lalu,
			  'susut_lalu2' => $susut_lalu2,
			  'susut_now'  => $susut_now,
			);	
		$this->load->view('dashboard/pdf/report_pengeluaran_operasi_v', $data);

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


			$biaya_opr    = $this->model->get_biaya_opr($tahun, $periode);	
			$biaya_adm    = $this->model->get_rencana_adm($tahun, $periode);	
			$biaya_luar   = $this->model->get_biaya_luar($tahun, $periode);	

			$rencana_beli = $this->model->get_rencana_beli($tahun, $periode);	
			$susut_lalu   = $this->model->get_penyusutan_lalu($tahun, $periode);	
			$susut_lalu2   = $this->model->get_penyusutan_lalu2($tahun, $periode);	
			$susut_now    = $this->model->get_penyusutan_now($tahun, $periode);	


			$data = array(
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			  'biaya_opr'  => $biaya_opr ,
			  'biaya_adm'  => $biaya_adm ,
			  'biaya_luar' => $biaya_luar,
			  'rencana_beli' => $rencana_beli,
			  'susut_lalu' => $susut_lalu,
			  'susut_lalu2' => $susut_lalu2,
			  'susut_now'  => $susut_now,
			);
				
			$this->load->view('dashboard/excel/report_pengeluaran_operasi_xls', $data);

		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */