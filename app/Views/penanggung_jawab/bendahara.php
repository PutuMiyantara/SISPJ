<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="Bendahara">

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
                        <li class="breadcrumb-item active"><a href="#">Bendahara</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('/penanggungjawab') ?>" class="btn btn-outline-info">Penanggung Jawab Anggaran</a>
            <a href="<?= base_url('/penanggungjawab/kpa_ppk') ?>" class="btn btn-outline-info">KPA PPK</a>
            <a href="<?= base_url('/penanggungjawab/pptk') ?>" class="btn btn-outline-info">PPTK</a>
            <a href="<?= base_url('/penanggungjawab/bendahara') ?>" class="btn btn-outline-info active">Bendahara</a>
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
                    cellspacing="0" ng-init="getBendahara()">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>NIP KPA_PPK</th>
                            <th>Nama KPA_PPK</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>NIP KPA_PPK</th>
                            <th>Nama KPA_PPK</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr ng-repeat="d in datas">
                            <td>{{ $index +1 }}</td>
                            <td>{{ d.nip_bendahara }}</td>
                            <td>{{ d.nama_bendahara }}</td>
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
    <div class="modal fade" tabindex="1" role="dialog" id="bendahara">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" name="formBendahara" ng-submit="submitData()">
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
                            <div class="col"><label>NIP Bendahara</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="nip_bendahara"
                                        ng-model="nip_bendahara" ng-required="false" ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nama Bendahara</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="nama_bendahara"
                                        ng-model="nama_bendahara" ng-required="false" ng-readonly="false">
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