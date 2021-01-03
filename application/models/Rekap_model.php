<?php 

class Rekap_model extends CI_Model{

    public function getrekap(){
        $this->db->select(['rekap.*','pengorder.id as pid','pengorder.nama as nama_pengorder'])
            ->from('rekap')
            ->join('pengorder','rekap.pengorder = pengorder.id','LEFT');
        return $this->db->get()->result_array();
    }

    public function getById($id){
        $this->db->select(['rekap.*','pengorder.id as pid','pengorder.nama as nama_pengorder'])
            ->from('rekap')
            ->join('pengorder','rekap.pengorder = pengorder.id','LEFT')
            ->where('rekap.id', $id);
        return $this->db->get()->row_array();
    }

    public function getByDate($month,$year){
        $this->db->select(['rekap.*','pengorder.id as pid','pengorder.nama as nama_pengorder'])
            ->from('rekap')
            ->join('pengorder','rekap.pengorder = pengorder.id','LEFT')
            ->where(['YEAR(`tgl_masuk`)' => $year, 'MONTH(`tgl_masuk`)' => $month]);
        return $this->db->get()->result_array();
    }

    public function getYear(){
        $query = $this->db->query("SELECT DISTINCT YEAR(`tgl_masuk`) as `year` FROM `rekap`");
        return $query->result_array();
    }

    public function getMonth($year){
        $query = $this->db->query("SELECT DISTINCT MONTH(`tgl_masuk`) as `month` FROM `rekap` WHERE YEAR(`tgl_masuk`) = ".$year);
        return $query->result_array();
    }

    public function add(){
        $data = [
            'pengorder' => htmlspecialchars($this->input->post('pengorder')),
            'no_urut' => htmlspecialchars($this->input->post('no_urut')),
            'data_sertifikat' => htmlspecialchars($this->input->post('data_sertifikat')),
            'status' => htmlspecialchars($this->input->post('status')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan')),
            'nb' => htmlspecialchars($this->input->post('nb')),
            'tgl_masuk' => $this->input->post('tgl_masuk'),
            'tgl_keluar' => $this->input->post('tgl_keluar'),
        ];
        $this->db->insert('rekap',$data);
    }
    public function edit($id){
        $data = [
            'pengorder' => htmlspecialchars($this->input->post('pengorder')),
            'no_urut' => htmlspecialchars($this->input->post('no_urut')),
            'data_sertifikat' => htmlspecialchars($this->input->post('data_sertifikat')),
            'status' => htmlspecialchars($this->input->post('status')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan')),
            'nb' => htmlspecialchars($this->input->post('nb')),
            'tgl_masuk' => $this->input->post('tgl_masuk'),
            'tgl_keluar' => $this->input->post('tgl_keluar'),
        ];
        $this->db->update('rekap',$data,['id' => $id]);
    }

    public function delete($id){
        $this->db->delete('rekap',['id' => $id]);
    }


}

?>