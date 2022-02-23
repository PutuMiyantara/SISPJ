sispj.controller("KodeBelanjaSub2", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
    $scope.formModel = {};
    $scope.formModel.id_rekening_dasar = null;
    $scope.formModel.id_kode_belanja_sub1 = null;
    $scope.id = null;
  };

  $scope.getKodeBelanjaSub2 = function () {
    $http.get("/rekbelanja/getKodeBelanjaSub2").then(function (data) {
      $scope.datas = data.data;
      // console.log(data)
    },function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function (){
    $scope.hideRekRef = true;
    $scope.openModal("#kodeBelanjaSub2");
    $scope.modalTitle = "Tambah Kode Rekening Belanja Sub 2";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
    $scope.hideForAddSub = true;
    $scope.setDefault();

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
      $http
        .post("/rekbelanja/insertKodeBelanjaSub2", {
          kode_belanja_sub2: $scope.formModel.kode_belanja_sub2,
          nama_rekening_belanja_sub2: $scope.formModel.nama_rekening_belanja_sub2,
          jumlah_anggaran_belanja_sub2: $scope.formModel.jumlah_anggaran_belanja_sub2,
          id_kode_belanja_sub1: $scope.formModel.id_kode_belanja_sub1,
        })
        .then(
          function successCallback(data) {
            
            console.log(data.data);
            if (data.data.errortext == "") {
              $scope.kode_rek_kegiatan = $scope.nama = null;
              $scope.getKodeBelanjaSub2();
              $scope.closeModal("#kodeBelanjaSub2");
              $scope.success = true;
              $scope.message = data.data.message;
              $timeout(function () {
                $scope.success = false;
              }, 5000);
              $scope.setDefault();
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

  $scope.getDetail = function (id, id_rek_dasar) {
    $scope.setDefault();
    $scope.dataRekBelanjaSub1(id_rek_dasar);
    $scope.hideForAddSub = false;
    $scope.hideRekRef = false;
    $http.get("/rekbelanja/getDetailKodeBelanjaSub2/" + id).then(
      function successCallback(data) {
        console.log("dibawah ini data get detail");
        console.log(data);


        $scope.openModal("#kodeBelanjaSub2");
        $scope.modalTitle = "Detail Kode Belanja Sub 2";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";

        $scope.id = data.data[0].id;
        $scope.formModel.kode_belanja_sub2 = data.data[0].kode_belanja_sub2;
        $scope.formModel.nama_rekening_belanja_sub2 = data.data[0].nama_rekening_belanja_sub2;
        $scope.formModel.jumlah_anggaran_belanja_sub2 = data.data[0].jumlah_anggaran_belanja_sub2;
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
        $scope.formModel.tahun_anggaran = data.data[0].tahun_anggaran;

        console.log("id rek sub1 get detail "+ $scope.formModel.id_kode_belanja_sub1);

      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.editData = function () {
    $http
      .post("/rekbelanja/updateKodeBelanjaSub2/" + $scope.id , {
        kode_belanja_sub2: $scope.formModel.kode_belanja_sub2,
        nama_rekening_belanja_sub2: $scope.formModel.nama_rekening_belanja_sub2,
        jumlah_anggaran_belanja_sub2: $scope.formModel.jumlah_anggaran_belanja_sub2,
        id_kode_belanja_sub1: $scope.formModel.id_kode_belanja_sub1,
      })
      .then(
        function successCallback(data) {
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getKodeBelanjaSub2();
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
      $http.post("/rekbelanja/deleteKodeBelanjaSub2",{
        id: id,
      }).then(
        function successCallback(data){
          $scope.getKodeBelanjaSub2();
          $scope.message = "Data Berhasil Dihapus";
          $scope.success = true;
          $timeout(function(){
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
      console.log("dataRekDasar: "+data.data.id);
      $scope.getRekDasar = data.data;
    });
  };
  
  $scope.rekDasarChange = function(where) {
    if (where != null) {
      $http.get("/rekdasar/getDetailRekeningDasar/" + where).then(
        function successCallback(data) {
          console.log(data);
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
      $scope.hideRekRef = false;
      console.log("testete");
      $http.get("/rekbelanja/searchRekBelanjaSub1/" + where).then(function (data) {
        $scope.getRekRefSub1 = data.data;
        console.log($scope.getRekRefSub1);
      });
    }
  };
  
});
