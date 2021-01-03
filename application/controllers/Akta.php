<?php 
class Akta extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        admin_check();
        $this->load->model('Akta_model');
        $this->load->library('form_validation');
    }

    private function admin(){
        $admin = $this->session->userdata('admin');
        return $this->db->get_where('admin', ['username' => $admin['username']])->row_array();
    }

    public function index(){
        $data = [
            'title' => 'Akta',
            'akta' => $this->Akta_model->getAkta(),
            'script' => 'akta',
            'admin' => $this->admin(),
            'date' => $this->getYear()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('akta/index', $data);
        $this->load->view('templates/footer');
    }

    public function getAkta(){
        $data = $this->Akta_model->getAkta();
        echo json_encode($data);
    }

    public function getById($id){
        $data = $this->Akta_model->getById($id);
        echo json_encode($data);
    }

    public function getMonth($year){
        $data = $this->Akta_model->getMonth($year);
        echo json_encode($data);
    }

    public function getYear(){
        return $this->Akta_model->getYear();
    }

    public function add(){
        $data = [
            'title' => 'Tambah Data',
            'admin' => $this->admin(),
            'klien' => $this->db->get('klien')->result_array(),
            'choice' => 'choice'
        ];
        
        $this->form_validation->set_rules('klien','klien','required');
        $this->form_validation->set_rules('no_berkas','no_berkas','required');
        $this->form_validation->set_rules('tgl_akta','tgl_akta','required');
        $this->form_validation->set_rules('sifat_akta','sifat_akta','required');
        $this->form_validation->set_rules('no_akta','no_akta','required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('akta/add', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Akta_model->add();
            $this->session->set_flashdata('flash','Data Berhasil Ditambahkan');
            redirect('akta');
        }
    }
    public function edit($id){
        $data = [
            'title' => 'Edit Data',
            'akta' => $this->Akta_model->getById($id),
            'admin' => $this->admin(),
            'klien' => $this->db->get('klien')->result_array(),
            'choice' => 'choice'
        ];
        
        $this->form_validation->set_rules('klien','klien','required');
        $this->form_validation->set_rules('no_berkas','no_berkas','required');
        $this->form_validation->set_rules('tgl_akta','tgl_akta','required');
        $this->form_validation->set_rules('sifat_akta','sifat_akta','required');
        $this->form_validation->set_rules('no_akta','no_akta','required');
        
        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('akta/edit', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Akta_model->edit($id);
            $this->session->set_flashdata('flash','Data Berhasil Diubah');
            redirect('akta');
        }
    }

    public function delete($id){
        $admin = $this->admin();
        if($admin['akses'] == 1){
            $this->Akta_model->delete($id);
        }
        else{
            $this->session->set_flashdata('notif','Anda tidak memiliki akses!');
            redirect('akta');
        }
    }
}

?>