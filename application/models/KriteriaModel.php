<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KriteriaModel extends CI_Model {
    
    // datatables
    function json() {
        $this->datatables->select('a.id_kriteria, a.range_nilai, b.id_bobot, c.id_atribut, c.kode');
        $this->datatables->from('kriteria as a');
        //add this line for join
        $this->datatables->join('bobot as b', 'a.id_bobot=b.id_bobot');
        $this->datatables->join('atribut as c', 'a.id_atribut=c.id_atribut');
        $this->datatables->add_column('action',anchor(site_url('controllerKriteria/edit_kriteria/$1'),'<i class="fas fa-edit"></i> Edit','class="btn btn-success" title="Edit Data"')." ".anchor(site_url('controllerKriteria/hapus_kriteria/$1'),'<i class="fa fa-archive"></i> Hapus','class="btn btn-danger hapus" title="Hapus Data"'), 'id_kriteria');
        return $this->datatables->generate();
    }

    function insert_kriteria($data)
    {
        $this->db->insert('kriteria', $data);
    }

    function get_by_id($nis)
    {
        $this->db->where('id_kriteria', $nis);
        return $this->db->get("kriteria")->row();
    }

    function update_kriteria($nis, $data)
    {
        $this->db->where("id_kriteria", $nis);
        $this->db->update("kriteria", $data);
    }

    function delete_kriteria($nis)
    {
        $this->db->where("id_kriteria", $nis);
        $this->db->delete("kriteria");
    }

    function get_all_atribut()
    {
        return $this->db->get('atribut')->result();
    }
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */