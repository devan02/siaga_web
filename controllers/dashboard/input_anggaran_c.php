<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('kode_anggaran_m','kode');
		$this->load->model('input_anggaran_m','model');
		$this->load->model('kode_perkiraan_m','koper');
		
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id']; 
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$sessi = $this->session->userdata('masuk_bos');
		if($sessi){
			$username = $sessi['username'];
			$id_dep = $sessi['id_departemen'];
			$id_div = $sessi['id_divisi'];
			$ctrl = $this->uri->segment(2);
			$kunci = "";
			$ket = "";

			$disable = "";
			$disable2 = "";
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

			//CEK KUNCI
			$sql_peg = "SELECT * FROM stp_pegawai WHERE USERNAME = '$username'";
			$peg_det = $this->db->query($sql_peg)->row();
			$id_dep = $peg_det->ID_DEPARTEMEN;
			$id_div = $peg_det->ID_DIVISI;
			$thn_now = date('Y');
			$sts = 0;
			$kunci = "terkunci";
			$sql_kunci = $this->db->query("SELECT * FROM stp_kunci_anggaran WHERE DEPARTEMEN = $id_dep AND DIVISI = 0 AND TAHUN = $thn_now AND NAMA_MENU_KUNCI = 'input_anggaran_c'")->result();

			if(count($sql_kunci) == 0){
				$sql_kunci = $this->db->query("SELECT * FROM stp_kunci_anggaran WHERE DEPARTEMEN = $id_dep AND DIVISI = $id_div AND TAHUN = $thn_now AND NAMA_MENU_KUNCI = 'input_anggaran_c'")->result();
				$sts = 1;
			}

			if(count($sql_kunci) > 0){
				if($sts == 0){
				$sql_kunci = $this->db->query("SELECT * FROM stp_kunci_anggaran WHERE DEPARTEMEN = $id_dep AND DIVISI = 0 AND TAHUN = $thn_now AND NAMA_MENU_KUNCI = 'input_anggaran_c' ORDER BY ID DESC")->row();
				$tgl_akhir = $sql_kunci->TGL_AKHIR;
				} else {
				$sql_kunci = $this->db->query("SELECT * FROM stp_kunci_anggaran WHERE DEPARTEMEN = $id_dep AND DIVISI = $id_div AND TAHUN = $thn_now AND NAMA_MENU_KUNCI = 'input_anggaran_c' ORDER BY ID DESC")->row();
				$tgl_akhir = $sql_kunci->TGL_AKHIR;
				}
				
				$tgl_akhir      = date('Y-m-d', strtotime($tgl_akhir));
				$tgl_akhir_now  = date('Y-m-d');

				$pecah1 = explode("-", $tgl_akhir);
			    $date1 = $pecah1[2];
			    $month1 = $pecah1[1];
			    $year1 = $pecah1[0];

			    $pecah2 = explode("-", $tgl_akhir_now);
			    $date2 = $pecah2[2];
			    $month2 = $pecah2[1];
			    $year2 =  $pecah2[0];


			    $jd1 = GregorianToJD($month1, $date1, $year1);
			    $jd2 = GregorianToJD($month2, $date2, $year2);
			    $selisih = $jd2 - $jd1;

			    if($selisih <= 0){
			    	$kunci = "terbuka";
			    } else {
			    	$kunci = "terkunci";
			    }

			} else {
				$kunci = "terkunci";
			}

			// END OF KUNCI

			//KONDISI GAWE ADMIN

			if($peg_det->LEVEL == "ADMIN"){
				$kunci = "terbuka";
			}
			
			$key = "";
			$data = array(
				  'page' 		=> "dashboard/input_anggaran_v",
				  'induk_menu'	=> "rencana_anggaran",
				  'menu' 		=> "input_anggaran",
				  'title' 		=> "INPUT ANGGARAN",
				  'url'			=> base_url().'dashboard/input_anggaran_c/simpan_ag',
				  'url_del'		=> base_url().'dashboard/input_anggaran_c/hapus_anggaran',
				  'departemen'	=> $this->dep_div->departemen(),
				  'sumber_dana' => $this->kode->sumber_dana(),
				  'koper'		=> $this->koper->get_koper_all($key),
				  'kunci'		=> $kunci,
				  'ket'			=> $ket,
				  'disable'		=> $disable,
				  'disable2'	=> $disable2,
			);
			$this->load->view('dashboard/beranda_v', $data);
		}else{
			redirect('login');
		}
	}

	function divisi(){
		$id_departemen = $this->input->post('id_departemen');
		$data = $this->dep_div->divisi($id_departemen);
		echo json_encode($data);
	}

	function get_kode_anggaran(){
		$departemen = $this->input->post('departemen');
		$divisi = $this->input->post('divisi');
		$tahun = $this->input->post('tahun');

		$sql_nama_dep = "SELECT NAMA FROM stp_departemen WHERE ID = $departemen";
		$nama_dep = $this->db->query($sql_nama_dep)->row()->NAMA;

		$kode = $this->kode->kode_anggaran($nama_dep,$tahun);
		echo json_encode($kode);
	}

	function simpan_ag(){
		$kategori = $this->input->post('kategori');

		if($kategori == "baru"){
			$kode_perkiraan = $this->input->post('kelompok_perkiraan');
			$kode_anggaran = $this->input->post('kode_anggaran');
			$tahun = $this->input->post('tahun');
			
			$departemen = "";
			$divisi = "";
			$sessi = $this->session->userdata('masuk_bos');
			$id_pegawai = $sessi['id'];
			$sql_pegawai = "SELECT LEVEL FROM stp_pegawai WHERE ID = $id_pegawai";
			$q_pegawai = $this->db->query($sql_pegawai)->row();
			$level = $q_pegawai->LEVEL;
			if($level == "KABAG"){
				$sql_bag = "
					SELECT 
						PEGAWAI.*,
						BAGIAN.ID AS ID_BAGIAN,
						SUB_BAGIAN.ID AS ID_SUB_BAGIAN 
					FROM stp_pegawai PEGAWAI
					LEFT JOIN stp_departemen BAGIAN ON BAGIAN.ID = PEGAWAI.ID_DEPARTEMEN
					LEFT JOIN stp_divisi SUB_BAGIAN ON SUB_BAGIAN.ID_DEPARTEMEN = BAGIAN.ID
					WHERE PEGAWAI.ID = '$id_pegawai'
				";
				$q_bag = $this->db->query($sql_bag)->row();
				$departemen = $q_bag->ID_BAGIAN;
				$divisi = $this->input->post('divisi');
			}else if($level == "ADMIN"){
				$departemen = $this->input->post('departemen');
				$divisi = $this->input->post('divisi');
			}else if($level == null){
				$sql_bag = "
					SELECT 
						PEGAWAI.*,
						BAGIAN.ID AS ID_BAGIAN,
						SUB_BAGIAN.ID AS ID_SUB_BAGIAN 
					FROM stp_pegawai PEGAWAI
					LEFT JOIN stp_departemen BAGIAN ON BAGIAN.ID = PEGAWAI.ID_DEPARTEMEN
					LEFT JOIN stp_divisi SUB_BAGIAN ON SUB_BAGIAN.ID_DEPARTEMEN = BAGIAN.ID
					WHERE PEGAWAI.ID = '$id_pegawai'
				";
				$q_bag = $this->db->query($sql_bag)->row();
				$departemen = $q_bag->ID_BAGIAN;
				$divisi = $q_bag->ID_SUB_BAGIAN;
			}
			
			$jenis_anggaran = $this->input->post('jenis_anggaran');
			$id_jenis_anggaran = $this->input->post('id_jenis_anggaran');
			$uraian = addslashes($this->input->post('uraian'));
			$sumber_dana = addslashes($this->input->post('sumber_dana'));
			$lokasi = addslashes($this->input->post('lokasi'));
			$satuan = addslashes($this->input->post('satuan'));
			$harga = str_replace(',', '',$this->input->post('harga_satuan'));
			$jumlah = $this->input->post('volume');
			$total = "";
			$tmt_pelaksanaan = "";
			$lama_pelaksanaan = "";
			$total_pelaksanaan = "";
			$jenis_rapat = "RKAP";
			$setuju = "DISETUJUI";
			$sts_tambahan = 1;
			$januari = str_replace(',', '', $this->input->post('januari'));
			$februari = str_replace(',', '', $this->input->post('februari'));
			$maret = str_replace(',', '', $this->input->post('maret'));
			$april = str_replace(',', '', $this->input->post('april'));
			$mei = str_replace(',', '', $this->input->post('mei'));
			$juni = str_replace(',', '', $this->input->post('juni'));
			$juli = str_replace(',', '', $this->input->post('juli'));
			$agustus = str_replace(',', '', $this->input->post('agustus'));
			$september = str_replace(',', '', $this->input->post('september'));
			$oktober = str_replace(',', '', $this->input->post('oktober'));
			$november = str_replace(',', '', $this->input->post('november'));
			$desember = str_replace(',', '', $this->input->post('desember'));
			$tanggal_input = date('d-m-Y');

			$januari 			= ($januari == null || $januari == '') ? 0 : $januari ; 
			$februari 			= ($februari == null || $februari == '') ? 0 : $februari ;
			$maret 				= ($maret == null || $maret == '') ? 0 : $maret ;
			$april  			= ($april == null || $april == '') ? 0 : $april ;
			$mei 	 			= ($mei == null || $mei == '') ? 0 : $mei ;
			$juni 				= ($juni == null || $juni == '') ? 0 : $juni ;
			$juli 	 			= ($juli == null || $juli == '') ? 0 : $juli ;
			$agustus  			= ($agustus == null || $agustus == '') ? 0 : $agustus ;
			$september 			= ($september == null || $september == '') ? 0 : $september ;
			$oktober 			= ($oktober == null || $oktober == '') ? 0 : $oktober ;
			$november 			= ($november == null || $november == '') ? 0 : $november ;
			$desember			= ($desember == null || $desember == '') ? 0 : $desember ;

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
			
			$this->model->simpan_anggaran(
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
				$sts_tambahan,
				$januari,
				$februari,
				$maret,
				$april,
				$mei,
				$juni,
				$juli,
				$agustus,
				$september,
				$oktober,
				$november,
				$desember,
				$tanggal_input);
		}else{
			$kode_anggaran = $this->input->post('kode_anggaran_ubah');
			$kode_perkiraan = $this->input->post('kelompok_perkiraan_ubah');
			$jenis_anggaran = $this->input->post('jenis_anggaran');
			$id_jenis_anggaran = "";
			$total = "";
			$tmt_pelaksanaan = "";
			$lama_pelaksanaan = "";
			$total_pelaksanaan = "";
			if($jenis_anggaran == "Barang"){
				$id_jenis_anggaran = $this->input->post('id_jenis_anggaran');
				$total = str_replace(',', '', $this->input->post('total'));
				$tmt_pelaksanaan = "";
				$lama_pelaksanaan = 0;
				$total_pelaksanaan = 0;
			}else{
				$id_jenis_anggaran = "";
				$total = 0;
				$tmt_pelaksanaan = $this->input->post('tmt_pelaksanaan');
				$lama_pelaksanaan = $this->input->post('lama_pelaksanaan');
				$total_pelaksanaan = str_replace(',', '', $this->input->post('total'));
			}
			$uraian = addslashes($this->input->post('uraian'));
			$sumber_dana = addslashes($this->input->post('sumber_dana'));
			$lokasi = addslashes($this->input->post('lokasi'));
			$satuan = $this->input->post('satuan');
			$harga = str_replace(',', '', $this->input->post('harga_satuan'));
			$jumlah = $this->input->post('volume');
			
			
			$januari = str_replace(',', '', $this->input->post('januari'));
			$februari = str_replace(',', '', $this->input->post('februari'));
			$maret = str_replace(',', '', $this->input->post('maret'));
			$april = str_replace(',', '', $this->input->post('april'));
			$mei = str_replace(',', '', $this->input->post('mei'));
			$juni = str_replace(',', '', $this->input->post('juni'));
			$juli = str_replace(',', '', $this->input->post('juli'));
			$agustus = str_replace(',', '', $this->input->post('agustus'));
			$september = str_replace(',', '', $this->input->post('september'));
			$oktober = str_replace(',', '', $this->input->post('oktober'));
			$november = str_replace(',', '', $this->input->post('november'));
			$desember = str_replace(',', '', $this->input->post('desember'));

			$this->model->ubah_anggaran(
				$kode_anggaran,
				$kode_perkiraan,
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
				$januari,
				$februari,
				$maret,
				$april,
				$mei,
				$juni,
				$juli,
				$agustus,
				$september,
				$oktober,
				$november,
				$desember);
		}
		
		$this->session->set_flashdata('status','1');
		redirect('dashboard/input_anggaran_c');

	}

	function get_anggaran_by_id(){
		$kode_anggaran = $this->input->post('kode_anggaran');
		$data = $this->model->get_anggaran_id($kode_anggaran);
		echo json_encode($data);
	}

	function hapus_anggaran(){
		$id_anggaran = $this->input->post('id_hapus');
		$this->model->hapus_anggaran($id_anggaran);
		$this->session->set_flashdata('hapus','1');
		redirect('dashboard/input_anggaran_c');
	}

	function get_barang(){
		$keyword = $this->input->get('keyword');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (KODE_BARANG LIKE '%$keyword%' OR NAMA_BARANG LIKE '%$keyword%')";
		}
		$sql = "SELECT * FROM stp_kode_barang WHERE $where LIMIT 10";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function get_barang_id(){
		$id_barang = $this->input->post('id_barang');
		$sql = "SELECT * FROM stp_kode_barang WHERE ID = $id_barang";
		$data = $this->db->query($sql)->row();
		echo json_encode($data);
	}

	function update_harga_satuan(){
		$id_barang = $this->input->post('id_barang');
		$harga_barang = str_replace(',', '', $this->input->post('harga_satuan'));
		$sql = "UPDATE stp_kode_barang SET HARGA_BARANG = '$harga_barang' WHERE ID = '$id_barang'";
		$this->db->query($sql);
		echo '1';
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */