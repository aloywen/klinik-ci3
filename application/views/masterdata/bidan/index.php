<style>
  .t{
    height: 450px
  }
  th {
    width: 100px !important;
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
              

                <div class="mb-3 r">
                  <button class="btn btn-success px-3 py-2 mr-2" data-toggle="modal" data-target="#add">TAMBAH DATA BIDAN <i class="fas fa-plus"></i></button>
                </div>

                <div class="table-responsive t">
                      <table class="table table-bordered table-hover" id="example">

                        <thead>
                          <tr class="sticky-top bg-light">
                            <th style="width: 10%"></th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Bidan</th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($bidan as $r) : ?>
                          <tr>
                            <td>
                              <button class="btn btn-warning px-2 py-2 mr-2" data-toggle="modal" data-target="#editRoleModal<?= $r['id'] ?>"><i class="fas fa-pencil-alt"></i></button>
                              <a href="<?= base_url('masterdata/daftarbidan/hapusBidan/') . $r['id']; ?>" onclick="return confirm('yakin dihapus?')" class="btn btn-danger px-2 py-2 mr-2 text-white"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <td ><?= $r['kode_bidan']; ?></td>
                            <td ><?= $r['nama_bidan']; ?></td>
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
                <h5 class="modal-title">Tambah Data Bidan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form action="<?= base_url('masterdata/daftarbidan/store'); ?>" method="post">

              <?php
              $nourut = substr($kode, 0, 6);
              $m_record = floatval($nourut) + 1;
              
              ?>
                <div class="modal-body">
                    <div class="form-group col-md-12">
                      <h6 for="kode_bidan">Kode</h6>
                      <input type="text" class="form-control" name="kode_bidan" id="kode_bidan" readonly value="<?= sprintf("%06s", $m_record) ?>">
                    </div>
                    <div class="form-group col-md-12">
                      <h6 for="nama_bidan">Nama Bidan</h6>
                      <input type="text" class="form-control" name="nama_bidan" id="nama_bidan" required autocomplete="off">
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
<?php foreach ($bidan as $r) : ?>
      <div class="modal fade" id="editRoleModal<?= $r['id'] ?>" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Data Bidan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form action="<?= base_url('masterdata/daftarbidan/editBidan/') . $r['id']; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group col-md-6">
                      <h6 for="kode_bidan">Kode</h6>
                      <input type="text" class="form-control" name="kode_bidan" id="kode_bidan" value="<?= $r['kode_bidan']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-12">
                      <h6 for="nama_bidan">Nama Bidan</h6>
                      <input type="text" class="form-control" name="nama_bidan" id="nama_bidan" value="<?= $r['nama_bidan']; ?>" required>
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