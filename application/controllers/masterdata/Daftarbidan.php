<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarbidan extends CI_Controller {

	public function index() {
		$data = array(
			'title' => "Daftar Bidan",
			'menu' => "Daftar Bidan"
		);

		$data['bidan'] = $this->db->get_where('bidan', ['ket' => 'b'])->result_array();

        $query = $this->db->query("SELECT MAX(kode_bidan) as m_bidan from bidan");
        $da = $query->row();
        $data['kode'] = $da->m_bidan;

		$this->load->view('masterdata/bidan/index', $data);
	}


    public function store()
    {
        

            $data = [
                'kode_bidan' => htmlspecialchars($this->input->post('kode_bidan', true)),
                'nama_bidan' => htmlspecialchars(strtoupper($this->input->post('nama_bidan', true))),
                'ket' => 'b'
            ];

            // var_dump($data);


            $this->db->insert('bidan', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Berhasil Ditambah!</div>');
            redirect('masterdata/daftarbidan/index');
        
    }

    public function editBidan($id)
    {
        
            $nama = strtoupper($this->input->post('nama_bidan'));


            $this->db->set(['nama_bidan' => $nama]);
            $this->db->where('id', $id);
            $this->db->update('bidan');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diedit!</div>');
            redirect('masterdata/daftarbidan/index');
        
    }

	public function hapusBidan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bidan');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');
        redirect('masterdata/daftarbidan/index');
    }

}
