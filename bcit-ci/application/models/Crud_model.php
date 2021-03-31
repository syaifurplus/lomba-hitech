<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {

    public function get($tabel){
        return $this->db->get($tabel);
    }

    public function tambah($tabel, $data){
        return $this->db->insert($tabel, $data);
    }

    public function hapus($tabel, $where){
        return $this->db->delete($tabel, $where);
    }

    public function perbarui($tabel, $data, $where){
        return $this->db->update($tabel, $data, $where);
    }

    public function getWhere($table, $where, $order = false)
    {
        return $this->db->get_where($table, $where);
    }
    
    public function cek_data($table, $gid_3=null, $gid_4=null, $rw=null, $rt=null){
        return $this->db->select('*')
                        ->from('pasien_kelurahan')
                        ->where('gid_3', $gid_3)
                        ->where('gid_4', $gid_4)
                        ->where('rw', $rw)
                        ->where('rt', $rt)
                        ->get();
    }
}
