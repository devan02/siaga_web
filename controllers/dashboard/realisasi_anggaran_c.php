<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Realisasi_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('realisasi_anggaran_m','model');
		$this->load->model('kode_perkiraan_m','koper');
		$this->load->model('biaya_luar_m','biaya_luar');
		$this->load->model('kode_anggaran_m','kode');

		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index(){
		$disable = "";
		$disable2 = "";
		$sessi = $this->session->userdata('masuk_bos');
		$id_pegawai = $sessi['id'];
		$sql_peg = "SELECT * FROM stp_pegawai WHERE ID = '$id_pegawai'";
		$q_peg = $this->db->query($sql_peg)->row();
		$level = $q_peg->LEVEL;
		if($level == "KABAG"){
			$disable = "disabled='disabled'";
		}else if($level == "ADMIN"){
			$disable = "";
		}else if($level == null){
			$disable = "disabled='disabled'";
			$disable2 = "disabled='disabled'";
		}

		$key = "";
		$data = array(
		  'page' 		=> "dashboard/realisasi_anggaran_v",
		  'induk_menu' 	=> "realisasi_anggaran",
		  'menu' 		=> "realisasi_anggaran",
		  'title' 		=> "REALISASI ANGGARAN",
		  'departemen'	=> $this->dep_div->departemen(),
		  'koper'		=> $this->koper->get_koper_all($key),
		  'sumber_dana' => $this->kode->sumber_dana(),
		  'url'			=> base_url().'dashboard/realisasi_anggaran_c/simpan_realisasi',
		  'url_del'		=> base_url().'dashboard/realisasi_anggaran_c/hapus_realisasi',
		  'url_tambahan'=> base_url().'dashboard/realisasi_anggaran_c/simpan_anggaran_tambahan',
		  'disable'		=> $disable,
		  'disable2'	=> $disable2,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function data_anggaran(){
		$tahun = $this->input->post('tahun');
		$bagian = $this->input->post('bagian');
		$sub_bagian = $this->input->post('sub_bagian');
		$kode_perkiraan = $this->input->post('kode_perkiraan');
		$keyword = $this->input->post('keyword');
		$kriteria = $this->input->post('kriteria');
		$data = $this->model->get_anggaran($tahun,$bagian,$sub_bagian,$kode_perkiraan,$keyword,$kriteria);

		echo json_encode($data);
	}
	
	function do_realisasi(){
		$id_anggaran = $this->input->post('id_anggaran');
		$data['keterangan'] = "";
		$cek_realisasi = $this->db->query("SELECT a.* FROM stp_realisasi_anggaran a where a.id_anggaran = '$id_anggaran'"); 
		$sudah_realisasi = $cek_realisasi->num_rows();
		$data['data'] = $this->model->do_realisasi($id_anggaran);

		if($sudah_realisasi > 0){
			$cek_dppb = $this->model->cek_do_realisasi($id_anggaran,1);
			$cek_spk = $this->model->cek_do_realisasi($id_anggaran,2);
			$cek_spm = $this->model->cek_do_realisasi($id_anggaran,3);
			
			if($cek_dppb->num_rows() > 0 && $cek_spk->num_rows() > 0 ){
				$data['keterangan'] = "ALL";
			}else if($cek_spk->num_rows() > 0){
				$data['keterangan'] = "RAB";
			}else if($cek_dppb->num_rows() > 0){
				$data['keterangan'] = "DPBM";
			}else if($cek_spm->num_rows() > 0){
				$data['keterangan'] = "SPM";
			}
		}else{
			$data['keterangan'] = "belum_realisasi";
		}
		echo json_encode($data);
	}

	function popup_data_dpbm(){
		$keyword = $this->input->get('keyword');
		$data = $this->model->get_dpbm($keyword);
		echo json_encode($data);
	}

	function popup_data_rab(){
		$keyword = $this->input->get('keyword');
		$data = $this->model->get_rab($keyword);
		echo json_encode($data);
	}

	function popup_data_surat(){
		$keyword = $this->input->get('keyword');
		$data = $this->biaya_luar->get_no_surat($keyword);
		echo json_encode($data);
	}

	function popup_data_spm(){
		$keyword = $this->input->get('keyword');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND NO_SPM LIKE '%$keyword%' OR KET LIKE '%$keyword%'";
		}
		$sql = "SELECT * FROM stp_input_spm WHERE $where AND (NO_KEU != '' OR NO_KEU IS NOT NULL) AND (STATUS = 0 OR STATUS IS NULL) ORDER BY NO_SPM DESC";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function get_dpbm_id(){
		$id_dpbm = $this->input->post('id_dpbm');
		$data = $this->model->get_dpbm_by_id($id_dpbm);
		echo json_encode($data);
	}

	function get_realisasi_by_dpbm(){
		$id_anggaran = $this->input->post('id_anggaran');
		$data = $this->model->realisasi_by_dpbm($id_anggaran);
		echo json_encode($data);
	}

	function get_realisasi_by_id_dpbm(){
		$id_dpbm = $this->input->post('id_dpbm');
		$data = $this->model->realisasi_by_id_dpbm($id_dpbm);
		echo json_encode($data);
	}

	function get_rab_by_id(){
		$id_rab = $this->input->post('id_rab');
		$data = $this->model->get_rab_id($id_rab);
		echo json_encode($data);
	}

	function get_realisasi_rab(){
		$id_anggaran = $this->input->post('id_anggaran');
		$data = $this->model->get_realisasi_rab($id_anggaran);
		echo json_encode($data);
	}

	function get_realisasi_spm(){
		$id_anggaran = $this->input->post('id_anggaran');
		$data = $this->model->get_realisasi_spm($id_anggaran);
		echo json_encode($data);
	}

	function get_rab_click(){
		$id_anggaran = $this->input->post('id_rab');
		$data = $this->model->get_rab_click($id_anggaran);
		echo json_encode($data);
	}

	function get_spm_id(){
		$id_spm = $this->input->post('id_spm');
		$sql = "
			SELECT
				SPM.*,
				REALISASI.ID AS ID_REALISASI
			FROM stp_input_spm SPM
			LEFT JOIN stp_realisasi_anggaran REALISASI ON REALISASI.ID_SPM = SPM.ID
			WHERE SPM.ID = '$id_spm'
		";
		$data = $this->db->query($sql)->row();
		echo json_encode($data);
	}

	function get_spm_click(){
		$id_spm = $this->input->post('id_spm');
		$sql = "
			SELECT * FROM stp_input_spm WHERE ID = '$id_spm'
		";
		$data = $this->db->query($sql)->row();
		echo json_encode($data);
	}

	function simpan_realisasi(){
		$jenis_realisasi = $this->input->post('jenis_realisasi');
		$tanggal = $this->input->post('tanggal');
		$kode_anggaran = $this->input->post('kode_anggaran');

		if($jenis_realisasi == "DPBM"){
			$id_det_dpbm = $this->input->post('id_det_dpbm');
			$id_anggaran = $this->input->post('id_anggaran');
			$no_keu = $this->input->post('no_keu_dpbm');
			$id_dpbm = $this->input->post('id_det_dpbm');
			$no_dpbm = $this->input->post('no_dpbm');
			$volume_dpbm = $this->input->post('jumlah_dpbm');
			$harga_satuan_dpbm = str_replace(',', '', $this->input->post('harga_dpbm'));
			$id_rab = 0;
			$no_rab = "";
			$volume_rab = 0;
			$harga_satuan_rab = 0;
			$id_spk = 0;
			$no_spk = "";
			$volume_spk = 0;
			$biaya_kontrak_spk = 0;
			$nilai_spk_adendum = 0;
			$id_spm = 0;
			$no_spm = "";
			$nilai_spm = 0;

			$this->model->simpan_realisasi(
				$tanggal,
				$id_anggaran,
				$no_keu,
				$id_dpbm,
				$no_dpbm,
				$volume_dpbm,
				$harga_satuan_dpbm,
				$id_rab,
				$no_rab,
				$volume_rab,
				$harga_satuan_rab,
				$id_spk,
				$no_spk,
				$volume_spk,
				$biaya_kontrak_spk,
				$nilai_spk_adendum,
				$id_spm,
				$no_spm,
				$nilai_spm);

			$this->model->update_status_dpbm($id_det_dpbm);
			// save_log($jenis, $kegiatan, $modul, $kegiatan2, $objek)
			$kegiatan2 = "dengan Kode Anggaran ".$kode_anggaran." dan NO DPBM ".$no_dpbm;
			$objek = $kode_anggaran." - ".$no_dpbm;
			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada MENU', 'REALISASI ANGGARAN', $kegiatan2, $objek);

		}else if($jenis_realisasi == "RAB"){

			$id_anggaran = $this->input->post('id_anggaran');
			$no_keu = $this->input->post('no_keu_rab');
			$id_dpbm = 0;
			$no_dpbm = "";
			$volume_dpbm = 0;
			$harga_satuan_dpbm = 0;
			$id_rab = $this->input->post('id_det_rab');
			$no_rab = $this->input->post('no_rab');
			$volume_rab = $this->input->post('jumlah_rab');
			$harga_satuan_rab = str_replace(',', '', $this->input->post('harga_rab'));
			
			$id_spk = $this->input->post('id_spk');
			$no_spk = $this->input->post('no_spk');
			$volume_spk = 1;
			$biaya_kontrak_spk = $this->input->post('biaya_kontrak_spk');
			$nilai_spk_adendum = $this->input->post('nilai_spk_adendum');

			$id_spm = 0;
			$no_spm = "";
			$nilai_spm = 0;

			$this->model->simpan_realisasi(
				$tanggal,
				$id_anggaran,
				$no_keu,
				$id_dpbm,
				$no_dpbm,
				$volume_dpbm,
				$harga_satuan_dpbm,
				$id_rab,
				$no_rab,
				$volume_rab,
				$harga_satuan_rab,
				$id_spk,
				$no_spk,
				$volume_spk,
				$biaya_kontrak_spk,
				$nilai_spk_adendum,
				$id_spm,
				$no_spm,
				$nilai_spm);

			$this->model->update_status_rab($id_rab);
			// save_log($jenis, $kegiatan, $modul, $kegiatan2, $objek)
			$kegiatan2 = "dengan Kode Anggaran ".$kode_anggaran." dan NO RAB ".$no_rab;
			$objek = $kode_anggaran." - ".$no_rab;
			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada MENU', 'REALISASI ANGGARAN', $kegiatan2, $objek);
		
		}else if($jenis_realisasi == "SPM"){

			$id_anggaran = $this->input->post('id_anggaran');
			$no_keu = $this->input->post('no_keu_spm');
			$id_dpbm = 0;
			$no_dpbm = "";
			$volume_dpbm = 0;
			$harga_satuan_dpbm = 0;
			$id_rab = 0;
			$no_rab = "";
			$volume_rab = 0;
			$harga_satuan_rab = 0;
			
			$id_spk = 0;
			$no_spk = "";
			$volume_spk = 0;
			$biaya_kontrak_spk = 0;
			$nilai_spk_adendum = 0;

			$id_spm = $this->input->post('id_spm');
			$no_spm = $this->input->post('no_spm');
			$nilai_spm = str_replace(',', '', $this->input->post('total_spm'));

			$this->model->simpan_realisasi(
				$tanggal,
				$id_anggaran,
				$no_keu,
				$id_dpbm,
				$no_dpbm,
				$volume_dpbm,
				$harga_satuan_dpbm,
				$id_rab,
				$no_rab,
				$volume_rab,
				$harga_satuan_rab,
				$id_spk,
				$no_spk,
				$volume_spk,
				$biaya_kontrak_spk,
				$nilai_spk_adendum,
				$id_spm,
				$no_spm,
				$nilai_spm);

			$update_status_spm = "UPDATE stp_input_spm SET STATUS = 1 WHERE ID = '$id_spm'";
			$this->db->query($update_status_spm);
			// save_log($jenis, $kegiatan, $modul, $kegiatan2, $objek)
			$kegiatan2 = "dengan Kode Anggaran ".$kode_anggaran." dan NO SPM ".$no_spm;
			$objek = $kode_anggaran." - ".$no_spm;
			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada MENU', 'REALISASI ANGGARAN', $kegiatan2, $objek);
		}

		echo '1';
		// $this->session->set_flashdata('sukses','1');
		// redirect('dashboard/realisasi_anggaran_c');
	}

	function hapus_realisasi(){
		$id_hapus = $this->input->post('id_hapus');
		$id_realisasi = $this->input->post('id_realisasi');
		$ket_realisasi = $this->input->post('ket_realisasi');
		$no_bukti_hapus = $this->input->post('no_bukti_hapus');

		if($ket_realisasi == "DPBM"){
			$sql = "UPDATE stp_dpbm_detail SET STATUS = 0 WHERE ID = $id_hapus";
			$this->db->query($sql);

			$query = "DELETE FROM stp_realisasi_anggaran WHERE ID = $id_realisasi";
			$this->db->query($query);
			// save_log($jenis, $kegiatan, $modul, $kegiatan2, $objek)
			$kegiatan2 = "NO DPBM ".$no_bukti_hapus;
			$objek = $no_bukti_hapus;
			$this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada MENU', 'REALISASI ANGGARAN', $kegiatan2, $objek);
		}else if($ket_realisasi == "RAB"){
			$sql = "UPDATE stp_rincian_anggaran_biaya_detail SET STATUS = 0 WHERE ID = $id_realisasi";
			$this->db->query($sql);

			$query = "DELETE FROM stp_realisasi_anggaran WHERE ID = $id_hapus";
			$this->db->query($query);
			// save_log($jenis, $kegiatan, $modul, $kegiatan2, $objek)
			$kegiatan2 = "NO RAB ".$no_bukti_hapus;
			$objek = $no_bukti_hapus;
			$this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada MENU', 'REALISASI ANGGARAN', $kegiatan2, $objek);
		}else{
			$sql = "UPDATE stp_input_spm SET STATUS = 0 WHERE ID = $id_realisasi";
			$this->db->query($sql);

			$query = "DELETE FROM stp_realisasi_anggaran WHERE ID = $id_hapus";
			$this->db->query($query);
			// save_log($jenis, $kegiatan, $modul, $kegiatan2, $objek)
			$kegiatan2 = "NO SPM ".$no_bukti_hapus;
			$objek = $no_bukti_hapus;
			$this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada MENU', 'REALISASI ANGGARAN', $kegiatan2, $objek);
		}

		// $this->session->set_flashdata('hapus','1');
		// redirect('dashboard/realisasi_anggaran_c');

		echo '1';
	}

	function simpan_anggaran_tambahan(){
		$kode_perkiraan = $this->input->post('koper_tambahan');
		$kode_anggaran = $this->input->post('kode_anggaran_tambahan');
		$tahun = $this->input->post('tahun_tambahan');
		$departemen = $this->input->post('id_bagian_tambahan');
		$divisi = $this->input->post('id_sub_bagian_tambahan');
		$jenis_anggaran = $this->input->post('jenis_anggaran');

		if($jenis_anggaran == "Barang"){
			$total = str_replace(',', '', $this->input->post('total'));
			$total_pelaksanaan = 0;
			$tmt_pelaksanaan = "";
			$lama_pelaksanaan = 0;
		}else{
			$total = 0;
			$total_pelaksanaan = str_replace(',', '', $this->input->post('total'));
			$tmt_pelaksanaan = $this->input->post('tmt_pelaksanaan');
			$lama_pelaksanaan = $this->input->post('lama_pelaksanaan');
		}

		$id_jenis_anggaran = $this->input->post('id_jenis_anggaran');
		$uraian = addslashes($this->input->post('uraian_tambahan'));
		$sumber_dana = addslashes($this->input->post('sumber_dana'));
		$lokasi = addslashes($this->input->post('lokasi'));
		$satuan = addslashes($this->input->post('satuan'));
		$harga = str_replace(',', '', $this->input->post('harga_satuan'));
		$jumlah = $this->input->post('volume');
		
		$jenis_rapat = "RKAP";
		$setuju = "DISETUJUI";
		$no_surat = $this->input->post('no_surat');
		$sts_tambahan = 2;
		$tanggal_input = date("d-m-Y");

		$deparray = array(
			'KEUANGAN' => 'KEU', 
			'DISTRIBUSI' => 'DIS', 
			'FUNGSIONAL (SPI)' => 'FNGS', 
			'HUBLANG' => 'HUBL', 
			'KEPEGAWAIAN' => 'KEPEG',
			'PERENCANAAN' => 'PERNC',
			'PRODUKSI' => 'PRO', 
			'UMUM' => 'UMUM'
		);

		$sql_nama_dep = "SELECT NAMA FROM stp_departemen WHERE ID = $departemen";
		$nama_dep = $this->db->query($sql_nama_dep)->row()->NAMA;

		$count = $this->kode->cek_kode_anggaran($nama_dep,$tahun)->JUMLAH;
		if($count == 0){
			$sql = "SELECT * FROM stp_kode_anggaran WHERE DEPARTEMEN = '$nama_dep' AND TAHUN = $tahun ORDER BY ID DESC LIMIT 1";
			$data = $this->db->query($sql)->row();
			//IT/001/2016
			$dep = $deparray[$nama_dep];
			$next = 1;
			$this->kode->insert_kode_baru($nama_dep,$next,$tahun,$departemen);
		}else{
			$sql = "SELECT * FROM stp_kode_anggaran WHERE DEPARTEMEN = '$nama_dep' AND TAHUN = $tahun ORDER BY ID DESC LIMIT 1";
			$data = $this->db->query($sql)->row();
			//IT/001/2016
			$next = $data->NEXT+1;
			$this->kode->update_kode_ag($nama_dep,$tahun,$next);
		}

		$this->model->simpan_anggaran_tambahan(
			$kode_perkiraan,
			$kode_anggaran,
			$tahun,
			$departemen,
			$divisi,
			$jenis_anggaran,
			$id_jenis_anggaran,
			$uraian,
			$sumber_dana,
			$lokasi,
			$satuan,
			$harga,
			$jumlah,
			$total,
			$tmt_pelaksanaan,
			$lama_pelaksanaan,
			$total_pelaksanaan,
			$jenis_rapat,
			$setuju,
			$no_surat,
			$sts_tambahan,
			$tanggal_input);

		// save_log($jenis, $kegiatan, $modul, $kegiatan2, $objek)
		$kegiatan2 = "dengan Kode Anggaran ".$kode_anggaran." dan NO SURAT ".$id_jenis_anggaran;
		$objek = $kode_anggaran." - ".$id_jenis_anggaran;
		$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada MENU', 'REALISASI ANGGARAN INPUT ANGGARAN TAMBAHAN', $kegiatan2, $objek);

		// $this->session->set_flashdata('sukses','1');
		// redirect('dashboard/realisasi_anggaran_c');

		echo '1';
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */