<?php 
class Ppat extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        admin_check();
        $this->load->model('Ppat_model');
        $this->load->library('form_validation');
    }

    private function admin(){
        $admin = $this->session->userdata('admin');
        return $this->db->get_where('admin', ['username' => $admin['username']])->row_array();
    }

    public function index(){
        $data = [
            'title' => 'PPAT',
            'script' => 'ppat',
            'admin' => $this->admin(),
            'date' => $this->getYear()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('ppat/index', $data);
        $this->load->view('templates/footer');
    }

    public function getPpat(){
        $data = $this->Ppat_model->getPpat();
        echo json_encode($data);
    }

    public function getById($id){
        $data = $this->Ppat_model->getById($id);
        echo json_encode($data);
    }

    public function getPemberi($ppat){
        $data = $this->Ppat_model->getPemberi($ppat);
        echo json_encode($data);
    }

    public function getPenerima($ppat){
        $data = $this->Ppat_model->getPenerima($ppat);
        echo json_encode($data);
    }

    public function getMonth($year){
        $data = $this->Ppat_model->getMonth($year);
        echo json_encode($data);
    }

    public function getYear(){
        return $this->Ppat_model->getYear();
    }

    public function add(){
        $data = [
            'title' => 'Tambah Data',
            'admin' => $this->admin(),
            'klien' => $this->db->get('klien')->result_array(),
            'pengorder' => $this->db->get('pengorder')->result_array(),
            'choice' => 'choice'
        ];
        
        $this->form_validation->set_rules('pemberi[]','pemberi','required');
        $this->form_validation->set_rules('penerima[]','penerima','required');
        $this->form_validation->set_rules('pengorder','pengorder','required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('ppat/add', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Ppat_model->add();
            $this->session->set_flashdata('flash','Data Berhasil Ditambahkan');
            redirect('ppat');
        }
    }
    public function edit($id){
        $data = [
            'title' => 'Edit Data',
            'ppat' => $this->Ppat_model->getById($id),
            'pb' => $this->Ppat_model->getPemberi($id),
            'pn' => $this->Ppat_model->getPenerima($id),
            'admin' => $this->admin(),
            'klien' => $this->db->get('klien')->result_array(),
            'pengorder' => $this->db->get('pengorder')->result_array(),
            'choice' => 'choice'
        ];
        
        $this->form_validation->set_rules('pemberi[]','pemberi','required');
        $this->form_validation->set_rules('penerima[]','penerima','required');
        $this->form_validation->set_rules('pengorder','pengorder','required');
        
        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('ppat/edit', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Ppat_model->edit($id);
            $this->session->set_flashdata('flash','Data Berhasil Diubah');
            redirect('ppat');
        }
    }

    public function delete($id){
        $admin = $this->admin();
        if($admin['akses'] == 1){
            $this->Ppat_model->delete($id);
        }
        else{
            $this->session->set_flashdata('notif','Anda tidak memiliki akses!');
            redirect('ppat');
        }
    }
}

?>