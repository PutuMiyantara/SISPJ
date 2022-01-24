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
    $scope.keterangan_rekening_dasar =
    $scope.kode_rek_dinas_style = 
    $scope.kode_rek_urusan_style = 
    $scope.kode_rek_bidang_style = 
    $scope.kode_rek_kegiatan_style = 
    $scope.kode_rek_program_style = 
    $scope.kode_rek_unit_style = null;

    $scope.hide_rek_dinas = 
    $scope.hide_rek_urusan = 
    $scope.hide_rek_bidang = 
    $scope.hide_rek_kegiatan = 
    $scope.hide_rek_program = 
    $scope.hide_rek_unit = 
    $scope.hide_rek_dinas = true;
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
          kode_rek_dinas: $scope.kode_rek_dinas,
          kode_rek_urusan: $scope.kode_rek_urusan,
          kode_rek_bidang: $scope.kode_rek_bidang,
          kode_rek_program: $scope.kode_rek_program,
          kode_rek_kegiatan: $scope.kode_rek_kegiatan,
          kode_rek_unit: $scope.kode_rek_unit,
          nama_rekening_dasar: $scope.nama_rekening_dasar,
          tahun_anggaran: $scope.tahun_anggaran,
          jumlah_anggaran_rekening_dasar: $scope.jumlah_anggaran_rekening_dasar,
          keterangan_rekening_dasar: $scope.keterangan_rekening_dasar
        })
        .then(
          function successCallback(data) {
            console.log(data.data);
            if (data.data.errortext == "") {
              $scope.id = $scope.kode_rek = $scope.uraian =  null;
              $scope.getRekeningDasar();
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

  // searchbox rekening DINAS
  $http.get("/rekdasar/getKodeDinas").then(function (data) {
    $scope.rek_dinas_search = data.data;
  });
  $scope.hide_rek_dinas = true;
  $scope.searchRekDinas = function (string) {
    console.log("Rek Dinas Search", string);
    $scope.hide_rek_dinas = false;
    $scope.error = null;
    $scope.kode_rek_dinas_style = null;

    var output = [];
    if (string != null) {
      angular.forEach($scope.rek_dinas_search, function (kode_dinas) {
        if (kode_dinas.kode_rek_dinas.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(kode_dinas);
        }
      });
    } else {
      angular.forEach($scope.rek_dinas_search, function (kode_dinas) {
        output.push(kode_dinas);
      });
    }
    if (output.length > 0) {
      $scope.filterRekDinas = output;
      if (string != null && string.toLowerCase() == output[0].kode_rek_dinas.toLowerCase()) {
        $scope.error = null;
        $scope.kode_rek_dinas_style = null;
        $scope.hide_rek_dinas = true;
      } else {
        $scope.kode_rek_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_rek_dinas = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.kode_rek_style = { border: "solid red" };
    }
  };

  $scope.fillRekDinas = function (id, kode_rek_dinas) {
    $scope.kode_rek_dinas = kode_rek_dinas;
    $scope.hide_rek_dinas = true;
    $scope.error = false;
    $scope.kode_rek_style = null;
  };

  // searchbox rekening URUSAN
  $http.get("/rekdasar/getKodeUrusan").then(function (data) {
    $scope.rek_urusan_search = data.data;
  });
  $scope.hide_rek_urusan = true;
  $scope.searchRekUrusan = function (string) {
    console.log("Rek Urusan Search", string);
    $scope.hide_rek_urusan = false;
    $scope.error = null;
    $scope.kode_rek_urusan_style = null;

    var output = [];
    if (string != null) {
      angular.forEach($scope.rek_urusan_search, function (kode_urusan) {
        if (kode_urusan.kode_rek_urusan.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(kode_urusan);
        }
      });
    } else {
      angular.forEach($scope.rek_urusan_search, function (kode_urusan) {
        output.push(kode_urusan);
      });
    }
    if (output.length > 0) {
      $scope.filterRekUrusan = output;
      if (string != null && string.toLowerCase() == output[0].kode_rek_urusan.toLowerCase()) {
        $scope.error = null;
        $scope.kode_rek_urusan_style = null;
        $scope.hide_rek_urusan = true;
      } else {
        $scope.kode_rek_urusan_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_rek_urusan = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.kode_rek_urusan_style = { border: "solid red" };
    }
  };

  $scope.fillRekUrusan = function (id, kode_rek_urusan) {
    $scope.kode_rek_urusan = kode_rek_urusan;
    $scope.hide_rek_urusan = true;
    $scope.error = false;
    $scope.kode_rek_urusan_style = null;
  };

  // searchbox rekening BIDANG
  $http.get("/rekdasar/getKodeBidang").then(function (data) {
    $scope.rek_bidang_search = data.data;
  });
  $scope.hide_rek_bidang = true;
  $scope.searchRekBidang = function (string) {
    console.log("Rek bidang Search bidang", string);
    $scope.hide_rek_bidang = false;
    $scope.error = null;
    $scope.kode_rek_bidang_style = null;

    var output = [];
    if (string != null) {
      angular.forEach($scope.rek_bidang_search, function (kode_bidang) {
        if (kode_bidang.kode_rek_bidang.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(kode_bidang);
        }
      });
    } else {
      angular.forEach($scope.rek_bidang_search, function (kode_bidang) {
        output.push(kode_bidang);
      });
    }
    if (output.length > 0) {
      $scope.filterRekbidang = output;
      if (string != null && string.toLowerCase() == output[0].kode_rek_bidang.toLowerCase()) {
        $scope.error = null;
        $scope.kode_rek_bidang_style = null;
        $scope.hide_rek_bidang = true;
      } else {
        $scope.kode_rek_bidang_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_rek_bidang = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.kode_rek_bidang_style = { border: "solid red" };
    }
  };

  $scope.fillRekBidang = function (id, kode_rek_bidang) {
    $scope.kode_rek_bidang = kode_rek_bidang;
    $scope.hide_rek_bidang = true;
    $scope.error = false;
    $scope.kode_rek_bidang_style = null;
  };

  // searchbox rekening PROGRAM
  $http.get("/rekdasar/getKodeProgram").then(function (data) {
    $scope.rek_program_search = data.data;
  });
  $scope.hide_rek_program = true;
  $scope.searchRekProgram = function (string) {
    console.log("Rek kegiatan Search", string);
    $scope.hide_rek_program = false;
    $scope.error = null;
    $scope.kode_rek_program_style = null;

    var output = [];
    if (string != null) {
      angular.forEach($scope.rek_program_search, function (kode_program) {
        if (kode_program.kode_rek_program.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(kode_program);
        }
      });
    } else {
      angular.forEach($scope.rek_program_search, function (kode_program) {
        output.push(kode_program);
      });
    }
    if (output.length > 0) {
      $scope.filterRekProgram = output;
      if (string != null && string.toLowerCase() == output[0].kode_rek_program.toLowerCase()) {
        $scope.error = null;
        $scope.kode_rek_program_style = null;
        $scope.hide_rek_program = true;
      } else {
        $scope.kode_rek_program_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_rek_program = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.kode_rek_program_style = { border: "solid red" };
    }
  };

  $scope.fillRekProgram = function (id, kode_rek_program) {
    $scope.kode_rek_program = kode_rek_program;
    $scope.hide_rek_program = true;
    $scope.error = false;
    $scope.kode_rek_program_style = null;
  };

  // searchbox rekening KEGIATAN
  $http.get("/rekdasar/getKodeKegiatan").then(function (data) {
    $scope.rek_kegiatan_search = data.data;
  });
  $scope.hide_rek_kegiatan = true;
  $scope.searchRekKegiatan = function (string) {
    console.log("Rek kegiatan Search", string);
    $scope.hide_rek_kegiatan = false;
    $scope.error = null;
    $scope.kode_rek_kegiatan_style = null;

    var output = [];
    if (string != null) {
      angular.forEach($scope.rek_kegiatan_search, function (kode_kegiatan) {
        if (kode_kegiatan.kode_rek_kegiatan.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(kode_kegiatan);
        }
      });
    } else {
      angular.forEach($scope.rek_kegiatan_search, function (kode_kegiatan) {
        output.push(kode_kegiatan);
      });
    }
    if (output.length > 0) {
      $scope.filterRekKegiatan = output;
      if (string != null && string.toLowerCase() == output[0].kode_rek_kegiatan.toLowerCase()) {
        $scope.error = null;
        $scope.kode_rek_kegiatan_style = null;
        $scope.hide_rek_kegiatan = true;
      } else {
        $scope.kode_rek_kegiatan_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_rek_kegiatan = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.kode_rek_kegiatan_style = { border: "solid red" };
    }
  };

  $scope.fillRekKegiatan = function (id, kode_rek_kegiatan) {
    $scope.kode_rek_kegiatan = kode_rek_kegiatan;
    $scope.hide_rek_kegiatan = true;
    $scope.error = false;
    $scope.kode_rek_kegiatan_style = null;
  };
  
  // searchbox rekening UNIT
  $http.get("/rekdasar/getKodeUnit").then(function (data) {
    $scope.rek_unit_search = data.data;
  });
  $scope.hide_rek_unit = true;
  $scope.searchRekUnit = function (string) {
    console.log("Rek Unit Search", string);
    $scope.hide_rek_unit = false;
    $scope.error = null;
    $scope.kode_rek_unit_style = null;

    var output = [];
    if (string != null) {
      angular.forEach($scope.rek_unit_search, function (kode_unit) {
        if (kode_unit.kode_rek_unit.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(kode_unit);
        }
      });
    } else {
      angular.forEach($scope.rek_unit_search, function (kode_unit) {
        output.push(kode_unit);
      });
    }
    if (output.length > 0) {
      $scope.filterRekUnit = output;
      if (string != null && string.toLowerCase() == output[0].kode_rek_unit.toLowerCase()) {
        $scope.error = null;
        $scope.kode_rek_unit_style = null;
        $scope.hide_rek_unit = true;
      } else {
        $scope.kode_rek_unit_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_rek_unit = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.kode_rek_unit_style = { border: "solid red" };
    }
  };

  $scope.fillRekUnit = function (id, kode_rek_unit) {
    $scope.kode_rek_unit = kode_rek_unit;
    $scope.hide_rek_unit = true;
    $scope.error = false;
    $scope.kode_rek_unit_style = null;
  };

});
