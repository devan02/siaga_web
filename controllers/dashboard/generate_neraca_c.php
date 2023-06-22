<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_neraca_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('generate_neraca_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";

		if($this->input->post('generate')){
			$msg = 1;
			$periode = $this->input->post('periode');
			$tahun   = $this->input->post('tahun');

			$this->model->delete_neraca($tahun, $periode);

			//NILAI BANK
			$get_nilai_bank = $this->model->get_nilai_bank($tahun, $periode);
			$nilai_bank     = ceil($get_nilai_bank->NILAI);
			$this->model->simpan_nilai_neraca(2, $tahun, $periode, $nilai_bank);

			//PERSEDIAAN BAHAN OPERASI
			$get_nilai_bahan_operasi = $this->model->get_nilai_bahan_operasi($tahun, $periode);
			$nilai_bo     = (ceil($get_nilai_bahan_operasi->NILAI) * 0.2);
			$this->model->simpan_nilai_neraca(10, $tahun, $periode, $nilai_bo);

			//NILAI PEROLEHAN
			$get_nilai_perolehan = $this->model->get_nilai_perolehan($tahun, $periode); 
			foreach ($get_nilai_perolehan as $key => $nilai_po) {
				$this->model->simpan_nilai_neraca($nilai_po->ID_NERACA, $tahun, $periode, $nilai_po->NILAI);
			}

			//UTANG USAHA
			$get_nilai_utang_usaha = $this->model->get_nilai_utang_usaha($tahun, $periode);
			$nilai_utang_usaha     = $get_nilai_utang_usaha->NILAI;
			$this->model->simpan_nilai_neraca_wajib(37, $tahun, $periode, $nilai_utang_usaha);

			//LABA RUGI BERJALAN
			$get_laba_rugi = $this->model->get_laba_rugi($tahun, $periode);
			$nilai_lb      = $get_laba_rugi->NILAI;
			$this->model->simpan_nilai_neraca_wajib(65, $tahun, $periode, $nilai_lb);

			//UTANG PAJAK
			$pph29    = $this->model->get_pph29($tahun, $periode);

			if($pph29 == null || $pph29 == ""){
            	$totpph29 = $nilai_lb;
            	$totpph29 = ($totpph29 * 25) / 100; 
			} else {
           		$totpph29 = $nilai_lb + ($pph29->TOTAL1 - $pph29->TOTAL2);
           		$totpph29 = ($totpph29 * 25) / 100;
        	}

            $this->model->simpan_nilai_neraca_wajib(38, $tahun, $periode, $totpph29);

		}


		$data = array(
		  'page' => "dashboard/generate_neraca_v",
		  'induk_menu' => "generate_neraca",
		  'menu' => "generate_neraca",
		  'title' => "PEMBENTUKAN NERACA OTOMATIS",		
		  'departemen'	=> $this->dep_div->departemen(),  
		  'post_url' => "dashboard/generate_neraca_c",  
		  'msg'  => $msg,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}
}