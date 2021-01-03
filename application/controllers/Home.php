<?php 
class Home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        admin_check();
    }

    private function admin(){
        $admin = $this->session->userdata('admin');
        return $this->db->get_where('admin', ['username' => $admin['username']])->row_array();
    }

    public function index(){
        $data = [
            'title' => 'Home',
            'admin' => $this->admin(),
            'klien' => $this->db->count_all_results('klien'),
            'pengorder' => $this->db->count_all_results('pengorder'),
            'user' => $this->db->count_all_results('admin'),
            'ppat' => $this->db->count_all_results('ppat'),
            'akta' => $this->db->count_all_results('akta'),
            'berkas' => $this->db->count_all_results('berkas'),
            'rekap' => $this->db->count_all_results('rekap'),
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit_profil($id){

    }
}

?>