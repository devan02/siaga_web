<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_spm_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('input_spm_m','model');
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index()
	{

		$msg = "";

		if($this->input->post('simpan')){

			$thn = date('Y');
			$bln = date('m');

			$msg = 1;
			$no_spm = $this->input->post('no_spm');
			$tgl_spm = $this->input->post('tgl_spm');
			$keterangan = $this->input->post('keterangan');
			$nilai_spm = str_replace(',', '', $this->input->post('nilai_spm'));

			$this->model->simpan_spm($no_spm, $tgl_spm, $keterangan, $nilai_spm);
			$this->model->save_next_spm($thn, $bln);

			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada menu', 'INPUT SPM', 'dengan NO SPM', $no_spm);
		
		} else if($this->input->post('id_hapus')){
			$msg = 3;
			$id_hapus = $this->input->post('id_hapus');
			$dt_spm = $this->model->get_spm_by_id($id_hapus);
			$this->model->delete_spm($id_hapus);

			$this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada menu', 'INPUT SPM', 'dengan NO SPM', $dt_spm->NO_SPM);

		} else if($this->input->post('edit')){
			$msg = 1;
			$no_spm = $this->input->post('no_spm');
			$tgl_spm = $this->input->post('tgl_spm');
			$keterangan = $this->input->post('keterangan');
			$nilai_spm = str_replace(',', '', $this->input->post('nilai_spm'));

			$this->model->edit_spm($no_spm, $tgl_spm, $keterangan, $nilai_spm);

			$this->master_model_m->save_log('Ubah', 'Melakukan ubah data pada menu', 'INPUT SPM', 'dengan NO SPM', $no_spm);
		
		} else if($this->input->post('excel')){
			$this->print_excel();
		} else if($this->input->post('pdf')){
			$this->print_pdf();
		}

		$data = array(

		  'page' => "dashboard/input_spm_v",
		  'msg'  => $msg,
		  'post_url' => "dashboard/input_spm_c",
		  'menu' => "input_spm",
		  'title' => "INPUT SPM",		  
		  'induk_menu' => "input_spm",
		  'dt' => $this->model->get_all_spm(),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function print_excel(){

		$data = array(
		  'dt' => $this->model->get_all_spm(),	
		);
		$this->load->view('dashboard/excel/input_spm_xls', $data);
	}

	function print_pdf(){

		$data = array(
		  'dt' => $this->model->get_all_spm(),	
		);
		$this->load->view('dashboard/pdf/input_spm_pdf', $data);
	}

	function get_spm_by_id(){
		$id = $this->input->post('id');
		$dt = $this->model->get_spm_by_id($id);

		echo json_encode($dt);
	}

	function get_nomor_spm(){
		$thn = date('Y');
		$bln = date('m');

		$cek_nomor = $this->model->cek_tahun_spm($thn, $bln);

		if(count($cek_nomor) == 0){
			$this->model->simpan_nomor_spm($thn, $bln);
		} 

		$get_nomor = $this->model->get_next_nomor_spm($thn, $bln)->NEXT;

		$no = sprintf("%04d", $get_nomor);
		$bulan = date('m');
		$tgl   = date('d');
		$tahun = substr($thn,2);

		$nmr = "SPM-".$no."/$tahun/$bulan/$tgl";

		echo json_encode($nmr);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */