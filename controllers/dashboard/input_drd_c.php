<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_drd_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('input_drd_m','model');
	}

	function index()
	{

		$msg = "";
		$dt = "";
		$edit = "";
		$periode = "";
		$tahun = "";

		if($this->input->post('generate')){
			$edit = 1;
			$periode = $this->input->post('periode');
			$tahun = $this->input->post('tahun');

			$dt = $this->model->get_nilai_blok($periode, $tahun);
		
		} else if($this->input->post('simpan')){
			$msg = 1;
			$edit = 1;

			$tahun = $this->input->post('thn');
			$periode = $this->input->post('prd');			
			$ID_BLOK = $this->input->post('ID_BLOK');
			$JAN 	 = $this->input->post('JAN');
			$FEB 	 = $this->input->post('FEB');
			$MAR 	 = $this->input->post('MAR');
			$APR 	 = $this->input->post('APR');
			$MEI 	 = $this->input->post('MEI');
			$JUN 	 = $this->input->post('JUN');
			$JUL 	 = $this->input->post('JUL');
			$AGU 	 = $this->input->post('AGU');
			$SEP 	 = $this->input->post('SEP');
			$OKT 	 = $this->input->post('OKT');
			$NOP 	 = $this->input->post('NOP');
			$DES 	 = $this->input->post('DES');

			$this->model->delete_nilai_blok($tahun, $periode);

			foreach ($ID_BLOK as $key => $val) {
				$this->model->save_nilai_blok($tahun, $periode, $val, 
												$JAN[$key], $FEB[$key], $MAR[$key], $APR[$key], $MEI[$key], $JUN[$key], $JUL[$key], $AGU[$key], $SEP[$key], $OKT[$key], $NOP[$key], $DES[$key]);
			}

			$dt = $this->model->get_nilai_blok($periode, $tahun);
		}

		$data = array(

		  'page' => "dashboard/input_drd_v",
		  'msg'  => $msg,
		  'post_url' => "dashboard/input_drd_c",
		  'menu' => "input_drd",
		  'title' => "INPUT REALISASI DRD",		  
		  'induk_menu' => "input_drd",
		  'dt' => $dt,
		  'edit' => $edit,
		  'tahun' => $tahun,
		  'periode' => $periode,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function get_spm_by_id(){
		$id = $this->input->post('id');
		$dt = $this->model->get_spm_by_id($id);

		echo json_encode($dt);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */