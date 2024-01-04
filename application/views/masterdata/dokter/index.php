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
              

                <div class="mb-3 mt-2 r">
                      <button class="btn btn-success px-3 py-2 mr-2" data-toggle="modal" data-target="#add">TAMBAH DATA DOKTER <i class="fas fa-plus"></i></button>
                      
                </div>

                <div class="table-responsive t">
                      <table class="table table-bordered table-hover" id="example">

                        <thead>
                          <tr class="bg-light">
                            <th style="width: 10%"></th>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Dokter</th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($dokter as $r) : ?>
                          <tr>
                            <td>
                            <button class="btn btn-warning px-2 py-2 mr-2" data-toggle="modal" data-target="#editRoleModal<?= $r['id'] ?>"><i class="fas fa-pencil-alt"></i></button>
                            <a href="<?= base_url('masterdata/daftardokter/deleteDokter/') . $r['id']; ?>" onclick="return confirm('yakin dihapus?')">
                              <button class="btn btn-danger px-2 py-2 mr-2"><i class="fas fa-trash-alt"></i></button></a>
                            </td>
                            <td ><?= $r['kode_dokter']; ?></td>
                            <td ><?= $r['nama_dokter']; ?></td>
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

      <div class="modal fade" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form action="<?= base_url('masterdata/daftardokter/store'); ?>" method="post">
                <div class="modal-body">
                <?php echo validation_errors(); ?>
                    <div class="form-group col-md-12">
                      <h6 for="nama_dokter">Nama Dokter</h6>
                      <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" required autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>

            </div>
          </div>
        </div>


<?php foreach ($dokter as $r) : ?>
  <div class="modal fade" id="editRoleModal<?= $r['id'] ?>" tabindex="1" role="dialog" aria-labelledby="editnewRoleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newRoleModalLabel">Edit Dokter</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="<?= base_url('masterdata/daftardokter/editDokter/') . $r['id']; ?>" method="post">
                  <div class="modal-body">

                      <div class="form-group">
                          <label for="nama_dokter" class="form-label">Nama Dokter</label>
                          <input data-field-name="supplier" type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="<?= $r['nama_dokter'] ?>">
                      </div>
                      
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Edit</button>
                  </div>
              </form>
          </div>
      </div>
  </div> 
<?php endforeach ?>
<?php $this->load->view('dist/_partials/footer'); ?>