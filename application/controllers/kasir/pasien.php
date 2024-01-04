<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function index() {
		$data = array(
			'title' => "Kasir Pasien",
			'menu' => "Kasir Pasien"
		);

        $data['pasien'] = $this->db->get('pasien')->result_array();
        $data['dokter'] = $this->db->get('dokter')->result_array();
        $data['obat'] = $this->db->get('jasa')->result_array();
        $data['bidan'] = $this->db->get('bidan')->result_array();

        // $query = $this->db->query("SELECT MAX(no_kwitansi) as m_kwitansi from transaksi_pasien");
        // $da = $query->row();
        // $data['no_kwitansi'] = $da->m_kwitansi;

        // $this->db->select_max('no_kwitansi');
        // $data['no_kwitansi'] = $this->db->get('transaksi_pasien')->row_array();
        // $datt = $this->db->get('transaksi_pasien')->row_array();
        // var_dump($datt);
        
        $data['no_kwitansi'] = $this->db->order_by('id',"desc")
        ->limit(1)
        ->get('transaksi_pasien')
        ->row_array();
        // var_dump($last['no_kwitansi']);

        // $data['no_kwitansi'] = substr($no_k, 12, 9);
        // $m_register = $nourut + 1; 

        $query = $this->db->query("SELECT MAX(register) as m_register from transaksi_pasien");
        $da = $query->row();
        $data['no_register'] = $da->m_register;
        
		$this->load->view('kasir/pasien', $data);
	}

    public function cari(){
        // $kode=$_GET['kode'];
        // $cari = $this->db->get_where('pasien', ['medical_record' => $kode])->row_array();
        // echo json_encode($cari);

        $name=$_GET['name'];
        $fieldName=$_GET['fieldName'];


        $this->db->select('*');
        $this->db->from('pasien');
        $this->db->like('nama_pasien', $name);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
    }
  
    public function cariobat(){
        $name=$_GET['name'];
        $fieldName=$_GET['fieldName'];


        $this->db->select('*');
        $this->db->from('jasa');
        $this->db->like('nama', $name);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
    }

	public function store()
    {
            $grand_total = $this->input->post('grand_total');
            $fix = preg_replace("/[^0-9]/", "", $grand_total);
            $penanggung = strtoupper($this->input->post('penanggung', true));
            // $tgl = $this->input->post('tgl_kwitansi');
            // $tgl = date('Y-m-d h:i:s',$this->input->post('tgl_kwitansi'));
            date_default_timezone_set('Asia/Jakarta');
            $tgl = date('Y-m-d G:i:s');

            // var_dump($tgl);
            
        
            $e = [
                    'register' => htmlspecialchars($this->input->post('register', true)),
                    // 'register' => '01/230120/1/000000008',
                    'medical_record' => htmlspecialchars($this->input->post('kode_pasien', true)),
                    'no_kwitansi' => htmlspecialchars($this->input->post('no_kwitansi', true)),
                    // 'no_kwitansi' => '02/04/000000019',
                    'tgl_kwitansi' => $tgl,
                    'status' => htmlspecialchars($this->input->post('status', true)),
                    'jns_pasien' => htmlspecialchars($this->input->post('jns_pasien', true)),
                    'penanggung' => $penanggung,
                    'perusahaan' => htmlspecialchars($this->input->post('perusahaan', true)),
                    'asuransi' => htmlspecialchars($this->input->post('asuransi', true)),
                    'dokter' => htmlspecialchars($this->input->post('dokter', true)),
                    'bidan' => htmlspecialchars($this->input->post('bidan', true)),
                    'diagnosa' => htmlspecialchars(strtoupper($this->input->post('diagnosa', true))),
                    'icd' => htmlspecialchars($this->input->post('icd', true)),
                    'grand_total' => $fix,
                    'posting' => 'belum',
 
            ];

            
            // INSERT TRANSAKSI PASIEN
            $this->db->insert('transaksi_pasien', $e);


            $i = 0;

            $a = $this->input->post('kode');
            $b = $this->input->post('obat');
            $c = $this->input->post('qty');
            $d = $this->input->post('total_harga');
            $fee = $this->input->post('fee');
            $induk = $this->input->post('induk');
            $keterangan = $this->input->post('ket');

            date_default_timezone_set('Asia/Jakarta');
            
            // INSERT OBAT PASIEN
            foreach($a as $row){
                $dat = array(
                        'kode_obat'=> $row,
                        'no_kwitansi' => $this->input->post('no_kwitansi'),
                        'rm_pasien' => $this->input->post('kode_pasien'),
                        'dokter' => $this->input->post('dokter'),
                        'qty'=> $c[$i],
                        'total_harga'=> $d[$i],
                        'fee'=> $fee[$i]*$c[$i],
                        'tgl' => date('Y-m-d G:i:s'),
                        'ket'=> $keterangan[$i],
                        'induk'=> $induk[$i],
                        'posting'=> 'belum',
                ); 
                $i++;
                // var_dump($dat);
                
                $this->db->insert("obat_pasien",$dat);
            }

            $waktu = date('G:i:s');

            $code = '';
            
            if($waktu < '21:00:00'){
                $code = 'ZKON0002';
            };
            
            $ind = 0;
            // INSERT JASA PASIEN
            // foreach($a as $cod){
            //     if($cod == 'ZKON0002' || $cod == 'ZKON0003' || $cod == 'ZKON0003'){
                    
            //     }
            //     $jas = array(
            //         'no_kwitansi' => $this->input->post('no_kwitansi'),
            //         'rm_pasien' => $this->input->post('kode_pasien'),
            //         'dokter' => $this->input->post('dokter'),
            //         'kodejasa'=> $cod,
            //         'harga'=> $fee[$ind],
            //         'tgl' => date('Y-m-d h:i:s'),
            //         'ket'=> $keterangan[$ind],
            //     );
            //     $ind++;
            //     if($jas['ket'] == 'A' || $jas['ket'] == 'J'){
            //         $this->db->insert("jasa_pasien",$jas);
            //         // var_dump($jas);

            //     }
            // }


            // INSERT MUTASI KELUAR
            // $no = 0;
            // foreach($a as $k){
            //     $tran = array(
            //         'nomor_transaksi' => $this->input->post('no_kwitansi'),
            //         'jns_transaksi' => 'KELUAR',
            //         'tgl_transaksi' => date('Y-m-d G:i:s'),
            //         'kode_obat'=> $k,
            //         'keluar'=> $c[$no],
            //         'ket'=> $keterangan[$no],
            //     );
            //     $no++;
            //     if($tran['ket'] == 'O'){
            //         $this->db->insert("mutasi",$tran);
            //     }
            // }
            


            $ket = $this->input->post('ket');
            $kodejasa = $this->input->post('kode');
            
            // // INSERT FEE DOKTER
            // $in = 0;
            // foreach($kodejasa as $r){
            //     $fee = array(
            //         'kode_jasa'=> $r,
            //         'dokter' => $this->input->post('dokter'),
            //         'ket'=> $ket[$in],
            //         'tgl' => date('Y-m-d h:i:s'),
            //     );
            //     $in++;
            //     if($fee['ket'] == 'J'){
            //         $this->db->insert("fee_dokter",$fee);
            //     }
            // }
            


            
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi Berhasil!</div>');
            $this->session->set_flashdata('item', $dat);
            $this->session->set_flashdata('items', $e);
            redirect('kasir/pasien/print', $data);
        
    }

    public function print()
    {

        $dat = $this->session->flashdata('item');
        $t_pasien = $this->session->flashdata('items');

        $this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('obat_pasien', 'obat_pasien.no_kwitansi = transaksi_pasien.no_kwitansi', 'left');
        $this->db->join('jasa', 'jasa.kode = obat_pasien.kode_obat', 'left');
        // $this->db->where('obat_pasien.ket', 'A'); 
        $this->db->where('obat_pasien.ket', 'J'); 
        $this->db->where('obat_pasien.no_kwitansi', $t_pasien['no_kwitansi']); 
        $data['jasa'] = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('obat_pasien', 'obat_pasien.no_kwitansi = transaksi_pasien.no_kwitansi', 'left');
        $this->db->join('jasa', 'jasa.kode = obat_pasien.kode_obat', 'left');
        $this->db->where('obat_pasien.no_kwitansi', $t_pasien['no_kwitansi']); 
        $data['data_obat'] = $this->db->get()->result_array();

        $this->db->select_sum('total_harga');
        $this->db->where('ket', 'O');
        $this->db->where('no_kwitansi', $t_pasien['no_kwitansi']);
        $query = $this->db->get('obat_pasien')->result_array();
        $data['total_obat'] = $query[0];
        

        // $this->db->select('*');
        // $this->db->from('jasa');
        // $this->db->join('jasa_pasien', 'jasa_pasien.kodejasa = jasa.kode');
        // $this->db->where('jasa_pasien.no_kwitansi', $t_pasien['no_kwitansi']); 
        // $data['jasa'] = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('bidan', 'bidan.kode_bidan = transaksi_pasien.bidan');
        $this->db->where('transaksi_pasien.no_kwitansi', $t_pasien['no_kwitansi']); 
        $data['bidan'] = $this->db->get()->row_array();


        $this->db->select('*');
        $this->db->from('dokter');
        $this->db->join('transaksi_pasien', 'transaksi_pasien.dokter = dokter.kode_dokter');
        $this->db->join('pasien', 'pasien.medical_record = transaksi_pasien.medical_record');
        $this->db->where('transaksi_pasien.no_kwitansi', $t_pasien['no_kwitansi']); 
        $this->db->where('transaksi_pasien.medical_record', $t_pasien['medical_record']); 
        $data['data_pasien'] = $this->db->get()->row_array();


        // var_dump($l);
        
        $this->load->view('kasir/print', $data);
    }

    public function printulang($no, $rm)
    {

        $contoh1 = substr_replace($no, '/', 2, 0);
        $contoh2 = substr_replace($contoh1, '/', 5, 0);

        $this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('obat_pasien', 'obat_pasien.no_kwitansi = transaksi_pasien.no_kwitansi', 'left');
        $this->db->join('jasa', 'jasa.kode = obat_pasien.kode_obat', 'left');
        $this->db->where('obat_pasien.no_kwitansi', $contoh2); 
        $data['data_obat'] = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('obat_pasien', 'obat_pasien.no_kwitansi = transaksi_pasien.no_kwitansi', 'left');
        $this->db->join('jasa', 'jasa.kode = obat_pasien.kode_obat', 'left');
        // $this->db->where('obat_pasien.ket', 'A'); 
        $this->db->where('obat_pasien.ket', 'J'); 
        $this->db->where('obat_pasien.no_kwitansi', $contoh2); 
        $data['jasa'] = $this->db->get()->result_array();

        $this->db->select_sum('total_harga');
        $this->db->where('ket', 'O');
        $this->db->where('no_kwitansi', $contoh2);
        $query = $this->db->get('obat_pasien')->row_array();
        $data['total_obat'] = $query['total_harga'];
        

        $this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('bidan', 'bidan.kode_bidan = transaksi_pasien.bidan');
        $this->db->where('transaksi_pasien.no_kwitansi', $contoh2); 
        $data['bidan'] = $this->db->get()->row_array();


        $this->db->select('*');
        $this->db->from('dokter');
        $this->db->join('transaksi_pasien', 'transaksi_pasien.dokter = dokter.kode_dokter');
        $this->db->join('pasien', 'pasien.medical_record = transaksi_pasien.medical_record');
        $this->db->where('transaksi_pasien.no_kwitansi', $contoh2); 
        $this->db->where('transaksi_pasien.medical_record', $rm); 
        $data['data_pasien'] = $this->db->get()->row_array();

        
        // $this->db->select('*'); 
        // $this->db->from('jasa');
        // $this->db->join('jasa_pasien', 'jasa_pasien.kodejasa = jasa.kode');
        // $this->db->where('jasa_pasien.no_kwitansi', $contoh2); 
        // $data['jasa'] = $this->db->get()->result_array();

        // var_dump($jasa);
        // var_dump('<br/>');
        // var_dump($dataaa);
        
        $this->load->view('kasir/printulang', $data);
    }

    public function riwayatpasien()
    {
        $data = array(
			'title' => "Riwayat Pasien",
			'menu' => "Riwayat Pasien"
		);

        $datet = new DateTime('tomorrow');
        $data['besok'] = $datet->format('d-m-Y');

		$this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('pasien', 'pasien.medical_record = transaksi_pasien.medical_record');
        // $this->db->join('obat_pasien', 'obat_pasien.no_kwitansi = transaksi_pasien.no_kwitansi');
        $this->db->where('transaksi_pasien.posting', 'belum');
        $data['item'] = $this->db->get()->result_array();

		$this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('obat_pasien', 'obat_pasien.no_kwitansi = transaksi_pasien.no_kwitansi');
        $this->db->where('transaksi_pasien.posting', 'belum');
        $cariO = $this->db->get()->result_array();

        // var_dump($cariO);

		$this->load->view('kasir/riwayatpasien', $data);
    
    }

    public function historytransaksi()
    {
        $data = array(
			'title' => "History Semua Transaksi",
			'menu' => "History Semua Transaksi"
		);

		$this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('pasien', 'pasien.medical_record = transaksi_pasien.medical_record');
        $this->db->where('transaksi_pasien.posting', 'sudah');
        $data['item'] = $this->db->get()->result_array();

		$this->load->view('kasir/historytransaksi', $data);
    
    }

    public function detail($no)
    {

        $data = array(
			'title' => "Detail Transaksi pasien",
			'menu' => "Detail Transaksi pasien"
		);

        $contoh1 = substr_replace($no, '/', 2, 0);
        $contoh2 = substr_replace($contoh1, '/', 5, 0);

        // $this->db->select('*');
        // $this->db->from('jasa_pasien');
        // $this->db->join('jasa', 'jasa.kode = jasa_pasien.kode_obat', 'left');
        // $this->db->join('jasa_pasien', 'jasa_pasien.kodejasa = jasa.kode', 'left');
        // $this->db->where('jasa_pasien.no_kwitansi', $contoh2); 
        // $data['jasa'] = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('obat_pasien');
        $this->db->join('transaksi_pasien', 'transaksi_pasien.no_kwitansi = obat_pasien.no_kwitansi', 'left');
        $this->db->join('jasa', 'jasa.kode = obat_pasien.kode_obat', 'left');
        // $this->db->join('jasa_pasien', 'jasa_pasien.no_kwitansi = transaksi_pasien.no_kwitansi', 'left');
        $this->db->where('obat_pasien.no_kwitansi', $contoh2);  
        $data['obat'] = $this->db->get()->result_array();
        // $this->db->select('*');
        // $this->db->from('obat_pasien');
        // $this->db->join('jasa', 'jasa.kode = obat_pasien.kode_obat', 'left');
        // $this->db->join('jasa_pasien', 'jasa_pasien.kodejasa = jasa.kode', 'left');
        // $this->db->where('obat_pasien.no_kwitansi', $contoh2);  
        // $data['obat'] = $this->db->get()->result_array();
 
        $this->db->select('*');
        $this->db->from('transaksi_pasien');
        $this->db->join('pasien', 'pasien.medical_record = transaksi_pasien.medical_record', 'left');
        $this->db->join('dokter', 'dokter.kode_dokter = transaksi_pasien.dokter', 'left');
        $this->db->join('bidan', 'bidan.kode_bidan = transaksi_pasien.bidan', 'left');
        $this->db->where('transaksi_pasien.no_kwitansi', $contoh2); 
        $data['transaksi'] = $this->db->get()->row_array();

        $data['dokter'] = $this->db->get('dokter')->result_array();
        $data['bidan'] = $this->db->get('bidan')->result_array();

        // $data['transaksi'] = $this->db->get_where('transaksi_pasien', ['no_kwitansi' => $contoh2])->row_array();

        // var_dump($obat);
		$this->load->view('kasir/detailpasien', $data);
        
    }

    public function editKasir($no)
    {
        $no_kwitansi = $this->input->post('no_kwitansi');
        $a = $this->input->post('kode');
        $b = $this->input->post('obat');
        $c = $this->input->post('qty');
        $d = $this->input->post('total_harga');
        $fee = $this->input->post('fee');
        $keterangan = $this->input->post('ket');
        $status = $this->input->post('status');
        $jns_pasien = $this->input->post('jns_pasien');
        $penanggung = $this->input->post('penanggung');
        $perusahaan = $this->input->post('perusahaan');
        $asuransi = $this->input->post('asuransi');
        $diagnosa = $this->input->post('diagnosa');
        $ics = $this->input->post('ics');
        $grand_total = $this->input->post('grand_total');
        $induk = $this->input->post('induk');
        $tempDokter = $this->input->post('kode_dokter');
        $newDokter = $this->input->post('dokter');
        $idDokter = substr($newDokter, 0, 6);
        $tempBidan = $this->input->post('kode_bidan');
        $newBidan = $this->input->post('bidan');
        $idBidan = substr($newBidan, 0, 6);

        $dokter = '';
        if($tempDokter == $newDokter){
            $dokter = $tempDokter;
        } else if ( $tempDokter !== $newDokter){
            $dokter = $idDokter;
        }
        $bidan = '';
        if($tempBidan == $newBidan){
            $bidan = $tempBidan;
        } else if ( $tempBidan !== $newBidan){
            $bidan = $idBidan;
        }

        $this->db->where('no_kwitansi', $no_kwitansi);
        $this->db->delete('obat_pasien');

        $totalHargaa = preg_replace("/[^0-9]/", "", $d);
        $fix = preg_replace("/[^0-9]/", "", $grand_total);

            // var_dump($idDokter);
        
        // foreach($a as $row){
        //     date_default_timezone_set('Asia/Jakarta');
        //     $data = array(
        //         'kode_obat'=> $row,
        //         'no_kwitansi' => $this->input->post('no_kwitansi'),
        //         'rm_pasien' => $this->input->post('kode_pasien'),
        //         'dokter' => $this->input->post('kode_dokter'),
        //         'qty'=> $c[$i],
        //         'total_harga'=> $d[$i],
        //         'fee'=> $fee[$i],
        //         'tgl' => date('Y-m-d'),
        //         'ket'=> $keterangan[$i],
        //     ); 
        //     $i++;
        //     $this->db->insert("obat_pasien",$data);
        // }

        $i = 0; 
        // INSERT OBAT PASIEN
        foreach($a as $row){
            $dat = array(
                    'kode_obat'=> $row,
                    'no_kwitansi' => $this->input->post('no_kwitansi'),
                    'rm_pasien' => $this->input->post('kode_pasien'),
                    'dokter' => $dokter,
                    'qty'=> $c[$i],
                    'total_harga'=> $totalHargaa[$i],
                    'fee'=> $fee[$i]*$c[$i],
                    'tgl' => date('Y-m-d G:i:s'),
                    'ket'=> $keterangan[$i],
                    'induk'=> $induk[$i],
                    'posting'=> 'belum',
            ); 
            $i++;
            // var_dump($dat);
            
            $this->db->insert("obat_pasien",$dat);
        }

        $this->db->set(['medical_record' => $this->input->post('kode_pasien'), 'status' => $status, 'jns_pasien' => $jns_pasien, 'penanggung' => $penanggung, 'perusahaan' => $perusahaan, 'asuransi' => $asuransi, 'dokter' => $dokter, 'bidan' => $bidan, 'diagnosa' => $diagnosa, 'icd' => $icd, 'grand_total' => $fix]);
        $this->db->where('no_kwitansi', $no_kwitansi);
        $this->db->update('transaksi_pasien');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi Berhasil Diupdate!</div>');
        redirect('kasir/pasien/riwayatpasien');
    }

    public function deleteTransaksi($no_kwitansi)
    {
        // $fix = preg_replace("/[^0-9]/", "", $no_kwitansi);

        $tambahgaring1 = substr_replace($no_kwitansi, '/', 2, 0);
        $fix_kwitansi = substr_replace($tambahgaring1, '/', 5, 0);
        // var_dump($contoh2);
        $this->db->where('no_kwitansi', $fix_kwitansi);
        $this->db->delete('obat_pasien');

        $this->db->where('no_kwitansi', $fix_kwitansi);
        $this->db->delete('transaksi_pasien');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');
        redirect('kasir/pasien/riwayatpasien');
    }

    public function ksjask() {
        $this->db->set(['posting' => 'belum']);
        $this->db->where('no_kwitansi >=', '10/27/325');
        $this->db->where('no_kwitansi <=', '10/27/365');
        $this->db->update('obat_pasien');

        $this->db->set(['posting' => 'belum']);
        $this->db->where('no_kwitansi >=', '10/27/325');
        $this->db->where('no_kwitansi <=', '10/27/365');
        $this->db->update('transaksi_pasien');
    }
}

