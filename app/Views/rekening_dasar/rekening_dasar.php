<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="RekeningDasar">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data User</h1>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rekening Dasar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Rekening Dasar</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('/rekdasar') ?>" class="btn btn-outline-info active">Rekening Dasar</a>
            <a href="<?= base_url('/rekdasar/dinas') ?>" class="btn btn-outline-info">Kode Dinas</a>
            <a href="<?= base_url('/rekdasar/urusan') ?>" class="btn btn-outline-info">Kode Urusan</a>
            <a href="<?= base_url('/rekdasar/bidang') ?>" class="btn btn-outline-info">Kode Bidang</a>
            <a href="<?= base_url('/rekdasar/kegiatan') ?>" class="btn btn-outline-info">Kode Kegiatan</a>
            <a href="<?= base_url('/rekdasar/program]') ?>" class="btn btn-outline-info">Kode Program</a>
            <a href="<?= base_url('/rekdasar/unit') ?>" class="btn btn-outline-info">Kode Unit</a>
        </div>
        <div class="card-body">
            <div>
                <div class="alert alert-danger alert-dismissable" ng-show="errror">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                </div>
                <div class="alert alert-success alert-dismissable" ng-show="success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                </div>
            </div>
            <div class="table-responsive">
                <a href="/rekdasar/dinas/tambah" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                    style="margin-bottom: 10px;"><i class="fas fa-plus fa-sm text-white-50"></i>Tambah
                    Data</a>
                <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                    cellspacing="0" ng-init="getUser()">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Nama Rekening</th>
                            <th>Kode Dinas</th>
                            <th>Kode Urusan</th>
                            <th>Kode Bidang</th>
                            <th>Kode Program</th>
                            <th>Kode Kegiatan</th>
                            <th>Kode Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Nama Rekening</th>
                            <th>Kode Dinas</th>
                            <th>Kode Urusan</th>
                            <th>Kode Bidang</th>
                            <th>Kode Program</th>
                            <th>Kode Kegiatan</th>
                            <th>Kode Unit</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr ng-repeat="d in datas">
                            <td>{{ $index +1 }}</td>
                            <td>{{ d.kode_dinas }}</td>
                            <td>{{ d.kode_urusan }}</td>
                            <td>{{ d.kude_bidang }}</td>
                            <td>{{ d.kode_program }}</td>
                            <td>{{ d.kode_kegiatan }}</td>
                            <td>{{ d.kode_unit }}</td>
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
    <div class="modal fade" tabindex="1" role="dialog" id="detailEditUser">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" name="formUser" id="formDetailUser"
                    ng-submit="editData()">
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
                            <div class="col"><label>Nama</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="nama" ng-model="nama"
                                        ng-required="true" ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Email</label><br>
                                <small style="color: red;"
                                    ng-show="formUser.email.$touched && formUser.email.$error.required">Masukan Alamat
                                    Email</small>
                                <small style="color: red;"
                                    ng-show="formUser.email.$dirty && formUser.email.$error.email">Masukan Email dengan
                                    Benar</small>
                            </div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="email" class="form-control" name="email" ng-model="email"
                                        ng-required="true"
                                        ng-style="formUser.email.$dirty && formUser.email.$invalid && {'border':'solid red'}"
                                        ng-readonly="readOnly">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col">
                                <label>Password</label><br>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <small style="color: red;"
                                        ng-show="formUser.password.$touched && formUser.password.$error.required">Masukan
                                        Password</small>
                                    <small style="color: red;"
                                        ng-if="formUser.password.$dirty && password.length < 8">Minimal
                                        8 Karakter</small>
                                </div>
                                <div class="col-sm-6"><small ng-style="s_msg">{{msg}}</small></div>
                                <div class="col-sm-6">
                                    <input type="{{typepass}}" name="password" class="form-control"
                                        placeholder="Password" ng-model="password" ng-change="check()"
                                        ng-style="spassword">
                                </div>
                                <div class="col-sm-5">
                                    <input type="{{typepass}}" class="form-control" name="repass"
                                        placeholder="Repeat Password" ng-model="repass" ng-change="check()"
                                        ng-style="srepass">
                                </div>
                                <div><span class="{{showHide}}" style="cursor: pointer; margin-top: 10px"
                                        ng-click="showPassword()" style="align-content: center"></span></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Status Aktif</label></div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-6 mb-sm-0">
                                    <small style="color: red;"
                                        ng-show="formUser.status.$touched && formUser.status.$error.required">Pilih
                                        Status Aktif Pegawai</small>
                                    <select name="status" class="form-control" ng-model="status" ng-required="true"
                                        ng-disabled="readOnly">
                                        <option value="1">Aktif</option>
                                        <option value="2">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="idUser" ng-model="iduser" ng-hide="true">
                        <!-- <input type="text" name="file_lama" ng-model="file_lama" ng-hide="false"> -->
                        <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                                Update</i></button>
                        <button type="button" class="btn btn-danger col-sm-3 mb-6"
                            ng-click="closeModal('#detailEditUser')">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
</div>