<?php $session = session();
$uri = new \CodeIgniter\HTTP\URI(current_url()); ?>

<body id="page-top" ng-app="sispj">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class=" navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" <?php
                                                                                        if ($session->has('email') && $session->get('role') == 3) {
                                                                                            echo 'href = "/home/admin"';
                                                                                        } else {
                                                                                            echo 'href="/home/user"';
                                                                                        }
                                                                                        ?>>
                <div class="sidebar-brand-icon">
                    <i>
                        <img src="/assets/foto/lambangklungkung.png" style="width: 60px; height: 50px;">
                    </i>
                </div>
                <div class="sidebar-brand-text mx-3">SISPJ</div>
            </a>
            <hr class="sidebar-divider">

            <!-- foreach mein menu -->
            <?php foreach ($dataUrl as $main) : 
                # code...
                ?>
            <div class="sidebar-heading">
                <?= $main['name_main_menu'] ?>
            </div>
            <?php
                foreach ($main['sub_menu'] as $sub) :
                # code...
                    if (count($sub['subsub_menu']) == 0) :
                        # code...
                        ?>
            <li class="nav-item <?php if ($uri->getSegment(1) == preg_replace("/[^a-zA-Z]/", "", $sub['sub_url'])): echo 'active'; 
                else: ''; endif?>">
                <a class="nav-link" href="<?php
                $role_user = '';
                if (preg_replace("/[^a-zA-Z]/", "", $sub['sub_url']) == 'dashboard') {
                    # code...
                    if ($session->get('role') == '3') {
                        # code...
                        $role_user = 'admin';
                    } elseif ($session->get('role') == '1') {
                        # code...
                        $role_user = 'pegawai';
                    } elseif ($session->get('role') == '2') {
                        # code...
                        $role_user = 'monitoring';
                    }
                }
                echo $sub['sub_url'] . '/' . $role_user;
                ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span><?= $sub['name_sub_menu'] ?></span></a>
            </li>
            <?php
                    else:
                        ?>
            <li
                class="nav-item <?php if ($uri->getSegment(1) == preg_replace("/[^a-zA-Z]/", "", $sub['sub_url'])): echo 'active'; else: ''; endif?>">
                <a class=" nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#rekdasarmenu<?= $sub['id_sub_menu']?>" aria-expanded="true"
                    aria-controls="rekdasarmenu">
                    <i class="fas fa-fw fa-table"></i>
                    <span><?= $sub['name_sub_menu'] ?></span>
                </a>
                <div id="rekdasarmenu<?= $sub['id_sub_menu']?>" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">--Pilihan--</h6>
                        <?php
                            foreach ($sub['subsub_menu'] as $subsub) :
                                # code...
                                ?>
                        <a class="collapse-item <?php if ($uri->getSegment(2) == preg_replace("/[^a-zA-Z]/", "", $subsub['sub_sub_url'])): echo 'active'; else: ''; endif?>"
                            href="<?= $sub['sub_url'].$subsub['sub_sub_url'] ?>"><?= $subsub['name_sub_sub_menu'] ?></a>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
            </li>
            <?php
                    endif;
                endforeach;
            endforeach;
            ?>
            <!-- ============================================================================ -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- endforeach main menu -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow">
                    <div style="margin-right: 10px;">
                        <img style="width: 50px; height: 50px;" src="/assets/foto/lambangklungkung.png">
                    </div>
                    <div>
                        <h1 style="text-decoration: solid;">SI SPJ</h1>
                        <h5 style="margin-top: -10px;">UPTD Pengelolaan Pasar Klungkung</h5>
                    </div>
                    <ul class="navbar-nav ml-auto" ng-controller="User">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow" ng-init="getHeaderUser(<?= $session->get('id') ?>)">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- buatin js untuk get ini berdasarkan id dari session agar saat update data langsung nama dan foto keganti -->
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ nama }}</span>
                                <img class="img-profile rounded-circle" src="{{ foto }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href=""
                                    ng-click="getdetailuserHeader(<?= $session->get('id') ?>)">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                        <!-- Modal -->
                        <div class="modal fade" tabindex="1" role="dialog" id="detailuserHeader">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" enctype="multipart/form-data" name="formUser"
                                        ng-submit="edituserHeader()">
                                        <div class="modal-header">
                                            <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger alert-dismissable" ng-show="error">
                                                <a href="#" class="close" data-dismiss="alert"
                                                    aria-label="close">&times;</a>{{message}}
                                            </div>
                                            <div class="alert alert-success alert-dismissable" ng-show="success">
                                                <a href="#" class="close" data-dismiss="alert"
                                                    aria-label="close">&times;</a>{{message}}
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Nama</label></div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="nama"
                                                            ng-model="nama" ng-required="true" ng-readonly="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Email</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formUser.email.$touched && formUser.email.$error.required">Masukan
                                                        Alamat
                                                        Email</small>
                                                    <small style="color: red;"
                                                        ng-show="formUser.email.$dirty && formUser.email.$error.email">Masukan
                                                        Email
                                                        dengan
                                                        Benar</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="email" class="form-control" name="email"
                                                            ng-model="email" ng-required="true"
                                                            ng-style="formUser.email.$dirty && formUser.email.$invalid && {'border':'solid red'}">
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
                                                            placeholder="Password" ng-model="password"
                                                            ng-change="check()" ng-style="spassword">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="{{typepass}}" class="form-control" name="repass"
                                                            placeholder="Repeat Password" ng-model="repass"
                                                            ng-change="check()" ng-style="srepass">
                                                    </div>
                                                    <div><span class="{{showHide}}"
                                                            style="cursor: pointer; margin-top: 10px" ord()"
                                                            style="align-content: center"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Foto</label></div>
                                                <div class="form-group row">
                                                    <div class="col-3">
                                                        <img style="width: 80px; height: 100px;"
                                                            src="/foto/<?= $session->get('foto') ?>" ng-hide="false"
                                                            class="img-thumbnail">
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="file" class="form-control" name="file_foto"
                                                            file-input="files"
                                                            onchange="angular.element(this).scope().filesChanged(this)"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <li ng-repeat="file in files">{{file.name}}</li> -->
                                        </div>
                                        <div class="modal-footer">
                                            <input type="text" name="iduser" ng-model="iduser" ng-hide="true">
                                            <!-- <input type="text" name="file_lama" ng-model="file_lama" ng-hide="false"> -->
                                            <button type="submit" class="btn btn-success col-sm-3 mb-6"><i
                                                    class="fas fa-edit"> Update</i></button>
                                            <button type="button" class="btn btn-danger col-sm-3 mb-6"
                                                ng-click="closeModal('#detailuserHeader')">Kembali</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->

                    </ul>

                </nav>
                <!-- End of Topbar -->