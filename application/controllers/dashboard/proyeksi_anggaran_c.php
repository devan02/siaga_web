<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyeksi_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('proyeksi_anggaran_m','model');
	}

	function index(){
		$periode = $this->input->post('periode');
		$jenis_laporan = $this->input->post('jenis_laporan');
		$output_laporan2 = $this->input->post('output_laporan2');

		if($this->input->post('pdf')){
			if($output_laporan2 == "1"){
				$this->cetak_pdf_all();
			}else{
				if($jenis_laporan == "laba"){
					$this->cetak_pdf_laba();
				}else if($jenis_laporan == "arus"){
					$this->arus_kas_pdf();
				}else if($jenis_laporan == "neraca"){
					$this->cetak_pdf_neraca();
				}
			}
		}else if($this->input->post('excel')){
			if($output_laporan2 == "1"){
				$this->cetak_excel_all();
			}else{
				if($jenis_laporan == "laba"){
					$this->cetak_excel_laba();
				}else if($jenis_laporan == "arus"){
					$this->arus_kas_excel();
				}else if($jenis_laporan == "neraca"){
					$this->cetak_excel_neraca();
				}
			}
		}

		$data = array(
		  'page' => "dashboard/proyeksi_anggaran_v",
		  'induk_menu' => "menu_laporan",
		  'menu' => "proyeksi_anggaran",
		  'title' => "PROYEKSI ANGGARAN",	
		  'post_url' => 'dashboard/proyeksi_anggaran_c'  
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak_pdf_laba(){
		$tahun = $this->input->post('tahun');
		$output_laporan = $this->input->post('output_laporan');
		$periode = $this->input->post('periode');

		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}

		$dt    = $this->model->get_condition($tahun, $periode);

		if($tahun > 2015){
			$dt    = $this->model->get_condition_laba_new($tahun, $periode);
		}

		$pph29 = $this->model->get_pph29($tahun, $periode);
		$pph29_lalu1 = $this->model->get_pph29_lalu1($tahun, $periode);
		$pph29_lalu2 = $this->model->get_pph29_lalu2($tahun, $periode);
		
		$data = array(
		  'title' => "LAPORAN RKAP",	
		  'dt'    => $dt,
		  'thn'   => $tahun,
		  'ket_periode' => $ket_periode,
		  'pph29' => $pph29,
		  'pph29_lalu1' => $pph29_lalu1,
		  'pph29_lalu2' => $pph29_lalu2,
		);

		if($output_laporan == "rinci"){			
			$this->load->view('dashboard/pdf/report_proyeksi_laba_rugi_v', $data);
		} else {
			$this->load->view('dashboard/pdf/report_proyeksi_laba_rugi_non_rinci_v', $data);
		}
	}

	function cetak_excel_laba(){
		$tahun = $this->input->post('tahun');
		$output_laporan = $this->input->post('output_laporan');

		$periode = $this->input->post('periode');
		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}

		
		$dt    = $this->model->get_condition($tahun, $periode);

		if($tahun > 2015){
			$dt    = $this->model->get_condition_laba_new($tahun, $periode);
		}

		$pph29 = $this->model->get_pph29($tahun, $periode);
		$pph29_lalu1 = $this->model->get_pph29_lalu1($tahun, $periode);
		$pph29_lalu2 = $this->model->get_pph29_lalu2($tahun, $periode);
		
		$data = array(
		  'title' => "LAPORAN RKAP",	
		  'dt'    => $dt,
		  'thn'   => $tahun,
		  'ket_periode' => $ket_periode,
		  'pph29' => $pph29,
		  'pph29_lalu1' => $pph29_lalu1,
		  'pph29_lalu2' => $pph29_lalu2,
		);

		if($output_laporan == "rinci"){			
			$this->load->view('dashboard/excel/report_proyeksi_laba_rugi_xls', $data);
		} else {
			$this->load->view('dashboard/excel/report_proyeksi_laba_rugi_non_rinci_xls', $data);
		}

		
	}

	function arus_kas_pdf(){
		$tahun = $this->input->post('tahun');
		$periode = $this->input->post('periode');
		$output_laporan = $this->input->post('output_laporan');

		$data = array(
		  'title' => "PROYEKSI ARUS KAS",
		  'thn'   => $tahun,
		  'arus'  => $this->model->arus_kas($tahun,$periode),
		  'arus2' => $this->model->arus_kas_tidak_rinci($tahun,$periode),
		);

		if($output_laporan == "rinci"){			
			$this->load->view('dashboard/pdf/report_proyeksi_arus_kas', $data);
		} else {
			$this->load->view('dashboard/pdf/report_proyeksi_arus_kas_tidak_rinci', $data);
		}
	}

	function arus_kas_excel(){
		$tahun = $this->input->post('tahun');
		$periode = $this->input->post('periode');
		$output_laporan = $this->input->post('output_laporan');

		$data = array(
		  'title' => "PROYEKSI ARUS KAS",
		  'thn'   => $tahun,
		  'arus'  => $this->model->arus_kas($tahun,$periode),
		  'arus2' => $this->model->arus_kas_tidak_rinci($tahun,$periode),
		);

		if($output_laporan == "rinci"){			
			$this->load->view('dashboard/excel/report_proyeksi_arus_kas_xls', $data);
		} else {
			$this->load->view('dashboard/excel/report_proyeksi_arus_kas_tidak_rinci_xls', $data);
		}
	}

	function cetak_pdf_all(){
		$tahun = $this->input->post('tahun');
		$output_laporan = $this->input->post('output_laporan');
		$periode = $this->input->post('periode');

		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}
		
		//NERACA
		$setup = $this->model->get_setup_neraca($periode, $tahun);
		$get_penyesuaian = $this->model->get_penyesuaian($periode, $tahun);
		$get_penyesuaian_LALU1 = $this->model->get_penyesuaian($periode, $tahun - 1);
		$get_penyesuaian_LALU2 = $this->model->get_penyesuaian($periode, $tahun - 2);

		//LABA RUGI
		$dt    = $this->model->get_condition($tahun, $periode);
		if($tahun > 2015){
			$dt    = $this->model->get_condition_laba_new($tahun, $periode);
		}
		$pph29 = $this->model->get_pph29($tahun, $periode);
		$pph29_lalu1 = $this->model->get_pph29_lalu1($tahun, $periode);
		$pph29_lalu2 = $this->model->get_pph29_lalu2($tahun, $periode);
		$susut1 = $this->model->susut1($tahun, $periode);
		$susut2 = $this->model->susut2($tahun, $periode);

		$data = array(
		  'title' => "LAPORAN NERACA",	
		  'setup'    => $setup,
		  'thn'   => $tahun,
		  'ket_periode' => $ket_periode,
		  'get_penyesuaian' => $get_penyesuaian,
		  'get_penyesuaian_LALU1' => $get_penyesuaian_LALU1,
		  'get_penyesuaian_LALU2' => $get_penyesuaian_LALU2,
		  'dt' => $dt,
		  'pph29' => $pph29,
		  'pph29_lalu1' => $pph29_lalu1,
		  'pph29_lalu2' => $pph29_lalu2,
		  'arus'  => $this->model->arus_kas($tahun, $periode),
		  'susut1' => $susut1,
		  'susut2' => $susut2,
		);
	
		$this->load->view('dashboard/pdf/report_proyeksi_anggaran_all_pdf', $data);
	}


	function cetak_excel_all(){
		$tahun = $this->input->post('tahun');
		$output_laporan = $this->input->post('output_laporan');
		$periode = $this->input->post('periode');

		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}
		
		//NERACA
		$setup = $this->model->get_setup_neraca($periode, $tahun);
		$get_penyesuaian = $this->model->get_penyesuaian($periode, $tahun);
		$get_penyesuaian_LALU1 = $this->model->get_penyesuaian($periode, $tahun - 1);
		$get_penyesuaian_LALU2 = $this->model->get_penyesuaian($periode, $tahun - 2);

		//LABA RUGI
		$dt    = $this->model->get_condition($tahun, $periode);
		if($tahun > 2015){
			$dt    = $this->model->get_condition_laba_new($tahun, $periode);
		}
		$pph29 = $this->model->get_pph29($tahun, $periode);
		$pph29_lalu1 = $this->model->get_pph29_lalu1($tahun, $periode);
		$pph29_lalu2 = $this->model->get_pph29_lalu2($tahun, $periode);
		$susut1 = $this->model->susut1($tahun, $periode);
		$susut2 = $this->model->susut2($tahun, $periode);

		$data = array(
		  'title' => "LAPORAN NERACA",	
		  'setup'    => $setup,
		  'thn'   => $tahun,
		  'ket_periode' => $ket_periode,
		  'get_penyesuaian' => $get_penyesuaian,
		  'get_penyesuaian_LALU1' => $get_penyesuaian_LALU1,
		  'get_penyesuaian_LALU2' => $get_penyesuaian_LALU2,
		  'dt' => $dt,
		  'pph29' => $pph29,
		  'pph29_lalu1' => $pph29_lalu1,
		  'pph29_lalu2' => $pph29_lalu2,
		  'arus'  => $this->model->arus_kas($tahun, $periode),
		  'susut1' => $susut1,
		  'susut2' => $susut2,
		);
	
		$this->load->view('dashboard/excel/report_proyeksi_anggaran_all_xls', $data);
	}

	function cetak_pdf_neraca(){
		$tahun = $this->input->post('tahun');
		$output_laporan = $this->input->post('output_laporan');
		$periode = $this->input->post('periode');

		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}
		
		$setup = $this->model->get_setup_neraca($periode, $tahun);

		$get_penyesuaian = $this->model->get_penyesuaian($periode, $tahun);
		$get_penyesuaian_LALU1 = $this->model->get_penyesuaian($periode, $tahun - 1);
		$get_penyesuaian_LALU2 = $this->model->get_penyesuaian($periode, $tahun - 2);

		$data = array(
		  'title' => "LAPORAN NERACA",	
		  'setup'    => $setup,
		  'thn'   => $tahun,
		  'ket_periode' => $ket_periode,
		  'get_penyesuaian' => $get_penyesuaian,
		  'get_penyesuaian_LALU1' => $get_penyesuaian_LALU1,
		  'get_penyesuaian_LALU2' => $get_penyesuaian_LALU2,
		);
	
		$this->load->view('dashboard/pdf/report_proyeksi_neraca_v', $data);
	}

	function cetak_excel_neraca(){
		$tahun = $this->input->post('tahun');
		$output_laporan = $this->input->post('output_laporan');
		$periode = $this->input->post('periode');

		$ket_periode = "";
		if($periode == 1){
			$ket_periode = "RKAP";
		} else {
			$ket_periode = "REVISI RKAP";
		}
		
		$setup = $this->model->get_setup_neraca($periode, $tahun);

		$get_penyesuaian = $this->model->get_penyesuaian($periode, $tahun);
		$get_penyesuaian_LALU1 = $this->model->get_penyesuaian($periode, $tahun - 1);
		$get_penyesuaian_LALU2 = $this->model->get_penyesuaian($periode, $tahun - 2);

		$data = array(
		  'title' => "LAPORAN NERACA",	
		  'setup'    => $setup,
		  'thn'   => $tahun,
		  'ket_periode' => $ket_periode,
		  'get_penyesuaian' => $get_penyesuaian,
		  'get_penyesuaian_LALU1' => $get_penyesuaian_LALU1,
		  'get_penyesuaian_LALU2' => $get_penyesuaian_LALU2,
		);

		$this->load->view('dashboard/excel/report_proyeksi_neraca_xls', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */