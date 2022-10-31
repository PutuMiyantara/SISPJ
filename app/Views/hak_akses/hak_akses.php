<?php $session = session();
$uri = new \CodeIgniter\HTTP\URI(current_url()); ?>
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
            <!-- <a href="<?= base_url('/menu') ?>" class="btn btn-outline-info active">Main</a> -->
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
                    cellspacing="0" ng-init="getRoleAkses()">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Hak Akses</th>
                            <th>Dibuat Oleh</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Hak Akses</th>
                            <th>Dibuat Oleh</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr ng-repeat="d in datas">
                            <td>{{ $index +1 }}</td>
                            <td>{{ d.role_name }}</td>
                            <td>{{ d.created_by }}</td>
                            <td style="text-align: center; width: 100px;">
                                <button type="submit" class="btn btn-info" ng-click="getDetail(d.role_name)"><i
                                        class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" tabindex="1" role="dialog" id="HakAkses">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10px;">No</th>
                                <th>Main Menu</th>
                                <th>Main URL</th>
                                <th>Status Menu</th>
                                <th style="width: 50px;">Hak Akses</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Main Menu</th>
                                <th>Main URL</th>
                                <th>Status Menu</th>
                                <th>Hak Akses</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="d in dataMenu">
                                <td>{{ $index +1 }}</td>
                                <td>{{ d.name_sub_menu }}</td>
                                <td>{{ d.sub_url }}</td>
                                <td ng-if="d.status_sub_menu == '1'">Aktif</td>
                                <td ng-if="d.status_sub_menu == '0'">Tidak Aktif</td>
                                <td style="text-align: center; width: 150px;">
                                    <div
                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" id={{$index+1}}>
                                        <label class="custom-control-label" for={{$index+1}}></label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
</div>
<!-- <script type="text/javascript">
$('#rek_dasar').select2({
    // dropdownParent: $('#kodeBelanjaSub1'),
    placeholder: "Select Here",
    theme: "bootstrap-5"
});
</script> -->