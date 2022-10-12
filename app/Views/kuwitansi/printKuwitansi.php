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
        margin-top: 10px;
    }

    #header {
        border-bottom: 2px solid #000000;
        font-size: 10pt;
    }

    #tableHeader {
        margin: auto;
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

    .topAlignTable {
        vertical-align: top;
    }

    #tableBody td {
        padding-top: 10px;
    }
    </style>
</head>

<body>
    <?php foreach ($dKuwitansi as $key) : ?>
    <div>
        <div id="header">
            <table id="tableHeader">
                <tr>
                    <td style="width: 135px;">Tahun Anggaran</td>
                    <td>: <?= $key->tahun_anggaran ?></td>
                    <td class="headerRight" style="width: 90px ;font-size: 12px;">Rekening Bank</td>
                    <td style="width: 160px;font-size: 12px;">: <?= $key->bank_rekanan ?>.
                        <?= $key->no_rekening_rekanan ?></td>
                </tr>
                <tr>
                    <td>Kode Rekening</td>
                    <td style="width: 390px;">:
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
                    <td class="headerRight" style="font-size: 12px;">NPWP</td>
                    <td style="font-size: 12px;">: 1234567890</td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>: 111</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div id="tableBody">
            <h1 style="text-decoration: underline; font-weight: bold; text-align: center;">K U I T A N S I</h1>
            <table>
                <tr>
                    <td class="topAlignTable" style="width: 135px;">Terima Dari</td>
                    <td class="topAlignTable">: </td>
                    <td> Kepala Satuan Kerja Prangkat Daerah Dinas Koperasi UKM Kabupaten
                        Klungkung</td>
                </tr>
                <tr>
                    <td class="topAlignTable">Banyaknya Uang</td>
                    <td class="topAlignTable">: </td>
                    <td style="font-style: italic;">
                        <?= $nominal . " rupiah" ?>
                    </td>
                </tr>
                <tr>
                    <td class="topAlignTable">Untuk Pembayaran</td>
                    <td class="topAlignTable">: </td>
                    <td style="text-align: justify;"> <?= $key->nama_rekening_belanja_sub5?> berupa
                        <?= $key->uraian_belanja ?> di di UPTD.
                        Pengelolaan Pasar Pada Dinas Koperasi UKM
                        dan Perdagangan Kabupaten Klungkung pada kegiatan pembinaan terhadap pengelola sarana
                        distribusi perdagangan masyarakat di wilayah kerjanya pada sub kegiatan pemberdayaan
                        /pengelola sarana distribusi perdagangan pada kegiatan Pemberdayaan Pengelola Sarana
                        Distribusi Perdagangan sesuai dengan order dan nota terlampir</td>
                </tr>
                <tr>
                    <td class="topAlignTable">Terbilang</td>
                    <td class="topAlignTable">: </td>
                    <td>
                        <div style="border:2px solid black; position: absolute; padding: 3px; margin-bottom: 10px"> Rp.
                            <?= number_format($key->nominal) ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div id="ttd">
            <table id="ttdTable">
                <tr>
                    <td rowspan="2" style="width: 400px;">Pejabat Pelaksana Teknis Kegiatan,</td>
                    <td style="width: 100px;"></td>
                    <td style="width: 300px;">Semarapura,.</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Yang Menerima Uang Tersebut</td>
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
                    <td style=" font-weight: bold; text-decoration: underline;"><?= $key->nama_pptk ?></td>
                    <td></td>
                    <td style=" font-weight: bold; text-decoration: underline;"><?= $key->nama_rekanan ?></td>
                </tr>
                <tr>
                    <td>NIP. : <?= $key->nip_pptk ?></td>
                    <td></td>
                    <td>.</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td>&nbsp;</td>
                </tr>
                <?php if($key->keterangan == 'LS'): ?>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td>Diajukan ke Kepala SKPD.</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td>Dinas Koperasi, UKM dan Perdagangan</td>
                </tr>
                <tr>
                    <td>Mengetahui,</td>
                    <td></td>
                    <td>Kab. Klungkung</td>
                </tr>
                <?php else: ?>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Mengetahui,</td>
                    <td></td>
                    <td>Dibayar Lunas</td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td>Kuasa pengguna Anggaran</td>
                    <td></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Bidang Perdagangan</td>
                    <td></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>SKPD Dinas Koperasi, UKM Dan Perdagangan</td>
                    <td></td>
                    <td>pada tanggal :</td>
                </tr>
                <tr>
                    <td>Kabupaten Klungkung</td>
                    <td></td>
                    <td>Bendahara Pengeluaran</td>
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
                    <td style=" font-weight: bold; text-decoration: underline;"><?= $key->nama_kpa_ppk ?></td>
                    <td></td>
                    <td style=" font-weight: bold; text-decoration: underline;"><?= $key->nama_bendahara ?></td>
                </tr>
                <tr>
                    <td>NIP. : <?= $key->nip_kpa_ppk ?></td>
                    <td></td>
                    <td>NIP. : <?= $key->nip_bendahara; ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td>&nbsp;</td>
                </tr>
                <?php if($key->keterangan_kode_belanja_sub3 == "Barang"): ?>
                <tr>
                    <td colspan="3" style="text-align: center;">
                        <p>Barang-barang tersebut telah diterima</p>
                        <p>dalam keadaan baik dan cukup</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">Pengurus barang pengguna, </td>
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
                        <?= $key->nama_pengurus_barang ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">NIP. : <?= $key->nip_pengurus_barang ?></td>
                </tr>
                <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;"></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;"></td>
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
                    <td colspan="3" style="text-align: center;  font-weight: bold; text-decoration: underline;"></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;"></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <?php endforeach; ?>
</body>

</html>