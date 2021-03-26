<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_panel extends CI_Controller {

	public function __construct()
    {

		// if($this->session->userdata('status') != "login"){
		// 	redirect(base_url("welcome_message"));
		// }

		parent::__construct();
		$this->load->model('ic_model');

		// if (!$this->_is_logged_in()) {
		// 	$this->session->sess_destroy();
		// 	redirect(base_url());
		// }
	}

	public function index()
	{		
		// $this->load->view("vp_fOutlet_insert");
		$this->load->view("sign-in");
	}

	public function cmc_login()
	{		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			// 'password' => md5($password)
			'password' => $password
			);
		$cek = $this->ic_model->cek_login("tbl_user",$where)->num_rows();
		if($cek > 0){
 
			// $data_session = array(
			// 	'nama' => $username,
			// 	'status' => "login"
			// 	);
 
			// $this->session->set_userdata($data_session);
 
			// redirect(base_url("admin"));
			redirect(base_url()."index.php/c_panel/cm_fOutlet_insert");
 
		}else{
			// echo "Username dan password salah !";
			echo '<div class="alert alert-warning">
			<strong>Peringatan!</strong> Check kembali Username dan Password Anda. <a href="'.base_url().'">Masuk Kembali</a>.
			</div>';
			// redirect(base_url()."index.php/c_panel");
			// echo '0';
		}
	}

	public function cm_fOutlet_insert()
	{	
		$this->load->view("vp_fOutlet_insert");
	}

	public function cm_tOutlet()
	{	
		$data_outlet = $this->ic_model->getData("tbl_outlet");
		$data = array(
			"dataOutlet" => $data_outlet
		);

		// $this->load->view("form-examples", $data);
		$this->load->view("vp_tOutlet", $data);
	}

	public function cmt_outlet(){
		// echo $this->input->post('idOutlet'); echo "<br>";
		// echo $this->input->post('nama');echo "<br>";
		// echo $this->input->post('telepon');echo "<br>";
		// echo $this->input->post('handphone');echo "<br>";
		// echo $this->input->post('kordinat');echo "<br>";
		// echo $this->input->post('alamat');echo "<br>";
		// echo $this->input->post('jalan');echo "<br>";
		// echo $this->input->post('kelurahan');echo "<br>";
		// echo $this->input->post('kecamatan');echo "<br>";
		// echo $this->input->post('daerah');echo "<br>";
		// echo $this->input->post('provinsi');echo "<br>";
		// echo $this->input->post('negara');echo "<br>";
		// echo $this->input->post('latitude');echo "<br>";
		// echo $this->input->post('longitude');echo "<br>";

		$data_last = $this->ic_model->getLastIdRow("tbl_outlet");
		// echo $data_last[0]['no'];
		$dataLast = $data_last[0]['no']+1;
		$KodeOutlet = "ILx".$dataLast."xOTL";

		$dataInputan = array(
			'idOutlet' => $KodeOutlet,
			'nama' => $this->input->post('nama'),
			'telepon' => $this->input->post('telepon'),
			'handphone' => $this->input->post('handphone'),
			'kordinat' => $this->input->post('kordinat'),
			'alamat' => $this->input->post('alamat'),
			'jalan' => $this->input->post('jalan'),
			'kelurahan' => $this->input->post('kelurahan'),
			'kecamatan' => $this->input->post('kecamatan'),
			'daerah' => $this->input->post('daerah'),
			'provinsi' => $this->input->post('provinsi'),
			'negara' => $this->input->post('negara'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude')
		);
		$this->ic_model->setData('tbl_outlet', $dataInputan);
		redirect(base_url()."index.php/c_panel/cm_tOutlet", 'refresh');
	
	}

	public function cm_fOutlet_update($penunjuk){
		$dataPenunjuk = array(
			'no' => $penunjuk	
		);

		$data_outlet = $this->ic_model->getData_khusus("tbl_outlet", $dataPenunjuk);
		$data = array(
			"dataOutlet" => $data_outlet
		);

		$this->load->view("vp_fOutlet_update", $data);
	}

	public function cmu_outlet(){

		$dataUpdate = array(
			'nama' => $this->input->post('nama'),
			'telepon' => $this->input->post('telepon'),
			'handphone' => $this->input->post('handphone'),
			'kordinat' => $this->input->post('kordinat'),
			'alamat' => $this->input->post('alamat'),
			'jalan' => $this->input->post('jalan'),
			'kelurahan' => $this->input->post('kelurahan'),
			'kecamatan' => $this->input->post('kecamatan'),
			'daerah' => $this->input->post('daerah'),
			'provinsi' => $this->input->post('provinsi'),
			'negara' => $this->input->post('negara'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude')
		);

		$dataPenunjuk = array(
			'no' => $this->input->post('no')
		);
		$dataMhs = $this->ic_model->upDataRow('tbl_outlet', $dataUpdate, $dataPenunjuk);
		redirect(base_url()."index.php/c_panel/cm_tOutlet", 'refresh');
	}

	public function cm_outlet_detail($penunjuk){
		$dataPenunjuk = array(
			'no' => $penunjuk	
		);

		$data_outlet = $this->ic_model->getData_khusus("tbl_outlet", $dataPenunjuk);
		$data = array(
			"dataOutlet" => $data_outlet
		);

		$this->load->view("vp_dOutlet", $data);
	}

	public function cm_outlet_delete($penunjuk){
		$dataPenunjuk = array(
			'no' => $penunjuk	
		);
		$this->ic_model->delDataRow('tbl_outlet', $dataPenunjuk);
		redirect(base_url()."index.php/c_panel/cm_tOutlet", 'refresh');
	}

	public function reverse_gKordinat(){

		$kord = $_GET['kordinat'];
		$kord = explode(",", $kord);
		$lat = $kord[0];
		$lng = $kord[1];
	
		$dataJson = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&key=AIzaSyDHPA_-jsMJ1N7T24IRMJT7B-TjYuGA56s");    
		$data1 = json_decode($dataJson,true);
	
		$data = array();
		
		foreach($data1['results']['0']['address_components'] as $element){
			$data[ implode(' ',$element['types']) ] = $element['long_name'];
		}
		
		$alamat = $data1['results'][0]['formatted_address'];
		$jalan = $data['route'];
		$kelurahan = $data['administrative_area_level_4 political'];
		$kecamatan = $data['administrative_area_level_3 political'];
		$daerah = $data['administrative_area_level_2 political'];
		$provinsi = $data['administrative_area_level_1 political'];
		$negara = $data['country political'];
	
	
		$data = array(
					'alamat'    =>  $alamat,
					'jalan'    =>  $jalan,
					'kelurahan'    =>  $kelurahan,
					'kecamatan'    =>  $kecamatan,
					'daerah'    =>  $daerah,
					'provinsi'    =>  $provinsi,
					'negara'    =>  $negara,
					'latitude'    =>  $lat,
					'longitude'    =>  $lng
				);
	
		echo json_encode($data);

	}
}
