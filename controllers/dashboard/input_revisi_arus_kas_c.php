<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_revisi_arus_kas_c extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('input_revisi_arus_kas_m','model');

		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index(){
		$msg = "";
		$dt = "";
		$id = $this->input->post('id');
		$uraian = $this->input->post('uraian');
		$tahun = $this->input->post('tahun');
		$periode = $this->input->post('periode');
		$jenis = $this->input->post('jenis');

		if($this->input->post('cari')){
			$dt = $this->model->get_arus_kas($tahun,$periode,$jenis);
		}else if($this->input->post('simpan')){
			$JANUARI = str_replace(',','',$this->input->post('jan'));
	        $FEBRUARI = str_replace(',','',$this->input->post('feb'));
	        $MARET = str_replace(',','',$this->input->post('mar'));
	        $APRIL = str_replace(',','',$this->input->post('apr'));
	        $MEI = str_replace(',','',$this->input->post('mei'));
	        $JUNI = str_replace(',','',$this->input->post('jun'));
	        $JULI = str_replace(',','',$this->input->post('jul'));
	        $AGUSTUS = str_replace(',','',$this->input->post('agt'));
	        $SEPTEMBER = str_replace(',','',$this->input->post('sep'));
	        $OKTOBER = str_replace(',','',$this->input->post('okt'));
	        $NOVEMBER = str_replace(',','',$this->input->post('nov'));
	        $DESEMBER = str_replace(',','',$this->input->post('des'));

	        $this->model->delete($tahun,$jenis,$periode);
	        
			foreach ($id as $key => $value){
	        	$JUMLAH = $JANUARI[$key]+$FEBRUARI[$key]+$MARET[$key]+$APRIL[$key]+$MEI[$key]+$JUNI[$key]+$JULI[$key]+$AGUSTUS[$key]+$SEPTEMBER[$key]+$OKTOBER[$key]+$NOVEMBER[$key]+$DESEMBER[$key];
				$this->model->simpan(
			        $uraian[$key],
			        $jenis,
			        $tahun,
			        $JANUARI[$key],
			        $FEBRUARI[$key],
			        $MARET[$key],
			        $APRIL[$key],
			        $MEI[$key],
			        $JUNI[$key],
			        $JULI[$key],
			        $AGUSTUS[$key],
			        $SEPTEMBER[$key],
			        $OKTOBER[$key],
			        $NOVEMBER[$key],
			        $DESEMBER[$key],
			        $JUMLAH,
			        $periode);
			}

			$dt = $this->model->get_arus_kas($tahun,$periode,$jenis);
		}

		$data = array(
		  'page' => "dashboard/input_revisi_arus_kas_v",
		  'induk_menu' => "arus_kas",
		  'menu' => "arus_kas",
		  'title' => "INPUT ARUS KAS",		
		  'departemen'	=> $this->dep_div->departemen(),  
		  'post_url' => "dashboard/input_revisi_arus_kas_c",  
		  'msg'  => $msg,
		  'dt' => $dt,
		  'tahun' => $tahun,
		  'periode' => $periode,
		  'jenis' => $jenis,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}


}