<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_create extends CI_Controller {

	public function index()
	{
		$this->load->view('home');
	}

    public function gC($kord=null, $rw=null, $rt=null, $rmh=null){

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
	
        $hijau=0;
        $kuning=0;
        $orange=0;
        $orange=0;

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
            $orange = 1;
        }

        // pencocokan gid kelurahan dan kecamatan dlu

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
            'longitude'     => $lng
        );
	
		// echo json_encode($data);
        //insert data dari $data ke pasien_kelurahan
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
