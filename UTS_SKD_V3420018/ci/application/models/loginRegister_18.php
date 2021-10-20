<?php
class loginRegister_18 extends CI_Model
{
    public $table_user = 'tb_user';
    public $table_siswa = 'tb_siswa';
    public $id_user = 'id';

    function tambah_user($data)
    {
        return $this->db->insert($this->table_user, $data);
    }
    public function ambil_data()
    {
        return $this->db->get($this->table_siswa)->result();
    }
    function tambah_siswa($data)
    {
        return $this->db->insert($this->table_siswa, $data);
    }
}
