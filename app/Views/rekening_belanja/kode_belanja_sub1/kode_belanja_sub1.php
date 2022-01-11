<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="kodesub1">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kode Belanja Sub 1</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Master Data</li>
                        <li class="breadcrumb-item active">Rekening Dasar</li>
                        <li class="breadcrumb-item active">Kode Belanja Sub 1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="/kodesub1/tambah" class="d-none d-sm-inline-block btn btn-primary shadow-sm"
                                style="margin-bottom: 10px;"><i class="fa fa-plus text-white-100"></i> Tambah
                                Data</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-hover text-nowrap" ng-init="getKodeSub1()">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No</th>
                                        <th>Kode Rekening</th>
                                        <th>Uraian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr ng-repeat="item in items track by $index"> -->
                                    <tr ng-repeat="d in datas">
                                        <td>{{$index +1}}</td>
                                        <td>{{ d.kode_belanja_sub1 }}</td>
                                        <td>{{ d.uraian }}</td>
                                        <td>
                                            <button class="btn btn-info">Detail</button>
                                            <button class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Rekening</th>
                                        <th>Uraian</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->