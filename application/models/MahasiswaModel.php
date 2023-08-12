<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MahasiswaModel extends CI_Model {
    
    // datatables
    function json() {
        $this->datatables->select('a.nim, a.nama_lengkap, a.tanggal_lahir, a.jenis_kelamin, a.alamat');
        $this->datatables->from('mahasiswa as a');
        //add this line for join
        $this->datatables->add_column('action',anchor(site_url('controllerMahasiswa/edit_mahasiswa/$1'),'<i class="fas fa-edit"></i> Edit','class="btn btn-success" title="Edit Data"')." ".anchor(site_url('controllerMahasiswa/hapus_siswa/$1'),'<i class="fa fa-archive"></i> Hapus','data-nama_mahasiswa="$2" class="btn btn-danger hapus" title="Hapus Data"'), 'nim,nama_lengkap');
        return $this->datatables->generate();
    }

    function insert_mahasiswa($data)
    {
        $this->db->insert('mahasiswa', $data);
    }

    function get_by_id($nim)
    {
        $this->db->where('nim', $nim);
        return $this->db->get("mahasiswa")->row();
    }

    function update_siswa($nim, $data)
    {
        $this->db->where("nim", $nim);
        $this->db->update("mahasiswa", $data);
    }

    function delete_siswa($nim)
    {
        $this->db->where("nim", $nim);
        $this->db->delete("mahasiswa");
    }
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */