<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_spk_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('master_spk_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";

		if($this->input->post('simpan')){

			$tgl_pisah2 		      = "";
		    $tgl_awal_adendum		  = "";
		    $tgl_adendum	          = "";

			$msg = 1;
			$nomor_spk 		  = $this->input->post('nomor_spk');
			$no_rab 		  = $this->input->post('no_rab');
			$kepada 		  = addslashes($this->input->post('kepada'));
			$uraian_pekerjaan = addslashes($this->input->post('uraian'));
			$dasar 			  = addslashes($this->input->post('dasar'));
			$biaya_tawar 	  = str_replace(',', '', $this->input->post('biaya_tawar'));
			$biaya_tawar 	  = str_replace('.', '', $biaya_tawar);
			$biaya_kontrak 	  = str_replace(',', '', $this->input->post('biaya_kontrak'));
			$biaya_kontrak 	  = str_replace('.', '', $biaya_kontrak);
			$beban_biaya 	  = addslashes($this->input->post('beban_biaya'));
			$pembayaran 	  = addslashes($this->input->post('pembayaran'));
			$sanksi2 	      = addslashes($this->input->post('sanksi2'));
			$selisihan 	      = addslashes($this->input->post('selisihan'));
			$selesai          = $this->input->post('selesai');

			$nomor_spk_adendum 	      = addslashes($this->input->post('nomor_spk_adendum'));			
			$jenis_adendum 	      	  = $this->input->post('jenis_adendum');
			$nilai_adendum 	  		  = str_replace(',', '', $this->input->post('nilai_adendum'));
			$nilai_adendum 	  		  = str_replace('.', '', $nilai_adendum);
			$waktu_adendum 	      	  = $this->input->post('waktu_adendum');
			$tgl_adendum 			  = "";

			$kepada_ad                = addslashes($this->input->post('kepada_ad'));		
			$uraian_ad   			  = addslashes($this->input->post('uraian_ad'));
			$dasar_ad   	  		  = addslashes($this->input->post('dasar_ad'));
			$beban_biaya_ad  	      = addslashes($this->input->post('beban_biaya_ad'));
			$pembayaran_ad 		      = addslashes($this->input->post('pembayaran_ad'));
			$sanksi2_ad   		      = addslashes($this->input->post('sanksi2_ad'));
			$selisihan_ad  		      = addslashes($this->input->post('selisihan_ad'));

			if($waktu_adendum != ""){
				$tgl_pisah2 		      = explode(" sampai ", trim($waktu_adendum)) ;
				$tgl_awal_adendum		  = $tgl_pisah2[0];
				$tgl_adendum	          = $tgl_pisah2[1];
			}


			$tgl_full       = $this->input->post('jangka');
			$tgl_pisah 		= explode(" sampai ", trim($tgl_full)) ;
			$tgl_awal		= $tgl_pisah[0];
			$tgl_akhir		= $tgl_pisah[1];

			$this->model->save_spk($nomor_spk, $no_rab, $kepada, $uraian_pekerjaan, $dasar, $biaya_tawar, $biaya_kontrak, $beban_biaya, 
								   $pembayaran, $sanksi2, $selisihan, $tgl_awal, $tgl_akhir, $nomor_spk_adendum, $jenis_adendum, $nilai_adendum, $tgl_adendum, $selesai,
								   $kepada_ad, $uraian_ad,  $dasar_ad,  $beban_biaya_ad,  $pembayaran_ad,  $sanksi2_ad,  $selisihan_ad);

			$get_id_spk = $this->model->get_id_spk($nomor_spk);
			$id_spk     = $get_id_spk->ID;
			$no_rab_spk     = $get_id_spk->NO_RAB;
			$biaya_kontrak_spk = $get_id_spk->BIAYA_KONTRAK + $get_id_spk->NILAI_ADENDUM;

			if($no_rab_spk != "" || $no_rab_spk != null){
				$this->model->update_realisasi_by_spk($id_spk, $biaya_kontrak_spk, $no_rab_spk);
			}

			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada menu', 'MASTER SPK', 'dengan NO SPK', $nomor_spk);




		} else if($this->input->post('id_hapus')){

			$id_hapus = $this->input->post('id_hapus');

			$cek = $this->model->cek_spk_in_realisasi($id_hapus);
			$data = $this->model->get_spk_by_id($id_hapus);
			$msg = 0;
			

			if(count($cek) > 0 ){
			   $msg = 5;
			} else {
			   $this->model->hapus_spk($id_hapus);
			   $msg = 3;
			   $this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada menu', 'MASTER SPK', 'dengan NO SPK', $data->NO_SPK);
			} 

		} else if($this->input->post('ubah')){
			$msg = 1;
			$id_spk 		  = $this->input->post('id_spk');
			$nomor_spk 		  = $this->input->post('nomor_spk');
			$no_rab 		  = $this->input->post('no_rab');
			$kepada 		  = addslashes($this->input->post('kepada'));
			$uraian_pekerjaan = addslashes($this->input->post('uraian'));
			$dasar 			  = addslashes($this->input->post('dasar'));
			$biaya_tawar 	  = str_replace(',', '', $this->input->post('biaya_tawar'));
			$biaya_kontrak 	  = str_replace(',', '', $this->input->post('biaya_kontrak'));
			$beban_biaya 	  = addslashes($this->input->post('beban_biaya'));
			$pembayaran 	  = addslashes($this->input->post('pembayaran'));
			$sanksi2 	      = addslashes($this->input->post('sanksi2'));
			$selisihan 	      = addslashes($this->input->post('selisihan'));

			$selesai          = $this->input->post('selesai');

			$nomor_spk_adendum 	      = addslashes($this->input->post('nomor_spk_adendum'));			
			$jenis_adendum 	      	  = $this->input->post('jenis_adendum');
			$nilai_adendum 	  		  = str_replace(',', '', $this->input->post('nilai_adendum'));
			$nilai_adendum 	  		  = str_replace('.', '', $nilai_adendum);
			$waktu_adendum 	      	  = $this->input->post('waktu_adendum');
			$tgl_adendum 			  = "";

			$kepada_ad                = addslashes($this->input->post('kepada_ad'));		
			$uraian_ad   			  = addslashes($this->input->post('uraian_ad'));
			$dasar_ad   	  		  = addslashes($this->input->post('dasar_ad'));
			$beban_biaya_ad  	      = addslashes($this->input->post('beban_biaya_ad'));
			$pembayaran_ad 		      = addslashes($this->input->post('pembayaran_ad'));
			$sanksi2_ad   		      = addslashes($this->input->post('sanksi2_ad'));
			$selisihan_ad  		      = addslashes($this->input->post('selisihan_ad'));

			if($waktu_adendum != ""){
				$tgl_pisah2 		      = explode(" sampai ", trim($waktu_adendum)) ;
				$tgl_awal_adendum		  = $tgl_pisah2[0];
				$tgl_adendum	          = $tgl_pisah2[1];
			}

			$tgl_full       = $this->input->post('jangka');
			$tgl_pisah 		= explode(" sampai ", trim($tgl_full)) ;
			$tgl_awal		= $tgl_pisah[0];
			$tgl_akhir		= $tgl_pisah[1];

			$this->model->edit_spk($id_spk, $nomor_spk, $no_rab, $kepada, $uraian_pekerjaan, $dasar, $biaya_tawar, $biaya_kontrak, $beban_biaya, 
								   $pembayaran, $sanksi2, $selisihan, $tgl_awal, $tgl_akhir, $nomor_spk_adendum, $jenis_adendum, $nilai_adendum, $tgl_adendum, $selesai,
								   $kepada_ad, $uraian_ad,  $dasar_ad,  $beban_biaya_ad,  $pembayaran_ad,  $sanksi2_ad,  $selisihan_ad);
			
			$this->master_model_m->save_log('Ubah', 'Melakukan ubah data pada menu', 'MASTER SPK', 'dengan NO SPK', $nomor_spk);

		} else if($this->input->post('excel')){
			$this->print_excel();
		} else if($this->input->post('pdf')){
			$this->print_pdf();
		}

		$data = array(
		  'page' => "dashboard/master_spk_v",
		  'induk_menu' => "setup_data",
		  'menu' => "set_spk",
		  'title' => "MASTER SPK",
		  'post_url' => "dashboard/master_spk_c",  
		  'msg'  => $msg,
		  'dt'   => $this->model->get_all_spk(),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function print_excel(){		

		$data = array(
		  'dt'   => $this->model->get_all_spk(),
		);
		$this->load->view('dashboard/excel/master_spk_xls', $data);
	}

	function print_pdf(){		

		$data = array(
		  'dt'   => $this->model->get_all_spk(),
		);
		$this->load->view('dashboard/pdf/master_spk_pdf', $data);
	}

	function get_norab(){
		$keyword = $this->input->get('keyword');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (a.NO_RAB LIKE '%$keyword%' OR a.TAHUN LIKE '%$keyword%')";
		}
		$sql = "
			SELECT a.* FROM stp_rincian_anggaran_biaya a 
			LEFT JOIN stp_realisasi_anggaran b ON a.NO_RAB = b.NO_RAB
			WHERE $where AND b.ID IS NULL LIMIT 10
		";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function get_selisih_tgl(){
		$tgl_full = $this->input->post('tgl');

		$tgl_pisah 		= explode(" sampai ", trim($tgl_full)) ;
		$tgl_awal		= $tgl_pisah[0];
		$tgl_akhir		= $tgl_pisah[1];
		$tgl_awal       = date('Y-m-d', strtotime($tgl_awal));
		$tgl_akhir      = date('Y-m-d', strtotime($tgl_akhir));
		$tgl_akhir_now  = date('Y-m-d');

		$pecah1 = explode("-", $tgl_akhir);
	    $date1 = $pecah1[2];
	    $month1 = $pecah1[1];
	    $year1 = $pecah1[0];

	    // memecah string tanggal akhir untuk mendapatkan
	    // tanggal, bulan, tahun
	    $pecah2 = explode("-", $tgl_akhir_now);
	    $date2 = $pecah2[2];
	    $month2 = $pecah2[1];
	    $year2 =  $pecah2[0];

	    // mencari total selisih hari dari tanggal awal dan akhir
	    $jd1 = GregorianToJD($month1, $date1, $year1);
	    $jd2 = GregorianToJD($month2, $date2, $year2);

	    $selisih = $jd2 - $jd1;

		echo json_encode($selisih);
	}

	function cek_spk(){
		$nomor_spk = $this->input->post('nomor_spk');
		$hasil = 0;

		$cek = $this->model->cek_nomor_spk($nomor_spk);
		if(count($cek) > 0){
			$hasil = 1;
		} else {
			$hasil = 0;
		}

		echo json_encode($hasil);

	}

	function get_data_spk(){
		$id = $this->input->post('id');
		$dt = $this->model->get_spk_by_id($id);
		$cek = $this->model->cek_rab_in_realisasi($dt->NO_RAB);

		$data['data'] = $this->model->get_spk_by_id($id);
		$data['cek_rab'] = count($cek);

		echo json_encode($data);

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */