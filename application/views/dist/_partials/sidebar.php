<style>
  span {
    font-size: 15px;
    color: black;
    font-weight: 200px
  }
  .active {
    color: blue !important;
  }
</style>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo base_url(); ?>">KLINIK DHARMA BAKTI</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>">DB</a>
          </div>
          <ul class="sidebar-menu">

            <!-- MASTER DATA -->
            <li class="dropdown <?php echo $this->uri->segment(2) == 'daftarpasien' || $this->uri->segment(2) == 'daftardokter' || $this->uri->segment(2) == 'daftarbidan' || $this->uri->segment(2) == 'daftarjasa' || $this->uri->segment(2) == 'daftarperawat' || $this->uri->segment(2) == 'daftarobat' || $this->uri->segment(2) == 'daftarsatuan' || $this->uri->segment(2) == 'lapstokobat' || $this->uri->segment(2) == 'lapkunjungan' || $this->uri->segment(2) == 'lapomzet' || $this->uri->segment(2) == 'dokter' ? 'active' : ''; ?>">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span class="mt-2">Inventory</span></a>
              <ul class="dropdown-menu">

                <li class="<?php echo $this->uri->segment(2) == 'daftarpasien' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>masterdata/daftarpasien"><span>Daftar Pasien</span></a></li>

                <li class="<?php echo $this->uri->segment(2) == 'daftardokter' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>masterdata/daftardokter/index"><span>Daftar Dokter</span></a></li>

                <li class="<?php echo $this->uri->segment(2) == 'daftarbidan' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>masterdata/daftarbidan/index"><span>Daftar Bidan</span></a></li>

                <li class="<?php echo $this->uri->segment(2) == 'daftarperawat' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>masterdata/daftarperawat/index"><span>Daftar Perawat</span></a></li>

                <li class="<?php echo $this->uri->segment(2) == 'daftarjasa' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>masterdata/daftarjasa"><span>Daftar Jasa</span></a></li>

                <li class="<?php echo $this->uri->segment(2) == 'daftarobat' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>masterdata/daftarobat"><span>Daftar Obat</span></a></li>

                <li class="<?php echo $this->uri->segment(2) == 'lapomzet' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>masterdata/lapomzet"><span>Lap. Omzet</span></a></li>

                <li class="<?php echo $this->uri->segment(2) == 'lapstokobat' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>masterdata/lapstokobat"><span>Lap. Stok Obat</span></a></li>

                <li class="<?php echo $this->uri->segment(2) == 'lapkunjungan' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>masterdata/lapkunjungan"><span>Lap. Kunjungan</span></a></li>

                
                <li class="<?php echo $this->uri->segment(2) == 'dokter' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>kasir/dokter"><span>Fee Dokter</span></a></li>

              </ul>
            </li>
             


            <!-- KASIR -->
            <li class="dropdown <?php echo $this->uri->segment(2) == 'pasien' || $this->uri->segment(3) == 'riwayat' ? 'active' : ''; ?>">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-bill"></i> <span class="mt-2">Kasir</span></a>
              <ul class="dropdown-menu">

                <li class="<?php echo $this->uri->segment(2) == 'pasien' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>kasir/pasien"><span>Pasien</span></a></li>
                <li class="<?php echo $this->uri->segment(3) == 'riwayatpasien' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>kasir/pasien/riwayatpasien"><span>History Perhari</span></a></li>
                <li class="<?php echo $this->uri->segment(3) == 'historytransaksi' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>kasir/pasien/historytransaksi"><span>History Transaksi</span></a></li>

              </ul>
            </li>


            <!-- PEMBELIAN -->
            <li class="dropdown <?php echo $this->uri->segment(2) == 'pembelian' || $this->uri->segment(2) == 'riwayatpembelian' ? 'active' : ''; ?>">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-money-bill"></i> <span class="mt-2">Pembelian</span></a>
              <ul class="dropdown-menu">

                <li class="<?php echo $this->uri->segment(3) == 'add' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>pembelian/pembelian/add"><span>Pembelian Obat</span></a></li>
                <li class="<?php echo $this->uri->segment(3) == 'riwayat' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>pembelian/pembelian/riwayat"><span>Riwayat Pembelian</span></a></li>
                <li class="<?php echo $this->uri->segment(3) == 'stokobat' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>pembelian/pembelian/stokobat"><span>Stok Obat</span></a></li>


              </ul>
            </li>




            <!-- PENGATURAN -->
            <!-- <li class="dropdown <?php echo $this->uri->segment(2) == 'daftaruser' || $this->uri->segment(2) == 'aksesuser' || $this->uri->segment(2) == 'pengaturanumum' || $this->uri->segment(2) == 'settingnomortransaksi' || $this->uri->segment(2) == 'logaktifitas' ? 'active' : ''; ?>">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-wrench"></i> <span class="mt-2">Pengaturan</span></a>
              <ul class="dropdown-menu">
                <li class="<?php echo $this->uri->segment(2) == 'daftaruser' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>pengaturan/daftaruser"> <span>Daftar Pasien</span> </a></li>
                <li class="<?php echo $this->uri->segment(2) == 'daftaruser' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>pengaturan/daftaruser"> <span>Daftar Pasien</span> </a></li>


              </ul>
            </li> -->
            
          </ul>

        </aside>
      </div>
