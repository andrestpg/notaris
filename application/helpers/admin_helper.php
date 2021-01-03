<?php 

function admin_check(){
    $ci = get_instance();
    if(!$ci->session->userdata('admin')){
        $url = uri_string();
        $ci->session->set_flashdata('url',$url);
        redirect('login'); 
    }
}

?>