sispj.controller("KodeKegiatan", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
  };

  $scope.getKodeKegiatan = function () {
    $http.get("/rekdasar/getKodeKegiatan/all").then(function (data) {
      $scope.datas = data.data;
      console.log(data)
    }, function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function () {
    $scope.openModal("#kodeKegiatan");
    $scope.modalTitle = "Tambah Kode Rekening Dinas";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
    $scope.id = $scope.kode_rek_kegiatan = $scope.nama_rek_kegiatan = null;
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
    $scope.setDefault();
    $http
      .post("/rekdasar/insertKodeKegiatan", {
        kode_rek_kegiatan: $scope.kode_rek_kegiatan,
        nama_rek_kegiatan: $scope.nama_rek_kegiatan,
      })
      .then(
        function successCallback(data) {
          console.log(data.data);
          if (data.data.errortext == "") {
            $scope.kode_rek_kegiatan = $scope.nama = null;
            $scope.getKodeKegiatan();
            $scope.closeModal("#kodeKegiatan");
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
    $http.get("/rekdasar/getDetailKodeKegiatan/" + id).then(
      function successCallback(data) {
        $scope.openModal("#kodeKegiatan");
        $scope.modalTitle = "Detail Kode Dinas";
        $scope.modalButton = "Update";
        $scope.actionButton = "Kembali";

        $scope.id = data.data[0].id;
        $scope.kode_rek_kegiatan = data.data[0].kode_rek_kegiatan;
        $scope.nama_rek_kegiatan = data.data[0].nama_rek_kegiatan;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.editData = function () {
    console.log('ini benar edit');
    $http
      .post("/rekdasar/updateKodeKegiatan/" + $scope.id, {
        kode_rek_kegiatan: $scope.kode_rek_kegiatan,
        nama_rek_kegiatan: $scope.nama_rek_kegiatan
      })
      .then(
        function successCallback(data) {
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getKodeKegiatan();
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
      $http.post("/rekdasar/deleteKodeKegiatan", {
        id: id,
      }).then(
        function successCallback(data) {
          $scope.getKodeKegiatan();
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

});
