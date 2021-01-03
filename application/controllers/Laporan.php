<?php 
class Laporan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        admin_check();
        $this->load->library('form_validation');
    }

    private function admin(){
        $admin = $this->session->userdata('admin');
        return $this->db->get_where('admin', ['username' => $admin['username']])->row_array();
    }

    public function ppat($month, $year){
        $this->load->model('Ppat_model');
        $data = [
            'ppat' => $this->Ppat_model->getByDate($month, $year),
            'n' => 1,
            'title' => 'LAPORAN BULANAN PPAT BULAN '. strtoupper(date('F', strtotime($year.'-'.$month.'-1'))).' TAHUN '.$year,
            'title2' => 'LAPORAN BULANAN PPAT <br> BULAN '. strtoupper(date('F', strtotime($year.'-'.$month.'-1'))).' TAHUN '.$year,
            'admin' => $this->admin()
        ];
        $this->load->view('laporan/ppat',$data);
    }

    public function akta($month, $year){
        $this->load->model('Akta_model');
        $data = [
            'akta' => $this->Akta_model->getByDate($month, $year),
            'n' => 1,
            'title' => 'DAFTAR AKTA TAHUN '.$year,
            'title2' => 'DAFTAR AKTA TAHUN '.$year,
            'admin' => $this->admin()
        ];
        $this->load->view('laporan/akta',$data);
    }

    public function berkas($month, $year){
        $this->load->model('Berkas_model');
        $data = [
            'akta' => $this->Berkas_model->getByDate($month, $year),
            'n' => 1,
            'title' => 'BERKAS MASUK PEKERJAAN PPAT '.$year,
            'title2' => 'BERKAS MASUK PEKERJAAN PPAT '.$year,
            'admin' => $this->admin()
        ];
        $this->load->view('laporan/berkas',$data);
    }

    public function rekap($month, $year){
        $this->load->model('Rekap_model');
        $data = [
            'rekap' => $this->Rekap_model->getByDate($month, $year),
            'n' => 1,
            'title' => 'REKAP DATA SERTIFIKAT '. strtoupper($month).' '.$year,
            'title2' => 'REKAP DATA SERTIFIKAT '. strtoupper($month).' '.$year,
            'admin' => $this->admin()
        ];
        $this->load->view('laporan/rekap',$data);
    }
    
}

?>