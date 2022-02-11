<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="KodeBelanjaSub1">

    <!-- Page Heading -->
    <!-- Content Header (Page header) -->
    <section class=" content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kode Rekening Dinas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Rekening Belanja</a></li>
                        <li class="breadcrumb-item"><a href="#">Kode Rekening Belanja Sub 1</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('/rekbelanja') ?>" class="btn btn-outline-info">Rekening Belanja</a>
            <a href="<?= base_url('/rekbelanja/kodesub1') ?>" class="btn btn-outline-info active">Kode Sub 1</a>
            <a href="<?= base_url('/rekbelanja/kodesub2') ?>" class="btn btn-outline-info">Kode Sub 2</a>
            <a href="<?= base_url('/rekbelanja/kodesub3') ?>" class="btn btn-outline-info">Kode Sub 3</a>
            <a href="<?= base_url('/rekbelanja/kodesub4') ?>" class="btn btn-outline-info">Kode Sub 4</a>
            <a href="<?= base_url('/rekbelanja/kodesub5') ?>" class="btn btn-outline-info">Kode Sub 5</a>
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
                    cellspacing="0" ng-init="getKodeBelanjaSub1()">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Kode Rekening</th>
                            <th>Nama Rekening</th>
                            <th>Jumlah Anggaran</th>
                            <th>Rekening Dasar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode Rekening</th>
                            <th>Nama Rekening</th>
                            <th>Jumlah Anggaran</th>
                            <th>Rekening Dasar</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr ng-repeat="d in datas">
                            <td>{{ $index +1 }}</td>
                            <td>{{ d.kode_belanja_sub1 }}</td>
                            <td>{{ d.nama_rekening_belanja_sub1 }}</td>
                            <td>Rp. {{ d.jumlah_anggaran_belanja_sub1 }}</td>
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
                            <td style="text-align: center;">
                                <button type="submit" class="btn btn-info" ng-click="getDetail(d.id)"><i
                                        class="fa fa-edit"> Detail</i></button>
                                <button type="submit" class="btn btn-danger" ng-click="deleteData(d.id)"><i
                                        class="fa fa-edit"> Delete</i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" role="dialog" role="dialog" aria-hidden="true" id="kodeBelanjaSub1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" name="formKodeDinas" ng-submit="submitData()">
                    <div class="modal-header">
                        <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
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
                            <div class="col"><label>Kode Rekening</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="kode_belanja_sub1"
                                        ng-model="formModel.kode_belanja_sub1" ng-required="false" ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nama Kode Belanja</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input class="form-control" name="nama_rekening_belanja_sub1"
                                        ng-model="formModel.nama_rekening_belanja_sub1" ng-required="false"
                                        ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Jumlah Anggaran Belanja Sub 1</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input class="form-control" name="jumlah_anggaran_belanja_sub1"
                                        ng-model="formModel.jumlah_anggaran_belanja_sub1" ng-required="false"
                                        ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                            <div class="col"><label>Rekening Induk</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row" ng-init="dataRekDasar()">
                                    <select style="width: 100%;" id="rek_dasar" select2="" class="form-control"
                                        name="rek_dasar" ng-model="formModel.id_rekening_dasar"
                                        ng-options="rek_dasar.id as rek_dasar.kode_rekening_dasar for rek_dasar in getRekDasar"
                                        ng-required="true" ng-disabled="readOnly"
                                        ng-change="rekDasarChange(formModel.id_rekening_dasar)">
                                        <option value="">--Select Here--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="hideForAddSub">
                            <div class="col"><label>Tahun Anggaran</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input class="form-control" name="tahun_anggaran"
                                        ng-model="formModel.tahun_anggaran" ng-readonly="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="id" ng-model="id" ng-hide="false" ng-readonly="true">
                        <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                            </i> {{ modalButton }}</button>
                        <button type="button" class="btn btn-danger col-sm-3 mb-6"
                            ng-click="closeModal('#kodeDinas')">Kembali</button>
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