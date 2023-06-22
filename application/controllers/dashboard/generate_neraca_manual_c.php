<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_neraca_manual_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('generate_neraca_manual_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";
		$edit = 0;
		$dt = "";
		$tahun = 0;
		$periode = 0;

		if($this->input->post('generate')){
			$edit = 1;
			$periode = $this->input->post('periode');
			$tahun   = $this->input->post('tahun');

			$dt = $this->model->get_neraca($periode, $tahun);

		} else if($this->input->post('simpan')){
			$edit = 1;
			$msg = 1;
			$tahun   = $this->input->post('thn');
			$periode   = $this->input->post('prd');

			$this->model->delete_neraca($tahun, $periode);
			$this->model->delete_neraca($tahun - 1, $periode);
			$this->model->delete_neraca($tahun - 2, $periode);

			$id_neraca     = $this->input->post('id_neraca');
			$sts     	   = $this->input->post('sts');
			$NILAI         = $this->input->post('NILAI');
			$NILAI_LALU1   = $this->input->post('NILAI_LALU1');
			$NILAI_LALU2   = $this->input->post('NILAI_LALU2');

			$id_neraca_wajib     = $this->input->post('id_neraca_wajib');
			$sts_wajib     	   = $this->input->post('sts_wajib');
			$WAJIB_NILAI         = $this->input->post('WAJIB_NILAI');
			$WAJIB_NILAI_LALU1   = $this->input->post('WAJIB_NILAI_LALU1');
			$WAJIB_NILAI_LALU2   = $this->input->post('WAJIB_NILAI_LALU2');

			foreach ($id_neraca as $key => $val) {
				$this->model->simpan_nilai_neraca($val, $tahun, $periode, $NILAI[$key], $sts[$key]);
				$this->model->simpan_nilai_neraca($val, $tahun - 1, $periode, $NILAI_LALU1[$key], $sts[$key]);
				$this->model->simpan_nilai_neraca($val, $tahun - 2, $periode, $NILAI_LALU2[$key], $sts[$key]);
			}

			foreach ($id_neraca_wajib as $key => $val) {
				$this->model->simpan_nilai_neraca($val, $tahun, $periode, $WAJIB_NILAI[$key], $sts_wajib[$key]);
				$this->model->simpan_nilai_neraca($val, $tahun - 1, $periode, $WAJIB_NILAI_LALU1[$key], $sts_wajib[$key]);
				$this->model->simpan_nilai_neraca($val, $tahun - 2, $periode, $WAJIB_NILAI_LALU2[$key], $sts_wajib[$key]);
			}

			$dt = $this->model->get_neraca($periode, $tahun);

		}

		$data = array(
		  'page' => "dashboard/generate_neraca_manual_v",
		  'induk_menu' => "generate_neraca",
		  'menu' => "generate_neraca_manual",
		  'title' => "PEMBENTUKAN NERACA MANUAL",		
		  'departemen'	=> $this->dep_div->departemen(),  
		  'post_url' => "dashboard/generate_neraca_manual_c",  
		  'msg'  => $msg,
		  'edit' => $edit,
		  'dt' => $dt,
		  'tahun' => $tahun,
		  'periode' => $periode,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}
}