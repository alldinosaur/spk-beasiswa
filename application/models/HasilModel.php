<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HasilModel extends CI_Model {
    
    // datatables
    function json_klasifikasi() {
        $this->datatables->select('a.id_klasifikasi, a.nim, a.c1, a.c2, a.c3, a.c4, a.c5, a.c6, b.nama_lengkap');
        $this->datatables->from('klasifikasi as a');
        //add this line for join
        $this->datatables->join('mahasiswa as b', 'a.nim=b.nim');
        return $this->datatables->generate();
    }

    function json_normalisasi() {
        $this->datatables->select('a.nim, a.c1, a.c2, a.c3, a.c4, a.c5, a.c6, b.nama_lengkap');
        $this->datatables->from('normalisasi as a');
        //add this line for join
        $this->datatables->join('mahasiswa as b', 'a.nim=b.nim');
        return $this->datatables->generate();
    }

    function json_ranking() {
        $this->datatables->select("a.nim, CAST(a.nilai_total as FLOAT) as nilai, b.nama_lengkap, a.keterangan");
        $this->datatables->from('hasil as a');
        //add this line for join
        $this->datatables->join('mahasiswa as b', 'a.nim=b.nim');
        return $this->datatables->generate();
    }

    function hasil_ranking() {
        $this->db->select("a.nim, a.nilai_total, b.nama_lengkap, a.keterangan");
        $this->db->from('hasil as a');
        //add this line for join
        $this->db->join('mahasiswa as b', 'a.nim=b.nim');

        $this->db->order_by('a.nilai_total', 'DESC');
        return $this->db->get()->result();
    }

    function update_hasil($nim, $data)
    {
        $this->db->where("nim", $nim);
        $this->db->update("hasil", $data);
    }

    function insert_hasil($data)
    {
        $this->db->insert('hasil', $data);
    }
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */