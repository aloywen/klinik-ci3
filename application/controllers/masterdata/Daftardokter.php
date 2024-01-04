<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftardokter extends CI_Controller {

	public function index() {
		$data = array(
			'title' => "Daftar Dokter",
			'menu' => "Daftar Dokter"
		);

		$data['dokter'] = $this->db->get('dokter')->result_array();

		$this->load->view('masterdata/dokter/index', $data);
	}


    public function store()
    {
        $query = $this->db->query("SELECT MAX(kode_dokter) as m_record from dokter");
        $da = $query->row();
        $kode = $da->m_record;

        $m_rec =  floatval($kode) + 1;

        $m_record = sprintf("%06s", $m_rec);
        
        $this->form_validation->set_rules('nama_dokter', 'Nama_dokter', 'required|trim');
        
        $nama_dokter = strtoupper($this->input->post('nama_dokter'));
        // var_dump($dr);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Daftar Dokter';
            $this->load->view('masterdata/dokter/index', $data);
        } else {
            $data = [
                'kode_dokter' => $m_record,
                'nama_dokter' => htmlspecialchars($nama_dokter, true)
            ];

            // var_dump($data);


            $this->db->insert('dokter', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Ditambah!</div>');
            redirect('masterdata/daftardokter/index');
        }
    }

    public function editDokter($id)
    {
        
            $nama = strtoupper($this->input->post('nama_dokter'));


            $this->db->set(['nama_dokter' => $nama]);
            $this->db->where('id', $id);
            $this->db->update('dokter');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diedit!</div>');
            redirect('masterdata/daftardokter/index');
        
    }

	public function deleteDokter($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('dokter');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');
        redirect('masterdata/daftardokter/index');
    }

}
