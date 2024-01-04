<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarperawat extends CI_Controller {

	public function index() {
		$data = array(
			'title' => "Daftar perawat",
			'menu' => "Daftar perawat"
		);

		$data['perawat'] = $this->db->get_where('bidan', ['ket' => 'p'])->result_array();

        $query = $this->db->query("SELECT MAX(kode_bidan) as m_perawat from bidan");
        $da = $query->row();
        $data['kode'] = $da->m_perawat;

		$this->load->view('masterdata/perawat/index', $data);
	}


    public function store()
    {
        

            $data = [
                'kode_bidan' => htmlspecialchars($this->input->post('kode_perawat', true)),
                'nama_bidan' => htmlspecialchars(strtoupper($this->input->post('nama_perawat', true))),
                'ket' => 'p'
            ];

            // var_dump($data);


            $this->db->insert('bidan', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Ditambah!</div>');
            redirect('masterdata/daftarperawat/index');
        
    }

    public function editPerawat($id)
    {
        
            $nama = strtoupper($this->input->post('nama_perawat'));


            $this->db->set(['nama_perawat' => $nama]);
            $this->db->where('id', $id);
            $this->db->update('bidan');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diupdate!</div>');
            redirect('masterdata/daftarperawat/index');
        
    }

	public function hapusPerawat($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bidan');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');
        redirect('masterdata/daftarperawat/index');
    }

}
