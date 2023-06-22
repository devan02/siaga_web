<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_dpbm_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('master_dpbm_m','model');
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

			$nomor_dpbm = addslashes($this->input->post('no_dpbm'));
			$tanggal    = $this->input->post('tanggal');
			$diminta    = addslashes($this->input->post('diminta'));
			$keterangan = addslashes($this->input->post('keterangan'));

			$kode_barang = $this->input->post('kode_barang2');
			$nama_barang = $this->input->post('nama_barang2');
			$vol_barang  = $this->input->post('vol_barang2');
			$harga 		 = str_replace(',', '', $this->input->post('harga2'));
			$harga 		 = str_replace('.', '', $harga);
			$no_po 		 = $this->input->post('no_po');

			$this->model->save_dpbm($nomor_dpbm, $tanggal, $diminta, $keterangan);

			$get_id_dpbm = $this->model->get_id_dpbm()->ID;

			if($kode_barang != "" || $kode_barang != null){
				foreach ($kode_barang as $key => $val){
					$this->model->save_detail_dpbm($get_id_dpbm, $val, $nama_barang[$key], $vol_barang[$key], $harga[$key], $no_po[$key]);
					$this->model->update_harga_barang($val, $harga[$key]);
				}
			}

			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada menu', 'MASTER DPBM', 'dengan nomor DPBM', $nomor_dpbm);

		} else if($this->input->post('ubah')){

			$msg = 1;

			$id_dpbm    = $this->input->post('id_dpbm');
			$nomor_dpbm = addslashes($this->input->post('no_dpbm'));
			$tanggal    = $this->input->post('tanggal');
			$diminta    = addslashes($this->input->post('diminta'));
			$keterangan = addslashes($this->input->post('keterangan'));

			$kode_barang = $this->input->post('kode_barang2');
			$nama_barang = $this->input->post('nama_barang2');
			$vol_barang  = $this->input->post('vol_barang2');
			$harga 		 = str_replace(',', '', $this->input->post('harga2'));
			$harga 		 = str_replace('.', '', $harga);
			$no_po 		 = $this->input->post('no_po');

			$this->model->update_dpbm($id_dpbm, $nomor_dpbm, $tanggal, $diminta, $keterangan);

			$this->model->delete_detail($id_dpbm);

			foreach ($kode_barang as $key => $val){
				$this->model->save_detail_dpbm($id_dpbm, $val, $nama_barang[$key], $vol_barang[$key], $harga[$key], $no_po[$key]);
				$this->model->update_harga_barang($val, $harga[$key]);
			}

			$this->master_model_m->save_log('Ubah', 'Melakukan ubah data pada menu', 'MASTER DPBM', 'dengan nomor DPBM', $nomor_dpbm);

		} else if($this->input->post('id_hapus')){

			$id_hapus = $this->input->post('id_hapus');
			$data = $this->model->get_dpbm_by_id($id_hapus);

			$cek = $this->model->cek_dpbm_in_realisasi($data->NO_DPBM);
			$msg = 0;

			if(count($cek) > 0 ){
			   $msg = 5;
			} else {
			   $this->model->hapus_dpbm($id_hapus);
			   $msg = 3;
			   $this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada menu', 'MASTER DPBM', 'dengan nomor DPBM', $data->NO_DPBM);
			} 			
			
		} else if($this->input->post('excel')){
			$this->print_excel();
		} else if($this->input->post('pdf')){
			$this->print_pdf();
		}


		$data = array(
		  'page' => "dashboard/master_dpbm_v",
		  'induk_menu' => "setup_data",
		  'menu' => "set_dppb",
		  'title' => "MASTER DPBM",
		  'post_url' => "dashboard/master_dpbm_c",  
		  'msg'  => $msg,
		  'get_barang' => $this->model->get_barang_all(),
		  'dt' => $this->model->get_data_dpbm(),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function print_excel(){

		$data = array(
		  'dt' => $this->model->get_data_dpbm(),	
		);
		$this->load->view('dashboard/excel/master_dpbm_xls', $data);
	}

	function print_pdf(){

		$data = array(
		  'dt' => $this->model->get_data_dpbm(),	
		);
		$this->load->view('dashboard/pdf/master_dpbm_pdf', $data);
	}

	function get_data_dpbm(){
		$id = $this->input->post('id');
		$data = $this->model->get_dpbm_by_id($id);

		echo json_encode($data);
	}

	function get_detail_data_dpbm(){
		$id = $this->input->post('id');
		$data = $this->model->get_detail_dpbm_by_id($id);

		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */