<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapkunjungan extends CI_Controller {

    public function index() {
		$data = array(
			'title' => "Laporan Kunjungan Harian",
			'menu' => "Laporan Kunjungan Harian"
		);

		// $data['item'] = $this->db->get('pembelian')->result_array();

		$this->load->view('masterdata/lapkunjungan/index', $data);
	}

	public function store()
    {
        $tgl_dari = $this->input->post('tgl_dari');
        $tgl_sampai = $this->input->post('tgl_sampai');


        $data['pasien'] = $this->db->get_where('transaksi_pasien', ['tgl_kwitansi >=' => $tgl_dari, 'tgl_kwitansi <=' => $tgl_sampai])->result_array();

        $data = [
            'satuan' => htmlspecialchars($this->input->post('satuan', true)),
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true))
        ];

        // var_dump($dataa);


        // $this->db->insert('daftar_satuan', $data);

        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Berhasil Ditambah!</div>');
        $this->session->set_flashdata('item', $data);

        redirect('masterdata/lapkunjungan/print');
        
    }

    public function print()
    {

        $tgl_dari = $this->input->post('tgl_dari');
        $tgl_sampai = $this->input->post('tgl_sampai');

        // $d = date('Y-m-d 07:00:00', strtotime($tgl_dari));
        // $s = date('Y-m-d 07:00:00', strtotime($tgl_sampai));

        // var_dump($d, $s);

        $data['tgl'] = $tgl_dari;

        $data['pasien'] = $this->db->get_where('transaksi_pasien', ['tgl_kwitansi >=' => $tgl_dari, 'tgl_kwitansi <=' => $tgl_sampai])->result_array();

        $this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('pasien', 'pasien.medical_record = transaksi_pasien.medical_record');
        $this->db->where('transaksi_pasien.tgl_kwitansi >=', $tgl_dari); 
        $this->db->where('transaksi_pasien.tgl_kwitansi <=', $tgl_sampai);
        $this->db->where('transaksi_pasien.posting', 'belum'); 
        $data['pasien'] = $this->db->get()->result_array();

        $this->db->select_sum('grand_total');
        $this->db->from('transaksi_pasien');
        $this->db->join('pasien', 'pasien.medical_record = transaksi_pasien.medical_record');
        $this->db->where('transaksi_pasien.tgl_kwitansi >=', $tgl_dari); 
        $this->db->where('transaksi_pasien.tgl_kwitansi <=', $tgl_sampai); 
        
        $data['total'] = $this->db->get()->row_array();

		$this->load->view('masterdata/lapkunjungan/print', $data);
        
    }

}