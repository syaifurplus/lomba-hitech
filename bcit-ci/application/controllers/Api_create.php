<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_create extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Crud_model', 'crud');
		// $this->load->model('Crud_model');

    }

	public function index()
	{
		$this->load->view('home');
	}

	public function nyoba(){
		echo "uhuy";
	}

    public function gC($kord=null, $rw=null, $rt=null, $rmh=null){

		// http://localhost:8888/Projek/Pos/lomba-hitech/bcit-ci/Api_create/gC/-6.9943448,110.4113608

		// $kord = $_GET['kordinat'];
		$kord = explode(",", $kord);
		$lat = $kord[0];
		$lng = $kord[1];

        // https://maps.googleapis.com/maps/api/geocode/json?latlng=-6.9828663,110.406908&key=AIzaSyDHPA_-jsMJ1N7T24IRMJT7B-TjYuGA56s
		$dataJson = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&key=AIzaSyDHPA_-jsMJ1N7T24IRMJT7B-TjYuGA56s");    
		$data1 = json_decode($dataJson,true);
	
		$data = array();
		
		foreach($data1['results']['0']['address_components'] as $element){
			$data[ implode(' ',$element['types']) ] = $element['long_name'];
		}

		$kelurahan = $data['administrative_area_level_4 political'];
		$kecamatan = $data['administrative_area_level_3 political'];
	
		$kec = explode(" ", $kecamatan); 
		$jmlkec = count($kec);

		if ($jmlkec == 3){		
			$kect = $kec[1]." ".$kec[2];
		} else if($jmlkec == 2){
			$kect = $jmlkec[1];
		}

		$dataDaerah = $this->crud->getWhere('data_daerah', ['name_3' => $kect, 'name_4' => $kelurahan])->result_array();
		// echo json_encode($dataDaerah);
		$kelurahan = $dataDaerah[0]['gid_4'];
		$kecamatan = $dataDaerah[0]['gid_3'];
		// echo count($dataDaerah);

        $hijau=0;
        $kuning=0;
        $orange=0;
        $merah=0;

        if($rmh==0){
            $hijau = 1;
        }
        else if($rmh>= 1 && $rmh<=5){
            $kuning = 1;
        }
        else if($rmh>= 6 && $rmh<=10){
            $orange = 1;
        }
        else if($rmh > 10){
            $merah = 1;
        }
		
		$format = "%Y-%M-%d %H:%i";

        $data = array(
            'gid_4'         => $kelurahan,
            'gid_3'         => $kecamatan,
            'hijau'         => $hijau,
            'kuning'        => $kuning,
            'orange'        => $orange,
            'merah'         => $merah,
            'jumlah_rumah'  => $rmh,
            'rw'            => $rt,
            'rt'            => $rw,
            'latitude'      => $lat,
            'longitude'     => $lng,
        );
		// $data['created_at'] = mdate($format);

		// echo json_encode($data);
		// pencocokan gid kelurahan dan kecamatan dlu

		// [ ] Algoritma Klasifikasi RW RT
        //     1.3.1 [ ] Jika data sudah ada, update where gid_4, gid_3, rw, rt sama dengan DB
        //     1.3.2 [ ] Jika data belum ada, simpan

		// $sql = "SELECT * FROM iotdinus_cPPKM.pasien_kelurahan WHERE gid_3 ='IDN.10.17.11_1' AND gid_4='IDN.10.17.11.9_1' AND rw ='4' AND rt='5'";
		// $sql = "SELECT * FROM iotdinus_cPPKM.pasien_kelurahan WHERE gid_3 = '".$kecamatan."' AND gid_4= '".$kelurahan."' AND rw = '".$rw."' AND rt= '".$rt."'";
		// $ada = $this->db->query($sql);

		$ada = $this->crud->getWhere('pasien_kelurahan', ['gid_3' => $kecamatan, 'gid_4' => $kelurahan, 'rw' => $rw, 'rt' => $rt]);
		// echo json_encode($ada);
		echo $jmlada = count($ada);

		if ($jmlada >= 1){
			#update
			// $data['updated_at'] = mdate($format);
			$this->crud->perbarui('pasien_kelurahan', $data, ['gid_3' => $kecamatan, 'gid_4' => $kelurahan, 'rw' => $rw, 'rt' => $rt]);
			$feedback['status'] = "Data diperbarui";
			echo json_encode($feedback);
		}else if ($jmlada == 0){
			#tambah
			// $data['created_at'] = mdate($format);
			$this->crud->tambah('pasien_kelurahan', $data);
			$feedback['status'] = "Data ditambah";
			echo json_encode($feedback);
		}

	}

    public function am_kec()
	{
		$this->load->view('api/kecamatan');
	}

    public function am_kel()
	{
		$this->load->view('api/kelurahan');
	}

    public function mapkecamatan()
	{
        $data	= $this->crud->get('*', 'pasien_kecamatan')->result_array();

        $response = [
            'data'		=> $data,
        ];

        echo json_encode($response);
	}

    public function mapkelurahan($idKecamatan = null)
	{
		if ($idKecamatan == null)
		{
			$data	= $this->crud->get('*', 'pasien_kelurahan')->result_array();

			$response = [
				'data'		=> $data,
			];

			echo json_encode($response);
		}
		else
		{
			$data	= $this->crud->getWhere('*', 'pasien_kelurahan', ['gid_3' => $idKecamatan])->result_array();

			$response = [
				'data'		=> $data,
			];

			echo json_encode($response);
		}
	}
}
