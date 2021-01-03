<?php 

class Pengorder extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        admin_check();
        $this->load->model('Pengorder_model');
        $this->load->library('form_validation');
    }

    private function admin(){
        $admin = $this->session->userdata('admin');
        return $this->db->get_where('admin', ['username' => $admin['username']])->row_array();
    }

    public function index(){
        $data = [
            'title' => 'Pengorder',
            'pengorder' => $this->db->get('pengorder')->result_array(),
            'script' => 'pengorder',
            'admin' => $this->admin()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('pengorder/index', $data);
        $this->load->view('templates/footer');
    }

    public function getPengorder(){
        $data = $this->db->get('pengorder')->result_array();
        echo json_encode($data);
    }
    
    public function addPengorder(){
        $data = [
            'nama' => $this->input->post('nama'),
            'hp' => $this->input->post('hp')
        ];
        $this->db->insert('pengorder',$data);
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
            $this->load->view('pengorder/add', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Pengorder_model->add();
            $this->session->set_flashdata('flash','Data Berhasil Ditambahkan');
            redirect('pengorder');
        }
    }
    public function edit($id){
        $data = [
            'title' => 'Edit Data',
            'pengorder' => $this->Pengorder_model->getById($id),
            'admin' => $this->admin()
        ];
        
        $this->form_validation->set_rules('nama','nama','required');
        $this->form_validation->set_rules('hp','hp','required');
        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('pengorder/edit', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->Pengorder_model->edit($id);
            $this->session->set_flashdata('flash','Data Berhasil Diubah');
            redirect('pengorder');
        }
    }

    public function delete($id){
        $admin = $this->admin();
        if($admin['akses'] == 1){
            $this->Pengorder_model->delete($id);
        }
        else{
            $this->session->set_flashdata('notif','Anda tidak memiliki akses!');
            redirect('pengorder');
        }

    }

}


?>