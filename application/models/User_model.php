<?php 


class User_model extends CI_Model{


    public function getUser($id){
        return $this->db->get_where('admin',['id !=' => $id ])->result_array();
    }

    public function getById($id){
        return $this->db->get_where('admin',['id' => $id])->row_array();
    }

    public function add(){
        $id = htmlspecialchars($this->input->post('id', true));
        $data = [
            'id' => $id,
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'hp' => htmlspecialchars($this->input->post('hp')),
            'email' => htmlspecialchars($this->input->post('email')),
            'akses' => htmlspecialchars($this->input->post('akses')),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        ];
        $this->db->insert('admin',$data);
    }
    
    public function edit($id,$link){
        $data = [
            'id' => htmlspecialchars($this->input->post('id', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat')),
            'hp' => htmlspecialchars($this->input->post('hp')),
            'email' => htmlspecialchars($this->input->post('email')),
            'foto' => $this->upload($id,$link)
        ];
        if($this->input->post('password1') != ''){
            $data['password'] = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
        }
        if($link == 'edit'){
            $data['akses'] = htmlspecialchars($this->input->post('akses'));
        }
        $this->db->update('admin',$data,['id' => $id]);
    }

    public function delete($id){
        $user = $this->getById($id);
        $this->deleteImage($id,$user['foto']);
        $this->db->delete('admin',['id' => $id]);
    }

    public function deleteImage($id,$foto){
        if ($foto != 'default.jpg') {
            array_map('unlink', glob("./assets/img/$id.*"));
        }
    }

    public function upload($id,$link){
        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 2048;
        $config['overwrite']            = true;
        $config['file_name']            = $id;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('foto')){
            if($this->input->post('foto_lama')){
                return $this->input->post('foto_lama');
            }
            else{
                $error = array('error' => $this->upload->display_errors());
                $this->load->library('session');
                $this->session->set_flashdata('flash', $error['error']);
                redirect(base_url('user/').$link.'/'.$id);
            }
        }
        else{
            return $this->upload->data('file_name');
        }
    }

    function getPassword($email){
        $this->load->helper('string');
        $pass = random_string('alnum',8);
        $data['password'] = password_hash($pass,PASSWORD_DEFAULT);
        $this->db->update('admin',$data,['email' => $email]);
        return $pass;
    }
}

?>