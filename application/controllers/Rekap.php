<?php 
class Rekap extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        admin_check();
        $this->load->model('Rekap_model');
        $this->load->library('form_validation');
    }

    private function admin(){
        $admin = $this->session->userdata('admin');
        return $this->db->get_where('admin', ['username' => $admin['username']])->row_array();
    }

    public function index(){
        $data = [
            'title' => 'Rekap Data Sertifikat',
            'rekap' => $this->Rekap_model->getRekap(),
            'script' => 'rekap',
            'admin' => $this->admin(),
            'date' => $this->getYear()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('rekap/index', $data);
        $this->load->view('templates/footer');
    }

    public function getRekap(){
        $data = $this->Rekap_model->getRekap();
        echo json_encode($data);
    }

    public function getById($id){
        $data = $this->Rekap_model->getById($id);
        echo json_encode($data);
    }

    public function getMonth($year){
        $data = $this->Rekap_model->getMonth($year);
        echo json_encode($data);
    }

    public function getYear(){
        return $this->Rekap_model->getYear();
    }

    public function add(){
        $data = [
            'title' => 'Tambah Data',
            'admin' => $this->admin(),
            'pengorder' => $this->db->get('pengorder')->result_array(),
            'choice' => 'choice'
        ];
        
        $this->form_validation->set_rules('pengorder','pengorder','required');
        $this->form_validation->set_rules('no_urut','no_urut','required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('rekap/add', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Rekap_model->add();
            $this->session->set_flashdata('flash','Data Berhasil Ditambahkan');
            redirect('rekap');
        }
    }
    public function edit($id){
        $data = [
            'title' => 'Edit Data',
            'rekap' => $this->Rekap_model->getById($id),
            'admin' => $this->admin(),
            'pengorder' => $this->db->get('pengorder')->result_array(),
            'choice' => 'choice'
        ];
        
        $this->form_validation->set_rules('pengorder','pengorder','required');
        $this->form_validation->set_rules('no_urut','no_urut','required');
        
        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('rekap/edit', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Rekap_model->edit($id);
            $this->session->set_flashdata('flash','Data Berhasil Diubah');
            redirect('rekap');
        }
    }

    public function delete($id){
        $admin = $this->admin();
        if($admin['akses'] == 1){
            $this->Rekap_model->delete($id);
        }
        else{
            $this->session->set_flashdata('notif','Anda tidak memiliki akses!');
            redirect('rekap');
        }
    }
}

?>