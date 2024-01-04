<style>
    label {
        font-size: 17px !important
    }
    .r {
        margin-top: -10px
    }
</style>


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header', $menu);
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <div class="section-body">

            <div class="card">
                  <div class="card-body">
                    

                  <form action="<?= base_url('masterdata/daftarpasien/editPasien/');?><?= $pasien['medical_record'] ?>" method="post">

                        <div class="form-row">
                            <div class="form-group d-flex align-items-center col-md-2">
                                <label for="m_record">Medical Record</label>
                            </div>                            
                            <div class="form-group d-flex align-items-center col-md-3">
                                <input type="text" class="form-control ml-3 text-center" id="m_record" readonly value="<?= $pasien['medical_record'] ?>" name="m_record">
                            </div>                            
                        </div>

                        <div class="form-row r">
                            <div class="form-group col-md-4">
                                <label for="nama_pasien">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?= $pasien['nama_pasien'] ?>" autocomplete="off">
                            </div>                            
                            <div class="form-group col-md-8">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" value="<?= $pasien['alamat'] ?>" id="alamat" name="alamat" autocomplete="off">
                            </div>                         
                        </div>

                        <div class="form-row r">
                            <div class="form-group col-md-4">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" value="<?= $pasien['kota'] ?>" id="kota" name="kota" autocomplete="off">
                            </div> 
                            <div class="form-group col-md-4">
                                <label for="kode_area">Kode Area :</label>
                                <select id="kode_area" value="<?= $pasien['kode_area'] ?>" name="kode_area" class="form-control">
                                <option selected>Pilih...</option>
                                <option value="00001 - Tambun">00001 - Tambun</option>
                                <option value="00002 - Cibitung">00002 - Cibitung</option>
                                </select>
                            </div>                            
                            <div class="form-group col-md-4">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control" value="<?= $pasien['kontak'] ?>" id="telepon" name="telepon" autocomplete="off">
                            </div>                   
                        </div>
 
                        <div class="form-row r">
                            <div class="form-group col-md-4">
                                <div class="form-group ">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <div class="d-flex align-items-center">
                                        <!-- <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir"> -->
                                        <select id="tgl_lahir" name="tgl_lahir" class="form-control l">
                                                <option selected ><?= $pasien['tgl_lahir'] ?></option>
                                                <?php foreach ($tgl as $d) : ?>
                                                <option value="<?= $d ?>"><?= $d ?></option>
                                                <?php endforeach ?>
                                        </select>-
                                        <select id="bln_lahir" name="bln_lahir" class="form-control l">
                                                <option selected ><?= $pasien['bln_lahir'] ?></option>
                                                <?php foreach ($bulan as $d) : ?>
                                                <option value="<?= $d ?>"><?= $d ?></option>
                                                <?php endforeach ?>
                                        </select>-
                                        <input type="text" class="form-control" id="tahun_lahir" name="tahun_lahir" value="<?= $pasien['tahun_lahir'] ?>">
                                    </div>
                                </div>
                            </div>                         
                            <div class="form-group col-md-4">
                                <label for="inputState">Jenis Kelamin (L/P) :</label>
                                <select id="inputState" name="kelamin" class="form-control">
                                    <option selected value="<?= $pasien['kelamin'] ?>"><?= $pasien['kelamin'] ?></option>
                                    <option value="L">L</option>
                                    <option value="P">P</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-4">
                                <label for="kebangsaan">Kebangsaan</label>
                                <input type="text" value="<?= $pasien['kebangsaan'] ?>" class="form-control" id="kebangsaan" name="kebangsaan" autocomplete="off">
                            </div>                         
                        </div>

                        <div class="form-row r">     
                            <div class="form-group col-md-4">
                                <label for="ktp">KTP/SIM/Passport</label>
                                <input type="text" class="form-control" value="<?= $pasien['ktp'] ?>" id="ktp" name="ktp" autocomplete="off">
                            </div>                            
                            <div class="form-group col-md-4">
                                <label for="agama">Agama</label>
                                <input type="text" value="<?= $pasien['agama'] ?>" class="form-control" id="agama" name="agama" autocomplete="off">
                            </div>  
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="text" value="<?= $pasien['email'] ?>" class="form-control" id="email" name="email" autocomplete="off">
                            </div>                            
                        </div>

                        <div class="form-row r">      
                            <div class="form-group col-md-4">
                                <label for="tgl_masuk">Tanggal Masuk</label>
                                <input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk"
                                <?php
                                date_default_timezone_set('Asia/Jakarta');
                                ?>
                                value="<?= $pasien['tgl_masuk'] ?>" readonly>
                            </div>                            
                            <div class="form-group col-md-4">
                                <label for="status">Status Pasien :</label>
                                <select id="status" name="status" class="form-control">
                                <option selected value="<?= $pasien['status'] ?>"><?= $pasien['status'] ?></option>
                                <option value="UMUM">UMUM</option>
                                <option value="RAWAT">RAWAT</option>
                                </select>
                            </div> 
                            <div class="form-group col-md-4">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" value="<?= $pasien['pekerjaan'] ?>" id="pekerjaan" name="pekerjaan" autocomplete="off">
                            </div>                    
                        </div>

                        <div class="form-row r">     
                            <div class="form-group col-md-4">
                                <label for="perusahaan">Perusahaan</label>
                                <input type="text" value="<?= $pasien['perusahaan'] ?>" class="form-control" id="perusahaan" name="perusahaan" autocomplete="off">
                            </div>                             
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                        
                    </form>
                    
                </div>
                      

                  </div>

            </div>

          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>
