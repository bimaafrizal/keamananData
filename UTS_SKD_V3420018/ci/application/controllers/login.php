<?php
class login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('loginRegister_18');
    }

    public function index()
    {
        // $data['email'] = $this->db->get_whare();
        $this->load->view('login/view_login_18');
    }
    public function proses_login()
    {
        $user = $this->input->post('user');
        $password = $this->input->post('password');
        $cekdb = $this->db->get_where('tb_user', ['user' => $user])->row_array();

        if (($user != '') and ($password != '')) {
            if ($cekdb) {
                if (password_verify($password, $cekdb['password'])) {
                    $data = array(
                        'id_user' => $cekdb['id'],
                        'user' => $cekdb['user'],
                        'namaPengguna' => $cekdb['namaPengguna']
                    );
                    $this->session->set_userdata($data);
                    redirect('admin');
                } else {
                    //cek password tidak benar
                }
            } else {
                //cekuser ada atau tidak
            }
        } else {
            //cek disi atau tidak
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
