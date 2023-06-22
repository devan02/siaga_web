<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencana_realisasi_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('realisasi_anggaran_m','model');
	}

	function index(){
		$keyword = "";

		$data = array(
		  'page' 		=> "dashboard/rencana_realisasi_anggaran_v",
		  'induk_menu' 	=> "rencana_realisasi_anggaran",
		  'menu' 		=> "rencana_realisasi_anggaran",
		  'title' 		=> "RENCANA REALISASI ANGGARAN",
		  'departemen'	=> $this->dep_div->departemen(),
		  'dpbm'		=> $this->model->get_dpbm($keyword),
		  'rab'			=> $this->model->get_rab($keyword),
		  'url'			=> base_url().'dashboard/realisasi_anggaran_c/simpan_realisasi',
		  'url_del'		=> base_url().'dashboard/realisasi_anggaran_c/hapus_realisasi',
		  'keu_dpbm'	=> base_url().'dashboard/rencana_realisasi_anggaran_c/no_keu_dpbm',
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function data_dpbm(){
		$keyword = $this->input->get('keyword');
		$data = $this->model->get_rencana_realisasi_dpbm($keyword);
		echo json_encode($data);
	}

	function preview_data_dpbm(){
		$keyword = $this->input->get('keyword');
		$data = $this->model->preview_data_dpbm($keyword);
		echo json_encode($data);
	}

	function get_rab_spk(){
		$keyword = $this->input->get('keyword');
		$data = $this->model->get_rencana_realisasi_rab_spk($keyword);
		echo json_encode($data);
	}

	function preview_data_rab_spk(){
		$keyword = $this->input->get('keyword');
		$data = $this->model->preview_data_rab_spk($keyword);
		echo json_encode($data);
	}

	function add_leading_zero($value, $threshold = 2) {
	    return sprintf('%0' . $threshold . 's', $value); 
	}

	function data_spm(){
		$keyword = $this->input->get('keyword');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND NO_SPM LIKE '%$keyword%' OR KET LIKE '%$keyword%'";
		}
		$sql = "
			SELECT * FROM stp_input_spm 
			WHERE $where 
			AND (NO_KEU = '' OR NO_KEU IS NULL) 
			AND (STATUS = 0 OR STATUS IS NULL) 
			ORDER BY NO_KEU DESC
		";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function preview_data_spm(){
		$keyword = $this->input->get('keyword');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND SPM.NO_SPM LIKE '%$keyword%' OR SPM.KET LIKE '%$keyword%'";
		}

		$sql = "
			SELECT 
				SPM.ID AS ID_SPM,
				SPM.NO_SPM,
				SPM.NILAI,
				SPM.TGL_SPM,
				SPM.KET,
				SPM.NO_KEU,
				DASAR.KODE_ANGGARAN,
				SPM.TANGGAL_CAIR,
				(CASE
					WHEN STS_REVISI = 5 THEN
						'RKAP REVISI'
					ELSE
						'RKAP'
				END) AS PERIODE
			FROM stp_input_spm SPM
			LEFT JOIN(
				SELECT * FROM stp_realisasi_anggaran
			) REALISASI ON SPM.ID = REALISASI.ID_SPM
			LEFT JOIN stp_anggaran_dasar DASAR ON DASAR.ID_ANGGARAN = REALISASI.ID_ANGGARAN
			WHERE $where
			ORDER BY SPM.NO_KEU DESC
		";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function no_keu(){
		$id = 1;
		$sql = "SELECT NO_URUT FROM stp_no_urut_anggaran WHERE ID = $id";
		$data = $this->db->query($sql)->row();
		$no = $data->NO_URUT;

		echo json_encode($no);
	}

	function no_keu_dpbm(){
		$id = 1;
		$id_dpbm = $this->input->post('id_dpbm');
		$no_urut = $this->input->post('no_urut');
		$tgl_cair = date("d-m-Y");

		$sql_count = "SELECT COUNT(*) AS TOTAL FROM stp_no_urut_anggaran WHERE ID = $id";
		$total = $this->db->query($sql_count)->row()->TOTAL;

		if($total == 0){
			$no_urut = $this->add_leading_zero(1,3);
			$insert = "INSERT INTO stp_no_urut_anggaran(NO_URUT) VALUES('$no_urut')";
			$this->db->query($insert);

			$update_keu = "UPDATE stp_dpbm SET NO_KEU = '$no_urut', TANGGAL_CAIR = '$tgl_cair' WHERE ID = $value";
			$this->db->query($update_keu);
		}else{
			$no_urut = $this->add_leading_zero($no_urut,3);
			$update_keu = "UPDATE stp_dpbm SET NO_KEU = '$no_urut', TANGGAL_CAIR = '$tgl_cair' WHERE ID = $id_dpbm";
			$this->db->query($update_keu);

			$update = "UPDATE stp_no_urut_anggaran SET NO_URUT = $no_urut WHERE ID = $id";
			$this->db->query($update);
		}

		echo '1';
	}

	function no_keu_rab(){
		$id = 1;
		$id_rab_spk = $this->input->post('id_rab_spk');
		$no_urut = $this->input->post('no_urut');
		$tgl_cair = date("d-m-Y");

		$sql_count = "SELECT COUNT(*) AS TOTAL FROM stp_no_urut_anggaran WHERE ID = $id";
		$total = $this->db->query($sql_count)->row()->TOTAL;
		
		if($total == 0){
			$no_urut = $this->add_leading_zero(1,3);
			$insert = "INSERT INTO stp_no_urut_anggaran(NO_URUT) VALUES('$no_urut')";
			$this->db->query($insert);

			$update_keu = "UPDATE stp_rincian_anggaran_biaya SET NO_KEU = '$no_urut', TANGGAL_CAIR = '$tgl_cair' WHERE ID = $id_rab_spk";
			$this->db->query($update_keu);
		}else{
			$no_urut = $this->add_leading_zero($no_urut,3);
			$update = "UPDATE stp_no_urut_anggaran SET NO_URUT = $no_urut WHERE ID = $id";
			$this->db->query($update);

			$update_keu = "UPDATE stp_rincian_anggaran_biaya SET NO_KEU = '$no_urut', TANGGAL_CAIR = '$tgl_cair' WHERE ID = $id_rab_spk";
			$this->db->query($update_keu);
		}

		echo '1';
	}

	function no_keu_spm(){
		$id = 1;
		$id_spm = $this->input->post('id_spm');
		$no_urut = $this->input->post('no_urut');
		$tgl_cair = date("d-m-Y");

		$sql_count = "SELECT COUNT(*) AS TOTAL FROM stp_no_urut_anggaran WHERE ID = $id";
		$total = $this->db->query($sql_count)->row()->TOTAL;

		if($total == 0){
			$no_urut = $this->add_leading_zero(1,3);
			$insert = "INSERT INTO stp_no_urut_anggaran(NO_URUT) VALUES('$no_urut')";
			$this->db->query($insert);

			$update_keu = "UPDATE stp_input_spm SET NO_KEU = '$no_urut', TANGGAL_CAIR = '$tgl_cair' WHERE ID = $id_spm";
			$this->db->query($update_keu);
		}else{
			$no_urut = $this->add_leading_zero($no_urut,3);
			$update = "UPDATE stp_no_urut_anggaran SET NO_URUT = $no_urut WHERE ID = $id";
			$this->db->query($update);

			$update_keu = "UPDATE stp_input_spm SET NO_KEU = '$no_urut', TANGGAL_CAIR = '$tgl_cair' WHERE ID = $id_spm";
			$this->db->query($update_keu);
		}

		echo '1';
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */