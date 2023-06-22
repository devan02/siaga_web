<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontrol_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('kode_perkiraan_m','koper');
		$this->load->model('kontrol_anggaran_m','model');

		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index(){
		$key = "";
		$data = array(
		  'page' => "dashboard/kontrol_anggaran_v",
		  'menu' => "kontrol_anggaran",
		  'title' => "KONTROL ANGGARAN",	
		  'induk_menu' => "",
		  'departemen'	=> $this->dep_div->departemen(),
		  'koper'		=> $this->koper->get_koper_all($key),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	//RKAP
	function get_anggaran_rinci_rkap(){
		$kriteria = $this->input->post('kriteria');
		$bagian = $this->input->post('bagian');
		$sub_bagian = $this->input->post('sub_bagian');
		$tahun = $this->input->post('tahun');
		$kode_perkiraan = $this->input->post('kode_perkiraan');
		$kode_anggaran = $this->input->post('kode_anggaran');
		$kondisi = $this->input->post('kondisi');
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$data = $this->model->get_data_anggaran_rkap($kriteria,$bagian,$sub_bagian,$tahun,$kode_perkiraan,$kode_anggaran,$kondisi,$tgl_awal,$tgl_akhir);
		echo json_encode($data);
	}

	function get_kode_anggaran_rinci_rkap(){
		$kriteria = $this->input->post('kriteria');
		$kode_perkiraan = $this->input->get('kode_perkiraan');
		$kode_anggaran = $this->input->get('kode_anggaran');
		$tahun = $this->input->get('tahun');
		$bagian = $this->input->get('bagian');
		$sub_bagian = $this->input->get('sub_bagian');
		$kondisi = $this->input->get('kondisi');
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data = $this->model->get_kode_anggaran_rinci_rkap($kriteria,$kode_perkiraan,$kode_anggaran,$tahun,$bagian,$sub_bagian,$kondisi,$tgl_awal,$tgl_akhir);
		echo json_encode($data);
	}

	function get_no_bukti_rinci_rkap(){
		$id_anggaran = $this->input->get('id_anggaran');
		$tahun = $this->input->get('tahun');
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data = $this->model->get_no_bukti_rinci_rkap($id_anggaran,$tahun,$tgl_awal,$tgl_akhir);
		echo json_encode($data);
	}

	function get_data_anggaran_tidak_rinci_rkap(){
		$kriteria = $this->input->post('kriteria');
		$bagian = $this->input->post('bagian');
		$sub_bagian = $this->input->post('sub_bagian');
		$tahun = $this->input->post('tahun');
		$kode_perkiraan = $this->input->post('kode_perkiraan');
		$kode_anggaran = $this->input->post('kode_anggaran');
		$kondisi = $this->input->post('kondisi');
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$data = $this->model->get_data_anggaran_rkap($kriteria,$bagian,$sub_bagian,$tahun,$kode_perkiraan,$kode_anggaran,$kondisi,$tgl_awal,$tgl_akhir);
		echo json_encode($data);
	}

	//REVISI
	function get_anggaran_rinci_revisi(){
		$kriteria = $this->input->post('kriteria');
		$bagian = $this->input->post('bagian');
		$sub_bagian = $this->input->post('sub_bagian');
		$tahun = $this->input->post('tahun');
		$kode_perkiraan = $this->input->post('kode_perkiraan');
		$kode_anggaran = $this->input->post('kode_anggaran');
		$kondisi = $this->input->post('kondisi');
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$data = $this->model->get_data_anggaran_revisi($kriteria,$bagian,$sub_bagian,$tahun,$kode_perkiraan,$kode_anggaran,$kondisi,$tgl_awal,$tgl_akhir);
		echo json_encode($data);
	}

	function get_kode_anggaran_rinci_revisi(){
		$kriteria = $this->input->post('kriteria');
		$kode_perkiraan = $this->input->get('kode_perkiraan');
		$kode_anggaran = $this->input->get('kode_anggaran');
		$tahun = $this->input->get('tahun');
		$bagian = $this->input->get('bagian');
		$sub_bagian = $this->input->get('sub_bagian');
		$kondisi = $this->input->post('kondisi');
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data = $this->model->get_kode_anggaran_revisi($kriteria,$kode_perkiraan,$kode_anggaran,$tahun,$bagian,$sub_bagian,$kondisi,$tgl_awal,$tgl_akhir);
		echo json_encode($data);
	}

	function get_no_bukti_rinci_revisi(){
		$id_anggaran = $this->input->get('id_anggaran');
		$tahun = $this->input->get('tahun');
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data = $this->model->get_no_bukti_revisi($id_anggaran,$tahun,$tgl_awal,$tgl_akhir);
		echo json_encode($data);
	}

	function get_data_anggaran_tidak_rinci_revisi(){
		$kriteria = $this->input->post('kriteria');
		$bagian = $this->input->post('bagian');
		$sub_bagian = $this->input->post('sub_bagian');
		$tahun = $this->input->post('tahun');
		$kode_perkiraan = $this->input->post('kode_perkiraan');
		$kode_anggaran = $this->input->post('kode_anggaran');
		$kondisi = $this->input->post('kondisi');
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$data = $this->model->get_data_anggaran_revisi($kriteria,$bagian,$sub_bagian,$tahun,$kode_perkiraan,$kode_anggaran,$kondisi,$tgl_awal,$tgl_akhir);
		echo json_encode($data);
	}

	function get_anggaran_by_id(){
		$kode_anggaran = $this->input->post('kode_anggaran');
		$tahun = $this->input->post('tahun');
		$data = $this->model->get_kode_anggaran($kode_anggaran,$tahun);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */