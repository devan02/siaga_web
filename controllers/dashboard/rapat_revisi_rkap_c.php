<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rapat_revisi_rkap_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('rapat_revisi_rkap_m','model');

		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index(){
		$sessi = $this->session->userdata('masuk_bos');
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

		$data = array(
		  'page' => "dashboard/rapat_revisi_rkap_v",
		  'induk_menu' => "revisi_anggaran",
		  'menu' => "rapat_revisi_anggaran",
		  'title' => "RAPAT REVISI RENCANA KEGIATAN ANGGARAN PERUSAHAAN (RKAP)",
		  'departemen'	=> $this->dep_div->departemen(),
		  'url' => base_url().'dashboard/rapat_revisi_rkap_c/simpan_revisi_rkap', 
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
			$where = $where." AND (a.KODE_PERKIRAAN LIKE '%$keyword%' OR a.NAMA_PERKIRAAN LIKE '%$keyword%')";
		}
		$sql = "
			SELECT a.*,b.ID,b.NAMA_PERKIRAAN, CHILD.INDUK_KODE, bb.NAMA_PERKIRAAN AS NAMA_PERKIRAAN2
			FROM
			(
				SELECT trim(a.KODE_PERKIRAAN) KODE_PERKIRAAN, trim(a.KODE_PERKIRAAN2) KODE_PERKIRAAN2   FROM stp_revisi_anggaran a
				WHERE $where
				AND a.TAHUN = '$tahun'
				group by trim(a.KODE_PERKIRAAN), trim(a.KODE_PERKIRAAN2)
			)a
			JOIN stp_setup_kode_perkiraan b ON trim(b.KODE_PERKIRAAN) = trim(a.KODE_PERKIRAAN)

			LEFT JOIN stp_koper_child_vw CHILD 
            ON TRIM(CHILD.KODE_PERKIRAAN) = TRIM(a.KODE_PERKIRAAN)

            LEFT JOIN stp_setup_kode_perkiraan bb ON trim(CHILD.INDUK_KODE) = trim(bb.KODE_PERKIRAAN)

			ORDER BY CHILD.INDUK_KODE, a.KODE_PERKIRAAN ASC
		";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function get_data_revisi_anggaran(){
		$keyword = $this->input->post('keyword');
		$bagian = $this->input->post('bagian');
		$sub_bagian = $this->input->post('sub_bagian');
		$tahun = $this->input->post('tahun');
		$kriteria = $this->input->post('kriteria');
		$kode_perkiraan = $this->input->post('kode_perkiraan');
		$data = $this->model->get_data($keyword,$bagian,$sub_bagian,$tahun,$kriteria,$kode_perkiraan);
		echo json_encode($data);
	}

	function get_data_anggaran_id(){
		$id_anggaran = $this->input->post('id_anggaran');
		$periode = $this->input->post('periode');
		$sql = "SELECT ID_ANGGARAN,RAPAT_KE FROM stp_usulan_anggaran WHERE ID_ANGGARAN = $id_anggaran";
		$query = $this->db->query($sql);
		$data['rapat'] = $query->row();
		$data['data'] = $this->model->get_data_by_id($id_anggaran,$periode);
		echo json_encode($data);
	}

	function simpan_revisi_rkap(){
		$id_anggaran = $this->input->post('id_anggaran');
        $kode_perkiraan = $this->input->post('rapat_koper');
        $kode_perkiraan2 = $this->input->post('rapat_kode_perkiraan2');
        $kode_anggaran = $this->input->post('rapat_koang');
        $uraian = $this->input->post('rapat_uraian');
        $tahun = $this->input->post('rapat_tahun');
        $departemen = $this->input->post('rapat_id_bagian');
        $divisi = $this->input->post('rapat_id_sub_bagian');
        $jenis_anggaran = $this->input->post('rapat_jenis_anggaran');
        $id_jenis_anggaran = "";
        // $total_rkap = 0;
        $total_revisi = 0;
        $tmt_pelaksanaan = "";
        $lama_pelaksanaan = 0;
        $total_pelaksanaan = 0;
        if($jenis_anggaran == "Barang"){
        	$id_jenis_anggaran = $this->input->post('rapat_id_jenis_anggaran');
        	// $total_rkap = str_replace(',', '', $this->input->post('rapat_biaya_rkap'));
        	$total_revisi = str_replace(',', '', $this->input->post('rapat_biaya_revisi'));
        	$tmt_pelaksanaan = "";
        	$lama_pelaksanaan = 0;
        	$total_pelaksanaan = 0;
        }else{
        	$id_jenis_anggaran = "";
        	// $total_rkap = 0;
        	$total_revisi = 0;
        	$tmt_pelaksanaan = $this->input->post('rapat_tmt_pelaksanaan');
	        $lama_pelaksanaan = $this->input->post('rapat_lama_pelaksanaan');
	        $total_pelaksanaan = str_replace(',', '', $this->input->post('rapat_biaya_revisi'));
        }
        $satuan = $this->input->post('rapat_satuan');
        $volume_rkap = $this->input->post('rapat_vol_rkap');
        $harga_rkap = str_replace(',', '', $this->input->post('rapat_harga_rkap'));
        $jenis_rapat = "REVISI-RKAP";
        $setuju = $this->input->post('setuju');
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
        $vol_revisi_lama = $this->input->post('vol_revisi_lama');
        $harga_revisi_lama = str_replace(',', '', $this->input->post('harga_revisi_lama'));
        $biaya_revisi_lama = str_replace(',', '', $this->input->post('biaya_revisi_lama'));

        $tanggal = date("d-m-Y");
        $jumlah_revisi = $this->input->post('rapat_vol_revisi');
        $harga_revisi = str_replace(',', '', $this->input->post('rapat_harga_revisi'));
        // $total_revisi = str_replace(',', '', $this->input->post('rapat_biaya_revisi'));

        $sql_cek = "SELECT COUNT(*) AS TOTAL FROM stp_usulan_anggaran WHERE ID_ANGGARAN = '$id_anggaran'";
        $query_cek = $this->db->query($sql_cek)->row();
        $count = $query_cek->TOTAL;

        if($count == 0){
        	//data lama ke usulan anggaran dan ubah data di revisi
        	$this->model->simpan_usulan(
		        $id_anggaran,
		        $kode_perkiraan,
		        $kode_perkiraan2,
		        $kode_anggaran,
		        $uraian,
		        $tahun,
		        $departemen,
		        $divisi,
		        $jenis_anggaran,
		        $id_jenis_anggaran,
		        $satuan,
		        $harga_rkap,
		        $volume_rkap,
		        $biaya_revisi_lama,
		        $tmt_pelaksanaan,
		        $lama_pelaksanaan,
		        $total_pelaksanaan,
		        $jenis_rapat,
		        $setuju,
		        $rapat_ke,
		        $januari_lama,
		        $februari_lama,
		        $maret_lama,
		        $april_lama,
		        $mei_lama,
		        $juni_lama,
		        $juli_lama,
		        $agustus_lama,
		        $september_lama,
		        $oktober_lama,
		        $november_lama,
		        $desember_lama,
		        $tanggal);
        	
        	$this->model->update_revisi_anggaran(
		        $id_anggaran,
		        $jenis_anggaran,
		        $jumlah_revisi,
		        $harga_revisi,
		        $total_revisi,
		        $januari,$februari,$maret,$april,$mei,$juni,$juli,$agustus,$september,$oktober,$november,$desember);

        }else{

        	$this->model->simpan_usulan(
		        $id_anggaran,
		        $kode_perkiraan,
		        $kode_perkiraan2,
		        $kode_anggaran,
		        $uraian,
		        $tahun,
		        $departemen,
		        $divisi,
		        $jenis_anggaran,
		        $id_jenis_anggaran,
		        $satuan,
		        $harga_rkap,
		        $volume_rkap,
		        $biaya_revisi_lama,
		        $tmt_pelaksanaan,
		        $lama_pelaksanaan,
		        $total_pelaksanaan,
		        $jenis_rapat,
		        $setuju,
		        $rapat_ke,
		        $januari_lama,
		        $februari_lama,
		        $maret_lama,
		        $april_lama,
		        $mei_lama,
		        $juni_lama,
		        $juli_lama,
		        $agustus_lama,
		        $september_lama,
		        $oktober_lama,
		        $november_lama,
		        $desember_lama,
		        $tanggal);

        	$sql_update = "UPDATE stp_usulan_anggaran SET AKTIF = 0 WHERE ID_ANGGARAN = '$id_anggaran' AND RAPAT_KE = '$rapat_ke_txt'";
        	$this->db->query($sql_update);

        	$this->model->update_revisi_anggaran(
		        $id_anggaran,
		        $jenis_anggaran,
		        $jumlah_revisi,
		        $harga_revisi,
		        $total_revisi,
		        $januari,$februari,$maret,$april,$mei,$juni,$juli,$agustus,$september,$oktober,$november,$desember);
        }

        // save_log($jenis, $kegiatan, $modul, $kegiatan2, $objek)
		$kegiatan2 = "dengan Kode Anggaran ".$kode_anggaran;
		$objek = $kode_anggaran;
		$this->master_model_m->save_log('Simpan', 'Melakukan simpan data pada MENU', 'RAPAT REVISI RKAP', $kegiatan2, $objek);

        // $this->session->set_flashdata('sukses','1');
        // redirect('dashboard/rapat_revisi_rkap_c');
		echo '1';
	}

	function update_setuju(){
		$id_anggaran = $this->input->post('id_anggaran');
		$setuju = $this->input->post('setuju');
		$periode = $this->input->post('periode');
		$sql = "";
		if($periode == "1"){
			$sql = "UPDATE stp_anggaran_dasar SET SETUJU = '$setuju' WHERE ID_ANGGARAN = '$id_anggaran'";
		}else{
			$sql = "UPDATE stp_revisi_anggaran SET SETUJU = '$setuju' WHERE ID = '$id_anggaran'";
		}
		$this->db->query($sql);
		echo '1';
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */