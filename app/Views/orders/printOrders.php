<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    @page {
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 35px;
    }

    #header {
        border-bottom: 2px solid #000000;
        font-size: 10pt;
    }

    #tableHeader {
        margin-top: 100 cm;
    }

    #terbilang_nominal {
        text-transform: capitalize;
    }

    #ttd {
        margin-top: 30px;
    }

    .headerRight {
        text-align: right;
    }

    #tableBody td {
        padding-top: 10px;
    }

    .topAlignTable {
        vertical-align: top;
        padding: 5px;
        height: 400px;
    }

    .UraianBarang {
        height: 500px;
        margin-top: 10px;
        border: 1px solid black;
        width: 800px;
    }

    .layerBarang {
        height: 500px;
        float: left;
        /* border: 2px solid black; */
    }

    .headerBarang {
        background-color: #dbdad7;
        border-style: double;
        border-bottom: 3px solid black;
        text-align: center;
        height: 25px;
        padding-top: 8px;
        padding-bottom: 8px;
    }

    .bodyBarang {
        list-style: none;
        margin: 2px;
    }

    /* .tdBarang {
        border-right: solid 1px black;
        border-left: solid 1px black;
        height: 1px;
        padding-top: -35px;
        padding-bottom: -35px;
    } */

    .footerBarang {
        height: 100%;
        background-color: red;
    }

    /* .tableBarang {
        background-color: red;
        width: 100%;
        border-collapse: collapse;
    } */
    </style>
</head>

<body>
    <?php foreach ($dOrders as $key) : ?>
    <div>
        <div id="header">
            <table id="tableHeader">
                <tr>
                    <td style="width: 135px;">Tahun Anggaran</td>
                    <td>:
                        <?= $key->tahun_anggaran ?>
                    </td>
                </tr>
                <tr>
                    <td>Kode Rekening</td>
                    <td style="font-size: 12px;">:
                        <?= $key->kode_rek_dinas . " . " . 
                         $key->kode_rek_urusan . " . " . 
                         $key->kode_rek_bidang . " . " . 
                         $key->kode_rek_program . " . " . 
                         $key->kode_rek_kegiatan . " . " . 
                         $key->kode_rek_unit . " . " . 
                         $key->kode_belanja_sub1 . " . " . 
                         $key->kode_belanja_sub2 . " . " . 
                         $key->kode_belanja_sub3 . " . " . 
                         $key->kode_belanja_sub4 . " . " . 
                         $key->kode_belanja_sub5 ?>
                    </td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>:
                        <?= $key->no_pesanan ?>
                    </td>
                </tr>
            </table>
        </div>

        <div id="Body">
            <div id="Rekanan">
                <table style="width: 100%; margin-bottom: 30px;">
                    <tr>
                        <td style="padding-top: 10px; margin: auto; text-align: center;">PEMERINTAH KABUPATEN KLUNGKUNG
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px; margin: auto; text-align: center;">ORDER/PESANAN</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td style="width: 135px;">Kepada</td>
                        <td>:
                            <?= $key->nama_rekanan?>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:
                            <?= $key->alamat_rekanan ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Telp/Hp.</td>
                        <td>:
                            <?= $key->no_telp_rekanan ?>
                        </td>
                    </tr>
                </table>
            </div>
            <?php endforeach; ?>
            <div class="UraianBarang">
                <div class="layerBarang" style="width: 149px;">
                    <div class="headerBarang">BANYAKNYA</div>
                    <div class="bodyBarang">
                        <table>
                            <?php foreach ($dBarang as $barang) : ?>
                            <tr>
                                <td><?= $barang->jumlah_barang ?></td>
                                <td><?= $barang->jenis_satuan_barang ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div class="layerBarang" style="width: 310px; border-left: 1px solid black;">
                    <div class="headerBarang">URAIAN</div>
                    <div class="boddyBarang">
                        <table>
                            <?php foreach ($dBarang as $barang) : ?>
                            <tr>
                                <td><?= $barang->jenis_barang ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div class="layerBarang" style="width: 310px; border-left: 1px solid black;">
                    <div class="headerBarang">KETERANGAN</div>
                    <div class="boddyBarang" style="text-align: justify; margin-left: 5px; margin-right: 10px;">
                        Berupa
                        <?= $key->nama_rekening_belanja_sub5; ?> yaitu
                        <?= $key->uraian_pesanan; ?> dalam rangka kegiatan pembinaan terhadap Pengelolaan Sarana
                        Distribusi Perdagangan Masyarakat di Wilayah Kerjanya, Sub Kegiatan Pemberdayaan
                        Pengelolaa
                        Sarana Distribusi Perdagangan pada Dinas Koperasi, UKM dan Perdagangan Kabupaten
                        Klungkung
                    </div>
                </div>
            </div>
            <div id="ttd">
                <table id="ttdTable">
                    <tr>
                        <td style="width: 400px;"></td>
                        <td style="width: 100px;"></td>
                        <td style="width: 300px;"></td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align: center;">
                            <p>Semarapura, 20 September 2021</p>
                            <p>Kuasa Pengguna Anggaran</p>
                            <p>Bidang Perdagangan</p>
                            <p>SKPD Dinas Koperasi, UKM Dan Perdagangan</p>
                            <p>Kabupaten Klungkung</p>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center;  font-weight: bold; text-decoration: underline;">
                            <?= $key->nama_kpa_ppk ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center;">NIP. :
                            <?= $key->nip_kpa_ppk ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="Footer"></div>
    </div>
</body>

</html>