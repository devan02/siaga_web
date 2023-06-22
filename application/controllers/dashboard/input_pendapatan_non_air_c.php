<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_pendapatan_non_air_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('input_pendapatan_m','model');
	}

	function index(){
		$data = array(
		  'page' 		=> "dashboard/input_pendapatan_non_air_v",
		  'induk_menu' 	=> "input_pendapatan",
		  'menu' 		=> "input_pendapatan_non_air",
		  'title'		=> "INPUT PENDAPATAN NON AIR",
		  'url'			=> base_url().'dashboard/input_pendapatan_non_air_c/simpan',
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function simpan(){
		$kode_perkiraan = $this->input->post('kode_perkiraan');
		$nama_perkiraan = $this->input->post('nama_perkiraan');
		$jenis = $this->input->post('jenis');
		$tahun = $this->input->post('tahun');
		$periode = $this->input->post('periode');
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

		$januari 	= ($januari == null || $januari == '') ? 0 : $januari;
		$februari 	= ($februari == null || $februari == '') ? 0 : $februari;
		$maret 		= ($maret == null || $maret == '') ? 0 : $maret;
		$april  	= ($april == null || $april == '') ? 0 : $april;
		$mei 	 	= ($mei == null || $mei == '') ? 0 : $mei;
		$juni 		= ($juni == null || $juni == '') ? 0 : $juni;
		$juli 	 	= ($juli == null || $juli == '') ? 0 : $juli;
		$agustus  	= ($agustus == null || $agustus == '') ? 0 : $agustus;
		$september 	= ($september == null || $september == '') ? 0 : $september;
		$oktober 	= ($oktober == null || $oktober == '') ? 0 : $oktober;
		$november 	= ($november == null || $november == '') ? 0 : $november;
		$desember	= ($desember == null || $desember == '') ? 0 : $desember;

		$jumlah = ($januari+$februari+$maret+$april+$mei+$juni+$juli+$agustus+$september+$oktober+$november+$desember);

		$this->model->simpan_non_air($kode_perkiraan,$jenis,$nama_perkiraan,$tahun,$januari,$februari,$maret,$april,$mei,$juni,$juli,$agustus,$september,$oktober,$november,$desember,$jumlah,$periode);
		$this->session->set_flashdata('sukses','1');
		redirect('dashboard/input_pendapatan_non_air_c');
	}

	function get_kode_perkiraan(){
		$keyword = $this->input->get('keyword');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (a.KODE_PERKIRAAN LIKE '%$keyword%' OR a.NAMA_PERKIRAAN LIKE '%$keyword%')";
		}
		$sql = "
			SELECT 
				a.*,
				b.NAMA_PERKIRAAN, 
				CHILD.INDUK_KODE, 
				bb.NAMA_PERKIRAAN AS NAMA_PERKIRAAN2
			FROM
			(
				SELECT a.ID,trim(a.KODE_PERKIRAAN) KODE_PERKIRAAN FROM stp_setup_kode_perkiraan a
				WHERE $where
				AND a.KP_GRUP = '81'
				GROUP BY trim(a.KODE_PERKIRAAN)
			)a
			JOIN stp_setup_kode_perkiraan b ON trim(b.KODE_PERKIRAAN) = trim(a.KODE_PERKIRAAN)
			LEFT JOIN stp_koper_child_vw CHILD ON TRIM(CHILD.KODE_PERKIRAAN) = TRIM(a.KODE_PERKIRAAN)
            LEFT JOIN stp_setup_kode_perkiraan bb ON trim(CHILD.INDUK_KODE) = trim(bb.KODE_PERKIRAAN)
			ORDER BY 
				CHILD.INDUK_KODE, 
				a.KODE_PERKIRAAN ASC
		";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */