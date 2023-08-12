<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AtributModel extends CI_Model {
    
    // datatables
    function json() {
        $this->datatables->select('a.id_atribut, a.kode, a.nama_atribut, a.tipe_atribut, a.bobot');
        $this->datatables->from('atribut as a');
        //add this line for join
        $this->datatables->add_column('action',anchor(site_url('controllerAtribut/edit_atribut/$1'),'<i class="fas fa-edit"></i> Edit','class="btn btn-success" title="Edit Data"')." ".anchor(site_url('controllerAtribut/hapus_atribut/$1'),'<i class="fa fa-archive"></i> Hapus','data-nama="$2" class="btn btn-danger hapus" title="Hapus Data"'), 'id_atribut,nama_kriteria');
        return $this->datatables->generate();
    }

    function get_total_bobot(){
        return $this->db->select_sum("bobot")->from("atribut")->get()->row();
    }

    function insert_atribut($data)
    {
        $this->db->insert('atribut', $data);
    }

    function get_by_id($nis)
    {
        $this->db->where('id_atribut', $nis);
        return $this->db->get("atribut")->row();
    }

    function update_atribut($nis, $data)
    {
        $this->db->where("id_atribut", $nis);
        $this->db->update("atribut", $data);
    }

    function delete_atribut($nis)
    {
        $this->db->where("id_atribut", $nis);
        $this->db->delete("atribut");
    }
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */