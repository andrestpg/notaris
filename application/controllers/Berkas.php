<?php 
class Berkas extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        admin_check();
        $this->load->model('Berkas_model');
        $this->load->library('form_validation');
    }

    private function admin(){
        $admin = $this->session->userdata('admin');
        return $this->db->get_where('admin', ['username' => $admin['username']])->row_array();
    }

    public function index(){
        $data = [
            'title' => 'Berkas Masuk PPAT',
            'berkas' => $this->Berkas_model->getBerkas(),
            'script' => 'berkas',
            'admin' => $this->admin(),
            'date' => $this->getYear()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('berkas/index', $data);
        $this->load->view('templates/footer');
    }

    public function getBerkas(){
        $data = $this->Berkas_model->getBerkas();
        echo json_encode($data);
    }

    public function getById($id){
        $data = $this->Berkas_model->getById($id);
        echo json_encode($data);
    }

    public function getMonth($year){
        $data = $this->Berkas_model->getMonth($year);
        echo json_encode($data);
    }

    public function getYear(){
        return $this->Berkas_model->getYear();
    }

    public function add(){
        $admin = $this->admin();
        $data = [
            'title' => 'Tambah Data',
            'admin' => $this->admin(),
            'klien' => $this->db->get('klien')->result_array(),
            'pengorder' => $this->db->get('pengorder')->result_array(),
            'choice' => 'choice'
        ];
        
        $this->form_validation->set_rules('pembeli','pemberi','required');
        $this->form_validation->set_rules('pengorder','penerima','required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('berkas/add', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Berkas_model->add($admin['id']);
            $this->session->set_flashdata('flash','Data Berhasil Ditambahkan');
            redirect('berkas');
        }
    }
    public function edit($id){
        $data = [
            'title' => 'Edit Data',
            'berkas' => $this->Berkas_model->getById($id),
            'admin' => $this->admin(),
            'klien' => $this->db->get('klien')->result_array(),
            'pengorder' => $this->db->get('pengorder')->result_array(),
            'choice' => 'choice'
        ];
        
        $this->form_validation->set_rules('pembeli','pemberi','required');
        $this->form_validation->set_rules('pengorder','penerima','required');
        
        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('berkas/edit', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Berkas_model->edit($id);
            $this->session->set_flashdata('flash','Data Berhasil Diubah');
            redirect('berkas');
        }
    }

    public function delete($id){
        $admin = $this->admin();
        if($admin['akses'] == 1){
            $this->Berkas_model->delete($id);
        }
        else{
            $this->session->set_flashdata('notif','Anda tidak memiliki akses!');
            redirect('berkas');
        }

    }
}

?>