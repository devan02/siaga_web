<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kunci_anggaran_c extends CI_Controller {
 
	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('kunci_anggaran_m','model');
	}

	function index()
	{
		$sessi = $this->session->userdata('masuk_bos');
		$msg = 0;

		if($this->input->post('id_hapus')){
			$msg = 3;
			$id_hapus = $this->input->post('id_hapus');
			$this->model->delete_kunci($id_hapus);

		} else if($this->input->post('hapus_multiple')){
			$id_hapus = $this->input->post('cek');
			$msg = 3;
			foreach ($id_hapus as $key => $val) {
				$this->model->delete_kunci($val);
			}
		}

		$dt = $this->model->get_all_kunci();

		if($sessi){
			$data = array(
			  'page' 		=> "dashboard/kunci_anggaran_v",
			  'induk_menu' 	=> "kunci",
			  'menu' 		=> "kunci",
			  'title' 		=> "KUNCI ANGGARAN",
			  'departemen'	=> $this->dep_div->departemen(),
			  'url'			=> base_url().'dashboard/kunci_anggaran_c/simpan_kunci',  
			  'post_url'	=> "dashboard/kunci_anggaran_c",  
			  'dt'			=> $dt,
			  'msg'			=> $msg,
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

	function simpan_kunci(){
		$kriteria = $this->input->post('kriteria');
		$setting_kunci = $this->input->post('setting_kunci');
		$departemen = $this->input->post('departemen');
		$divisi = $this->input->post('divisi');
		$set_tgl = $this->input->post('daterange');
        $tgl_awal = substr($set_tgl, 0,10);
        $tgl_akhir = substr($set_tgl, 18);
        $tahun = $this->input->post('tahun');

        $menu_kunci = $this->input->post('menu_kunci');
        
        foreach ($menu_kunci as $value_kunci) {
        	if($value_kunci != null || $value_kunci != ""){
        		$this->model->simpan_kunci($kriteria,$setting_kunci,$departemen,$divisi,$tgl_awal,$tgl_akhir,$tahun, $value_kunci);
        	}
        }

        $this->session->set_flashdata('status','1');
        redirect('dashboard/kunci_anggaran_c');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */