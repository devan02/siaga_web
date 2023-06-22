<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_kode_perkiraan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('setup_kode_perkiraan_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";

		if($this->input->post('simpan')){

			$msg = 1;
			$kode_perkiraan = $this->input->post('kode_perkiraan');
			$nama_perkiraan = addslashes($this->input->post('nama_perkiraan'));
			$grup = $this->input->post('kode1');
			$sub = $this->input->post('kode2');

			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada menu', 'MASTER KODE PERKIRAAN', 'dengan Kode Perkiraan', $kode_perkiraan);
			$this->model->simpan_kode_perkiraan($kode_perkiraan, $nama_perkiraan, $grup, $sub);

		} else if($this->input->post('id_hapus')){

			$id_hapus = $this->input->post('id_hapus');
			$kode_perkiraan = $this->model->get_kode_perkiraan($id_hapus)->KODE_PERKIRAAN;	
			$msg = 3;

			$this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada menu', 'MASTER KODE PERKIRAAN', 'dengan Kode Perkiraan', $kode_perkiraan);
			$this->model->hapus_koper($id_hapus);

		} else if($this->input->post('edit')){

			$id_edit = $this->input->post('id_edit');
			$nama_perkiraan_ed = addslashes($this->input->post('nama_perkiraan_ed'));
			$kode_perkiraan = $this->model->get_kode_perkiraan($id_edit)->KODE_PERKIRAAN;

			$this->master_model_m->save_log('Ubah', 'Melakukan ubah data pada menu', 'MASTER KODE PERKIRAAN', 'dengan Kode Perkiraan', $kode_perkiraan);
			$this->model->edit_koper($id_edit, $nama_perkiraan_ed);
			$msg = 1;

		} else if($this->input->post('excel')){
			$this->print_excel();
		} else if($this->input->post('pdf')){
			$this->print_pdf();
		}

		$get_koper = $this->model->get_koper_all();
		$get_grup = $this->model->get_grup_koper();

		$data = array(
		  'page' => "dashboard/setup_kode_perkiraan_v",
		  'induk_menu' => "setup_data",
		  'menu' => "set_kode_perkiraan",
		  'title' => "MASTER KODE PERKIRAAN",
		  'dt' => $get_koper,		
		  'get_grup' => $get_grup,  
		  'post_url' => "dashboard/setup_kode_perkiraan_c",  
		  'msg'  => $msg,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function print_excel(){

		$get_koper = $this->model->get_koper_all();

		$data = array(
		  'dt' => $get_koper,		
		);
		$this->load->view('dashboard/excel/setup_kode_perkiraan_xls', $data);
	}

	function print_pdf(){
		$get_koper = $this->model->get_koper_all();

		$data = array(
		  'dt' => $get_koper,		
		);
		$this->load->view('dashboard/pdf/setup_kode_perkiraan_pdf', $data);
	}

	function cek_kode(){
		$kode_perkiraan = $this->input->post('kode_perkiraan'); 
		$hasil = 0;

		$cek = $this->model->cek_kode($kode_perkiraan);

		if(count($cek) > 0){
			$hasil = 1;
		} else {
			$hasil = 0;
		}

		echo json_encode($hasil);

	}

	function get_kode_perkiraan(){
		$id = $this->input->post('id'); 
		$get_kode = $this->model->get_kode_perkiraan($id);

		echo json_encode($get_kode);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */