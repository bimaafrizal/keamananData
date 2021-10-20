<?php
class admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('loginRegister_18');
    }
    public function index()
    {
        $data = $this->loginRegister_18->ambil_data();
        $arrayData = array(
            'datas' => $data
        );
        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar');
        $this->load->view('admin/Main/main', $arrayData);
        $this->load->view('admin/Nav/footer');
    }

    public function tambah_siswa()
    {
        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar');
        $this->load->view('admin/Main/tambahSiswa');
        $this->load->view('admin/Nav/footer');
    }
    public function proses_tambah()
    {
        $namaSiswa = $this->input->post('namaSiswa');
        $nik = $this->input->post('nik');
        $alamat = $this->input->post('alamat');

        $enkripsiNik = $this->encryptPass($nik);
        $enkripsiAlamat = $this->encryptPass($alamat);

        $data = [
            'namaSiswa' => $namaSiswa,
            'nik' => $enkripsiNik,
            'alamat' => $enkripsiAlamat
        ];
        $this->loginRegister_18->tambah_siswa($data);
        redirect('admin');
    }
    private function encryptPass($data)
    {
        $sSalt = '20adeb83e85f03cfc84d0fb7e5f4d290';
        $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
        $method = 'aes-256-cbc';

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        $encrypted = base64_encode(openssl_encrypt($data, $method, $sSalt, OPENSSL_RAW_DATA, $iv));
        return $encrypted;
    }
    private function decryptPass($data)
    {
        $sSalt = '20adeb83e85f03cfc84d0fb7e5f4d290';
        $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
        $method = 'aes-256-cbc';

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        $decrypted = openssl_decrypt(base64_decode($data), $method, $sSalt, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }

    public function tampil_data()
    {
        $data = $this->loginRegister_18->ambil_data();
        // $enkripNik = $this->decryptPass($data->nik);
        // $enkripAlamat = $this->decryptPass($data->alamat);
        $arrayData = array(
            'datas' => $data,
            // 'enkripAlamat' => $enkripAlamat,
            // 'enkripNik' => $enkripNik
        );

        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar');
        $this->load->view('admin/Main/tampilSemua', $arrayData);
        $this->load->view('admin/Nav/footer');
    }
}
