<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biaya_luar_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('biaya_luar_m','model');
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('realisasi_anggaran_m','realisasi');
	}

	function index(){
		$key = "";
		$data = array(
		  'page' => "dashboard/biaya_luar_v",
		  'induk_menu' => "input_biaya",
		  'menu' => "biaya_luar",
		  'title' => "IZIN PENGGUNAAN BIAYA DILUAR ANGGARAN",
		  'departemen'	=> $this->dep_div->departemen(),
		  'dpbm'		=> $this->model->get_dpbm($key),
		  'rab'			=> $this->realisasi->get_rab($key),
		  'url'			=> base_url()."dashboard/biaya_luar_c/simpan",
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function add_leading_zero($value, $threshold = 2) {
	    return sprintf('%0' . $threshold . 's', $value);
	}

	function romanic_number($integer, $upcase = true){ 
	    $table = array(
	    	'I'		=> 1,
	    	'II'	=> 2,
	    	'III'	=> 3,
	    	'IV'	=> 4,
	    	'V'		=> 5,
	    	'VI'	=> 6,
	    	'VII'	=> 7,
	    	'VIII'	=> 8,
	    	'IX'	=> 9,
	    	'X'		=> 10,
	    	'XI'	=> 11,
	    	'XII'	=> 12
	    ); 
	    $return = ''; 
	    while($integer > 0) 
	    { 
	        foreach($table as $rom=>$arb) 
	        { 
	            if($integer >= $arb) 
	            { 
	                $integer -= $arb; 
	                $return .= $rom; 
	                break; 
	            } 
	        } 
	    } 

	    return $return; 
	}

	function cek_no_surat(){
		$no_surat = "";
		$bulan = date("m");
		$tahun = date("Y");
		$bln_romawi = $this->romanic_number($bulan);
		$sql = "SELECT COUNT(*) AS TOTAL FROM stp_no_surat WHERE BULAN = '$bulan' AND TAHUN = '$tahun'";
		$query = $this->db->query($sql)->row();
		$total = $query->TOTAL;

		if($total == 0){
			$no_surat = "001/IB/$bln_romawi/$tahun";
		}else{
			$sq = "SELECT * FROM stp_no_surat WHERE BULAN = '$bulan' AND TAHUN = '$tahun'";
			$q = $this->db->query($sq)->row();
			$no = $q->NOMOR;
			$next = $no+1;
			$no_surat = $this->add_leading_zero($next,3)."/IB/$bln_romawi/$tahun";
		}
		echo json_encode($no_surat);
	}

	function simpan(){
		$tanggal = $this->input->post('tanggal');
		$bulan = date("m");
		$tahun = date("Y");
		$no_surat = $this->input->post('no_surat');
		$bagian = $this->input->post('departemen');
		$sub_bagian = $this->input->post('divisi');
		
		$no_realisasi = $this->input->post('no_realisasi');
		
		if($no_realisasi == "dpbm"){
			$id_dpbm = $this->input->post('id_dpbm');
			$id_rab = 0;
		}else{
			$id_dpbm = 0;
			$id_rab = $this->input->post('id_rab');
		}

		$program_biaya = $this->input->post('program_biaya');
		$alasan = $this->input->post('alasan');
		$this->model->simpan_biaya_luar($no_surat,$bagian,$sub_bagian,$program_biaya,$alasan,$tanggal,$bulan,$id_dpbm,$id_rab);

		$sql = "SELECT COUNT(*) AS TOTAL FROM stp_no_surat WHERE BULAN = '$bulan' AND TAHUN = '$tahun'";
		$query = $this->db->query($sql)->row();
		$total = $query->TOTAL;

		if($total == 0){
			$nomor = 1;
			$this->model->insert_next_no_surat($nomor,$bulan,$tahun);
		}else{
			$sq = "SELECT * FROM stp_no_surat WHERE BULAN = '$bulan' AND TAHUN = '$tahun'";
			$q = $this->db->query($sq)->row();
			$no = $q->NOMOR;
			$id = $q->ID;
			$next = $no+1;
			$this->model->update_next_no_surat($id,$next);
		}

		// save_log($jenis, $kegiatan, $modul, $kegiatan2, $objek)
		$kegiatan2 = "dengan No Surat ".$no_surat;
		$objek = $no_surat;
		$this->master_model_m->save_log('Simpan', 'Melakukan simpan data pada MENU', 'IZIN PENGGUNAAN BIAYA DILUAR ANGGARAN', $kegiatan2, $objek);

		$this->session->set_flashdata('sukses','1');
		redirect('dashboard/biaya_luar_c');
	}

	function get_dpbm_id(){
		$id_dpbm = $this->input->post('id_dpbm');
		$data = $this->model->get_dpbm_by_id($id_dpbm);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */