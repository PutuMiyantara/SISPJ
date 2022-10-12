<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="HakAkses">

    <!-- Page Heading -->
    <!-- Content Header (Page header) -->
    <section class=" content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('/menu') ?>" class="btn btn-outline-info active">Main</a>
            <a href="<?= base_url('/menu/sub') ?>" class="btn btn-outline-info">Sub Menu</a>
            <a href="<?= base_url('/menu/subsub') ?>" class="btn btn-outline-info">Sub Sub Menu</a>
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
                    cellspacing="0" ng-init="getMenu()">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Nama Menu</th>
                            <th>Status Menu</th>
                            <th>Nomor Urut</th>
                            <th>Url Menu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Status Menu</th>
                            <th>Nomor Urut</th>
                            <th>Url Menu</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr ng-repeat="d in datas">
                            <td>{{ $index +1 }}</td>
                            <td>{{ d.name_main_menu }}</td>
                            <td ng-if="d.status_main_menu == '1'">Aktif</td>
                            <td ng-if="d.status_main_menu == '0'">Tidak Aktif</td>
                            <td>{{ d.no_urut_main_menu }}</td>
                            <td>{{ d.main_url }}</td>
                            <td style="text-align: center; width: 100px;">
                                <button type="submit" class="btn btn-info" ng-click="getDetail(d.id)"
                                    style="margin-top: 5px;"><i class="fa fa-edit"></i></button>
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
    <div class="modal fade" role="dialog" role="dialog" aria-hidden="true" id="Kuwitansi">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" name="formOrders" ng-submit="submitData()">
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
                            <div class="col"><label>Nomor Kuwitansi</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="number" class="form-control" name="no_kuwitansi"
                                        ng-model="formModel.no_kuwitansi" ng-required="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Tanggal Kuwitansi</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="date" class="form-control" name="tgl_kuwitansi"
                                        ng-model="formModel.tgl_kuwitansi" ng-required="false">
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
                                        ng-change="rekBelanjaChange(formModel.id_kode_belanja_sub5)">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nominal Harga</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input class="form-control" number-input name="nominal" ng-model="formModel.nominal"
                                        ng-required="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Uraian Belanja</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <textarea type="text" class="form-control" name="uraian_belanja"
                                        ng-model="formModel.uraian_belanja" ne-required="true" ng-readonly="false"
                                        ng-style="uraian_belanja_style">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Dasar SPJ (Bukti)</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="dasar_spj_bukti"
                                        ng-model="formModel.dasar_spj_bukti" ne-required="true" ng-readonly="false"
                                        ng-style="dasar_spj_bukti_style">
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
                            <div class="col"><label>Yang Menerima Uang</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="nama_rekanan"
                                        ng-model="formModel.nama_rekanan" ne-required="true" ng-readonly="false"
                                        ng-keyup="searchNamaRekanan(nama_rekanan)" ng-style="nama_rekanan_style"
                                        ng-readonly="rekananRO">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Alamat Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <textarea type="text" class="form-control" name="alamat_rekanan"
                                        ng-model="formModel.alamat_rekanan" ne-required="true" ng-readonly="false"
                                        ng-style="alamat_rekanan_style" ng-readonly="rekananRO"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>No Telepon Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="no_telp_rekanan"
                                        ng-model="formModel.no_telp_rekanan" ne-required="true" ng-readonly="false"
                                        ng-style="no_telp_rekanan_style" ng-readonly="rekananRO">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>NPWP Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="npwp" ng-model="formModel.npwp"
                                        ne-required="true" ng-readonly="false" ng-style="npwp_style"
                                        ng-readonly="rekananRO">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Akun Bank Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="bank_rekanan"
                                        ng-model="formModel.bank_rekanan" ne-required="true" ng-readonly="false"
                                        ng-style="bank_rekanan_style" ng-readonly="rekananRO">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>No Rekening Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="no_rekening_rekanan"
                                        ng-model="formModel.no_rekening_rekanan" ne-required="true" ng-readonly="false"
                                        ng-style="no_rekening_rekanan_style" ng-readonly="rekananRO">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Jabatan Rekanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input class="form-control" name="jabatan" ng-model="formModel.jabatan"
                                        ng-required="false" ng-readonly="false" ng-readonly="rekananRO">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Keterangan (LS/GU)</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <select class="form-control" name="keterangan" ng-model="formModel.keterangan"
                                        ng-required="false" ng-readonly="false">
                                        <option value="">---select here---</option>
                                        <option value="LS">LS</option>
                                        <option value="GU">GU</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Status SPJ</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <select class="form-control" name="status_spj" ng-model="formModel.status_spj"
                                        ng-required="false" ng-readonly="false">
                                        <option value="0">Belum Cair</option>
                                        <option value="1">Sudah Cair</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nomor Orders</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row" ng-init="dataOrders(null)">
                                    <!-- <input class="form-control" name="id_rekening_dasar"
                                        ng-model="formModel.id_rekening_dasar" ng-required="false" ng-readonly="true"> -->
                                    <select style="width: 100%;" id="kuwitansi_orders" select2="" class="form-control"
                                        name="orders" ng-model="formModel.id_order"
                                        ng-options="orders.id_order as orders.orders for orders in getOrders"
                                        ng-disabled="readOnly" ng-change="ordersChange(formModel.id_order)">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Uraian Pesanan</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <textarea class="form-control" name="uraian_pesanan"
                                        ng-model="formModel.uraian_pesanan" ng-required="false" ng-readonly="true">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="id" ng-model="id" ng-hide="true" ng-readonly="true">
                        <input type="text" name="id_rekanan" ng-model="formModel.id_rekanan" ng-hide="true"
                            ng-readonly="true">
                        <button type="submit" class="btn btn-success col-sm-2 mb-3"><i class="fa fa-save">
                            </i> {{ modalButton }}</button>
                        <button type="button" class="btn btn-danger col-sm-2 mb-3"
                            ng-click="closeModal('#Kuwitansi')"><i class="fa fa-right-from-bracket"></i>
                            Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</div>
<!-- <script type="text/javascript">
$('#rek_dasar').select2({
    // dropdownParent: $('#kodeBelanjaSub1'),
    placeholder: "Select Here",
    theme: "bootstrap-5"
});
</script> -->