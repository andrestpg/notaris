<?php 
class User extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        admin_check();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('string');
    }

    private function admin(){
        $admin = $this->session->userdata('admin');
        return $this->db->get_where('admin', ['username' => $admin['username']])->row_array();
    }

    public function index(){
        $admin = $this->admin();
        $data = [
            'title' => 'User',
            'user' => $this->User_model->getUser($admin['id']),
            'script' => 'user',
            'admin' => $this->admin()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function getUser(){
        $admin = $this->admin();
        $data = $this->User_model->getUser($admin['id']);
        echo json_encode($data);
    }

    public function add(){
        $data = [
            'title' => 'Tambah Data',
            'id' => random_string('alnum',10),
            'admin' => $this->admin()
        ];
        
        $this->form_validation->set_rules('nama','nama','required');
        $this->form_validation->set_rules('username','username','required|is_unique[admin.username]',['is_unique' => 'Username telah terdaftar!']);
        $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]',['min_length' => 'Password terlalu pendek!' ,'matches' => 'Password dan konfirmasi password harus sama!']);
        $this->form_validation->set_rules('password2', 'konfirmasi password', 'required');
        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('user/add', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->User_model->add();
            $this->session->set_flashdata('flash','Data Berhasil Ditambahkan');
            redirect('user');
        }
    }

    public function edit($id){
        $user = $this->User_model->getById($id);
        $data = [
            'title' => 'Edit Data',
            'user' => $user,
            'admin' => $this->admin()
        ];
        
        $this->form_validation->set_rules('nama','nama','required');
        
        if($this->input->post('username') != $user['username']){
            $this->form_validation->set_rules('username','username','required|is_unique[admin.username]',['is_unique' => 'Username telah terdaftar!']);
        }
        
        if($this->input->post('password1') != ''){
            $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]',[
                'min_length' => 'Password terlalu pendek!' ,'matches' => 'Password dan konfirmasi password harus sama!'
                ]);
            $this->form_validation->set_rules('password2', 'konfirmasi password', 'required');
        }

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->User_model->edit($id,'edit');
            $this->session->set_flashdata('flash','Data Berhasil Diubah');
            redirect('user');
        }
    }
    
    public function edit_profil($id){
        $user = $this->User_model->getById($id);
        $data = [
            'title' => 'Edit Profil',
            'user' => $user,
            'admin' => $this->admin()
        ];
        
        $this->form_validation->set_rules('nama','nama','required');
        
        if($this->input->post('username') != $user['username']){
            $this->form_validation->set_rules('username','username','required|is_unique[admin.username]',['is_unique' => 'Username telah terdaftar!']);
        }
        
        if($this->input->post('password1') != ''){
            $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]',[
                'min_length' => 'Password terlalu pendek!' ,'matches' => 'Password dan konfirmasi password harus sama!'
                ]);
            $this->form_validation->set_rules('password2', 'konfirmasi password', 'required');
        }

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        }
        else{
            $this->User_model->edit($id,'edit_profil');
            $this->session->set_flashdata('flash','Data Berhasil Diubah');
            redirect('user');
        }
    }

    public function delete($id){
        $admin = $this->admin();
        if($admin['akses'] == 1){
            $this->User_model->delete($id);
        }
        else{
            $this->session->set_flashdata('notif','Anda tidak memiliki akses!');
            redirect('user');
        }
    }

    public function akses($id,$akses){
        if($akses == 0){
            $this->db->update('admin',['akses' => 1],['id' => $id]);
            $this->session->set_flashdata('flash','Akses berhasil diberikan!');
            redirect('user');
        }else{
            $this->db->update('admin',['akses' => 0],['id' => $id]);
            $this->session->set_flashdata('flash','Akses berhasil dihapus!');
            redirect('user');
        }
    }
}

?>