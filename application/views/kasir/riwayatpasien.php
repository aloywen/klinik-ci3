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

            <div class="card">
                  <div class="card-body">

                  <!-- <?= $besok ?> -->
                  <?= $this->session->flashdata('message'); ?>
 
                    <!-- table -->
                    <div class="table-responsive t">
                      <table class="table table-bordered table-hover" id="example">

                        <thead> 
                          <tr class="sticky-top bg-light">
                            <th scope="col">Nomor Kwitansi</th>
                            <th scope="col">Tanggal Berobat</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
 
                        <tbody>
                          <?php foreach ($item as $r) : ?>
                            <?php $e = preg_replace("/[^a-zA-Z0-9]/", "", $r['no_kwitansi']); ?>
                          <tr>
                            <td><?= $r['no_kwitansi']; ?></td>
                            <td><?= date('d-m-Y', strtotime($r["tgl_kwitansi"])); ?></td>
                            <td><?= $r['nama_pasien']; ?></td>
                            <td class="d-flex align-items-center">
                            <a class="nav-link" href="<?php echo base_url(); ?>kasir/pasien/detail/<?= $e ?>"><button class="btn btn-warning px-3 py-1">Edit </button></a>
                            <a class="nav-link" href="<?php echo base_url(); ?>kasir/pasien/printulang/<?= $e ?>/<?= $r['medical_record'] ?>"><button class="btn btn-primary px-2 py-1">Print </button></a>
                            <a href="<?= base_url('kasir/pasien/deleteTransaksi/') . $e ?>" onclick="return confirm('yakin dihapus?')">
                              <button class="btn btn-danger px-2 py-1"> Hapus</button></a>
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
<?php $this->load->view('dist/_partials/footer'); ?>
