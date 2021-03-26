<?php
class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user', 'model');
		$this->table = 'user';
	}

	public function add()
	{
		$this->load->view('user_add');
	}

	public function save()
	{
		if(isset($_POST['kirim']))
		{
			$rt = $this->input->post('rt');
			
			$rw = $this->input->post('rw');

			/*//untuk cek apakah email, password, dan nama sudah terisi
			if($email and $pass and $nama)
			{
				//untuk cek apakah password lebih dari 6 karakter
				if(strlen($pass) > 6)
				{
					$data = [
					'email'=>$email,
					'password'=>$pass,
					'nama'=>$nama
					];

					$this->model->insert_data($this->table, $data);
				}
			}*/

			redirect('user/add');
		}
	}
}
?>