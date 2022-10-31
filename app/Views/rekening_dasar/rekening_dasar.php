<?php $session = session();
$uri = new \CodeIgniter\HTTP\URI(current_url()); ?>
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
            <?php
                foreach ($dataUrl as $main) {
                    # code...
                    foreach ($main['sub_menu'] as $sub) {
                        # code...
                        foreach ($sub['subsub_menu'] as $subsub) {
                            # code...
                            if (preg_replace("/[^a-zA-Z]/", "", $subsub['sub_sub_url']) == $uri->getSegment(2)) {
                                # code...
                                foreach ($subsub['kategori'] as $kategori) {
                                    # code...
                                    ?>
            <a href="<?= base_url($sub['sub_url'].$subsub['sub_sub_url'].$kategori['kategori_url'])?>" class="btn btn-outline-info 
                    <?php if ($uri->getSegment(3) == preg_replace("/[^a-zA-Z]/", "", $kategori['kategori_url'])): echo 'active'; 
                    else: ''; endif ?>
                    "><?= $kategori['name_kategori_menu'] ?></a>
            <?php
                                }
                            }
                        }
                    }
                }
            ?>
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
                <div style="float: right;" ng-init="tahunAnggaran()">
                    <select ng-options="rekDasar.tahun_anggaran as rekDasar.tahun_anggaran for rekDasar in tahun"
                        ng-model="tahunSelect" ng-change="changeTahunAnggaran()" class="form-control-sm">
                        <option label="" value="">All</option>
                    </select>
                </div>
                <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                    cellspacing="0" ng-init="getRekeningDasar()">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Nama Rekening</th>
                            <th>Tahun Anggaran</th>
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
                            <th>Tahun Anggaran</th>
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
                            <td>{{ d.tahun_anggaran }}</td>
                            <td>{{ d.kode_rek_dinas }}</td>
                            <td>{{ d.kode_rek_urusan }}</td>
                            <td>{{ d.kode_rek_bidang }}</td>
                            <td>{{ d.kode_rek_program }}</td>
                            <td>{{ d.kode_rek_kegiatan }}</td>
                            <td>{{ d.kode_rek_unit }}</td>
                            <td>Rp. {{ d.jumlah_anggaran_rekening_dasar }}</td>
                            <td style="width: 100px;">
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
    <div class="modal fade" role="dialog" role="dialog" aria-hidden="true" id="rekeningDasar">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" name="formModel" ng-submit="submitData()">
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
                                <div class="col-sm-2" ng-init="searchKodeDinas()">
                                    <select style="width: 100%;" id="kode_rek_dinas" select2="" class="form-control"
                                        name="kode_rek_dinas" ng-model="formModel.id_kode_dinas"
                                        ng-options="kode_rek_dinas.id_kode_dinas as kode_rek_dinas.kode_dinas for kode_rek_dinas in getKodeDinas"
                                        ng-required="true" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                                <div class="col-sm-2" ng-init="searchKodeUrusan()">
                                    <select style="width: 100%;" id="kode_rek_urusan" select2="" class="form-control"
                                        name="kode_rek_urusan" ng-model="formModel.id_kode_urusan"
                                        ng-options="kode_rek_urusan.id_kode_urusan as kode_rek_urusan.kode_urusan for kode_rek_urusan in getKodeUrusan"
                                        ng-required="true" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                                <div class="col-sm-2" ng-init="searchKodeBidang()">
                                    <select style="width: 100%;" id="kode_rek_bidang" select2="" class="form-control"
                                        name="kode_rek_bidang" ng-model="formModel.id_kode_bidang"
                                        ng-options="kode_rek_bidang.id_kode_bidang as kode_rek_bidang.kode_bidang for kode_rek_bidang in getKodeBidang"
                                        ng-required="true" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                                <div class="col-sm-2" ng-init="searchKodeProgram()">
                                    <select style="width: 100%;" id="kode_rek_program" select2="" class="form-control"
                                        name="kode_rek_program" ng-model="formModel.id_kode_program"
                                        ng-options="kode_rek_program.id_kode_program as kode_rek_program.kode_program for kode_rek_program in getKodeProgram"
                                        ng-required="true" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                                <div class="col-sm-2" ng-init="searchKodeKegiatan()">
                                    <select style="width: 100%;" id="kode_rek_kegiatan" select2="" class="form-control"
                                        name="kode_rek_kegiatan" ng-model="formModel.id_kode_kegiatan"
                                        ng-options="kode_rek_kegiatan.id_kode_kegiatan as kode_rek_kegiatan.kode_kegiatan for kode_rek_kegiatan in getKodeKegiatan"
                                        ng-required="true" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                                <div class="col-sm-2" ng-init="searchKodeUnit()">
                                    <select style="width: 100%;" id="kode_rek_unit" select2="" class="form-control"
                                        name="kode_rek_unit" ng-model="formModel.id_kode_unit"
                                        ng-options="kode_rek_unit.id_kode_unit as kode_rek_unit.kode_unit for kode_rek_unit in getKodeUnit"
                                        ng-required="true" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nama Rekening</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <textarea class="form-control" name="nama_rekening_dasar"
                                        ng-model="formModel.nama_rekening_dasar" ne-required="true" ng-readonly="false">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Tahun Anggaran</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="year" class="form-control" name="tahun_anggaran"
                                        ng-model="formModel.tahun_anggaran" ne-required="true" ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Jumlah Anggaran</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="jumlah_anggaran_rekening_dasar"
                                        ng-model="formModel.jumlah_anggaran_rekening_dasar" ne-required="true"
                                        ng-readonly="false">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Pejabat KPA PPK</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row" ng-init="searchKpaPpk()">
                                    <select style="width: 100%;" id="kpa_ppk_rek_dasar" select2="" class="form-control"
                                        name="kpa_ppk_rek_dasar" ng-model="formModel.id_kpa_ppk"
                                        ng-options="kpa_ppk_rek_dasar.id as kpa_ppk_rek_dasar.kpa_ppk for kpa_ppk_rek_dasar in getKpaPpk"
                                        ng-required="true" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Pejabat PPTK</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row" ng-init="searchPptk()">
                                    <select style="width: 100%;" id="pptk_rek_dasar" select2="" class="form-control"
                                        name="pptk_rek_dasar" ng-model="formModel.id_pptk"
                                        ng-options="pptk_rek_dasar.id as pptk_rek_dasar.pptk for pptk_rek_dasar in getPptk"
                                        ng-required="true" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Pejabat Bendahara Pengeluaran</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row" ng-init="searchBendahara()">
                                    <select style="width: 100%;" id="bendahara_rek_dasar" select2=""
                                        class="form-control" name="bendahara_rek_dasar"
                                        ng-model="formModel.id_bendahara"
                                        ng-options="bendahara_rek_dasar.id as bendahara_rek_dasar.bendahara for bendahara_rek_dasar in getBendahara"
                                        ng-required="true" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="id" ng-model="id" ng-hide="true" ng-readonly="true">
                        <button type="submit" class="btn btn-success col-sm-2 mb-3"><i class="fa fa-save">
                            </i> {{ modalButton }}</button>
                        <button type="button" class="btn btn-danger col-sm-2 mb-3"
                            ng-click="closeModal('#rekeningDasar')"><i class="fa fa-right-from-bracket"></i>
                            Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</div>