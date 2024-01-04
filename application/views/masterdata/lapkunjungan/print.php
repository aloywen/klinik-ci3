<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kunjungan Harian</title>

    <style>
        hr.g{
          border-top: 2px dashed black;
        }
    </style>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">

</head>
<body class="px-1">

<?php

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " BELAS";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." PULUH". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " SERATUS" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " RATUS" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " SERIBU" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " RIBU" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " JUTA" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " MILYAR" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " TRILYUN" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}

function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "MINUS ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }     		
    return $hasil;
}

?>
<div class="row">
    <div class="col-md-12">
      

    <div class="text-left">

    <?php
                                date_default_timezone_set('Asia/Jakarta');
                        ?>
        <h6 class="mt-4">KLINIK DHARMA BHAKTI</h5>
        <h5 style="margin-top:-8px">LAPORAN KUNJUNGAN HARIAN</h5>
        <h5 style="margin-top:-8px">PERIODE : <?= date('d-m-Y', strtotime($tgl)); ?></h5>
        <hr class="g" style="width:100%;text-align:left;margin-left:0;">
        <hr class="g" style="width:100%;text-align:left;margin-left:0;margin-top:-12px">
    </div>
    
    
        <table style="margin-top:-15px; margin-left:10px">
            <thead>
                <tr>
                    <td style="width:50px">No</td>
                    <td style="width:70px">Asuransi</td>
                    <td style="width:100px">Perusahaan</td>
                    <td style="width:150px">No. Kwitansi</td>
                    <td style="width:150px">Nama Pasien</td>
                    <td style="width:100px">Skin-Care</td>
                    <td style="width:70px">OTC</td>
                    <td style="width:100px">Resep-Luar</td>
                    <td style="width:60px; padding-right:7px;" class="text-right">Pasien Umum</td>
                    <td style="width:100px" class="text-center">Exces / Cc Payment</td>
                    <td style="width:80px; margin-right:7px" class="text-center">Tunai</td>
                    <td style="width:90px" class="text-center">Krt.SmArt</td>
                    <td style="width:50px">Piutang</td>
                </tr>
            </thead>
        </table>
        <hr class="g" style="width:100%;text-align:left;margin-left:0; margin-top:3px">
        <hr class="g" style="width:100%;text-align:left;margin-left:0;margin-top:-12px">
        
        <table style="margin-top:-17px; margin-left:10px">
            <tbody style="padding-top:3px"> 
                <?php $i = 1 ?>
                <?php foreach ($pasien as $t) : ?>
                <tr>
                    <td style="width:50px"><?= $i ?></td>
                    <td style="width:70px"><?= $t['asuransi'] ?></td>
                    <td style="width:100px"><?= $t['perusahaan'] ?></td>
                    <td style="width:150px""><h6><?= $t['no_kwitansi'] ?></h6></td>
                    <td style="width:150px"><?= $t['nama_pasien'] ?></td>
                    <td style="width:100px"></td>
                    <td style="width:70px"></td>
                    <td style="width:100px"></td>
                    <td style="width:60px; margin-right:15px !important" class="text-center mr-1"><?= number_format($t['grand_total'],0,',','.'); ?></td>
                    <td style="width:100px" class="text-center"></td>
                    <td style="width:80px; margin-right:15px !important" class="text-center mr-1"><?= number_format($t['grand_total'],0,',','.'); ?></td>
                    <td style="width:90px" class="text-center"></td>
                    <td style="width:50px"></td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
                
            </tbody>
            <tfoot>
                <!-- <hr class="g" style="width:100%;text-align:left;margin-left:0;margin-top:-12px"> -->
                <tr style="margin-top:5px !important">
                    <td colspan="8" >GRAND TOTAL</td>
                    <td colspan=""><?= number_format($total['grand_total'],0,',','.'); ?></td>
                    <td colspan="2" class="text-right"><?= number_format($total['grand_total'],0,',','.'); ?></td>
                    <!-- <hr class="g"> -->
                </tr>
            </tfoot>
            <!-- <hr class="g"> -->
        </table>
        <hr class="g" style="width:100%;text-align:left;margin-left:0;margin-top:-26px">
        <hr class="g" style="width:100%;text-align:left;margin-left:0;margin-top:30px">
  
    </div>
</div>


    
    <script>
        // my()

        function my() {
            window.print();
        }

        window.onafterprint = function () {
            closePrintView()
        }

        function closePrintView() {
            window.location.href =  'http://localhost/klinik/masterdata/lapkunjungan/index'
        }
    </script>
    </body>
</html>