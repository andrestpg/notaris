<?php 

class Klien_model extends CI_Model{

    public function getById($id){
        return $this->db->get_where('klien',['id' => $id])->row_array();
    }

    public function add(){
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'hp' => $this->input->post('hp'),
        ];
        $this->db->insert('klien',$data);
    }
    public function edit($id){
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'hp' => $this->input->post('hp'),
        ];
        $this->db->update('klien',$data,['id' => $id]);
    }

    public function delete($id){
        $this->db->delete('klien',['id' => $id]);
    }


}

?>