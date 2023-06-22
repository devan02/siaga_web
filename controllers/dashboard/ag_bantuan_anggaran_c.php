<?php
//by haruna07
class Ag_bantuan_anggaran_c extends CI_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->model('ag_bantuan_anggaran_m','model');
		$this->load->library("excel_reader2");
	}
	
	public function index() {
		$data = array(
			  'page' 		=> "dashboard/ag_bantuan_anggaran_v",
			  'induk_menu'	=> "bantuan_anggaran",
			  'menu' 		=> "bantuan_anggaran",
			  'title' 		=> "BANTUAN ANGGARAN",
			  'url'			=> base_url().'dashboard/ag_bantuan_anggaran_c/simpan',
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function simpan(){
		$excel= new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
		$hasildata = $excel->rowcount($sheet_index=0);
		for ($i=2; $i<=$hasildata; $i++){
			$URAIAN = $excel->val($i,2);
			$JANUARI = $excel->val($i,3);
			$FEBRUARI = $excel->val($i,4);
			$MARET = $excel->val($i,5);
			$APRIL = $excel->val($i,6);
			$MEI = $excel->val($i,7);
			$JUNI = $excel->val($i,8);
			$JULI = $excel->val($i,9);
			$AGUSTUS = $excel->val($i,10);
			$SEPTEMBER = $excel->val($i,11);
			$OKTOBER = $excel->val($i,12);
			$NOVEMBER = $excel->val($i,13);
			$DESEMBER = $excel->val($i,14);
			$TAHUN = $excel->val($i,15);
			$TAHUN_2014 = $excel->val($i,16);
			$JENIS = $excel->val($i,17);
			$PERIODE = $excel->val($i,18);

			$this->model->insert_data(
				$URAIAN,
				$JANUARI,
				$FEBRUARI,
				$MARET,
				$APRIL,
				$MEI,
				$JUNI,
				$JULI,
				$AGUSTUS,
				$SEPTEMBER,
				$OKTOBER,
				$NOVEMBER,
				$DESEMBER,
				$TAHUN,
				$TAHUN_2014,
				$JENIS,
				$PERIODE);

		}
		redirect('dashboard/ag_bantuan_anggaran_c');
	}

}

/* End of file contoh.php */
/* Location: ./application/controllers/master/contoh.php */

?>