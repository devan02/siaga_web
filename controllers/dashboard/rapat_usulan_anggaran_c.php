<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rapat_usulan_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('rapat_usulan_anggaran_m','model');
		$this->load->model('kode_perkiraan_m','koper');

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
		  'page' => "dashboard/rapat_usulan_anggaran_v",
		  'induk_menu' => "rencana_anggaran",
		  'menu' => "rapat_usulan_anggaran",
		  'title' => "RAPAT USULAN ANGGARAN",
		  'departemen'	=> $this->dep_div->departemen(),
		  'koper'		=> $this->koper->get_koper_all($key),
		  'url' 		=> base_url().'dashboard/rapat_usulan_anggaran_c/simpan_usulan',
		  'disable'		=> $disable,
		  'disable2'	=> $disable2,
		  'get_data_notif' => $this->model->get_data_notif(),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function get_kode_perkiraan(){
		$keyword = $this->input->get('keyword');
		$tahun = $this->input->get('tahun');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (a.KODE_PERKIRAAN LIKE '%$keyword%' OR b.NAMA_PERKIRAAN LIKE '%$keyword%')";
		}
		$sql = "
			SELECT 
				a.*,
				b.ID,
				b.NAMA_PERKIRAAN, 
				CHILD.INDUK_KODE, 
				bb.NAMA_PERKIRAAN AS NAMA_PERKIRAAN2
			FROM(
				SELECT trim(a.KODE_PERKIRAAN) KODE_PERKIRAAN, trim(a.KODE_PERKIRAAN2) KODE_PERKIRAAN2 FROM stp_anggaran_dasar a
				WHERE a.TAHUN = '$tahun'
				group by trim(a.KODE_PERKIRAAN), trim(a.KODE_PERKIRAAN2)
			) a
			JOIN stp_setup_kode_perkiraan b ON trim(b.KODE_PERKIRAAN) = trim(a.KODE_PERKIRAAN)
			LEFT JOIN stp_koper_child_vw CHILD 
            ON TRIM(CHILD.KODE_PERKIRAAN) = TRIM(a.KODE_PERKIRAAN)
            LEFT JOIN stp_setup_kode_perkiraan bb ON trim(CHILD.INDUK_KODE) = trim(bb.KODE_PERKIRAAN)
            WHERE $where
			ORDER BY CHILD.INDUK_KODE, a.KODE_PERKIRAAN ASC
		";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function get_data_anggaran(){
		$keyword = $this->input->post('keyword');
		$bagian = $this->input->post('bagian');
		$sub_bagian = $this->input->post('sub_bagian');
		$tahun = $this->input->post('tahun');
		$kriteria = $this->input->post('kriteria');
		$kode_perkiraan = $this->input->post('kode_perkiraan');
		$data = $this->model->get_data($keyword,$bagian,$sub_bagian,$tahun,$kriteria,$kode_perkiraan);
		echo json_encode($data);
	}

	function get_data_notif(){
		$data = $this->model->get_data_notif();
		echo json_encode($data);
	}

	function get_data_anggaran_id(){
		$id_anggaran = $this->input->post('id_anggaran');
		$data['data'] = $this->model->get_data_by_id($id_anggaran);
		echo json_encode($data);
	}

	function simpan_usulan(){
		$id_anggaran = $this->input->post('id_anggaran');
		$id_usulan = $this->input->post('id_usulan');
        $kode_perkiraan = $this->input->post('rapat_koper');
        $kode_perkiraan2 = $this->input->post('rapat_kode_perkiraan2');
        $kode_anggaran = $this->input->post('rapat_koang');
        $uraian = $this->input->post('rapat_uraian');
        $tahun = $this->input->post('rapat_tahun');
        $departemen = $this->input->post('rapat_id_bagian');
        $divisi = $this->input->post('rapat_id_sub_bagian');
        $jenis_anggaran = $this->input->post('rapat_jenis_anggaran');
        $id_jenis_anggaran = "";
        $total_usulan = 0;
        $tmt_pelaksanaan = "";
        $lama_pelaksanaan = 0;
        $total_pelaksanaan = 0;
        if($jenis_anggaran == "Barang"){
        	$id_jenis_anggaran = $this->input->post('rapat_id_jenis_anggaran');
        	$total_usulan = str_replace(',', '', $this->input->post('rapat_biaya_usulan'));
        	$tmt_pelaksanaan = "";
        	$lama_pelaksanaan = 0;
        	$total_pelaksanaan = 0;
        }else{
        	$id_jenis_anggaran = "";
        	$total_usulan = 0;
        	$tmt_pelaksanaan = $this->input->post('rapat_tmt_pelaksanaan');
	        $lama_pelaksanaan = $this->input->post('rapat_lama_pelaksanaan');
	        $total_pelaksanaan = str_replace(',', '', $this->input->post('rapat_total_pelaksanaan'));
        }
        $satuan = $this->input->post('rapat_satuan');
        $harga_usulan = str_replace(',', '', $this->input->post('rapat_harga_usulan'));
        $jumlah_usulan = $this->input->post('rapat_vol_usulan');
        $jenis_rapat = $this->input->post('rapat_jenis_rapat');
        $setuju = $this->input->post('rapat_setuju');
        $rapat_ke = $this->input->post('rapat_ke');
        $rapat_ke_txt = $this->input->post('rapat_ke_txt');
        
        $januari = str_replace(',', '', $this->input->post('rapat_januari'));
        $februari = str_replace(',', '', $this->input->post('rapat_februari'));
        $maret = str_replace(',', '', $this->input->post('rapat_maret'));
        $april = str_replace(',', '', $this->input->post('rapat_april'));
        $mei = str_replace(',', '', $this->input->post('rapat_mei'));
        $juni = str_replace(',', '', $this->input->post('rapat_juni'));
        $juli = str_replace(',', '', $this->input->post('rapat_juli'));
        $agustus = str_replace(',', '', $this->input->post('rapat_agustus'));
        $september = str_replace(',', '', $this->input->post('rapat_september'));
        $oktober = str_replace(',', '', $this->input->post('rapat_oktober'));
        $november = str_replace(',', '', $this->input->post('rapat_november'));
        $desember = str_replace(',', '', $this->input->post('rapat_desember'));
        $tanggal = date("d-m-Y");

        $januari_lama = str_replace(',', '', $this->input->post('januari_lama'));
        $februari_lama = str_replace(',', '', $this->input->post('februari_lama'));
        $maret_lama = str_replace(',', '', $this->input->post('maret_lama'));
        $april_lama = str_replace(',', '', $this->input->post('april_lama'));
        $mei_lama = str_replace(',', '', $this->input->post('mei_lama'));
        $juni_lama = str_replace(',', '', $this->input->post('juni_lama'));
        $juli_lama = str_replace(',', '', $this->input->post('juli_lama'));
        $agustus_lama = str_replace(',', '', $this->input->post('agustus_lama'));
        $september_lama = str_replace(',', '', $this->input->post('september_lama'));
        $oktober_lama = str_replace(',', '', $this->input->post('oktober_lama'));
        $november_lama = str_replace(',', '', $this->input->post('november_lama'));
        $desember_lama = str_replace(',', '', $this->input->post('desember_lama'));

        $volume_rkap = $this->input->post('rapat_vol_rkap');
        $harga_rkap = str_replace(',', '', $this->input->post('rapat_harga_rkap'));
        $biaya_rkap = str_replace(',', '', $this->input->post('rapat_biaya_rkap'));

        $sql_cek = "
        	SELECT 
        		COUNT(*) AS TOTAL 
        	FROM stp_usulan_anggaran 
        	WHERE ID_ANGGARAN = $id_anggaran 
        	AND TAHUN = '$tahun'
        	AND RAPAT_KE = '$rapat_ke_txt'
        ";
        $query_cek = $this->db->query($sql_cek)->row();
        $count = $query_cek->TOTAL;
        
        $sql_dasar = "SELECT * FROM stp_anggaran_dasar WHERE ID_ANGGARAN = '$id_anggaran'";
        $query_dasar = $this->db->query($sql_dasar)->row();

    	//data lama masuk usulan anggaran
    	$this->model->simpan_usulan(
	        $query_dasar->ID_ANGGARAN,
	        $query_dasar->KODE_PERKIRAAN,
	        $query_dasar->KODE_PERKIRAAN2,
	        $query_dasar->KODE_ANGGARAN,
	        $query_dasar->URAIAN,
	        $query_dasar->TAHUN,
	        $query_dasar->DEPARTEMEN,
	        $query_dasar->DIVISI,
	        $query_dasar->JENIS_ANGGARAN,
	        $query_dasar->ID_JENIS_ANGGARAN,
	        $query_dasar->SATUAN,
	        $query_dasar->HARGA,
	        $query_dasar->JUMLAH,
	        $query_dasar->TOTAL,
	        $query_dasar->TMT_PELAKSANAAN,
	        $query_dasar->LAMA_PELAKSANAAN,
	        $query_dasar->TOTAL_PELAKSANAAN,
	        $query_dasar->JENIS_RAPAT,
	        $query_dasar->SETUJU,
	        $rapat_ke,
	        $query_dasar->JANUARI,
	        $query_dasar->FEBRUARI,
	        $query_dasar->MARET,
	        $query_dasar->APRIL,
	        $query_dasar->MEI,
	        $query_dasar->JUNI,
	        $query_dasar->JULI,
	        $query_dasar->AGUSTUS,
	        $query_dasar->SEPTEMBER,
	        $query_dasar->OKTOBER,
	        $query_dasar->NOVEMBER,
	        $query_dasar->DESEMBER,
	        $tanggal);

    	$this->model->update_anggaran_dasar_rkap(
	        $id_anggaran,
	        $jenis_anggaran,
	        $volume_rkap,
	        $harga_rkap,
	        $biaya_rkap,
	        $januari,$februari,$maret,$april,$mei,$juni,$juli,$agustus,$september,$oktober,$november,$desember);

        if($count != 0){
        	$sql_update = "
        		UPDATE stp_usulan_anggaran SET 
        		AKTIF = 0 
        		WHERE ID = '$id_usulan' 
        		AND RAPAT_KE = '$rapat_ke_txt'
        	";
        	$this->db->query($sql_update);
        }

        // $this->session->set_flashdata('sukses','1');
        // redirect('dashboard/rapat_usulan_anggaran_c');
        echo '1';
	}

	function update_setuju(){
		$id_anggaran = $this->input->post('id_anggaran');
		$setuju = $this->input->post('setuju');
		$sql = "UPDATE stp_anggaran_dasar SET SETUJU = '$setuju' WHERE ID_ANGGARAN = '$id_anggaran'";
		$this->db->query($sql);
		echo '1';
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */