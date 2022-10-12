sispj.controller("Bendahara", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
    $scope.nip_bendahara = $scope.nama_bendahara = $scope.id = null;
  };

  $scope.getBendahara = function () {
    $http.get("/penanggungjawab/getBendahara/getAll").then(function (data) {
      $scope.datas = data.data;
      console.log(data)
    }, function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function () {
    $scope.openModal("#bendahara");
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
      .post("/penanggungjawab/insertBendahara", {
        nip_bendahara: $scope.nip_bendahara,
        nama_bendahara: $scope.nama_bendahara,
      })
      .then(
        function successCallback(data) {
          console.log(data.data);
          if (data.data.errortext == "") {
            $scope.setDefault();
            $scope.id = $scope.kode_rek = $scope.uraian = null;
            $scope.getBendahara();
            $scope.closeModal("#bendahara");
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
    $http.get("/penanggungjawab/getDetailBendahara/" + id).then(
      function successCallback(data) {
        $scope.openModal("#bendahara");
        $scope.modalTitle = "Detail Kode Urusan";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";
        console.log(data);

        $scope.id = data.data[0].id;
        $scope.nama_bendahara = data.data[0].nama_bendahara;
        $scope.nip_bendahara = data.data[0].nip_bendahara;
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
      .post("/penanggungjawab/updateBendahara/" + $scope.id, {
        nip_bendahara: $scope.nip_bendahara,
        nama_bendahara: $scope.nama_bendahara
      })
      .then(
        function successCallback(data) {
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getBendahara();
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
      $http.post("/penanggungjawab/deleteBendahara", {
        id: id,
      }).then(
        function successCallback(data) {
          $scope.getBendahara();
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
