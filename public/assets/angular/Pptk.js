sispj.controller("Pptk", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
    $scope.nip_pptk = $scope.nama_pptk = null;
  };

  $scope.getPptk = function () {
    $http.get("/penanggungjawab/getPptk/getAll").then(function (data) {
      $scope.datas = data.data;
      console.log(data)
    }, function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function () {
    $scope.openModal("#pptk");
    $scope.modalTitle = "Tambah Penanggung Jawab KPA PPK";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
    $scope.setDefault();
  };

  $scope.submitData = function () {
    if ($scope.id == null) {
      $scope.insertData();
    }
    else {
      $scope.editData()
    }
  };

  $scope.insertData = function () {
    $http
      .post("/penanggungjawab/insertPptk", {
        nip_pptk: $scope.nip_pptk,
        nama_pptk: $scope.nama_pptk,
      })
      .then(
        function successCallback(data) {
          console.log(data.data);
          if (data.data.errortext == "") {
            $scope.setDefault();
            $scope.id = $scope.kode_rek = $scope.uraian = null;
            $scope.getPptk();
            $scope.closeModal("#pptk");
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
    $http.get("/penanggungjawab/getDetailPptk/" + id).then(
      function successCallback(data) {
        $scope.openModal("#pptk");
        $scope.modalTitle = "Detail Kode Urusan";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";
        console.log(data);

        $scope.id = data.data[0].id;
        $scope.nama_pptk = data.data[0].nama_pptk;
        $scope.nip_pptk = data.data[0].nip_pptk;
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
      .post("/penanggungjawab/updatePptk/" + $scope.id, {
        nip_pptk: $scope.nip_pptk,
        nama_pptk: $scope.nama_pptk
      })
      .then(
        function successCallback(data) {
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getPptk();
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
      $http.post("/penanggungjawab/deletePptk", {
        id: id,
      }).then(
        function successCallback(data) {
          $scope.getPptk();
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
