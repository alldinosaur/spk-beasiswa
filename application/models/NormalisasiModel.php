<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NormalisasiModel extends CI_Model {
    function insert($data)
    {
        $this->db->insert('normalisasi', $data);
    }

    function update($nim, $data)
    {
        $this->db->where("nim", $nim);
        $this->db->update("normalisasi", $data);
    }

    function cariMax(){
        return $this->db->query(
            "SELECT max(bobot) as maksimal FROM bobot"
        )->row();
    }

    function cariMin(){
        return $this->db->query(
            "SELECT min(bobot) as minimal FROM bobot"
        )->row();
    }

    function bobot_atribut(){
        return $this->db->query(
            "SELECT bobot FROM atribut"
        )->result();
    }
}