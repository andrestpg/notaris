<?php 

class Akta_model extends CI_Model{


    public function getAkta(){
        $this->db->select(['akta.*','klien.id as kid','klien.nama as knama'])
            ->from('akta')
            ->join('klien','akta.klien = klien.id','LEFT')
            ->order_by('akta.no_berkas','ASC');
        return $this->db->get()->result_array();
    }

    public function getById($id){
        $this->db->select(['akta.*','klien.id as kid','klien.nama as knama'])
            ->from('akta')
            ->join('klien','akta.klien = klien.id','LEFT')
            ->where('akta.id', $id);
        return $this->db->get()->row_array();
    }

    public function getByDate($month,$year){
        $this->db->select(['akta.*','klien.id as kid','klien.nama as knama'])
            ->from('akta')
            ->join('klien','akta.klien = klien.id','LEFT')
            ->where(['YEAR(`tgl_akta`)' => $year, 'MONTH(`tgl_akta`)' => $month]);
        return $this->db->get()->result_array();
    }

    public function getYear(){
        $query = $this->db->query("SELECT DISTINCT YEAR(`tgl_akta`) as `year` FROM `akta`");
        return $query->result_array();
    }

    public function getMonth($year){
        $query = $this->db->query("SELECT DISTINCT MONTH(`tgl_akta`) as `month` FROM `akta` WHERE YEAR(`tgl_akta`) = ".$year);
        return $query->result_array();
    }

    public function add(){
        $data = [
            'klien' => htmlspecialchars($this->input->post('klien')),
            'no_berkas' => htmlspecialchars($this->input->post('no_berkas')),
            'sifat_akta' => htmlspecialchars($this->input->post('sifat_akta')),
            'no_akta' => htmlspecialchars($this->input->post('no_akta')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan')),
            'tgl_akta' => $this->input->post('tgl_akta'),
        ];
        $this->db->insert('akta',$data);
    }
    public function edit($id){
        $data = [
            'klien' => htmlspecialchars($this->input->post('klien')),
            'no_berkas' => htmlspecialchars($this->input->post('no_berkas')),
            'sifat_akta' => htmlspecialchars($this->input->post('sifat_akta')),
            'no_akta' => htmlspecialchars($this->input->post('no_akta')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan')),
            'tgl_akta' => $this->input->post('tgl_akta'),
        ];
        $this->db->update('akta',$data,['id' => $id]);
    }

    public function delete($id){
        $this->db->delete('akta',['id' => $id]);
    }


}

?>