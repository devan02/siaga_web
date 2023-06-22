<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_grup_kode_perkiraan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('setup_grup_kode_perkiraan_m','model');
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
			$kode_grup = $this->input->post('kode_grup');
			$kode_sub  = $this->input->post('kode_sub');
			$nama_grup = addslashes($this->input->post('nama_grup'));
			$sub_grup1 = addslashes($this->input->post('sub_grup1'));
			$sub_grup2 = addslashes($this->input->post('sub_grup2'));
			$sub_grup3 = addslashes($this->input->post('sub_grup3'));

			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada menu', 'MASTER GRUP KODE PERKIRAAN', 'dengan Kode GRUP', $kode_grup);
			$this->model->simpan_grup_koper($kode_grup, $kode_sub, $nama_grup, $sub_grup1, $sub_grup2, $sub_grup3);
			$this->session->set_flashdata('status','1');
		
		} else if($this->input->post('id_hapus')){

			$id_hapus = $this->input->post('id_hapus');
			$kode_grup = $this->model->get_sub_grup_koper_by_id($id_hapus)->KP_GRUP;

			$this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada menu', 'MASTER GRUP KODE PERKIRAAN', 'dengan Kode GRUP', $kode_grup);
			$this->model->hapus_grup($id_hapus);
			$msg = 2;

		} else if($this->input->post('edit')){

			$id_edit = $this->input->post('id_edit');
			$kode_grup_ed = $this->input->post('kode_grup_ed');
			$kode_sub_ed = $this->input->post('kode_sub_ed');
			$nama_grup_ed = addslashes($this->input->post('nama_grup_ed'));
			$sub_grup1_ed = addslashes($this->input->post('sub_grup1_ed'));
			$sub_grup2_ed = addslashes($this->input->post('sub_grup2_ed'));
			$sub_grup3_ed = addslashes($this->input->post('sub_grup3_ed'));

			$this->master_model_m->save_log('Ubah', 'Melakukan ubah data pada menu', 'MASTER GRUP KODE PERKIRAAN', 'dengan Kode GRUP', $kode_grup_ed);
			$this->model->edit_grup($id_edit, $kode_grup_ed, $kode_sub_ed, $nama_grup_ed, $sub_grup1_ed, $sub_grup2_ed, $sub_grup3_ed);
			$msg = 1;
		
		} else if($this->input->post('excel')){
			$this->print_excel();
		} else if($this->input->post('pdf')){
			$this->print_pdf();
		}


		$get_grup = $this->model->get_sub_grup_koper();

		$data = array(
		  'page' => "dashboard/setup_grup_kode_perkiraan_v",
		  'induk_menu' => "setup_data",
		  'menu' => "set_grup_kode_perkiraan",
		  'title' => "MASTER GRUP KODE PERKIRAAN",	
		  'dt' => $get_grup,	
		  'post_url' => "dashboard/setup_grup_kode_perkiraan_c",  
		  'msg'  => $msg,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function print_excel(){

		$get_grup = $this->model->get_sub_grup_koper();

		$data = array(
		  'dt' => $get_grup,		
		);
		$this->load->view('dashboard/excel/setup_grup_kode_perkiraan_xls', $data);
	}

	function print_pdf(){
		$get_grup = $this->model->get_sub_grup_koper();

		$data = array(
		  'dt' => $get_grup,		
		);
		$this->load->view('dashboard/pdf/setup_grup_kode_perkiraan_pdf', $data);
	}

	function get_grup(){
		$id = $this->input->post('id'); 
		$get_grup_by_id = $this->model->get_sub_grup_koper_by_id($id);

		echo json_encode($get_grup_by_id);
	}

	function cek_grup_sub(){
		$kode_grup = $this->input->post('kode_grup'); 
		$kode_sub = $this->input->post('kode_sub'); 
		$hasil = 0;

		$cek = $this->model->cek_grup_sub($kode_grup, $kode_sub);

		if(count($cek) > 0){
			$hasil = 1;
		} else {
			$hasil = 0;
		}

		echo json_encode($hasil);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */