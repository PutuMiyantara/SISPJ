sispj.controller("KodeBelanjaSub3", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
    $scope.formModel = {};
  };

  $scope.getKodeBelanjaSub3 = function () {
    $http.get("/rekbelanja/getKodeBelanjaSub3").then(function (data) {
      $scope.datas = data.data;
      console.log(data)
    },function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function (){
    $scope.openModal("#kodeBelanjaSub3");
    $scope.modalTitle = "Tambah Kode Rekening Dasar";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
    $scope.hideForAddSub = true;
    $scope.setDefault();
  }

  // $scope.submitData = function(){
  //   if ($scope.id == null) {
  //     $scope.insertData();
  //     console.log('insertdata');
  //   }
  //   else{
  //     $scope.editData()
  //     console.log('edit data');
  //   }
  // }

  // $scope.insertData = function () {
  //     $http
  //       .post("/rekbelanja/insertKodeBelanjaSub3", {
  //         kode_belanja_sub3: $scope.formModel.kode_belanja_sub3,
  //         nama_rekening_belanja_sub3: $scope.formModel.nama_rekening_belanja_sub3,
  //         jumlah_anggaran_belanja_sub3: $scope.formModel.jumlah_anggaran_belanja_sub3,
  //         id_kode_belanja_sub2: $scope.formModel.id_kode_belanja_sub2,
  //       })
  //       .then(
  //         function successCallback(data) {
            
  //           console.log(data.data);
  //           if (data.data.errortext == "") {
  //             $scope.kode_rek_kegiatan = $scope.nama = null;
  //             $scope.getKodeBelanjaSub2();
  //             $scope.closeModal("#kodeBelanjaSub3");
  //             $scope.success = true;
  //             $scope.message = data.data.message;
  //             $timeout(function () {
  //               $scope.success = false;
  //             }, 5000);
  //             $scope.setDefault();
  //           } else {
  //             $scope.message = data.data.errortext;
  //             $scope.error = true;
  //             $timeout(function () {
  //               $scope.error = false;
  //             }, 5000);
  //           }
  //         },
  //         function errorCallback(response) {
  //           $scope.error = true;
  //           $scope.message = "Gagal Menyimpan data";
  //           console.log("Gagal Menyimpan Data", response);
  //         }
  //       );
  // };

  // $scope.getDetail = function (id) {
  //   $scope.setDefault();
  //   $scope.hideForAddSub = false;
  //   $http.get("/rekbelanja/getDetailKodeBelanjaSub3/" + id).then(
  //     function successCallback(data) {
  //       console.log(data);
  //       $scope.openModal("#kodeBelanjaSub3");
  //       $scope.modalTitle = "Detail Kode Belanja Sub 2";
  //       $scope.submitButton = "Update";
  //       $scope.actionButton = "Kembali";

  //       $scope.id = data.data[0].id;
  //       $scope.formModel.kode_belanja_sub3 = data.data[0].kode_belanja_sub3;
  //       $scope.formModel.nama_rekening_belanja_sub3 = data.data[0].nama_rekening_belanja_sub3;
  //       $scope.formModel.jumlah_anggaran_belanja_sub3 = data.data[0].jumlah_anggaran_belanja_sub3;
  //       $scope.formModel.kode_rek_dasar = 
  //         data.data[0].kode_rek_dinas + '.' + 
  //         data.data[0].kode_rek_urusan + '.' + 
  //         data.data[0].kode_rek_bidang + '.' + 
  //         data.data[0].kode_rek_kegiatan + '.' + 
  //         data.data[0].kode_rek_program + '.' + 
  //         data.data[0].kode_rek_unit + ' - ' + 
  //         data.data[0].nama_rekening_dasar;
  //       $scope.formModel.nama_rekening_dasar = data.data[0].nama_rekening_dasar;
  //       $scope.formModel.tahun_anggaran = data.data[0].tahun_anggaran;
  //       $scope.formModel.id_kode_belanja_sub2 = data.data[0].id_kode_belanja_sub2
  //     },
  //     function errorCallback(response) {
  //       console.log(response);
  //       alert("error");
  //     }
  //   );
  // };

  // $scope.editData = function () {
  //   $http
  //     .post("/rekbelanja/updateKodeBelanjaSub3/" + $scope.id , {
  //       kode_belanja_sub2: $scope.formModel.kode_belanja_sub2,
  //       nama_rekening_belanja_sub2: $scope.formModel.nama_rekening_belanja_sub2,
  //       jumlah_anggaran_belanja_sub2: $scope.formModel.jumlah_anggaran_belanja_sub2,
  //       id_kode_belanja_sub2: $scope.formModel.id_kode_belanja_sub2,
  //     })
  //     .then(
  //       function successCallback(data) {
  //         if (data.data.errortext == "") {
  //           $scope.getDetail($scope.id);
  //           $scope.getKodeBelanjaSub2();
  //           $scope.success = true;
  //           $timeout(function () {
  //             $scope.success = false;
  //           }, 5000);
  //           $scope.message = data.data.message;
  //         } else {
  //           $scope.error = true;
  //           $scope.message = data.data.errortext;
  //         }
  //       },
  //       function errorCallback(response) {
  //         console.log(response);
  //       }
  //     );
  // };

  // $scope.deleteData = function(id){
  //   var isconfirm =  confirm("Ingin Menghapus Data?");
  //   if (isconfirm) {
  //     $http.post("/rekbelanja/deleteKodeBelanjaSub2",{
  //       id: id,
  //     }).then(
  //       function successCallback(data){
  //         $scope.getKodeBelanjaSub2();
  //         $scope.message = "Data Berhasil Dihapus";
  //         $scope.success = true;
  //         $timeout(function(){
  //           $scope.success = false;
  //         }, 5000);
  //       }
  //     );
  //   }

  // }

  $scope.openModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("show");
  };

  $scope.closeModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("hide");
  };
   
  $scope.dataRekReferensi = function () {
    $http.get("/rekbelanja/searchRekBelanjaSub2").then(function (data) {
      console.log(data.data);
      $scope.getRekRefSub2 = data.data;
    });
  };
  
  $scope.rekBelanjaSub2Change = function(id_sub2) {
    console.log('model rekbelanjasub2 '+$scope.formModel.id_kode_belanja_sub2);
    console.log('rekbelanjasub2'+id_sub2);
    $http.get("/rekbelanja/getDetailKodeBelanjaSub2/" + id_sub2).then(
      function successCallback(data) {
        console.log(data);
        $scope.formModel.kode_rek_dasar = 
        data.data[0].kode_rek_dinas + "." +
        data.data[0].kode_rek_unit + " - " +
        data.data[0].nama_rekening_dasar;
      $scope.formModel.tahun_anggaran = data.data[0].tahun_anggaran;

        $scope.formModel.kode_rek_dasar = 
          data.data[0].kode_rek_dinas + "." +
          data.data[0].kode_rek_urusan + "." +
          data.data[0].kode_rek_bidang + "." +
          data.data[0].kode_rek_program + "." +
          data.data[0].kode_rek_kegiatan + "." +
          data.data[0].kode_rek_unit + " - " +
          data.data[0].nama_rekening_dasar;
        $scope.formModel.tahun_anggaran = data.data[0].tahun_anggaran;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };
});
