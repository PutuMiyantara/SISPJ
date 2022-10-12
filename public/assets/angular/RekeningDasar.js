sispj.controller("RekeningDasar", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
    $scope.hide_kpa_ppk = true;
    $scope.hide_pptk = true;
    $scope.hide_bendahara = true;
    $scope.formModel = {};
    $scope.id_kode_dinas =
      $scope.id_kode_urusan =
      $scope.id_kode_bidang =
      $scope.id_kode_program =
      $scope.id_kode_kegiatan =
      $scope.id_kode_unit =
      $scope.id_kpa_ppk =
      $scope.id_pptk =
      $scope.id_bendahara = null;
  };

  $scope.tahunAnggaran = function () {
    $http.get("/rekdasar/getTahunAnggaran").then(function (data) {
      $scope.tahun = data.data;
      console.log(data)
    }, function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.changeTahunAnggaran = function () {
    console.log('test');
    if ($scope.tahunSelect == null) {
      $scope.getRekeningDasar(1);
    } else {
      $scope.getRekeningDasar($scope.tahunSelect);
    }
  };

  $scope.getRekeningDasar = function (tahun) {
    // 1 == all
    if (tahun == null) {
      tahun = 1;
    } else {
      tahun = tahun
    }
    console.log('tahun select:' + tahun);
    $http.get("/rekdasar/getRekeningDasar/" + tahun).then(function (data) {
      $scope.datas = data.data;
      console.log(data)
    }, function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function () {
    $scope.setDefault();
    $scope.openModal("#rekeningDasar");
    $scope.modalTitle = "Tambah Kode Rekening Dasar";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
  }

  $scope.submitData = function () {
    if ($scope.id == null) {
      $scope.insertData();
    }
    else {
      $scope.editData()
    }
  }

  $scope.insertData = function () {
    console.log($scope.id_kode_dinas)
    $http
      .post("/rekdasar/insertRekeningDasar", {
        id_kode_dinas: $scope.formModel.id_kode_dinas,
        id_kode_urusan: $scope.formModel.id_kode_urusan,
        id_kode_bidang: $scope.formModel.id_kode_bidang,
        id_kode_program: $scope.formModel.id_kode_program,
        id_kode_kegiatan: $scope.formModel.id_kode_kegiatan,
        id_kode_unit: $scope.formModel.id_kode_unit,
        nama_rekening_dasar: $scope.formModel.nama_rekening_dasar,
        tahun_anggaran: $scope.formModel.tahun_anggaran,
        jumlah_anggaran_rekening_dasar: $scope.formModel.jumlah_anggaran_rekening_dasar,
        id_kpa_ppk: $scope.formModel.id_kpa_ppk,
        id_pptk: $scope.formModel.id_pptk,
        id_bendahara: $scope.formModel.id_bendahara,
      })
      .then(
        function successCallback(data) {
          console.log(data.data);
          if (data.data.errortext == "") {
            $scope.id = $scope.kode_rek = $scope.uraian = null;
            $scope.setDefault();
            $scope.getRekeningDasar(1);
            $scope.closeModal("#rekeningDasar");
            $scope.success = true;
            $scope.message = data.data.message;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
          } else {
            $scope.message = data.data.errortext;
            $scope.error = true;
            $timeout(function () {
              $scope.error = false;
            }, 5000);
          }
        },
        function errorCallback(response) {
          $scope.error = true;
          $scope.message = "Gagal Menyimpan data";
          console.log("Gagal Menyimpan Data", response);
        }
      );
  };

  $scope.getDetail = function (id) {
    $scope.setDefault();
    $scope.searchKodeDinas();
    $scope.searchKodeUrusan();
    $scope.searchKodeBidang();
    $scope.searchKodeProgram();
    $scope.searchKodeKegiatan();
    $scope.searchKodeUnit();
    $scope.searchKpaPpk();
    $scope.searchPptk();
    $scope.searchBendahara();

    $http.get("/rekdasar/getDetailRekeningDasar/" + id).then(
      function successCallback(data) {
        $scope.openModal("#rekeningDasar");
        $scope.modalTitle = "Detail Kode Rekening Dasar";
        $scope.modalButton = "Update";
        $scope.actionButton = "Kembali";
        console.log(data);

        $scope.id = data.data[0].id;
        $scope.formModel.nama_rekening_dasar = data.data[0].nama_rekening_dasar;
        $scope.formModel.id_kode_dinas = data.data[0].id_kode_dinas;
        $scope.formModel.id_kode_urusan = data.data[0].id_kode_urusan;
        $scope.formModel.id_kode_bidang = data.data[0].id_kode_bidang;
        $scope.formModel.id_kode_program = data.data[0].id_kode_program;
        $scope.formModel.id_kode_kegiatan = data.data[0].id_kode_kegiatan;
        $scope.formModel.id_kode_unit = data.data[0].id_kode_unit;
        $scope.formModel.tahun_anggaran = data.data[0].tahun_anggaran;
        $scope.formModel.jumlah_anggaran_rekening_dasar = data.data[0].jumlah_anggaran_rekening_dasar;
        $scope.formModel.id_kpa_ppk = data.data[0].id_kpa_ppk;
        $scope.formModel.id_pptk = data.data[0].id_pptk;
        $scope.formModel.id_bendahara = data.data[0].id_bendahara;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.editData = function () {
    $http
      .post("/rekdasar/updateRekeningDasar/" + $scope.id, {
        id_kode_dinas: $scope.formModel.id_kode_dinas,
        id_kode_urusan: $scope.formModel.id_kode_urusan,
        id_kode_bidang: $scope.formModel.id_kode_bidang,
        id_kode_program: $scope.formModel.id_kode_program,
        id_kode_kegiatan: $scope.formModel.id_kode_kegiatan,
        id_kode_unit: $scope.formModel.id_kode_unit,
        nama_rekening_dasar: $scope.formModel.nama_rekening_dasar,
        tahun_anggaran: $scope.formModel.tahun_anggaran,
        jumlah_anggaran_rekening_dasar: $scope.formModel.jumlah_anggaran_rekening_dasar,
        id_kpa_ppk: $scope.formModel.id_kpa_ppk,
        id_pptk: $scope.formModel.id_pptk,
        id_bendahara: $scope.formModel.id_bendahara,
      })
      .then(
        function successCallback(data) {
          console.log(data.data);
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getRekeningDasar(1);
            $scope.success = true;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
            $scope.message = data.data.message;
          } else {
            $scope.error = true;
            $scope.message = data.data.errortext;
          }
        },
        function errorCallback(response) {
          console.log(response);
        }
      );
  };

  $scope.deleteData = function (id) {
    var isconfirm = confirm("Ingin Menghapus Data?");
    if (isconfirm) {
      $http.post("/rekdasar/deleteRekeningDasar", {
        id: id,
      }).then(
        function successCallback(data) {
          $scope.getRekeningDasar(1);
          $scope.message = "Data Berhasil Dihapus";
          $scope.success = true;
          $timeout(function () {
            $scope.success = false;
          }, 5000);
        }
      );
    }

  }

  $scope.openModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("show");
  };

  $scope.closeModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("hide");
  };

  // searchbox rekening DINAS
  $scope.searchKodeDinas = function () {
    $http.get("/rekdasar/getKodeDinas/search").then(function (data) {
      console.log(data.data);
      $scope.getKodeDinas = data.data;
    });
  };

  // searchbox rekening URUSAN
  $scope.searchKodeUrusan = function () {
    $http.get("/rekdasar/getKodeUrusan/search").then(function (data) {
      $scope.getKodeUrusan = data.data;
    });
  };

  // searchbox rekening BIDANG
  $scope.searchKodeBidang = function () {
    $http.get("/rekdasar/getKodeBidang/search").then(function (data) {
      $scope.getKodeBidang = data.data;
    });
  };

  // searchbox rekening PROGRAM
  $scope.searchKodeProgram = function () {
    $http.get("/rekdasar/getKodeProgram/search").then(function (data) {
      $scope.getKodeProgram = data.data;
    });
  };

  // searchbox rekening KEGIATAN
  $scope.searchKodeKegiatan = function () {
    $http.get("/rekdasar/getKodeKegiatan/search").then(function (data) {
      $scope.getKodeKegiatan = data.data;
    });
  };

  // searchbox rekening UNIT
  $scope.searchKodeUnit = function () {
    $http.get("/rekdasar/getKodeUnit/search").then(function (data) {
      $scope.getKodeUnit = data.data;
    });
  };

  // searchbox KPA PPK
  $scope.searchKpaPpk = function () {
    $http.get("/penanggungjawab/getKpaPpk/search").then(function (data) {
      $scope.getKpaPpk = data.data;
    });
  };

  // searchbox PPTK
  $scope.searchPptk = function () {
    $http.get("/penanggungjawab/getPptk/search").then(function (data) {
      $scope.getPptk = data.data;
    });
  };

  // searchbox Bendahara
  $scope.searchBendahara = function () {
    $http.get("/penanggungjawab/getBendahara/search").then(function (data) {
      $scope.getBendahara = data.data;
    });
  };
});
