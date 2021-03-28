<?php

class Rtrw_model extends CI_Model {
    public function tampilsemua(){
        return $this->db->get('user')->result_array();//mengambil semua data yang ada
    }

    public function TambahData(){
        $data = array(
            'rt' => $this->input->post('rt', true),
            'rw' => $this->input->post('rw', true)
        
        );
        
        $this->db->insert('user', $data);
    }

    public function getId($id){//penamaan bebas
        return $this->db->get_where('user', ['id' => $id])->row_array();//sudah pas
    }

    public function hapusData($id){
        $this->db->delete('user', array('id' => $id));
    }

    public function editData(){
        $data = array(
            'rt' => $this->input->post('rt', true),
            'rw' => $this->input->post('rw', true)
        
        );
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $data);//table database
    }
}