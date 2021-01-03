<?php 

class Ppat_model extends CI_Model{

    public function getPpat(){
        $this->db->select(['ppat.*','pengorder.id as pid','pengorder.nama as nama_pengorder'])
            ->from('ppat')
            ->join('pengorder','ppat.pengorder = pengorder.id','LEFT');
        return $this->db->get()->result_array();
    }

    public function getById($id){
        $this->db->select(['ppat.*','pengorder.id as pid','pengorder.nama as nama_pengorder'])
            ->from('ppat')
            ->join('pengorder','ppat.pengorder = pengorder.id','LEFT')
            ->where('ppat.id',$id);
        return $this->db->get()->row_array();
    }

    public function getByDate($month, $year){
        $this->db->select(['ppat.*','pengorder.id as pid','pengorder.nama as nama_pengorder'])
            ->from('ppat')
            ->join('pengorder','ppat.pengorder = pengorder.id','LEFT')
            ->where(['YEAR(tgl_akta)'=> $year, 'MONTH(tgl_akta)' => $month]);
        return $this->db->get()->result_array();
    }

    public function getPemberi($ppat){
        $this->db->select(['pemberi.*','klien.id as kid','klien.nama as nama_klien','klien.alamat as alamat_klien'])
            ->from('pemberi')
            ->join('klien','pemberi.pemberi = klien.id')
            ->where('pemberi.ppat',$ppat); 
        return $this->db->get()->result_array();
    }

    public function getPenerima($ppat){
        $this->db->select(['penerima.*','klien.id as kid','klien.nama as nama_klien','klien.alamat as alamat_klien'])
            ->from('penerima')
            ->join('klien','penerima.penerima = klien.id')
            ->where('penerima.ppat',$ppat);
        return $this->db->get()->result_array();
    }

    public function getYear(){
        $query = $this->db->query("SELECT DISTINCT YEAR(`tgl_akta`) as `year` FROM `ppat`");
        return $query->result_array();
    }

    public function getMonth($year){
        $query = $this->db->query("SELECT DISTINCT MONTH(`tgl_akta`) as `month` FROM `ppat` WHERE YEAR(`tgl_akta`) = ".$year);
        return $query->result_array();
    }

    public function add(){

        $pemberi = $this->input->post('pemberi');
        $penerima = $this->input->post('penerima');

        $data = [
            'pengorder' => htmlspecialchars($this->input->post('pengorder')),
            'no_akta' => htmlspecialchars($this->input->post('no_akta')),
            'hukum' => htmlspecialchars($this->input->post('hukum')),
            'jenis_hak' => htmlspecialchars($this->input->post('jenis_hak')),
            'letak' => htmlspecialchars($this->input->post('letak')),
            'luas_tanah' => htmlspecialchars($this->input->post('luas_tanah')),
            'luas_bangunan' => htmlspecialchars($this->input->post('luas_bangunan')),
            'harga' => htmlspecialchars($this->input->post('harga')),
            'nop_tahun' => htmlspecialchars($this->input->post('nop_tahun')),
            'njop' => htmlspecialchars($this->input->post('njop')),
            'jml_ssb' => htmlspecialchars($this->input->post('jml_ssb')),
            'jml_ssp' => htmlspecialchars($this->input->post('jml_ssp')),
            'tgl_akta' => $this->input->post('tgl_akta'),
            'tgl_ssb' => $this->input->post('tgl_ssb'),
            'tgl_ssp' => $this->input->post('tgl_ssp'),
        ];
        $this->db->insert('ppat',$data);
        $id = $this->db->insert_id();

        foreach($penerima as $p){
            $data = [
                'penerima' => $p,
                'ppat' => $id
            ];
            $this->db->insert('penerima',$data);
        }
        foreach($pemberi as $p){
            $data = [
                'pemberi' => $p,
                'ppat' => $id
            ];
            $this->db->insert('pemberi',$data);
        }
    }
    public function edit($id){

        $pemberi = $this->input->post('pemberi');
        $penerima = $this->input->post('penerima');

        $data = [
            'pengorder' => htmlspecialchars($this->input->post('pengorder')),
            'no_akta' => htmlspecialchars($this->input->post('no_akta')),
            'hukum' => htmlspecialchars($this->input->post('hukum')),
            'jenis_hak' => htmlspecialchars($this->input->post('jenis_hak')),
            'letak' => htmlspecialchars($this->input->post('letak')),
            'luas_tanah' => htmlspecialchars($this->input->post('luas_tanah')),
            'luas_bangunan' => htmlspecialchars($this->input->post('luas_bangunan')),
            'harga' => htmlspecialchars($this->input->post('harga')),
            'nop_tahun' => htmlspecialchars($this->input->post('nop_tahun')),
            'njop' => htmlspecialchars($this->input->post('njop')),
            'jml_ssb' => htmlspecialchars($this->input->post('jml_ssb')),
            'jml_ssp' => htmlspecialchars($this->input->post('jml_ssp')),
            'tgl_akta' => $this->input->post('tgl_akta'),
            'tgl_ssb' => $this->input->post('tgl_ssb'),
            'tgl_ssp' => $this->input->post('tgl_ssp'),
        ];

        $this->db->update('ppat',$data,['id' => $id]);
        $this->db->delete('pemberi',['ppat' => $id]);
        $this->db->delete('penerima',['ppat' => $id]);

        foreach($penerima as $p){
            $data = [
                'penerima' => $p,
                'ppat' => $id
            ];
            $this->db->insert('penerima',$data);
        }
        
        foreach($pemberi as $p){
            $data = [
                'pemberi' => $p,
                'ppat' => $id
            ];
            $this->db->insert('pemberi',$data);
        }
    }

    public function delete($id){
        $this->db->delete('ppat',['id' => $id]);
    }


}

?>