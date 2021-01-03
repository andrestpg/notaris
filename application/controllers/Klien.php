<?php 
class Klien extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        admin_check();
        $this->load->model('Klien_model');
        $this->load->library('form_validation');
    }

    private function admin(){
        $admin = $this->session->userdata('admin');
        return $this->db->get_where('admin', ['username' => $admin['username']])->row_array();
    }

    public function index(){
        $data = [
            'title' => 'Klien',
            'klien' => $this->db->get('klien')->result_array(),
            'script' => 'klien',
            'admin' => $this->admin()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('klien/index', $data);
        $this->load->view('templates/footer');
    }

    public function getKlien(){
        $data = $this->db->get('klien')->result_array();
        echo json_encode($data);
    }
    
    public function addKlien(){
        $data = [
            'nama' => $this->input->post('nama'),
            'hp' => $this->input->post('hp')
        ];
        $this->db->insert('klien',$data);
        $id = $this->db->insert_id();
        $klien = $this->db->get_where('klien',['id' => $id])->row_array();
        echo json_encode($klien);
    }

    public function add(){
        $data = [
            'title' => 'Tambah Data',
            'admin' => $this->admin()
        ];
        
        $this->form_validation->set_rules('nama','nama','required');
        $this->form_validation->set_rules('hp','hp','required');
        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('klien/add', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Klien_model->add();
            $this->session->set_flashdata('flash','Data Berhasil Ditambahkan');
            redirect('klien');
        }
    }
    public function edit($id){
        $data = [
            'title' => 'Edit Data',
            'klien' => $this->Klien_model->getById($id),
            'admin' => $this->admin()
        ];
        
        $this->form_validation->set_rules('nama','nama','required');
        $this->form_validation->set_rules('hp','hp','required');
        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('klien/edit', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Klien_model->edit($id);
            $this->session->set_flashdata('flash','Data Berhasil Diubah');
            redirect('klien');
        }
    }

    public function delete($id){
        $admin = $this->admin();
        if($admin['akses'] == 1){
            $this->Klien_model->delete($id);
        }
        else{
            $this->session->set_flashdata('notif','Anda tidak memiliki akses!');
            redirect('klien');
        }

    }
}

?>