<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarjasa extends CI_Controller {

	public function index() {
		$data = array(
			'title' => "Daftar Jasa",
			'menu' => "Daftar Jasa"
		);

        $this->db->select('*');
        $this->db->from('jasa');
        $this->db->where_in('ket', array('A', 'J'));
        $data['jasa'] = $this->db->get()->result_array();

		$this->load->view('masterdata/jasa/index', $data);
	}


    public function addJasa()
    {
        $data = array(
			'title' => "Tambah Jasa",
			'menu' => "Tambah Jasa"
		);


		$this->load->view('masterdata/jasa/addjasa', $data);
    }

    public function store()
    {

        $kode = $this->input->post('kode');
        $ket = $this->input->post('ket');
        $harga = $this->input->post('harga');
        $fee = $this->input->post('fee');
        $fix = preg_replace("/[^0-9]/", "", $harga);
        $namaupper = strtoupper($this->input->post('nama', true));

        $inisial = substr($namaupper, 0, 3);
        $feedok = floatval($fix)*(floatval($fee)/100);

        $this->db->select('*');
        $this->db->from('jasa');
        $this->db->where('ket', 'J');
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get()->result_array();

        $l = $query[0];
        $kodeDB = $l['kode'];
        $nourutdb = substr($kodeDB, 4, 4);
        $init = $nourutdb +1;
        
        $nourutbaru = sprintf("%04s", $init);

        $fixfee = '';
        $persen = '';
        $keterangan = '';
        if($ket == 'Konsultasi'){
            $fixfee = floatval($fix)*(floatval($fee)/100);
            $persen = $fee;
            $keterangan = 'J';
        } else if ($ket == 'Jasa'){
            $fixfee = floatval($fix)*(floatval($fee)/100);
            $persen = $fee;
            $keterangan = 'J';
        } else if( $ket == 'Tindakan Tanpa Alat' ) {
            $fixfee = $fee;
            $keterangan = 'J';
        } else if( $ket == 'Tindakan Dengan Alat' ) {
            $fixfee = $fee;
            $keterangan = 'J';
        } else if( $ket == 'Tindakan Gigi' ) {
            $fixfee = $fee;
            $keterangan = 'J';
        } else if( $ket == 'Home Visit' ) {
            $fixfee = $fee;
            $keterangan = 'J';
        } else if( $ket == 'Administrasi' ){
            $keterangan = 'A';
        }

            $data = [
                'kode' => 'Z'.$inisial. $nourutbaru,
                'nama' => htmlspecialchars($namaupper),
                'harga_jasa' => htmlspecialchars($fix),
                'ket' => $keterangan,
                'fee' => htmlspecialchars($fixfee),
                'persen' => htmlspecialchars($persen),
                'induk' => htmlspecialchars($this->input->post('ket', true)),
            ];

            // var_dump($data);


            $this->db->insert('jasa', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Ditambah!</div>');
            redirect('masterdata/daftarjasa/index');
        
    }

    public function editJasa($id)
    { 
        
            $kode = $this->input->post('kode');
            $nama = $this->input->post('nama');
            $ket = $this->input->post('ket');
            $harga = $this->input->post('hargae');
            $fix = preg_replace("/[^0-9]/", "", $harga);
            $fee = $this->input->post('fee');
            $namaupper = strtoupper($this->input->post('nama', true));

            $inisial = substr($namaupper, 0, 3);

            $cariKode = $this->db->get_where('jasa', ['kode' => $kode])->row_array();


            $this->db->select('*');
            $this->db->from('jasa');
            $this->db->where('ket', 'J');
            $this->db->order_by('id','DESC');
            $this->db->limit(1);
            $query = $this->db->get()->result_array();

            $l = $query[0];
            $kodeDB = $l['kode'];
            $nourutdb = substr($kodeDB, 4, 4);
            $init = $nourutdb +1;
            
            $nourutbaru = sprintf("%04s", $init);   

            $feedok = $harga*($fee/100);

            $fixKode = '';
            if($kode !== $cariKode['kode']){
                $fixKode = $nourutbaru;
            } else {
                $fixKode = $kode;
            }

            $fixfee = '';
            $persen = '';
            $keterangan = '';
            if($ket == 'Konsultasi'){
                $fixfee = floatval($fix)*(floatval($fee)/100);
                $persen = $fee;
                $keterangan = 'J';
            } else if( $ket == 'Jasa' ) {
                $fixfee = floatval($fix)*(floatval($fee)/100);
                $persen = $fee;
                $keterangan = 'J';
            } else if( $ket == 'Tindakan Tanpa Alat' ) {
                $fixfee = $fee;
                $keterangan = 'J';
            } else if( $ket == 'Tindakan Dengan Alat' ) {
                $fixfee = $fee;
                $keterangan = 'J';
            } else if( $ket == 'Tindakan Gigi' ) {
                $fixfee = $fee;
                $keterangan = 'J';
            } else if( $ket == 'Home Visit' ) {
                $fixfee = $fee;
                $keterangan = 'J';
            } else if( $ket == 'Administrasi' ){
                $keterangan = 'A';
            }
            $update = array(
                'kode' => $fixKode, 
                'nama' => $nama, 
                'harga_jasa' => $fix, 
                'fee' => $fixfee,
                'persen' => $persen,
                'induk' => $ket
            );
            // var_dump($update);
            $this->db->set($update);
            $this->db->where('id', $id);
            $this->db->update('jasa');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diupdate!</div>');
            redirect('masterdata/daftarjasa/index');
        
    }

    public function deleteJasa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jasa');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');
        redirect('masterdata/daftarjasa/index');
    }

}


