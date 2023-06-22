<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_biaya_tenaga_tkk_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('input_biaya_tenaga_tkk_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";
		$dt = "";

		$no_gol = "";
		$gol    = "";
		$tahun  = "";
		$periode = "";

		if($this->input->post('cari')){

			$no_gol = $this->input->post('no_gol');
			$gol    = $this->input->post('golongan');
			$tahun  = $this->input->post('tahun');
			$periode  = $this->input->post('periode');
			$dt     = $this->model->get_data_tenaga_kerja($no_gol, $tahun, $periode);

		} else if($this->input->post('simpan')){
			$no_gol = $this->input->post('no_gol');
			$gol    = $this->input->post('golongan');
			$tahun  = $this->input->post('tahun');
			$periode  = $this->input->post('periode');
			$msg    = 1;

			$id_judul  = $this->input->post('id_gol');			
			$JML  = str_replace(',', '', $this->input->post('JML'));
			$JAN  = str_replace(',', '', $this->input->post('JAN'));
			$FEB  = str_replace(',', '', $this->input->post('FEB'));
			$MAR  = str_replace(',', '', $this->input->post('MAR'));
			$APR  = str_replace(',', '', $this->input->post('APR'));
			$MEI  = str_replace(',', '', $this->input->post('MEI'));
			$JUN  = str_replace(',', '', $this->input->post('JUN'));
			$JUL  = str_replace(',', '', $this->input->post('JUL'));
			$AGU  = str_replace(',', '', $this->input->post('AGU'));
			$SEP  = str_replace(',', '', $this->input->post('SEP'));
			$OKT  = str_replace(',', '', $this->input->post('OKT'));
			$NOP  = str_replace(',', '', $this->input->post('NOP'));
			$DES  = str_replace(',', '', $this->input->post('DES'));

			$this->model->delete_biaya_tenaga_kerja($no_gol, $tahun, $periode);

			foreach ($id_judul as $key => $val) {
				$this->model->simpan_biaya_tenaga_kerja($periode, $val, $tahun, $no_gol, $JML[$key],  $JAN[$key], $FEB[$key], $MAR[$key], $APR[$key], $MEI[$key], $JUN[$key], $JUL[$key], $AGU[$key], $SEP[$key], $OKT[$key], $NOP[$key], $DES[$key]);
			}

			$dt     = $this->model->get_data_tenaga_kerja($no_gol, $tahun, $periode);
		}

		$data = array(
		  'page' => "dashboard/input_biaya_tenaga_tkk_v",
		  'induk_menu' => "input_biaya",
		  'menu' => "input_biaya_tk_tkk",
		  'title' => "INPUT BIAYA TENAGA KERJA (TKK)",		
		  'departemen'	=> $this->dep_div->departemen(),  
		  'post_url' => "dashboard/input_biaya_tenaga_tkk_c",  
		  'msg'  => $msg,
		  'dt' => $dt,
		  'no_gol' => $no_gol,
		  'gol' => $gol,
		  'tahun' => $tahun,
		  'periode' => $periode,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}


	function get_golongan(){

		$keyword = $this->input->post('keyword');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (INDUK LIKE '%$keyword%' OR JUDUL LIKE '%$keyword%')";
		}

		$sql = "
			SELECT NO, INDUK FROM stp_setup_biaya_tenaga_kerja 
			WHERE $where AND NO IN ('I', 'II', 'III', 'IV')
			GROUP BY NO, INDUK
			ORDER BY ID
			LIMIT 10";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);

	}

	function get_golongan_by_no(){
		$no = $this->input->post('no');

		$sql = "
			SELECT NO, INDUK FROM stp_setup_biaya_tenaga_kerja 
			WHERE NO = '$no'
			GROUP BY NO, INDUK
			";
		$data = $this->db->query($sql)->row();
		echo json_encode($data);

	}
}