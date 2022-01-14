<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="KodeBidang">

    <!-- Page Heading -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kode Rekening Bidang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Rekening Dasar</a></li>
                        <li class="breadcrumb-item active"><a href="#">Kode Rekening Bidang</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('/rekdasar') ?>" class="btn btn-outline-info">Rekening Dasar</a>
            <a href="<?= base_url('/rekdasar/dinas') ?>" class="btn btn-outline-info">Kode Dinas</a>
            <a href="<?= base_url('/rekdasar/urusan') ?>" class="btn btn-outline-info">Kode Urusan</a>
            <a href="<?= base_url('/rekdasar/bidang') ?>" class="btn btn-outline-info active">Kode Bidang</a>
            <a href="<?= base_url('/rekdasar/kegiatan') ?>" class="btn btn-outline-info">Kode Kegiatan</a>
            <a href="<?= base_url('/rekdasar/program') ?>" class="btn btn-outline-info">Kode Program</a>
            <a href="<?= base_url('/rekdasar/unit') ?>" class="btn btn-outline-info">Kode Unit</a>
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
                    cellspacing="0" ng-init="getKodeBidang()">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Kode Rekening</th>
                            <th>Jumlah Anggaran</th>
                            <th>Uraian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode Rekening</th>
                            <th>Jumlah Anggaran</th>
                            <th>Uraian</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr ng-repeat="d in datas">
                            <td>{{ $index +1 }}</td>
                            <td>{{ d.kode_rek }}</td>
                            <td style="text-align: right;">{{ 'Rp. '+ d.jumlah_anggaran }}</td>
                            <td>{{ d.uraian }}</td>
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
    <div class="modal fade" tabindex="1" role="dialog" id="kodeBidang">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" name="formKodeBidang" ng-submit="submitData()">
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
                                    <input type="text" class="form-control" name="kode_rek" ng-model="kode_rek"
                                        ng-required="false" ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Jumlah Anggaran</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="jumlah_anggaran"
                                        ng-model="jumlah_anggaran" ng-required="false" ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Uraian</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <textarea class="form-control" name="uraian" ng-model="uraian" ng-required="false"
                                        ng-readonly="false"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="id" ng-model="id" ng-hide="false" ng-readonly="true">
                        <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                            </i> {{ modalButton }}</button>
                        <button type="button" class="btn btn-danger col-sm-3 mb-6"
                            ng-click="closeModal('#kodeBidang')">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</div>