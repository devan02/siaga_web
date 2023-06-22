<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_rab_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('master_rab_m','model');
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

			$jenis_rab = $this->input->post('jenis_rab');
			$tahun = $this->input->post('tahun');
			$nomor_rab = $this->input->post('nomor_rab');
			$kota = addslashes($this->input->post('kota'));
			$kegiatan = addslashes($this->input->post('kegiatan'));
			$pekerjaan = addslashes($this->input->post('pekerjaan'));
			$lokasi = addslashes($this->input->post('lokasi'));
			$sumber_dana = $this->input->post('sumber_dana');
			$jns = $this->input->post('jenis_rab');

			if($jns == "teknik"){
				$jns = "TEK";
			} else {
				$jns = "OPR";
			}

			$bln = date('m');

			$this->model->save_rab($jenis_rab, $tahun, $nomor_rab, $kota, $kegiatan, $pekerjaan, $lokasi, $sumber_dana);
			$this->model->save_next_norab($tahun, $jns, $bln);

			$jns_kegiatan2 = $this->input->post('jns_kegiatan2');
			$sts_jns_kegiatan2 = $this->input->post('sts_jns_kegiatan2');
			$kode_barang2 = $this->input->post('kode_barang2');
			$volume2 = $this->input->post('volume2');
			$satuan2 = $this->input->post('satuan2');
			$harga_satuan2 = $this->input->post('harga_satuan2');

			$volume2 = str_replace(',', '', $volume2);


			$id_rab = $this->model->get_id_rab()->ID;
			foreach ($jns_kegiatan2 as $key => $val) {
				$this->model->save_detail_rab($id_rab, $val, $volume2[$key], $satuan2[$key], $harga_satuan2[$key]);

				if($sts_jns_kegiatan2[$key] == 1){
					$this->model->update_harga_barang($kode_barang2[$key], $harga_satuan2[$key]);
				}
			}

			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada menu', 'MASTER RAB', 'dengan Nomor RAB', $nomor_rab);

		} else if($this->input->post('id_hapus')){

			$id_hapus = $this->input->post('id_hapus');
			$msg = 0;
			$data = $this->model->get_rab_by_id($id_hapus);

			$cek  = $this->model->cek_rab_in_spk($data->NO_RAB);			
			$cek2 = $this->model->cek_rab_in_realisasi($data->NO_RAB);			

			if(count($cek) > 0 ){
			   $msg = 5;
			} else if(count($cek2) > 0 ){
			   $msg = 6;
			} else {
			   $this->model->hapus_rab($id_hapus);
			   $msg = 3;
			   $this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada menu', 'MASTER RAB', 'dengan Nomor RAB', $data->NO_RAB);
			} 

		} else if($this->input->post('ubah')){
			$msg = 1;

			$id_rab = $this->input->post('id_rab');
			$jenis_rab = $this->input->post('jenis_rab');
			$tahun = $this->input->post('tahun');
			$nomor_rab = $this->input->post('nomor_rab');
			$kota = addslashes($this->input->post('kota'));
			$kegiatan = addslashes($this->input->post('kegiatan'));
			$pekerjaan = addslashes($this->input->post('pekerjaan'));
			$lokasi = addslashes($this->input->post('lokasi'));
			$sumber_dana = $this->input->post('sumber_dana');
			$jns = $this->input->post('jenis_rab');

			if($jns == "teknik"){
				$jns = "TEK";
			} else {
				$jns = "OPR";
			}

			$this->model->edit_rab($id_rab, $jenis_rab, $tahun, $nomor_rab, $kota, $kegiatan, $pekerjaan, $lokasi, $sumber_dana);

			$jns_kegiatan2 = $this->input->post('jns_kegiatan2');
			$sts_jns_kegiatan2 = $this->input->post('sts_jns_kegiatan2');
			$volume2 = $this->input->post('volume2');
			$satuan2 = $this->input->post('satuan2');
			$harga_satuan2 = $this->input->post('harga_satuan2');

			$volume2 = str_replace(',', '', $volume2);

			$this->model->delete_rinci($id_rab);

			foreach ($jns_kegiatan2 as $key => $val) {
				$this->model->save_detail_rab($id_rab, $val, $volume2[$key], $satuan2[$key], $harga_satuan2[$key]);
			}

			$this->master_model_m->save_log('Ubah', 'Melakukan ubah data pada menu', 'MASTER RAB', 'dengan nomor RAB', $nomor_rab);
		
		} else if($this->input->post('excel')){
			$this->print_excel();
		} else if($this->input->post('pdf')){
			$this->print_pdf();
		}

		$data = array(
		  'page' => "dashboard/master_rab_v",
		  'induk_menu' => "setup_data",
		  'menu' => "set_rab",
		  'title' => "MASTER RAB",
		  'post_url' => "dashboard/master_rab_c",  
		  'msg'  => $msg,
		  'dt' => $this->model->get_all_rab(),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function print_excel(){		

		$data = array(
		  'dt' => $this->model->get_all_rab(),	
		);
		$this->load->view('dashboard/excel/master_rab_xls', $data);
	}

	function print_pdf(){		

		$data = array(
		  'dt' => $this->model->get_all_rab(),	
		);
		$this->load->view('dashboard/pdf/master_rab_pdf', $data);
	}


	function get_nomor_rab(){
		$thn = $this->input->post('thn');
		$jns = $this->input->post('jns');

		if($jns == "teknik"){
			$jns = "TEK";
		} else {
			$jns = "OPR";
		}

		$bln = date('m');
		$cek_nomor = $this->model->cek_tahun_rab($jns, $thn, $bln);

		if(count($cek_nomor) == 0){
			$this->model->simpan_nomor_rab($jns, $thn, $bln);
		} 

		$get_nomor = $this->model->get_next_nomor_rab($jns, $thn, $bln)->NEXT;

		$no = sprintf("%04d", $get_nomor);
		$bulan = date('m');
		$tgl   = date('d');
		$tahun = substr($thn,2);

		$nmr = "RAB.$jns-".$no."/$tahun/$bulan/$tgl";

		echo json_encode($nmr);
	}

	function get_data_rab(){
		$id = $this->input->post('id');

		$data = $this->model->get_rab_by_id($id);

		echo json_encode($data);
	}

	function get_detail_data_rab(){
		$id = $this->input->post('id');
		$data = $this->model->get_detail_rab_by_id($id);

		echo json_encode($data);
	}

	function get_kode_barang(){
		$keyword = $this->input->post('keyword');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (KODE_BARANG LIKE '%$keyword%' OR NAMA_BARANG LIKE '%$keyword%')";
		}
		$sql = "SELECT * FROM stp_kode_barang WHERE $where ORDER BY KODE_BARANG LIMIT 10";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function get_detil_barang(){
		$id = $this->input->post('id');
		$where = "1 = 1";
		if($id != ""){
			$where = $where." AND ID = $id";
		}
		$sql = "SELECT * FROM stp_kode_barang WHERE $where";
		$data = $this->db->query($sql)->row();
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */