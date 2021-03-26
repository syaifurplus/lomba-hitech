<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_create extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('home');
	}

    public function reverse_gKordinat($kord=null, $rw=null, $rt=null){

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
		
		// $alamat = $data1['results'][0]['formatted_address'];
		// $jalan = $data['route'];

		$kelurahan = $data['administrative_area_level_4 political'];
		$kecamatan = $data['administrative_area_level_3 political'];
		// $daerah = $data['administrative_area_level_2 political'];
		// $provinsi = $data['administrative_area_level_1 political'];
		// $negara = $data['country political'];
	
	
		// $data = array(
		// 			'alamat'    =>  $alamat,
		// 			'jalan'    =>  $jalan,
		// 			'kelurahan'    =>  $kelurahan,
		// 			'kecamatan'    =>  $kecamatan,
		// 			'daerah'    =>  $daerah,
		// 			'provinsi'    =>  $provinsi,
		// 			'negara'    =>  $negara,
		// 			'latitude'    =>  $lat,
		// 			'longitude'    =>  $lng
		// 		);

        $data = array(
            'rt'        => $rt,
            'rw'        => $rw,
            'kelurahan' =>  $kelurahan,
            'kecamatan' =>  $kecamatan,
            'latitude'  =>  $lat,
            'longitude' =>  $lng
        );
	
		echo json_encode($data);

	}
}
