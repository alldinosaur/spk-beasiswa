<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KlasifikasiModel extends CI_Model {
    
    // datatables
    function json() {
        $this->datatables->select('a.id_klasifikasi, b.nim, b.nama_lengkap, a.c1, a.c2, a.c3, a.c4, a.c5, a.c6');
        $this->datatables->from('klasifikasi as a');
        //add this line for join
        $this->datatables->join('mahasiswa as b', 'a.nim=b.nim');
        $this->datatables->add_column('action',anchor(site_url('controllerKlasifikasi/hapus_klasifikasi/$1'),'<i class="fa fa-archive"></i> Hapus','class="btn btn-danger hapus" title="Hapus Data"'), 'id_klasifikasi');
        return $this->datatables->generate();
    }

    function insert_klasifikasi($data)
    {
        $this->db->insert('klasifikasi', $data);
    }

    function get_by_id($nim)
    {
        $this->db->where('id_klasifikasi', $nim);
        return $this->db->get("klasifikasi")->row();
    }

    function update_kriteria($nim, $data)
    {
        $this->db->where("id_klasifikasi", $nim);
        $this->db->update("klasifikasi", $data);
    }

    function delete_klasifikasi($nim)
    {
        $this->db->where("id_klasifikasi", $nim);
        $this->db->delete("klasifikasi");
    }

    function get_all_mahasiswa()
    {
        return $this->db->get('mahasiswa')->result();
    }

    function get_all_kriteria()
    {
        $this->db->select("a.id_kriteria, a.id_atribut, a.range_nilai, b.nama_atribut, b.tipe_atribut, c.bobot");
        $this->db->from("kriteria as a");
        $this->db->join("atribut as b", "a.id_atribut =b.id_atribut");
        $this->db->join("bobot as c", "a.id_bobot =c.id_bobot");
        $this->db->order_by("a.id_atribut");
        return $this->db->get()->result();
    }
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */