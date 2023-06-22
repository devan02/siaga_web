<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_ttd_panitia_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('setup_ttd_panitia_m','model');
	}

	function index()
	{
		$msg = 0;		
		$id_lap = 0;		 

		if($this->input->post('simpan')){

			$msg = 1;

			$id_lap = $this->input->post('nama_lap');
			$jabatan = $this->input->post('jabatan');
			$is_tgl = $this->input->post('is_tgl_txt');
			$pejabat = $this->input->post('pejabat');			

			$this->model->delete_detail_ttd($id_lap);
			$ist = 0;

			foreach ($jabatan as $key => $val) {
				$this->model->simpan_detail_ttd($id_lap, $val, $is_tgl[$key], $pejabat[$key]);
			}
		}

		$list_laporan = $this->model->get_list_laporan();

		$data = array(
		  'page' => "dashboard/setup_ttd_panitia_v",
		  'induk_menu' => "setup_data",
		  'menu' => "setup_ttd_panitia",
		  'title' => "MASTER TANDA TANGAN LAPORAN",	
		  'post_url' => "dashboard/setup_ttd_panitia_c",
		  'list_laporan' => $list_laporan,	 
		  'msg' => $msg, 
		  'id_lap' => $id_lap,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function get_ttd_detail(){
		$id_ttd = $this->input->post('id_ttd');

		$dt = $this->model->get_ttd_detail_by_id($id_ttd);
		echo json_encode($dt);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */