<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_pendapatan_air_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('input_pendapatan_m','model');
		$this->load->model('master_tarif_blok_m','tarif');
	}

	function index(){
		$data = array(
		  'page' 			=> "dashboard/input_pendapatan_air_v",
		  'induk_menu' 		=> "input_pendapatan",
		  'menu' 			=> "input_pendapatan_air",
		  'title'			=> "INPUT PENDAPATAN AIR",
		  'url_kp1'	 		=> base_url().'dashboard/input_pendapatan_air_c/simpan_kp1',
		  'url_kp2'	 		=> base_url().'dashboard/input_pendapatan_air_c/simpan_kp2',
		  'url_kp3'	 		=> base_url().'dashboard/input_pendapatan_air_c/simpan_kp3',
		  'url_kp4'	 		=> base_url().'dashboard/input_pendapatan_air_c/simpan_kp4',
		  'url_jasa_admin'	=> base_url().'dashboard/input_pendapatan_air_c/simpan_jasa_admin',
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function simpan_kp1(){
		$kelompok_pelanggan = "Kelompok Pelanggan I";
		$jenis_kelompok_pelanggan = $this->input->post('jenis_kp1');
		$uraian = $this->input->post('uraian_kp1');
		$m3 = str_replace(',', '', $this->input->post('m3_kp1'));
		$tarif = 0;
		$jumlah_blok1 = str_replace(',','',$this->input->post('jumlah_blok1_kp1'));
		$tarif_blok1 = str_replace(',','',$this->input->post('tarif_blok1_kp1'));
		$total_blok1 = str_replace(',','',$this->input->post('total_blok1_kp1'));
		$jumlah_blok2 = str_replace(',','',$this->input->post('jumlah_blok2_kp1'));
		$tarif_blok2 = str_replace(',','',$this->input->post('tarif_blok2_kp1'));
		$total_blok2 = str_replace(',','',$this->input->post('total_blok2_kp1'));
		$januari = str_replace(',', '', $this->input->post('januari_kp1'));
		$februari = str_replace(',', '', $this->input->post('februari_kp1'));
		$maret = str_replace(',', '', $this->input->post('maret_kp1'));
		$april = str_replace(',', '', $this->input->post('april_kp1'));
		$mei = str_replace(',', '', $this->input->post('mei_kp1'));
		$juni = str_replace(',', '', $this->input->post('juni_kp1'));
		$juli = str_replace(',', '', $this->input->post('juli_kp1'));
		$agustus = str_replace(',', '', $this->input->post('agustus_kp1'));
		$september = str_replace(',', '', $this->input->post('september_kp1'));
		$oktober = str_replace(',', '', $this->input->post('oktober_kp1'));
		$november = str_replace(',', '', $this->input->post('november_kp1'));
		$desember = str_replace(',', '', $this->input->post('desember_kp1'));
		
		$januari 	= ($januari == null || $januari == '') ? 0 : $januari ; 
		$februari 	= ($februari == null || $februari == '') ? 0 : $februari ;
		$maret 		= ($maret == null || $maret == '') ? 0 : $maret ;
		$april  	= ($april == null || $april == '') ? 0 : $april ;
		$mei 	 	= ($mei == null || $mei == '') ? 0 : $mei ;
		$juni 		= ($juni == null || $juni == '') ? 0 : $juni ;
		$juli 	 	= ($juli == null || $juli == '') ? 0 : $juli ;
		$agustus  	= ($agustus == null || $agustus == '') ? 0 : $agustus ;
		$september 	= ($september == null || $september == '') ? 0 : $september ;
		$oktober 	= ($oktober == null || $oktober == '') ? 0 : $oktober ;
		$november 	= ($november == null || $november == '') ? 0 : $november ;
		$desember	= ($desember == null || $desember == '') ? 0 : $desember ;

		$jumlah = $desember;
		$tahun = $this->input->post('tahun_kp1');
		$periode = $this->input->post('periode_kp1');

		$this->model->simpan(
			$kelompok_pelanggan,
			$jenis_kelompok_pelanggan,
			$uraian,
			$m3,
			$tarif,
			$jumlah_blok1,
			$tarif_blok1,
			$total_blok1,
			$jumlah_blok2,
			$tarif_blok2,
			$total_blok2,
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
			$jumlah,
			$tahun,
			$periode);
		
		$this->session->set_flashdata('sukses','1');
		redirect('dashboard/input_pendapatan_air_c');
	}

	function simpan_kp2(){
		$kelompok_pelanggan = "Kelompok Pelanggan II";
		$jenis_kelompok_pelanggan = $this->input->post('jenis_kp2');
		$uraian = $this->input->post('uraian_kp2');
		$m3 = str_replace(',', '', $this->input->post('m3_kp2'));
		$tarif = 0;
		$jumlah_blok1 = str_replace(',','',$this->input->post('jumlah_blok1_kp2'));
		$tarif_blok1 = str_replace(',','',$this->input->post('tarif_blok1_kp2'));
		$total_blok1 = str_replace(',','',$this->input->post('total_blok1_kp2'));
		$jumlah_blok2 = str_replace(',','',$this->input->post('jumlah_blok2_kp2'));
		$tarif_blok2 = str_replace(',','',$this->input->post('tarif_blok2_kp2'));
		$total_blok2 = str_replace(',','',$this->input->post('total_blok2_kp2'));
		$januari = str_replace(',', '', $this->input->post('januari_kp2'));
		$februari = str_replace(',', '', $this->input->post('februari_kp2'));
		$maret = str_replace(',', '', $this->input->post('maret_kp2'));
		$april = str_replace(',', '', $this->input->post('april_kp2'));
		$mei = str_replace(',', '', $this->input->post('mei_kp2'));
		$juni = str_replace(',', '', $this->input->post('juni_kp2'));
		$juli = str_replace(',', '', $this->input->post('juli_kp2'));
		$agustus = str_replace(',', '', $this->input->post('agustus_kp2'));
		$september = str_replace(',', '', $this->input->post('september_kp2'));
		$oktober = str_replace(',', '', $this->input->post('oktober_kp2'));
		$november = str_replace(',', '', $this->input->post('november_kp2'));
		$desember = str_replace(',', '', $this->input->post('desember_kp2'));
		
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

		$jumlah = $desember;
		$tahun = $this->input->post('tahun_kp2');
		$periode = $this->input->post('periode_kp2');

		$this->model->simpan(
			$kelompok_pelanggan,
			$jenis_kelompok_pelanggan,
			$uraian,
			$m3,
			$tarif,
			$jumlah_blok1,
			$tarif_blok1,
			$total_blok1,
			$jumlah_blok2,
			$tarif_blok2,
			$total_blok2,
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
			$jumlah,
			$tahun,
			$periode);
		
		$this->session->set_flashdata('sukses','1');
		redirect('dashboard/input_pendapatan_air_c');
	}

	function simpan_kp3(){
		$kelompok_pelanggan = "Kelompok Pelanggan III";
		$jenis_kelompok_pelanggan = $this->input->post('jenis_kp3');
		$uraian = $this->input->post('uraian_kp3');
		$m3 = str_replace(',', '', $this->input->post('m3_kp3'));
		$tarif = 0;
		$jumlah_blok1 = str_replace(',','',$this->input->post('jumlah_blok1_kp3'));
		$tarif_blok1 = str_replace(',','',$this->input->post('tarif_blok1_kp3'));
		$total_blok1 = str_replace(',','',$this->input->post('total_blok1_kp3'));
		$jumlah_blok2 = str_replace(',','',$this->input->post('jumlah_blok2_kp3'));
		$tarif_blok2 = str_replace(',','',$this->input->post('tarif_blok2_kp3'));
		$total_blok2 = str_replace(',','',$this->input->post('total_blok2_kp3'));
		$januari = str_replace(',', '', $this->input->post('januari_kp3'));
		$februari = str_replace(',', '', $this->input->post('februari_kp3'));
		$maret = str_replace(',', '', $this->input->post('maret_kp3'));
		$april = str_replace(',', '', $this->input->post('april_kp3'));
		$mei = str_replace(',', '', $this->input->post('mei_kp3'));
		$juni = str_replace(',', '', $this->input->post('juni_kp3'));
		$juli = str_replace(',', '', $this->input->post('juli_kp3'));
		$agustus = str_replace(',', '', $this->input->post('agustus_kp3'));
		$september = str_replace(',', '', $this->input->post('september_kp3'));
		$oktober = str_replace(',', '', $this->input->post('oktober_kp3'));
		$november = str_replace(',', '', $this->input->post('november_kp3'));
		$desember = str_replace(',', '', $this->input->post('desember_kp3'));
		
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

		$jumlah = $desember;
		$tahun = $this->input->post('tahun_kp3');
		$periode = $this->input->post('periode_kp3');

		$this->model->simpan(
			$kelompok_pelanggan,
			$jenis_kelompok_pelanggan,
			$uraian,
			$m3,
			$tarif,
			$jumlah_blok1,
			$tarif_blok1,
			$total_blok1,
			$jumlah_blok2,
			$tarif_blok2,
			$total_blok2,
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
			$jumlah,
			$tahun,
			$periode);
		
		$this->session->set_flashdata('sukses','1');
		redirect('dashboard/input_pendapatan_air_c');
	}

	function simpan_kp4(){
		$kelompok_pelanggan = "Kelompok Pelanggan IV";
		$jenis_kelompok_pelanggan = $this->input->post('jenis_kp4');
		$uraian = $this->input->post('uraian_kp4');
		$m3 = str_replace(',', '', $this->input->post('m3_kp4'));
		$tarif = 0;
		$jumlah_blok1 = str_replace(',','',$this->input->post('jumlah_blok1_kp4'));
		$tarif_blok1 = str_replace(',','',$this->input->post('tarif_blok1_kp4'));
		$total_blok1 = str_replace(',','',$this->input->post('total_blok1_kp4'));
		$jumlah_blok2 = str_replace(',','',$this->input->post('jumlah_blok2_kp4'));
		$tarif_blok2 = str_replace(',','',$this->input->post('tarif_blok2_kp4'));
		$total_blok2 = str_replace(',','',$this->input->post('total_blok2_kp4'));
		$januari = str_replace(',', '', $this->input->post('januari_kp4'));
		$februari = str_replace(',', '', $this->input->post('februari_kp4'));
		$maret = str_replace(',', '', $this->input->post('maret_kp4'));
		$april = str_replace(',', '', $this->input->post('april_kp4'));
		$mei = str_replace(',', '', $this->input->post('mei_kp4'));
		$juni = str_replace(',', '', $this->input->post('juni_kp4'));
		$juli = str_replace(',', '', $this->input->post('juli_kp4'));
		$agustus = str_replace(',', '', $this->input->post('agustus_kp4'));
		$september = str_replace(',', '', $this->input->post('september_kp4'));
		$oktober = str_replace(',', '', $this->input->post('oktober_kp4'));
		$november = str_replace(',', '', $this->input->post('november_kp4'));
		$desember = str_replace(',', '', $this->input->post('desember_kp4'));
		
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

		$jumlah = $desember;
		$tahun = $this->input->post('tahun_kp4');
		$periode = $this->input->post('periode_kp4');

		$this->model->simpan(
			$kelompok_pelanggan,
			$jenis_kelompok_pelanggan,
			$uraian,
			$m3,
			$tarif,
			$jumlah_blok1,
			$tarif_blok1,
			$total_blok1,
			$jumlah_blok2,
			$tarif_blok2,
			$total_blok2,
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
			$jumlah,
			$tahun,
			$periode);
		
		$this->session->set_flashdata('sukses','1');
		redirect('dashboard/input_pendapatan_air_c');
	}

	function simpan_jasa_admin(){
		$kelompok_pelanggan = "Unsur Lainnya";
		$jenis_kelompok_pelanggan = "Jasa Administrasi";
		$uraian = $this->input->post('uraian_jasa_admin');
		$m3 = str_replace(',', '', $this->input->post('m3_jasa_admin'));
		$tarif = 0;
		$jumlah_blok1 = 0;
		$tarif_blok1 = 0;
		$total_blok1 = 0;
		$jumlah_blok2 = 0;
		$tarif_blok2 = 0;
		$total_blok2 = 0;
		$januari = str_replace(',', '', $this->input->post('januari_jasa_admin'));
		$februari = str_replace(',', '', $this->input->post('februari_jasa_admin'));
		$maret = str_replace(',', '', $this->input->post('maret_jasa_admin'));
		$april = str_replace(',', '', $this->input->post('april_jasa_admin'));
		$mei = str_replace(',', '', $this->input->post('mei_jasa_admin'));
		$juni = str_replace(',', '', $this->input->post('juni_jasa_admin'));
		$juli = str_replace(',', '', $this->input->post('juli_jasa_admin'));
		$agustus = str_replace(',', '', $this->input->post('agustus_jasa_admin'));
		$september = str_replace(',', '', $this->input->post('september_jasa_admin'));
		$oktober = str_replace(',', '', $this->input->post('oktober_jasa_admin'));
		$november = str_replace(',', '', $this->input->post('november_jasa_admin'));
		$desember = str_replace(',', '', $this->input->post('desember_jasa_admin'));
		
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

		$jumlah = $desember;
		$tahun = $this->input->post('tahun_jasa_admin');
		$periode = $this->input->post('periode_jasa_admin');

		$this->model->simpan(
			$kelompok_pelanggan,
			$jenis_kelompok_pelanggan,
			$uraian,
			$m3,
			$tarif,
			$jumlah_blok1,
			$tarif_blok1,
			$total_blok1,
			$jumlah_blok2,
			$tarif_blok2,
			$total_blok2,
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
			$jumlah,
			$tahun,
			$periode);
		
		$this->session->set_flashdata('sukses','1');
		redirect('dashboard/input_pendapatan_air_c');
	}

	function cek_tarif_blok_kp1(){
		$jenis = $this->input->get('jenis');
		$data = $this->model->cek_tarif($jenis);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */