<style>
  .t{
    height: 450px
  }
  th {
    width: 100px !important;
  }
  .r {
    margin-top: -20px !important;
  }
  .cari {
    /* padding-top: 5px !important;
    padding-bottom: 5px !important; */
    height: 45px !important;
    width: 70px !important;
    margin-top: 23px
  }
  .q {
    width: 1px !important;
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
              

                <div class="my-3">
                      <button class="btn btn-success px-3 py-2 mr-2" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Tambah Data</button>
                      
                    </div>

                <div class="table-responsive t">
                      <table class="table table-bordered table-hover" id="example">

                      <thead>
                        <tr class="bg-light">
                          <th style="width: 10%"></th>
                          <th scope="col">Kode</th>
                          <th scope="col">Nama Jasa/Obat</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Fee</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($jasa as $r) : ?>
                          
                          <tr>
                            <td>
                            <a data-toggle="modal" data-target="#editRoleModal<?= $r['id'] ?>"><button class="btn btn-warning px-2 py-2 mr-2"><i class="fas fa-pencil-alt"></i></button>
                              <a href="<?= base_url('masterdata/daftarjasa/deleteJasa/') . $r['id']; ?>" onclick="return confirm('yakin dihapus?')" class="btn btn-danger px-2 py-2 mr-2 text-white"><i class="fas fa-trash-alt"></i></a></a>
                            </td>
                            <td ><?= $r['kode']; ?></td>
                            <td ><?= $r['nama']; ?></td>
                            <td >Rp <?= number_format($r['harga_jasa'],0,',','.'); ?></td>
                            <td >Rp 
                              <?php if($r['fee'] == null){
                                echo '';
                              }else {
                                echo number_format($r['fee'],0,',','.');
                              }  ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                        </tbody>
                        
                      </table>
                </div>


              </div>
            </div>

          </div>

        </section>
      </div>

      <!-- TAMBAH DATA -->
      <div class="modal fade" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Jasa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form action="<?= base_url('masterdata/daftarjasa/store'); ?>" method="post">
                <div class="modal-body">
                <?php echo validation_errors(); ?>
                    <div class="form-group col-md-12">
                        <h6 for="ket">Keterangan</h6>
                        <select id="ket" name="ket" class="form-control">
                          <option selected name="ket"></option>
                          <option value="Administrasi">Administrasi</option>
                          <option value="Konsultasi">Konsultasi</option>
                          <option value="Jasa">Jasa</option>
                          <option value="Tindakan Tanpa Alat">Tindakan Tanpa Alat</option>
                          <option value="Tindakan Dengan Alat">Tindakan Dengan Alat</option>
                          <option value="Tindakan Gigi">Tindakan Gigi</option>
                          <option value="Home Visit">Home Visit</option>
                          <option value="Lain-Lain">Lain-Lain</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                      <h6 for="nama">Nama Jasa</h6>
                      <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-6">
                      <h6 for="harga">Harga</h6>
                      <input type="text" class="form-control" name="harga" id="harga" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-8">
                      <h6 for="fee">Fee Dokter ( %  atau Fix Rate )</h6>
                      <input type="number" class="form-control" name="fee" id="fee" autocomplete="off" required>
                    </div>
                    
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>

            </div>
          </div>
      </div>


      <!-- EDIT DATA -->
      <?php foreach ($jasa as $r) : ?>
                      
      <div class="modal fade" id="editRoleModal<?= $r['id'] ?>" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Jasa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form action="<?= base_url('masterdata/daftarjasa/editJasa/') . $r['id']; ?>" method="post">
                <div class="modal-body">
                <?php echo validation_errors(); ?>
                    <div class="form-group col-md-6">
                      <h6 for="kode">Keterangan</h6>
                      <select id="ket" name="ket" class="form-control">
                          <option selected name="ket"><?= $r['induk'] ?></option>
                          <option value="Administrasi">Administrasi</option>
                          <option value="Konsultasi">Konsultasi</option>
                          <option value="Jasa">Jasa</option>
                          <option value="Tindakan Tanpa Alat">Tindakan Tanpa Alat</option>
                          <option value="Tindakan Dengan Alat">Tindakan Dengan Alat</option>
                          <option value="Tindakan Gigi">Tindakan Gigi</option>
                          <option value="Home Visit">Home Visit</option>
                          <option value="Lain-Lain">Lain-Lain</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                      <h6 for="nama">Nama Jasa</h6>
                      <input type="hidden" class="form-control" name="kode" id="kode" value="<?= $r['kode']; ?>" required autocomplete="off">
                      <input type="text" class="form-control" name="nama" id="nama" value="<?= $r['nama']; ?>" required autocomplete="off">
                    </div>
                    <div class="form-group col-md-12">
                      <h6 for="harga">Harga</h6>
                      <input type="text" class="form-control" name="hargae" id="hargae"
                      
                      value="<?= number_format($r['harga_jasa'],0,',','.')?>" 
                      required autocomplete="off">
                    </div>
                    <div class="form-group col-md-12">
                      <h6 for="fee">Fee Dokter ( %  atau Fix Rate )</h6>
                      <?php
                        $e = 1;
                        if($r['induk'] == 'Konsultasi'){
                          $e = $r['persen']; 
                          // echo 'mantap';
                        } else if ($r['induk'] == 'Jasa'){
                          $e = $r['persen']; 
                        } else {
                          $e = $r['fee']; 
                        }
                      ?>

                      <input type="text" class="form-control" name="fee" id="fee" value="<?= $e ?>" required autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>

            </div>
          </div>
      </div>
      <?php endforeach; ?>  



<?php $this->load->view('dist/_partials/footer'); ?>



<script type="text/javascript">
	var masuk = document.getElementById('harga');
	masuk.addEventListener('keyup', function (e) {
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
		masuk.value = formatmasuk(this.value);
	});

	var harg = document.getElementById('hargae');
	harg.addEventListener('keyup', function (e) {
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
		harg.value = formatmasuk(this.value);
	});

	/* Fungsi formatmasuk */
	function formatmasuk(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			masuk = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? '.' : '';
			masuk += separator + ribuan.join('.');
		}

		masuk = split[1] != undefined ? masuk + ',' + split[1] : masuk;
		return prefix == undefined ? masuk : (masuk ? 'Rp ' + masuk : '');
	}
</script>