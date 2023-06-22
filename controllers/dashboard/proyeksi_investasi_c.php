<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyeksi_investasi_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('proyeksi_investasi_m','model');
	}

	function index()
	{

		if($this->input->post('pdf')){
				$this->cetak_pdf();	
		} else  if($this->input->post('excel')){
				$this->cetak_excel();
		}

		$data = array(
		  'page' => "dashboard/proyeksi_investasi_v",
		  'induk_menu' => "menu_laporan",
		  'menu' => "proyeksi_investasi",
		  'title' => "PROYEKSI INVESTASI",	
		  'post_url' => 'dashboard/proyeksi_investasi_c'  
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

			$susut    = $this->model->get_penyusutan_lalu($tahun, $periode);	

			$data = array(
			  'dt'    => $dt,
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			  'susut' => $susut,
			);	
			$this->load->view('dashboard/pdf/report_proyeksi_investasi_rinci_v', $data);

		} else {

			$dt    = $this->model->get_condition($tahun, $periode);

			if($tahun > 2015){
			$dt    = $this->model->get_condition_new($tahun, $periode);	
			}

			$susut    = $this->model->get_penyusutan_lalu($tahun, $periode);

			$data = array(
			  'dt'    => $dt,
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			  'susut' => $susut,
			);
			$this->load->view('dashboard/pdf/report_proyeksi_investasi_tdk_rinci_v', $data);
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

			$dt    = $this->model->get_condition_rinci($tahun, $periode);

			if($tahun > 2015){
			$dt    = $this->model->get_condition_rinci_new($tahun, $periode);	
			}

			$susut    = $this->model->get_penyusutan_lalu($tahun, $periode);

			$data = array(
			  'dt'    => $dt,
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			  'susut' => $susut,
			);	
			$this->load->view('dashboard/excel/report_proyeksi_investasi_rinci_xls', $data);

		} else {

			$dt    = $this->model->get_condition($tahun, $periode);

			if($tahun > 2015){
			$dt    = $this->model->get_condition_new($tahun, $periode);	
			}

			$susut    = $this->model->get_penyusutan_lalu($tahun, $periode);

			$data = array(
			  'dt'    => $dt,
			  'thn'   => $tahun,
			  'ket_periode' => $ket_periode,
			  'susut' => $susut,
			);
			$this->load->view('dashboard/excel/report_proyeksi_investasi_tdk_rinci_xls', $data);
		}


		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */