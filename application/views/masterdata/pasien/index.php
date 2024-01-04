<style>
  label {
    font-size: 15px !important;
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
          <?= $this->session->flashdata('message'); ?>

            <div class="card">
                  <div class="card-body">

                    <div class="mb-3 d-flex">
                        <!-- tambah -->
                        <a class="nav-link" href="<?php echo base_url(); ?>masterdata/daftarpasien/addPasien"><button class="btn btn-success px-3 py-3"><i class="fas fa-plus"> TAMBAH DATA PASIEN</i></button></a>
                    </div>

                    <!-- table -->
                    <div class="table-responsive t">
                      <table class="table table-bordered table-hover" id="example">

                        <thead>
                          <tr class="sticky-top bg-light">
                            <th scope="col"></th>
                            <th scope="col">Medical Record</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Tanggal Masuk</th>
                          </tr>
                        </thead>
 
                        <tbody>
                          <?php foreach ($pasien as $r) : ?>
                          <tr>
                            <td scope="row" class="d-flex align-items-center">
                            <a class="nav-link" href="<?php echo base_url(); ?>masterdata/daftarpasien/edit/<?= $r['medical_record']; ?>"><button class="btn px-2 py-2 btn-warning"><i class="fas fa-pencil-alt"></i></button></a>
                            <a href="<?= base_url('masterdata/daftarpasien/deletePasien/') . $r['medical_record']; ?>" onclick="return confirm('yakin dihapus?')">
                              <button class="btn btn-danger px-2 py-2 mr-2"><i class="fas fa-trash-alt"></i></button></a>
                            </td>
                            <td><?= $r['medical_record']; ?></td>
                            <td><?= $r['nama_pasien']; ?></td>
                            <td><?= $r['alamat']; ?> ,<?= $r['kota']; ?></td>
                            <td><?= date('d-m-Y', strtotime($r["tgl_masuk"])); ?></td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                        
                        
                      </table>
                    </div>

                    <!-- pagination -->
                    <!-- <div class="card-footer text-right">
                      
                      <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                          </li>
                          <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                          </li>
                        </ul>
                      </nav>
                    </div> -->
                      

                  </div>

            </div>

          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>
