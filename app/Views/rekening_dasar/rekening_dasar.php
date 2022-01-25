<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="RekeningDasar">

    <!-- Page Heading -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kode Rekening Dasar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Rekening Dasar</a></li>
                        <li class="breadcrumb-item"><a href="#">Kode Rekening Dasar</a></li>
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
                <div style="float: right;">
                    <select>
                        <option>2021</option>
                        <option>2022</option>
                    </select>
                </div>
                <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                    cellspacing="0" ng-init="getRekeningDasar()">
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
                            <th>Jumlah Anggaran</th>
                            <th style="width: 80px;">Action</th>
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
                            <th>Jumlah Anggaran</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr ng-repeat="d in datas">
                            <td>{{ $index +1 }}</td>
                            <td>{{ d.nama_rekening_dasar }}</td>
                            <td>{{ d.kode_rek_dinas }}</td>
                            <td>{{ d.kode_rek_urusan }}</td>
                            <td>{{ d.kode_rek_bidang }}</td>
                            <td>{{ d.kode_rek_program }}</td>
                            <td>{{ d.kode_rek_kegiatan }}</td>
                            <td>{{ d.kode_rek_unit }}</td>
                            <td>Rp. {{ d.jumlah_anggaran_rekening_dasar }}</td>
                            <td style="text-align: center;">
                                <button type="submit" class="btn btn-info" ng-click="getDetail(d.id)"><i
                                        class="fa fa-edit"></i></button>
                                <button type="submit" class="btn btn-danger" ng-click="deleteData(d.id)"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" tabindex="1" role="dialog" id="rekeningDasar">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" name="formRekeningDasar" ng-submit="submitData()">
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
                            <div class="col">
                                <label>Kode Rekening</label>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_rek_dinas"
                                        ng-model="kode_rek_dinas" ng-required="false" ng-readonly="false"
                                        ng-keyup="searchRekDinas(kode_rek_dinas)" ng-style="kode_rek_dinas_style">
                                    <ul class="list-group" ng-hide="hide_rek_dinas"
                                        style="height: 100px;overflow: auto;">
                                        <li class="list-group-item list-group-item-action"
                                            ng-repeat="kode_dinas in filterRekDinas"
                                            ng-click="fillRekDinas(kode_dinas.id ,kode_dinas.kode_rek_dinas)">
                                            <a href=""
                                                style="color: black; text-align: right; text-decoration: none;">{{kode_dinas.kode_rek_dinas}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_rek_urusan"
                                        ng-model="kode_rek_urusan" ng-required="false" ng-readonly="false"
                                        ng-keyup="searchRekUrusan(kode_rek_urusan)" ng-style="kode_rek_urusan_style">
                                    <ul class="list-group" ng-hide="hide_rek_urusan"
                                        style="height: 100px;overflow: auto;">
                                        <li class="list-group-item list-group-item-action"
                                            ng-repeat="kode_urusan in filterRekUrusan"
                                            ng-click="fillRekUrusan(kode_urusan.id ,kode_urusan.kode_rek_urusan)">
                                            <a href=""
                                                style="color: black; text-align: right; text-decoration: none;">{{kode_urusan.kode_rek_urusan}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_rek_bidang"
                                        ng-model="kode_rek_bidang" ng-required="false" ng-readonly="false"
                                        ng-keyup="searchRekBidang(kode_rek_bidang)" ng-style="kode_rek_bidang_style">
                                    <ul class="list-group" ng-hide="hide_rek_bidang"
                                        style="height: 100px;overflow: auto;">
                                        <li class="list-group-item list-group-item-action"
                                            ng-repeat="kode_bidang in filterRekbidang"
                                            ng-click="fillRekBidang(kode_bidang.id ,kode_bidang.kode_rek_bidang)">
                                            <a href=""
                                                style="color: black; text-align: right; text-decoration: none;">{{kode_bidang.kode_rek_bidang}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_rek_kegiatan"
                                        ng-model="kode_rek_kegiatan" ng-required="false" ng-readonly="false"
                                        ng-keyup="searchRekKegiatan(kode_rek_kegiatan)"
                                        ng-style="kode_rek_kegiatan_style">
                                    <ul class="list-group" ng-hide="hide_rek_kegiatan"
                                        style="height: 100px;overflow: auto;">
                                        <li class="list-group-item list-group-item-action"
                                            ng-repeat="kode_kegiatan in filterRekKegiatan"
                                            ng-click="fillRekKegiatan(kode_kegiatan.id ,kode_kegiatan.kode_rek_kegiatan)">
                                            <a href=""
                                                style="color: black; text-align: right; text-decoration: none;">{{kode_kegiatan.kode_rek_kegiatan}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_rek_program"
                                        ng-model="kode_rek_program" ng-required="false" ng-readonly="false"
                                        ng-keyup="searchRekProgram(kode_rek_program)" ng-style="kode_rek_program_style">
                                    <ul class="list-group" ng-hide="hide_rek_program"
                                        style="height: 100px;overflow: auto;">
                                        <li class="list-group-item list-group-item-action"
                                            ng-repeat="kode_program in filterRekProgram"
                                            ng-click="fillRekProgram(kode_program.id ,kode_program.kode_rek_program)">
                                            <a href=""
                                                style="color: black; text-align: right; text-decoration: none;">{{kode_program.kode_rek_program}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_rek_unit"
                                        ng-model="kode_rek_unit" ng-required="false" ng-readonly="false"
                                        ng-keyup="searchRekUnit(kode_rek_unit)" ng-style="kode_rek_unit_style">
                                    <ul class="list-group" ng-hide="hide_rek_unit"
                                        style="height: 100px;overflow: auto;">
                                        <li class="list-group-item list-group-item-action"
                                            ng-repeat="kode_kegiatan in filterRekUnit"
                                            ng-click="fillRekUnit(kode_kegiatan.id ,kode_kegiatan.kode_rek_unit)">
                                            <a href=""
                                                style="color: black; text-align: right; text-decoration: none;">{{kode_kegiatan.kode_rek_unit}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nama Rekening</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <textarea class="form-control" name="nama_rekening_dasar"
                                        ng-model="nama_rekening_dasar" ng-required="false" ng-readonly="false">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Tahun Anggaran</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="year" class="form-control" name="tahun_anggaran"
                                        ng-model="tahun_anggaran" ng-required="false" ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Jumlah Anggaran</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="jumlah_anggaran_rekening_dasar"
                                        ng-model="jumlah_anggaran_rekening_dasar" ng-required="false"
                                        ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Pejabat KPA PPK</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="nama_kpa_ppk" ng-model="nama_kpa_ppk"
                                        ng-required="false" ng-readonly="false">
                                    <ul class="list-group" ng-hide="hide_kpa_ppk" style="height: 100px;overflow: auto;">
                                        <li class="list-group-item list-group-item-action"
                                            ng-repeat="kpa_ppk in filterKpaPpk"
                                            ng-click="fillKpaPpk(kpa_ppk.id ,kpa_ppk.nama_kpa_ppk, kpa_ppk.nip_kpa_ppk)">
                                            <a href=""
                                                style="color: black; text-align: right; text-decoration: none;">{{kpa_ppk.nama_kpa_ppk}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Pejabat PPTK</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="nama_pptk" ng-model="nama_pptk"
                                        ng-required="false" ng-readonly="false">
                                    <ul class="list-group" ng-hide="hide_pptk" style="height: 100px;overflow: auto;">
                                        <li class="list-group-item list-group-item-action"
                                            ng-repeat="pptk in filterPptk"
                                            ng-click="fillPptk(pptk.id ,pptk.nama_pptk, pptk.nip_pptk)">
                                            <a href=""
                                                style="color: black; text-align: right; text-decoration: none;">{{pptk.nama_pptk}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Bendahara Pengeluaran</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="nama_bendahara"
                                        ng-model="nama_bendahara" ng-required="false" ng-readonly="false">
                                    <ul class="list-group" ng-hide="hide_bendahara"
                                        style="height: 100px;overflow: auto;">
                                        <li class="list-group-item list-group-item-action"
                                            ng-repeat="bendahara in filterBendahara"
                                            ng-click="fillBendahara(bendahara.id ,bendahara.nama_bendahara, bendahara.nip_bendahara)">
                                            <a href=""
                                                style="color: black; text-align: right; text-decoration: none;">{{bendahara.nama_bendahara}})</a>
                                        </li>
                                    </ul>
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