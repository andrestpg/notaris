<?php

class Login extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->model('User_model');
        $this->load->library('email');
    }

    public function index(){
        if($this->session->userdata('admin')){
            redirect('home');
        }
        $redirectURL = '';
        if($this->session->flashdata('url')){
            $redirectURL = $this->session->flashdata('url');
        }
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == false) {
        $data['title'] = 'Login';
        $data['rURL'] = $redirectURL;
        $this->load->view('login/lg',$data);
        }
        else {
            $this->_login();
        }
    }

    private function _login(){
        $rURL = $this->input->post('url');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $admin = $this->db->get_where('admin',['username' => $username])->row_array();

        if($admin){
            if(password_verify($password,$admin['password'])){
                $data= [
                    'username' => $admin['username']
                ];
                $this->session->set_userdata('admin',$data);
                if($rURL != ''){
                    $this->session->set_flashdata('notif', 'Selamat Datang '.$admin['nama']);
                    redirect("$rURL");
                }else{
                    $this->session->set_flashdata('notif', 'Selamat Datang '.$admin['nama']);
                    redirect('home');
                }
            }
            else{
                $this->session->set_flashdata('flash','Password salah!');
                redirect('login');
            }
        }
        else{
            $this->session->set_flashdata('flash','Username tidak terdaftar');
            redirect('login');
        }
    }

    public function logout(){
        $this->session->unset_userdata('admin');
        $this->session->set_flashdata('flash','Anda telah logout!');
            redirect('login');
    }

    function checkEmail(){
        $email = $this->input->post('email');
        $admin = $this->db->get_where('admin',['email' => $email])->row_array();
        if($admin){
            echo '1';
            $this->sendMail($email);
        }
        else{
            echo '0';
        }
    }

    function sendMail($email){
        $password = $this->User_model->getPassword($email);
        $config = [
            'charset' => 'utf-8',
            'protocol' => 'smtp',
            'smtp_port' => 465,
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'andrestpg95@gmail.com',
            'smtp_pass' => 'bajingan#3',
            'mailtype' => 'text',
            'dsn' => TRUE,
        ];
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->to($email);
        $this->email->from('andrestpg95@gmail.com');
        $this->email->subject('Password Reset');
        $this->email->message('Password kamu '.$password);
        $this->email->send();
    }

}

?>