<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_tarif_blok_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('master_tarif_blok_m','model');
	}

	function index()
	{
		$keyword = "";
		$data = array(
		  'page' 		=> "dashboard/master_tarif_blok_v",
		  'induk_menu' 	=> "setup_data",
		  'menu' 		=> "master_tarif_blok",
		  'title' 		=> "MASTER TARIF BLOK",
		  'url_ubah'	=> base_url()."dashboard/master_tarif_blok_c/ubah_data",
		  'url_del'	=> base_url()."dashboard/master_tarif_blok_c/hapus_data",
		  'tarif_blok'	=> $this->model->get_data_tarif_blok($keyword),
		  'post_url'	=> base_url()."dashboard/master_tarif_blok_c/simpan_data",
		  'jkp'			=> $this->model->get_jenis_kelompok_pel(),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cari_data(){
		$keyword = $this->input->post('keyword');
		$data = $this->model->get_data_tarif_blok($keyword);
		echo json_encode($data);
	}

	function get_tarif_id(){
		$id_tarif = $this->input->post('id_tarif');
		$data = $this->model->get_tarif_id($id_tarif);
		echo json_encode($data);
	}

	function ubah_data(){
		$id_tarif = $this->input->post('id_tarif');
		$kelompok_pelanggan = $this->input->post('ubah_kelompok_pelanggan');
		$blok_1_kurang_dr_sepuluh = $this->input->post('blok_1_kurang_dr_sepuluh');
		$blok_2_lebih_dr_sepuluh = $this->input->post('blok_2_lebih_dr_sepuluh');
		$blok_1_kurang_dr_sepuluh2 = $this->input->post('blok_1_kurang_dr_sepuluh2');
		$blok_2_lebih_dr_sepuluh2 = $this->input->post('blok_2_lebih_dr_sepuluh2');
		$sts = $this->input->post('sts');

		$this->model->ubah_data($id_tarif, $kelompok_pelanggan,$blok_1_kurang_dr_sepuluh,$blok_2_lebih_dr_sepuluh,$blok_1_kurang_dr_sepuluh2,$blok_2_lebih_dr_sepuluh2, $sts);
		$this->session->set_flashdata('status','1');
		redirect('dashboard/master_tarif_blok_c');
	}

	function hapus_data(){
		$id_hapus = $this->input->post('id_hapus');
		$sql = "DELETE FROM stp_master_tarif_blok WHERE ID = $id_hapus";
		$this->db->query($sql);
		$this->session->set_flashdata('hapus','1');
		redirect('dashboard/master_tarif_blok_c');
	}

	function simpan_data(){
		$kelompok_pelanggan = $this->input->post('kel_pel');
		$blok_1_kurang_dr_sepuluh = $this->input->post('blok_1_kurang_dr_sepuluh_new');
		$blok_2_lebih_dr_sepuluh = $this->input->post('blok_2_lebih_dr_sepuluh_new');
		$blok_1_kurang_dr_sepuluh2 = $this->input->post('blok_1_kurang_dr_sepuluh2_new');
		$blok_2_lebih_dr_sepuluh2 = $this->input->post('blok_2_lebih_dr_sepuluh2_new');
		$sts = $this->input->post('sts_new');
		$jkp = $this->input->post('jkp');

		$this->model->simpan_data($kelompok_pelanggan,$blok_1_kurang_dr_sepuluh,$blok_2_lebih_dr_sepuluh,$blok_1_kurang_dr_sepuluh2,$blok_2_lebih_dr_sepuluh2, $sts, $jkp);
		$this->session->set_flashdata('status','1');
		redirect('dashboard/master_tarif_blok_c');
	}


}