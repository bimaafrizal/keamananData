<?php
class register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('loginRegister_18');
    }

    public function index()
    {
        $this->load->view('login/view_register_18');
    }

    public function proses_register()
    {
        //ambil form
        $email = $this->input->post('email');
        $namaPengguna =  $this->input->post('namaPengguna');
        $password =  $this->input->post('password');
        $konfirmpassword =  $this->input->post('konfirmPassword');

        if (($email != '') and ($namaPengguna != '') and ($password != '') and ($konfirmpassword != '')) {
            $sql = $this->db->query("SELECT user FROM tb_user where user='$email'");
            $tes_duplikat = $sql->num_rows();
            if ($tes_duplikat > 0) {
                $this->session->set_flashdata('message', 'Email Sudah digunakan sebelumnya');
                $data['perans'] = $this->loginRegister_18->get_perans();
                redirect('register_18');
            } else {
                if ($password == $konfirmpassword) {
                    $data = [
                        'user' => $email,
                        'namaPengguna' => $namaPengguna,
                        'password' => password_hash($password, PASSWORD_DEFAULT)
                    ];

                    //tambah ke database user
                    $this->loginRegister_18->tambah_user($data);
                    redirect('login');
                } else {
                    $data['pesan'] = 'password yang anda masukan harus sama';
                    $this->load->view('login/view_register_18');
                }
            }
        }
    }
}
