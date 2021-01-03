<?php 

class Pengorder_model extends CI_Model{

    public function getById($id){
        return $this->db->get_where('pengorder',['id' => $id])->row_array();
    }

    public function add(){
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'hp' => $this->input->post('hp'),
        ];
        $this->db->insert('pengorder',$data);
    }
    public function edit($id){
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'hp' => $this->input->post('hp'),
        ];
        $this->db->update('pengorder',$data,['id' => $id]);
    }

    public function delete($id){
        $this->db->delete('pengorder',['id' => $id]);
    }


}

?>