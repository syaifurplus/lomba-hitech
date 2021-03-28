<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('Rtrw_model');//memanggil/mengaktifkan model bernama Kub_model di Controller ini
    }
	
	public function index()
	{
        $data['rtrw'] = $this->Rtrw_model->tampilsemua();//menggunakan fungsi yang ada di model
		$this->load->view('input',$data);//menampilkan tampilan yang ada di view
	}

    public function tambah()
    {
        $this->load->view('tambah');
    }

    public function proses_tambah(){
        $this->Rtrw_model->TambahData();

        redirect('home');
    }

    public function hapus($id){
        $this->Rtrw_model->hapusData($id);
        redirect('home');
    }

    public function edit($id){
        $data['edit'] = $this->Rtrw_model->getId($id);
        $this->load->view('edit',$data);
    }
    public function proses_edit(){
        $this->Rtrw_model->editData();
        redirect('home');
    }
    

}
