sispj.controller("RekeningDasar", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
  };

  $scope.getRekeningDasar = function () {
    $http.get("/rekdasar/getRekeningDasar").then(function (data) {
      $scope.datas = data.data;
      console.log(data)
    },function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };
  $scope.tambahData = function (){
    $scope.openModal("#rekeningDasar");
    $scope.modalTitle = "Tambah Kode Rekening Urusan";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
    $scope.id = 
    $scope.nama_rekening_dasar = 
    $scope.kode_rek_dinas = 
    $scope.kode_rek_urusan = 
    $scope.kode_rek_bidang = 
    $scope.kode_rek_program = 
    $scope.kode_rek_kegiatan = 
    $scope.kode_rek_unit = 
    $scope.tahun_anggaran = 
    $scope.jumlah_anggaran_rekening_dasar = 
    $scope.keterangan_rekening_dasar = null;
  }

  $scope.submitData = function(){
    if ($scope.id == null) {
      $scope.insertData();
    }
    else{
      $scope.editData()
    }
  }

  $scope.insertData = function () {
    $scope.setDefault();
      $http
        .post("/rekdasar/insertKodeUrusan", {
          kode_rek: $scope.kode_rek,
          nama_rekening: $scope.nama_rekening,
        })
        .then(
          function successCallback(data) {
            console.log(data.data);
            if (data.data.errortext == "") {
              $scope.id = $scope.kode_rek = $scope.uraian =  null;
              $scope.getRekeningDasar();
              $scope.closeModal("#kodeUrusan");
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
    $http.get("/rekdasar/getDetailRekeningDasar/" + id).then(
      function successCallback(data) {
        $scope.openModal("#rekeningDasar");
        $scope.modalTitle = "Detail Kode Urusan";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";

        $scope.id = data.data[0].id;
        $scope.nama_rekening_dasar = data.data[0].nama_rekening_dasar;
        $scope.kode_rek_dinas = data.data[0].kode_rek_dinas;
        $scope.kode_rek_urusan = data.data[0].kode_rek_urusan;
        $scope.kode_rek_bidang = data.data[0].kode_rek_bidang;
        $scope.kode_rek_program = data.data[0].kode_rek_program;
        $scope.kode_rek_kegiatan = data.data[0].kode_rek_kegiatan;
        $scope.kode_rek_unit = data.data[0].kode_rek_unit;
        $scope.tahun_anggaran = data.data[0].tahun_anggaran;
        $scope.jumlah_anggaran_rekening_dasar = data.data[0].jumlah_anggaran_rekening_dasar;
        $scope.keterangan_rekening_dasar = data.data[0].keterangan_rekening_dasar;
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
      .post("/rekdasar/updateKodeUrusan/" + $scope.id , {
        kode_rek : $scope.kode_rek,
        nama_rekening : $scope.nama_rekening
      })
      .then(
        function successCallback(data) {
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getRekeningDasar();
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

  $scope.deleteData = function(id){
    var isconfirm =  confirm("Ingin Menghapus Data?");
    if (isconfirm) {
      $http.post("/rekdasar/deleteKodeUrusan",{
        id: id,
      }).then(
        function successCallback(data){
          $scope.getRekeningDasar();
          $scope.message = "Data Berhasil Dihapus";
          $scope.success = true;
          $timeout(function(){
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
