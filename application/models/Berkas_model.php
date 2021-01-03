<?php 

class Berkas_model extends CI_Model{

    public function getBerkas(){
        $this->db->select(['berkas.*','klien.id as kid','klien.nama as nama_klien', 'pengorder.id as pid', 'pengorder.nama as nama_pengorder'])
            ->from('berkas')
            ->join('klien','berkas.pembeli = klien.id','LEFT')
            ->join('pengorder','berkas.pengorder = pengorder.id','LEFT');
        return $this->db->get()->result_array();
    }

    public function getById($id){
        $this->db->select(['berkas.*','klien.id as kid','klien.nama as nama_klien', 'pengorder.id as pid', 'pengorder.nama as nama_pengorder','admin.id as aid','admin.nama as nama_admin'])
            ->from('berkas')
            ->join('klien','berkas.pembeli = klien.id','LEFT')
            ->join('pengorder','berkas.pengorder = pengorder.id','LEFT')
            ->join('admin','berkas.petugas = admin.id','LEFT')
            ->where('berkas.id',$id);
        return $this->db->get()->row_array();
    }

    public function getByDate($month, $year){
        $this->db->select(['berkas.*','klien.id as kid','klien.nama as nama_klien', 'pengorder.id as pid', 'pengorder.nama as nama_pengorder','admin.id as aid','admin.nama as nama_admin'])
            ->from('berkas')
            ->join('klien','berkas.pembeli = klien.id','LEFT')
            ->join('pengorder','berkas.pengorder = pengorder.id','LEFT')
            ->join('admin','berkas.petugas = admin.id','LEFT')
            ->where(['YEAR(tgl)'=> $year, 'MONTH(tgl)' => $month]);
        return $this->db->get()->result_array();
    }

    public function getYear(){
        $query = $this->db->query("SELECT DISTINCT YEAR(`tgl`) as `year` FROM `berkas`");
        return $query->result_array();
    }

    public function getMonth($year){
        $query = $this->db->query("SELECT DISTINCT MONTH(`tgl`) as `month` FROM `berkas` WHERE YEAR(`tgl`) = ".$year);
        return $query->result_array();
    }

    public function add($admin){
        $data = [
            'pembeli' => htmlspecialchars($this->input->post('pembeli')),
            'pengorder' => htmlspecialchars($this->input->post('pengorder')),
            'no_berkas' => htmlspecialchars($this->input->post('no_berkas')),
            'nama_dan_no' => htmlspecialchars($this->input->post('nama_dan_no')),
            'jenis' => htmlspecialchars($this->input->post('jenis')),
            'ploting' => htmlspecialchars($this->input->post('ploting')),
            'pbb' => htmlspecialchars($this->input->post('pbb')),
            'bphtb' => htmlspecialchars($this->input->post('bphtb')),
            'pph' => htmlspecialchars($this->input->post('pph')),
            'dok_pertama' => htmlspecialchars($this->input->post('dok_pertama')),
            'dok_kedua' => htmlspecialchars($this->input->post('dok_kedua')),
            'petugas' => $admin,
            'keterangan' => htmlspecialchars($this->input->post('keterangan')),
            'tgl' => $this->input->post('tgl'),
        ];
        $this->db->insert('berkas',$data);
    }

    public function edit($id){
        $data = [
            'pembeli' => htmlspecialchars($this->input->post('pembeli')),
            'pengorder' => htmlspecialchars($this->input->post('pengorder')),
            'no_berkas' => htmlspecialchars($this->input->post('no_berkas')),
            'nama_dan_no' => htmlspecialchars($this->input->post('nama_dan_no')),
            'jenis' => htmlspecialchars($this->input->post('jenis')),
            'ploting' => htmlspecialchars($this->input->post('ploting')),
            'pbb' => htmlspecialchars($this->input->post('pbb')),
            'bphtb' => htmlspecialchars($this->input->post('bphtb')),
            'pph' => htmlspecialchars($this->input->post('pph')),
            'dok_pertama' => htmlspecialchars($this->input->post('dok_pertama')),
            'dok_kedua' => htmlspecialchars($this->input->post('dok_kedua')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan')),
            'tgl' => $this->input->post('tgl'),
        ];
        $this->db->update('berkas',$data,['id' => $id]);
    }

    public function delete($id){
        $this->db->delete('berkas',['id' => $id]);
    }


}

?>