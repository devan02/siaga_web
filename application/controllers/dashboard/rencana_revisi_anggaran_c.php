<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencana_revisi_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('realisasi_anggaran_m','model');

		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index(){
		$data = array(
		  'page' 		=> "dashboard/rencana_revisi_anggaran_v",
		  'induk_menu' 	=> "rencana_revisi_anggaran",
		  'menu' 		=> "rencana_revisi_anggaran",
		  'title' 		=> "RENCANA REVISI REALISASI ANGGARAN",
		  'departemen'	=> $this->dep_div->departemen(),
		  'dpbm'		=> $this->model->get_dpbm(),
		  'rab'			=> $this->model->get_rab(),
		  'url'			=> base_url().'dashboard/realisasi_anggaran_c/simpan_realisasi',
		  'url_del'		=> base_url().'dashboard/realisasi_anggaran_c/hapus_realisasi',
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function data_dpbm(){
		$data = $this->model->get_rencana_realisasi_dpbm();
		echo json_encode($data);
	}

	function preview_data_dpbm(){
		$data = $this->model->preview_data_dpbm();
		echo json_encode($data);
	}

	function get_rab_spk(){
		$data = $this->model->get_rencana_realisasi_rab_spk();
		echo json_encode($data);
	}

	function preview_data_rab_spk(){
		$data = $this->model->preview_data_rab_spk();
		echo json_encode($data);
	}

	function add_leading_zero($value, $threshold = 2) {
	    return sprintf('%0' . $threshold . 's', $value);
	}

	function get_no_urut_anggaran(){
		$id = $this->input->post('id');
		$id_dpbm = $this->input->post('id_dpbm');
		$sql_count = "SELECT COUNT(*) AS TOTAL FROM stp_no_urut_anggaran WHERE ID = $id";
		$total = $this->db->query($sql_count)->row()->TOTAL;
		$no_urut = "";

		if($total == 0){
			$no_urut = $this->add_leading_zero(1,3);
			$insert = "INSERT INTO stp_no_urut_anggaran(NO_URUT) VALUES('$no_urut')";
			$this->db->query($insert);

			$update_keu = "UPDATE stp_dpbm SET NO_KEU = '$no_urut' WHERE ID = $id_dpbm";
			$this->db->query($update_keu);
		}else{
			$sql = "SELECT NO_URUT FROM stp_no_urut_anggaran WHERE ID = $id";
			$data = $this->db->query($sql)->row();
			$no = $data->NO_URUT;
			$no_urut = $this->add_leading_zero($no+1,3);

			$update = "UPDATE stp_no_urut_anggaran SET NO_URUT = $no_urut WHERE ID = $id";
			$this->db->query($update);

			$update_keu = "UPDATE stp_dpbm SET NO_KEU = '$no_urut' WHERE ID = $id_dpbm";
			$this->db->query($update_keu);
		}
		echo json_encode($no_urut);
	}

	function get_no_urut_anggaran_rab_spk(){
		$id = $this->input->post('id');
		$id_rab = $this->input->post('id_rab');
		$sql_count = "SELECT COUNT(*) AS TOTAL FROM stp_no_urut_anggaran WHERE ID = $id";
		$total = $this->db->query($sql_count)->row()->TOTAL;
		$no_urut = "";

		if($total == 0){
			$no_urut = $this->add_leading_zero(1,3);
			$insert = "INSERT INTO stp_no_urut_anggaran(NO_URUT) VALUES('$no_urut')";
			$this->db->query($insert);

			$update_keu = "UPDATE stp_rincian_anggaran_biaya SET NO_KEU = '$no_urut' WHERE ID = $id_rab";
			$this->db->query($update_keu);
		}else{
			$sql = "SELECT NO_URUT FROM stp_no_urut_anggaran WHERE ID = $id";
			$data = $this->db->query($sql)->row();
			$no = $data->NO_URUT;
			$no_urut = $this->add_leading_zero($no+1,3);

			$update = "UPDATE stp_no_urut_anggaran SET NO_URUT = $no_urut WHERE ID = $id";
			$this->db->query($update);

			$update_keu = "UPDATE stp_rincian_anggaran_biaya SET NO_KEU = '$no_urut' WHERE ID = $id_rab";
			$this->db->query($update_keu);
		}
		echo json_encode($no_urut);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */