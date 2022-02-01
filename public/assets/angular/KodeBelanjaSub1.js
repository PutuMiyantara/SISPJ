sispj.controller("KodeBelanjaSub1", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
    $scope.formModel = {};
  };

  $scope.getKodeBelanjaSub1 = function () {
    $http.get("/rekbelanja/getKodeBelanjaSub1").then(function (data) {
      $scope.datas = data.data;
      console.log(data)
    },function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function (){
    $scope.setDefault();
    $scope.openModal("#kodeBelanjaSub1");
    $scope.modalTitle = "Tambah Kode Rekening Dasar";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
    $scope.hideForAddSub = true;
    $scope.id = $scope.kode_rek_kegiatan = $scope.nama_rek_kegiatan = null;
  }

  $scope.submitData = function(){
    if ($scope.id == null) {
      $scope.insertData();
      console.log('insertdata');
    }
    else{
      $scope.editData()
      console.log('edit data');
    }
  }

  $scope.insertData = function () {
    $scope.setDefault();
      $http
        .post("/rekbelanja/insertKodeBelanjaSub1", {
          kode_belanja_sub1: $scope.kode_belanja_sub1,
          nama_rekening_belanja_sub1: $scope.nama_rekening_belanja_sub1,
          jumlah_anggaran_belanja_sub1: $scope.jumlah_anggaran_belanja_sub1,
          id_rekening_dasar: $scope.id_rekening_dasar,
        })
        .then(
          function successCallback(data) {
            console.log(data.data);
            if (data.data.errortext == "") {
              $scope.kode_rek_kegiatan = $scope.nama = null;
              $scope.getKodeBelanjaSub1();
              $scope.closeModal("#kodeBelanjaSub1");
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
    $scope.hideForAddSub = false;
    $http.get("/rekbelanja/getDetailKodeBelanjaSub1/" + id).then(
      function successCallback(data) {
        console.log(data);
        $scope.openModal("#kodeBelanjaSub1");
        $scope.modalTitle = "Detail Kode Belanja Sub 1";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";

        $scope.id = data.data[0].id;
        $scope.formModel.kode_belanja_sub1 = data.data[0].kode_belanja_sub1;
        $scope.formModel.nama_rekening_belanja_sub1 = data.data[0].nama_rekening_belanja_sub1;
        $scope.formModel.jumlah_anggaran_belanja_sub1 = data.data[0].jumlah_anggaran_belanja_sub1;
        $scope.formModel.kode_rek_dasar = 
          data.data[0].kode_rek_dinas + '.' + 
          data.data[0].kode_rek_urusan + '.' + 
          data.data[0].kode_rek_bidang + '.' + 
          data.data[0].kode_rek_kegiatan + '.' + 
          data.data[0].kode_rek_program + '.' + 
          data.data[0].kode_rek_unit;
        $scope.formModel.nama_rekening_dasar = data.data[0].nama_rekening_dasar;
        $scope.formModel.tahun_anggaran = data.data[0].tahun_anggaran;
        $scope.id_rekening_dasar = data.data[0].id_rekening_dasar
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.editData = function () {
    $http
      .post("/rekbelanja/updateKodeBelanjaSub1/" + $scope.id , {
        kode_belanja_sub1: $scope.formModel.kode_belanja_sub1,
        nama_rekening_belanja_sub1: $scope.formModel.nama_rekening_belanja_sub1,
        jumlah_anggaran_belanja_sub1: $scope.formModel.jumlah_anggaran_belanja_sub1,
        id_rekening_dasar: $scope.id_rekening_dasar,
      })
      .then(
        function successCallback(data) {
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getKodeBelanjaSub1();
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
      $http.post("/rekbelanja/deleteKodeBelanjaSub1",{
        id: id,
      }).then(
        function successCallback(data){
          $scope.getKodeBelanjaSub1();
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

  // searchbox rekening DASAR
  $http.get("/rekbelanja/searchRekDasar").then(function (data) {
    $scope.rek_dasar_search = data.data;
  });
  $scope.hide_rek_dasar = true;
  $scope.id_rekening_dasar = null;
  $scope.searchRekDasar = function (string) {
    console.log("Rek dasar Search", string);
    $scope.hide_rek_dasar = false;
    $scope.error = null;
    $scope.kode_rek_dasar_style = null;

    var output = [];
    if (string != null) {
      angular.forEach($scope.rek_dasar_search, function (rekening_dasar) {
        if (rekening_dasar.nama_rekening_dasar.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(rekening_dasar);
        }
      });
    } else {
      angular.forEach($scope.rek_dasar_search, function (rekening_dasar) {
        output.push(rekening_dasar);
      });
    }
    if (output.length > 0) {
      $scope.filterRekDasar = output;
      if (string != null && string.toLowerCase() == output[0].nama_rekening_dasar.toLowerCase()) {
        $scope.id_kode_dasar = output[0].id;
        $scope.error = null;
        $scope.nama_rekening_dasar_style = null;
        $scope.hide_rek_dasar = true;
      } else {
        $scope.nama_rekening_dasar_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_rek_dasar = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.nama_rekening_dasar_style = { border: "solid red" };
    }
    console.log(output);
  };

  $scope.filRekDasar = function (id, nama_rekening_dasar) {
    $scope.id_rekening_dasar = id;
    $scope.formModel.nama_rekening_dasar = nama_rekening_dasar;
    $scope.hide_rek_dasar = true;
    $scope.error = false;
    $scope.nama_rekening_dasar_style = null;
  };

  $scope.searchRekDasarTest = function(){
    $scope.inputSearch = true;
  };
});
