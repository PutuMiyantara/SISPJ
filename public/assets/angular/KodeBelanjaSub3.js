sispj.controller("KodeBelanjaSub3", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
    $scope.formModel = {};
    $scope.formModel.id_rekening_dasar = null;
    $scope.formModel.id_kode_belanja_sub1 = null;
    $scope.id = null;
  };

  $scope.getKodeBelanjaSub3 = function () {
    $http.get("/rekbelanja/getKodeBelanjaSub3").then(function (data) {
      $scope.datas = data.data;
      // console.log(data)
    }, function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function () {
    $scope.openModal("#kodeBelanjaSub3");
    $scope.modalTitle = "Tambah Kode Rekening Belanja Sub 3";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
    $scope.hideRekRefSub1 = true;
    $scope.hideRekRefSub2 = true;
    $scope.hideRefPengurusBarang = true;
    $scope.setDefault();

  }

  $scope.submitData = function () {
    if ($scope.id == null) {
      $scope.insertData();
      // console.log('insertdata');
    }
    else {
      $scope.editData()
      // console.log('edit data');
    }
  }

  $scope.insertData = function () {
    $http
      .post("/rekbelanja/insertKodeBelanjaSub3", {
        kode_belanja_sub3: $scope.formModel.kode_belanja_sub3,
        nama_rekening_belanja_sub3: $scope.formModel.nama_rekening_belanja_sub3,
        jumlah_anggaran_belanja_sub3: $scope.formModel.jumlah_anggaran_belanja_sub3,
        id_kode_belanja_sub2: $scope.formModel.id_kode_belanja_sub2,
        keterangan_kode_belanja_sub3: $scope.formModel.keterangan_kode_belanja_sub3,
        id_pengurus_barang: $scope.formModel.id_pengurus_barang,
      })
      .then(
        function successCallback(data) {
          console.log(data.data);
          if (data.data.errortext == "") {
            $scope.kode_rek_kegiatan = $scope.nama = null;
            $scope.getKodeBelanjaSub3();
            $scope.closeModal("#kodeBelanjaSub3");
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

  $scope.getDetail = function (id, id_rek_dasar, id_kode_belanja_sub1) {
    $scope.setDefault();
    $scope.dataRekBelanjaSub1(id_rek_dasar);
    $scope.dataRekBelanjaSub2(id_kode_belanja_sub1);
    $scope.dataRekBelanjaSub2(id_kode_belanja_sub1);
    $scope.hideForAddSub = false;
    $scope.hideRekRef = false;
    $http.get("/rekbelanja/getDetailKodeBelanjaSub3/" + id).then(
      function successCallback(data) {
        console.log(data);
        $scope.openModal("#kodeBelanjaSub3");
        $scope.modalTitle = "Detail Kode Belanja Sub 3";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";

        $scope.id = data.data[0].id;
        $scope.formModel.kode_belanja_sub3 = data.data[0].kode_belanja_sub3;
        $scope.formModel.nama_rekening_belanja_sub3 = data.data[0].nama_rekening_belanja_sub3;
        $scope.formModel.jumlah_anggaran_belanja_sub3 = data.data[0].jumlah_anggaran_belanja_sub3;
        $scope.formModel.kode_rek_dasar =
          data.data[0].kode_rek_dinas + '.' +
          data.data[0].kode_rek_urusan + '.' +
          data.data[0].kode_rek_bidang + '.' +
          data.data[0].kode_rek_kegiatan + '.' +
          data.data[0].kode_rek_program + '.' +
          data.data[0].kode_rek_unit + ' - ' +
          data.data[0].nama_rekening_dasar;
        $scope.formModel.id_rekening_dasar = data.data[0].id_rekening_dasar;
        $scope.formModel.id_kode_belanja_sub1 = data.data[0].id_kode_belanja_sub1;
        $scope.formModel.id_kode_belanja_sub2 = data.data[0].id_kode_belanja_sub2;
        $scope.formModel.tahun_anggaran = data.data[0].tahun_anggaran;
        $scope.formModel.keterangan_kode_belanja_sub3 = data.data[0].keterangan_kode_belanja_sub3;
        if (data.data[0].keterangan_kode_belanja_sub3 == "Barang") {
          console.log("barang");
          $scope.changeJenisBelanja(data.data[0].keterangan_kode_belanja_sub3);
          $scope.dataPengurusBarang();
          $scope.formModel.id_pengurus_barang = data.data[0].id_pengurus_barang;
        } else {
          console.log("jasa");
          $scope.changeJenisBelanja(data.data[0].keterangan_kode_belanja_sub3);
          $scope.formModel.id_pengurus_barang = null;
        }
        console.log("id rek sub1 get detail " + $scope.formModel.id_kode_belanja_sub1);
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.editData = function () {
    $http
      .post("/rekbelanja/updateKodeBelanjaSub3/" + $scope.id, {
        kode_belanja_sub3: $scope.formModel.kode_belanja_sub3,
        nama_rekening_belanja_sub3: $scope.formModel.nama_rekening_belanja_sub3,
        jumlah_anggaran_belanja_sub3: $scope.formModel.jumlah_anggaran_belanja_sub3,
        id_kode_belanja_sub2: $scope.formModel.id_kode_belanja_sub2,
        keterangan_kode_belanja_sub3: $scope.formModel.keterangan_kode_belanja_sub3,
        id_pengurus_barang: $scope.formModel.id_pengurus_barang,
      })
      .then(
        function successCallback(data) {
          console.log(data)
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getKodeBelanjaSub3();
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
      $http.post("/rekbelanja/deleteKodeBelanjaSub3", {
        id: id,
      }).then(
        function successCallback(data) {
          $scope.getKodeBelanjaSub3();
          $scope.message = "Data Berhasil Dihapus";
          $scope.success = true;
          $timeout(function () {
            $scope.success = false;
          }, 5000);
        },
        function errorCallback(response) {
          console.log(response);
          $scope.message = "Data Gagal Dihapus";
          $scope.error = true;
          $timeout(function () {
            $scope.error = false;
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

  $scope.hideRekRef = true;
  $scope.dataRekDasar = function () {
    $http.get("/rekbelanja/searchRekDasar").then(function (data) {
      // console.log("dataRekDasar: " + data.data.id);
      $scope.getRekDasar = data.data;
    });
  };

  $scope.rekDasarChange = function (where) {
    if (where != null) {
      $http.get("/rekdasar/getDetailRekeningDasar/" + where).then(
        function successCallback(data) {
          // console.log(data);
          $scope.formModel.tahun_anggaran = data.data[0].tahun_anggaran;
        },
        function errorCallback(response) {
          console.log(response);
          alert("error");
        }
      );
    }
    $scope.dataRekBelanjaSub1(where);
  };

  $scope.dataRekBelanjaSub1 = function (where) {
    if (where != null) {
      $scope.hideRekRefSub1 = false;
      $http.get("/rekbelanja/searchRekBelanjaSub1/" + where).then(function (data) {
        $scope.getRekRefSub1 = data.data;
        // console.log($scope.getRekRefSub1);
      });
    }
  };

  $scope.rekSub1Change = function (where) {
    $scope.dataRekBelanjaSub2(where);
  }

  $scope.dataRekBelanjaSub2 = function (where) {
    if (where != null) {
      $scope.hideRekRefSub2 = false;
      $http.get("/rekbelanja/searchRekBelanjaSub2/" + where).then(function (data) {
        $scope.getRekRefSub2 = data.data;
        // console.log(data.data);
      });
    }
  };

  $scope.dataPengurusBarang = function () {
    $http.get("/penanggungjawab/getPengurusBarang/search").then(function (data) {
      $scope.getPengurusBarang = data.data;
      // console.log(data.data);
    });
  };

  $scope.changeJenisBelanja = function (keterangan) {
    if (keterangan == "Barang") {
      $scope.hideRefPengurusBarang = false;
      $scope.dataPengurusBarang(null);
    } else {
      $scope.hideRefPengurusBarang = true;
    }
  };
});
