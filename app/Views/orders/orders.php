<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="Orders">
    <!-- Page Heading -->
    <!-- Content Header (Page header) -->
    <section class=" content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pesanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Orders</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div>
                <div class="alert alert-danger alert-dismissable" ng-show="error">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                </div>
                <div class="alert alert-success alert-dismissable" ng-show="success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                </div>
            </div>
            <div class="table-responsive">
                <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="margin-bottom: 10px;"
                    ng-click="tambahData()"><i class="fas fa-plus fa-sm text-white-50"></i>Tambah
                    Data</button>
                <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                    cellspacing="0" ng-init="getOrders()">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>No Pesanana</th>
                            <th>Tanggal Pesanan</th>
                            <th>Rekening Dasar</th>
                            <th>Rekening Belanja</th>
                            <th>Rekanan</th>
                            <th>Nama Rekanan</th>
                            <th>Tlp Rekanan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No Pesanana</th>
                            <th>Tanggal Pesanan</th>
                            <th>Rekening Dasar</th>
                            <th>Rekening Belanja</th>
                            <th>Rekanan</th>
                            <th>Nama Rekanan</th>
                            <th>Tlp Rekanan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr ng-repeat="d in datas">
                            <td>{{ $index +1 }}</td>
                            <td>{{ d.no_pesanan }}</td>
                            <td>{{ d.tgl_pesanan }}</td>
                            <td>{{ 
                                d.kode_rek_dinas + "." +
                                d.kode_rek_urusan + "." +
                                d.kode_rek_bidang + "." +
                                d.kode_rek_program + "." +
                                d.kode_rek_kegiatan + "." +
                                d.kode_rek_unit + " - " +
                                d.nama_rekening_dasar + " (" +
                                d.tahun_anggaran + ")"
                            }}</td>
                            <td>{{ 
                                d.kode_belanja_sub1 + "." +    
                                d.kode_belanja_sub2 + "." +    
                                d.kode_belanja_sub3 + "." +    
                                d.kode_belanja_sub4 + "." +    
                                d.kode_belanja_sub5 + " - " +    
                                d.nama_rekening_belanja_sub5    
                            }}</td>
                            <td>{{ d.instansi_rekanan }}</td>
                            <td>{{ d.nama_rekanan }}</td>
                            <td>{{ d.no_telp_rekanan }}</td>
                            <td style="text-align: center; width: 100px;">
                                <button type="submit" class="btn btn-info"
                                    ng-click="getDetail(d.id, d.id_rekening_dasar)"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-success"><a
                                        href="<?= base_url('/orders/cetakOrders/') ?>{{ d.id }}" target="_blank"><i
                                            class="fa fa-print"></i></a></button>
                                <button type="submit" class="btn btn-danger" ng-click="deleteData(d.id)"
                                    style="margin-top: 5px;"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" role="dialog" role="dialog" aria-hidden="true" id="Orders">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" name="formKodeDinas" ng-submit="submitData()">
                    <div class="modal-header">
                        <h4 class="modal-title" ng-model="modalTitle">Detail Pesanan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="alert alert-success alert-dismissable" ng-show="success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nomor Pesanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input class="form-control" name="no_pesanan" ng-model="formModel.no_pesanan"
                                        ng-required="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Tanggal Pesanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="date" class="form-control" name="tgl_pesanan"
                                        ng-model="formModel.tgl_pesanan" ng-required="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                            <div class="col"><label>Kode Rekening Dasar</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row" ng-init="dataRekDasar(null)">
                                    <!-- <input class="form-control" name="id_rekening_dasar"
                                        ng-model="formModel.id_rekening_dasar" ng-required="false" ng-readonly="true"> -->
                                    <select style="width: 100%;" id="rek_dasar_orders" select2="" class="form-control"
                                        name="rek_dasar" ng-model="formModel.id_rekening_dasar"
                                        ng-options="rek_dasar.id as rek_dasar.kode_rekening_dasar for rek_dasar in getRekDasar"
                                        ng-required="true" ng-disabled="readOnly"
                                        ng-change="rekDasarChange(formModel.id_rekening_dasar)">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                            <div class="col"><label>Kode Rekening belanja</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row" ng-init="dataRekBelanja(null)">
                                    <!-- <input class="form-control" name="id_kode_belanja_sub1"
                                        ng-model="formModel.id_kode_belanja_sub1" ng-required="false"
                                        ng-readonly="true"> -->
                                    <select style="width: 100%;" id="rek_belanja" select2="" class="form-control"
                                        name="rek_belanja"
                                        ng-options="rek_belanja.id as rek_belanja.kode_belanja for rek_belanja in getRekBelanja"
                                        ng-required="true" ng-disabled="readOnly"
                                        ng-model="formModel.id_kode_belanja_sub5"
                                        ng-change="rekBelanjaChange(formModel.id)">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                            <div class="col"><label>Penanggung Jawab</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row" ng-init="dataKpaPpk()">
                                    <select style="width: 100%;" id="data_pegawai" select2="" class="form-control"
                                        name="data_pegawai"
                                        ng-options="data_pegawai.id as data_pegawai.kpa_ppk for data_pegawai in getPegawai"
                                        ng-required="true" ng-disabled="readOnly" ng-model="formModel.id_kpa_ppk">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Instansi Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="instansi_rekanan"
                                        ng-model="formModel.instansi_rekanan" ne-required="true" ng-readonly="false"
                                        ng-keyup="searchInstansiRekanan(formModel.instansi_rekanan)"
                                        ng-style="rekanan_style">
                                    <ul class="list-group col-sm-12 mb-6 mb-sm-0" ng-hide="hide_rekanan"
                                        style="height: 100px;overflow: auto;">
                                        <li class="list-group-item list-group-item-action"
                                            ng-repeat="rekanan in filterInstansiRekanan"
                                            ng-click="fillInstansiRekanan(rekanan.id, rekanan.instansi_rekanan, rekanan.nama_rekanan, rekanan.alamat_rekanan, rekanan.no_telp_rekanan, rekanan.npwp, rekanan.bank_rekanan, rekanan.no_rekening_rekanan, rekanan.jabatan)">
                                            <a href=""
                                                style="color: black; text-align: right; text-decoration: none;">{{rekanan.instansi_rekanan}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nama Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="nama_rekanan"
                                        ng-model="formModel.nama_rekanan" ne-required="true" ng-readonly="false"
                                        ng-keyup="searchNamaRekanan(nama_rekanan)" ng-style="nama_rekanan_style">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Alamat Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <textarea type="text" class="form-control" name="alamat_rekanan"
                                        ng-model="formModel.alamat_rekanan" ne-required="true" ng-readonly="false"
                                        ng-style="alamat_rekanan_style"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>No Telepon Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="no_telp_rekanan"
                                        ng-model="formModel.no_telp_rekanan" ne-required="true" ng-readonly="false"
                                        ng-style="no_telp_rekanan_style">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>NPWP Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="npwp" ng-model="formModel.npwp"
                                        ne-required="true" ng-readonly="false" ng-style="npwp_style">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Akun Bank Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="bank_rekanan"
                                        ng-model="formModel.bank_rekanan" ne-required="true" ng-readonly="false"
                                        ng-style="bank_rekanan_style">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>No Rekening Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="no_rekening_rekanan"
                                        ng-model="formModel.no_rekening_rekanan" ne-required="true" ng-readonly="false"
                                        ng-style="no_rekening_rekanan_style">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Jabatan Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input class="form-control" name="jabatan" ng-model="formModel.jabatan"
                                        ng-required="false" ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Uraian Pesanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <textarea class="form-control" name="uraian_pesanan"
                                        ng-model="formModel.uraian_pesanan" ng-required="false"
                                        ng-readonly="false"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Tambah Barang</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <button type="button" class="btn btn-info col-sm-2 mb-4" ng-click="addForm()"><i
                                            class="fa fa-plus">
                                        </i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive form" id="tableBarangHide" ng-hide="tableBarangHide">
                            <table class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">No</th>
                                        <th>Jenis Barang</th>
                                        <th>Jumlah Barang</th>
                                        <th>Jenis Satuan Barang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th style="width: 100px;">No</th>
                                        <th>Jenis Barang</th>
                                        <th>Jumlah Barang</th>
                                        <th>Jenis Satuan Barang</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody class="formTambah">
                                    <!-- <tr>
                                        <td>1</td>
                                        <td><input type="text" name="jenis_barang" id="jenis_barang"></td>
                                        <td><input type="number" name="jumlah_barang" id="jumlah_barang"></td>
                                        <td><input type="text" name="jenis_satuan_barang" id="jenis_satuan_barang"></td>
                                        <td><input type="text" name="uraian_pesanan" id="uraian_pesanan"></td>
                                        <td><button type="button" class="btn btn-danger" ng-click="deleteForm()"
                                                style="margin-top: 5px;"><i class="fa fa-trash"></i></button></td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="id" ng-model="id" ng-hide="false" ng-readonly="true">
                        <input type="text" name="id_rekanan" ng-model="formModel.id_rekanan" ng-hide="true"
                            ng-readonly="true">
                        <button type="submit" class="btn btn-success col-sm-2 mb-3"><i class="fa fa-save">
                            </i> {{ modalButton }}</button>
                        <button type="button" class="btn btn-danger col-sm-2 mb-3"
                            ng-click="closeModal('#kodeBelanjaSub5')"><i class="fa fa-right-from-bracket"></i>
                            Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</div>

<script>
$(document).on('click', '.deleteForm', function(e) {
    e.preventDefault();
    var barangBeforeDel = [];
    var barangAfterDel = [];
    var number = $(".number");
    number.each(function(j) {
        console.log('ini atasan: ' + j);
        const id_barang = document.getElementsByName("id_barang")[j].value;
        barangBeforeDel.push(id_barang);
    });

    $(this).parents('tr').remove();
    var number = $(".number");
    number.each(function(i) {
        console.log('ini bawahan: ' + i);
        document.getElementsByClassName("number")[i].innerHTML = i + 1;
        const id_barang = document.getElementsByName("id_barang")[i].value;
        barangAfterDel.push(id_barang);
    });
    // membandingkan array awal sebelum delete dan sesudah delete yang mana hilang maka itu akan muncul
    let difference = barangBeforeDel.filter(x => !barangAfterDel.includes(x));
    if (barangAfterDel.length == 0) {
        $("#tableBarangHide").hide();
    }

    // console.log('ini bedanya: ' + difference + " | Length: " + barangAfterDel.length);
    if (difference != '' && difference != null && difference != undefined) {
        var idBarang = JSON.stringify({
            id_barang: difference
        });
        $.ajax({
            type: "POST",
            url: '/orders/deleteBarang',
            data: idBarang,
            success: function(resultData) {
                console.log(resultData);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            },
            dataType: 'text'
        });
    }
});
</script>