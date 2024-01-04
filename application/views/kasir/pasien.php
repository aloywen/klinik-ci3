<style>
  label {
    font-size: 20px !important;
    margin-right: 5px
  }
  .r {
    margin-top: -20px
  }
  .l {
    height: 40px !important;
    margin-top: -10px;
    font-size: 16px !important
  }
  .g {
    height: 60px !important;
    font-size: 25px !important
  }
  .k {
    margin-top: -30px !important
  }
</style>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <div class="section-body">
          <?= $this->session->flashdata('message'); ?>

            <div class="card">
              <div class="card-body">
                <form action="<?= base_url('kasir/pasien/store'); ?>" method="post">
                        <?php
                        
                     $dat = $no_kwitansi['no_kwitansi'];
                     $nourut = substr($dat, 6, 9);
                     $m_record = $nourut + 1;
                    
                    //  if($nourut !== 'HABIS'){
                    //   $m_record + 1;
                    //  } else if($nourut === 'HABIS'){
                    //   $m_record = 001;
                    //  }

                    //  var_dump($nourut);
                    //  echo '<br/>';
                    //  echo $no_kwitansi;
                    //  echo '<br/>';
                    //  echo 'no baru'.$m_record;
                     
                     $nourut = substr($no_register, 12, 9);
                     $m_register = $nourut + 1; 
                     ?>
                  <div class="form-row">
                      <div class="form-group d-flex col-md-4 align-items-center">
                        <label for="register">Register:</label>
                        <input type="text" class="form-control l" id="register" value="01/<?= date('ymd');?>/1/<?= sprintf("%02s", $m_register) ?>" name="register" readonly>
                      </div>

                      <div class="form-group d-flex col-md-4 align-items-center">
                        <label for="no_kwitansi">Kwitansi:</label>
                        <input type="text" class="form-control l" id="no_kwitansi" value="<?= date('m/d');?>/<?= sprintf("%06s", $m_record) ?>" name="no_kwitansi" readonly>
                      </div>
 
                      <div class="form-group d-flex col-md-4 align-items-center">
                        <label for="tgl">Tanggal:</label>
                        <?php
                                date_default_timezone_set('Asia/Jakarta');
                        ?>
                        <input type="text" class="form-control l" id="tgl" name="tgl_kwitansi" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('d-m-Y H:i:s');?>" readonly>
                      </div>
                  </div>


                  <div class="form-row px-0 r">
                      <div class="form-group d-flex align-items-center col-md-6 row">
                        <label for="pasien" class="col-md-4 px-0">Nama Pasien :</label>
                        <input type="text" class="form-control l col-md-3" name="kode_pasien" id="kode_pasien" readonly>
                        <input data-field-name="pasien" type="text" name="pasien" id="pasien" class="form-control col-md-4 l js-example-basic-single autopasien" autocomplete="off" required>
                      </div>
                      <div class="form-group d-flex align-items-center col-md-3">
                        <label for="status">Status</label>
                        <input type="text" class="form-control l" name="status" id="status" autocomplete="off">
                      </div>
                      <div class="form-group d-flex align-items-center col-md-3 row">
                        <label style="font-size:18px!important" for="jns_pasien" class="col px-0 ml-3">Jenis Pasien</label>
                        <input type="text" class="form-control l col-md-6" name="jns_pasien" id="jns_pasien" autocomplete="off">
                      </div>
                  </div>


                  <div class="form-row r">
                      <div class="form-group d-flex align-items-center col-md-4">
                        <label for="penanggung">Nm. Penanggung</label>
                        <input type="text" class="form-control l" name="penanggung" id="penanggung" autocomplete="off">
                      </div>

                      <div class="form-group d-flex align-items-center col-md-4">
                        <label for="perusahaan">Perusahaan</label>
                        <input type="text" class="form-control l" name="perusahaan" id="perusahaan" autocomplete="off">
                      </div>

                      <div class="form-group d-flex align-items-center col-md-4">
                        <label for="asuransi">Asuransi</label>
                        <input type="text" class="form-control l" name="asuransi" id="asuransi" autocomplete="off">
                        <input type="text" class="form-control l" name="asuransi" id="asuransi" autocomplete="off">
                      </div>
                  </div>


                  <div class="form-row r">
                      <div class="form-group d-flex align-items-center col-md-4">
                        <label for="dokter">Dokter</label>
                        <!-- <input type="hidden" class="form-control l" name="kode_dokter" id="kode_dokter" autocomplete="off"> -->
                        <select id="status" name="dokter" class="form-control l">
                                <option selected ></option>
                                <?php foreach ($dokter as $d) : ?>
                                <option value="<?= $d['kode_dokter'] ?>"><?= $d['kode_dokter'] ?> - <?= $d['nama_dokter'] ?></option>
                                <?php endforeach ?>
                        </select>
                      </div>

                      <div class="form-group d-flex align-items-center col-md-4">
                        <label for="diagnosa">Diagnosa</label>
                        <input type="text" class="form-control l" name="diagnosa" id="diagnosa" autocomplete="off">
                      </div>

                      <div class="form-group d-flex align-items-center col-md-4">
                        <label for="icd">ICD</label>
                        <input type="text" class="form-control l" name="icd" id="icd" autocomplete="off">
                      </div>
                  </div>

                  <div class="form-row r">
                    <div class="form-group d-flex align-items-center col-md-4">
                        <label for="bidan">Bidan / Perawat</label>
                        <select id="bidan" name="bidan" class="form-control l">
                                <option selected ></option>
                                <?php foreach ($bidan as $d) : ?>
                                <option value="<?= $d['kode_bidan'] ?>"><?= $d['kode_bidan'] ?> - <?= $d['nama_bidan'] ?></option>
                                <?php endforeach ?>
                        </select>
                    </div>
                  </div>

                  <table class="table" style="width:100%">
                      <thead>
                        <tr>
                          <th style="width:120px">Kode</th>
                          <th style="width:220px">Nama Obat/Jasa</th>
                          <th style="width:140px" >Qty</th>
                          <th >Harga</th>
                          <th >Jml. Harga</th>
                        </tr>
                      </thead>
                      <tbody class="isi">
                        <tr id="row_1">
                          <td class="px-0">
                            <input data-field-name="kode" type="text" class="l form-control col-md-12 autocomplete" value="" name="kode[]" id="kode_1" autocomplete="off">
                          </td>
                          <td class="px-0">
                            <input data-field-name="obat" type="text" class="l form-control col-md-12 autocomplete" value="" name="obat[]" id="obat_1" autocomplete="off">
                          </td>
                          <td>
                            <input onchange="total();" type="number" class="l form-control qty" value="" name="qty[]" id="qty_1">
                          </td>
                          <td>
                            <input type="text" class="l form-control" value="" name="harga[]" id="harga_1">
                          </td>
                            <input type="hidden" class="l form-control" value="" name="fee[]" id="fee_1" readonly>
                            <input type="hidden" class="l form-control" value="" name="induk[]" id="induk_1" readonly>
                          <td>
                            <input type="text" class="l form-control total" value="" name="total_harga[]" id="total_harga_1" readonly>
                          </td>
                          <td class="d-flex align-items-center">
                            <input type="hidden" class="l form-control total" value="" name="ket[]" id="ket_1" readonly>
                          </td>
                        </tr>

                        
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="2"><button id="addField" class="btn btn-primary">TAMBAH DATA</button></td>
                        </tr>
                        <tr>
                          <td colspan="2"><h3>TOTAL</h3></td>
                          <td colspan="3" class="text-right"><input type="text" name="grand_total" id="grand_total" class="form-control text-right g" readonly></td>
                        </tr>
                              </tfoot>
                    </table>

                    <button type="submit" class="btn btn-success">SIMPAN</button>
                    </form>
                  </div>
            </div>

          
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>
