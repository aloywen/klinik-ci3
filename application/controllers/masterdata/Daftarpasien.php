<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarpasien extends CI_Controller {

	public function index() {
		$data = array(
			'title' => "Daftar Pasien",
			'menu' => "Daftar Pasien"
		);

        $data['pasien'] = $this->db->get('pasien')->result_array();

		$this->load->view('masterdata/pasien/index', $data);
	}
 
	public function addPasien() {
		$data = array(
			'title' => "Tambah Pasien",
			'menu' => "Tambah Pasien"
		);

        $query = $this->db->query("SELECT MAX(medical_record) as m_record from pasien");
        $da = $query->row();
        $data['kode_record'] = $da->m_record;
 
        // var_dump($daa);
        $data['tgl'] = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
        $data['bulan'] = [1,2,3,4,5,6,7,8,9,10,11,12];

		$this->load->view('masterdata/pasien/addpasien', $data);
	}

  
    public function store()
    {

        date_default_timezone_set('Asia/Jakarta');
        // $namaupper = strtoupper($this->input->post('nama_pasien', true));
        // $alamatupper = strtoupper($this->input->post('alamat', true));
                                
        $tgl = date('Y-m-d');
 
            $data = [
                'medical_record' => htmlspecialchars($this->input->post('m_record', true)),
                'nama_pasien' => htmlspecialchars(strtoupper($this->input->post('nama_pasien', true))),
                'alamat' => htmlspecialchars(strtoupper($this->input->post('alamat', true))),
                'kota' => htmlspecialchars(strtoupper($this->input->post('kota', true))),
                'kode_area' => htmlspecialchars($this->input->post('kode_area', true)),
                'kontak' => htmlspecialchars($this->input->post('telepon', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'bln_lahir' => htmlspecialchars($this->input->post('bln_lahir', true)),
                'tahun_lahir' => htmlspecialchars($this->input->post('tahun_lahir', true)),
                'kelamin' => htmlspecialchars($this->input->post('kelamin', true)),
                'kebangsaan' => htmlspecialchars(strtoupper($this->input->post('kebangsaan', true))),
                'ktp' => htmlspecialchars($this->input->post('ktp', true)),
                'agama' => htmlspecialchars(strtoupper($this->input->post('agama', true))),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'tgl_masuk' => htmlspecialchars($tgl),
                'status' => htmlspecialchars($this->input->post('status', true)),
                'pekerjaan' => htmlspecialchars(strtoupper($this->input->post('pekerjaan', true))),
                'perusahaan' => htmlspecialchars(strtoupper($this->input->post('perusahaan', true))),
            ];

            // var_dump($data);


            $this->db->insert('pasien', $data);

            redirect('masterdata/daftarpasien/index');
        
    }

    public function edit($rm) {
		$data = array(
			'title' => "Edit Pasien",
			'menu' => "Edit Pasien"
		);

        $data['pasien'] = $this->db->get_where('pasien', ['medical_record' => $rm])->row_array();

        $data['bidan'] = $this->db->get('bidan')->result_array();
        $data['dokter'] = $this->db->get('dokter')->result_array();
        // var_dump($daa);
        $data['tgl'] = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
        $data['bulan'] = [1,2,3,4,5,6,7,8,9,10,11,12];

		$this->load->view('masterdata/pasien/editpasien', $data);
	}

    public function deletePasien($id)
    {
        $this->db->where('medical_record', $id);
        $this->db->delete('pasien');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');
        redirect('masterdata/daftarpasien/index');
    }
 
    public function editPasien($id)
    {
        // var_dump($id);
        $namaupper = strtoupper($this->input->post('nama_pasien', true));

        $data = [
            'medical_record' => htmlspecialchars($this->input->post('m_record', true)),
            'nama_pasien' => $namaupper,
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'kota' => htmlspecialchars($this->input->post('kota', true)),
            'kode_area' => htmlspecialchars($this->input->post('kode_area', true)),
            'kontak' => htmlspecialchars($this->input->post('telepon', true)),
            'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
            'bln_lahir' => htmlspecialchars($this->input->post('bln_lahir', true)),
            'tahun_lahir' => htmlspecialchars($this->input->post('tahun_lahir', true)),
            'kelamin' => htmlspecialchars($this->input->post('kelamin', true)),
            'kebangsaan' => htmlspecialchars($this->input->post('kebangsaan', true)),
            'ktp' => htmlspecialchars($this->input->post('ktp', true)),
            'agama' => htmlspecialchars($this->input->post('agama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'tgl_masuk' => htmlspecialchars($this->input->post('tgl_masuk', true)),
            'status' => htmlspecialchars($this->input->post('status', true)),
            'pekerjaan' => htmlspecialchars($this->input->post('pekerjaan', true)),
            'perusahaan' => htmlspecialchars($this->input->post('perusahaan', true)),
        ];

        var_dump($data);
        
        $this->db->set($data);
        $this->db->where('medical_record', $id);
        $this->db->update('pasien');
        
        redirect('masterdata/daftarpasien/index');
        
    }

}
