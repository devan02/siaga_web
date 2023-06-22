<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_barang_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('master_barang_m','model');
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
			$kode_barang  = addslashes($this->input->post('kode_barang'));
			$nama_barang  = addslashes($this->input->post('nama_barang'));
			$harga_barang = str_replace(',', '', $this->input->post('harga_barang'));
			$satuan_barang = addslashes($this->input->post('satuan_barang'));

			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada menu', 'MASTER BARANG', 'dengan Kode Barang', $kode_barang);
			$this->model->simpan_barang($kode_barang, $nama_barang, $harga_barang, $satuan_barang);

		} else if($this->input->post('id_hapus')){
			$id_hapus = $this->input->post('id_hapus');
			$msg = 3;
			$kode_barang = $this->model->get_barang_by_id($id_hapus)->KODE_BARANG;

			$this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada menu', 'MASTER BARANG', 'dengan Kode Barang', $kode_barang);
			$this->model->hapus_barang($id_hapus);

		} else if($this->input->post('edit')){
			$msg = 1;
			$id_edit = $this->input->post('id_edit');
			$kode_barang_ed = addslashes($this->input->post('kode_barang_ed'));
			$nama_barang_ed = addslashes($this->input->post('nama_barang_ed'));
			$satuan_ed = addslashes($this->input->post('satuan_ed'));
			$harga_barang_ed = str_replace(',', '', $this->input->post('harga_barang_ed'));
			$harga_barang_ed = str_replace('.', '', $harga_barang_ed);

			$this->master_model_m->save_log('Ubah', 'Melakukan ubah data pada menu', 'MASTER BARANG', 'dengan Kode Barang', $kode_barang_ed);
			$this->model->edit_barang($id_edit, $kode_barang_ed, $nama_barang_ed, $satuan_ed, $harga_barang_ed);
		
		} else if($this->input->post('excel')){
			$this->print_excel();
		} else if($this->input->post('pdf')){
			$this->print_pdf();
		}

		$get_barang = $this->model->get_barang_all();

		$data = array(
		  'page' => "dashboard/master_barang_v",
		  'induk_menu' => "setup_data",
		  'menu' => "set_barang",
		  'title' => "MASTER BARANG",
		  'dt' => $get_barang,		
		  'post_url' => "dashboard/master_barang_c",  
		  'msg'  => $msg,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function print_excel(){

		$get_barang = $this->model->get_barang_all();

		$data = array(
		  'dt' => $get_barang,		
		);
		$this->load->view('dashboard/excel/master_barang_xls', $data);
	}

	function print_pdf(){
		$get_barang = $this->model->get_barang_all();

		$data = array(
		  'dt' => $get_barang,		
		);
		$this->load->view('dashboard/pdf/master_barang_pdf', $data);
	}

	function get_kode_barang(){
		$id = $this->input->post('id');

		$data = array();
		$data['get_barang'] = $this->model->get_barang_by_id($id);

		$rego = $this->model->get_barang_by_id($id)->HARGA_BARANG;
		$rego2 = str_replace(',', '.', number_format($rego));

		$data['harga'] = $rego2;


		echo json_encode($data);
	}

	function cek_kode_barang(){
		$kode_barang = $this->input->post('kode_barang'); 
		$hasil = 0;

		$cek = $this->model->cek_kode_barang($kode_barang);

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