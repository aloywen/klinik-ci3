<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarobat extends CI_Controller {

	public function index() {
		$data = array(
			'title' => "Daftar Obat",
			'menu' => "Daftar Obat"
		);

        $this->db->select('*');
        $this->db->from('jasa');
        $this->db->where_in('ket', 'O');
        $data['jasa'] = $this->db->get()->result_array();

		$this->load->view('masterdata/obat/index', $data);
	}


    public function store()
    {

        $namaupper = strtoupper($this->input->post('nama', true));

        $inisial = substr($namaupper, 0, 3);
        // $feedok = $fix*($fee/100);

        // $query = $this->db->query("SELECT MAX(kode) as m_kode from jasa where ket='J' order by id asc");
        // $da = $query->row();
        // $kodeTerakhir = $da->m_kode;
        $this->db->select('*');
        $this->db->from('jasa');
        $this->db->where('ket', 'O');
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get()->result_array();

        $l = $query[0];
        $kodeDB = $l['kode'];
        $nourutdb = substr($kodeDB, 4, 4);
        $init = $nourutdb +1;
        
        $nourutbaru = sprintf("%08s", $init);


            $data = [
                'kode' => $nourutbaru,
                'nama' => htmlspecialchars($namaupper),
                'ket' => 'O'
            ];
            $this->db->insert('jasa', $data);
            
            $tambah = [
                'kode_obat' => $nourutbaru,
                'stok' => 0
            ];
            $this->db->insert('stok_akhir', $tambah);

            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Berhasil Ditambah!</div>');
            redirect('masterdata/daftarobat');
        
    }

    public function editObat($id)
    {
        
        $namaupper = strtoupper($this->input->post('nama', true));



            $this->db->set(['nama' => $namaupper]);
            $this->db->where('id', $id);
            $this->db->update('jasa');

            redirect('masterdata/daftarobat');
        
    }

    public function deleteObat($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jasa');

        redirect('masterdata/daftarobat');
    }

}


