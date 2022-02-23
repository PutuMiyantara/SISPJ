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
    },function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.changeTahunAnggaran = function(){
    console.log('test');
    if ($scope.tahunSelect == null) {
      $scope.getRekeningDasar(1);
    } else{
      $scope.getRekeningDasar($scope.tahunSelect);
    }
  };

  $scope.getRekeningDasar = function (tahun) {
    // 1 == all
    if(tahun == null){
      tahun = 1;
    } else{
      tahun = tahun
    }
    console.log('tahun select:'+ tahun);
    $http.get("/rekdasar/getRekeningDasar/" + tahun).then(function (data) {
      $scope.datas = data.data;
      console.log(data)
    },function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function (){
    $scope.setDefault();
    $scope.openModal("#rekeningDasar");
    $scope.modalTitle = "Tambah Kode Rekening Dasar";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
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
      $http
        .post("/rekdasar/insertRekeningDasar", {
          id_kode_dinas: $scope.id_kode_dinas,
          id_kode_urusan: $scope.id_kode_urusan,
          id_kode_bidang: $scope.id_kode_bidang,
          id_kode_program: $scope.id_kode_program,
          id_kode_kegiatan: $scope.id_kode_kegiatan,
          id_kode_unit: $scope.id_kode_unit,
          nama_rekening_dasar: $scope.formModel.nama_rekening_dasar,
          tahun_anggaran: $scope.formModel.tahun_anggaran,
          jumlah_anggaran_rekening_dasar: $scope.formModel.jumlah_anggaran_rekening_dasar,
          id_kpa_ppk: $scope.id_kpa_ppk,
          id_pptk: $scope.id_pptk,
          id_bendahara: $scope.id_bendahara,
        })
        .then(
          function successCallback(data) {
            console.log(data.data);
            if (data.data.errortext == "") {
              $scope.id = $scope.kode_rek = $scope.uraian =  null;
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
    $http.get("/rekdasar/getDetailRekeningDasar/" + id).then(
      function successCallback(data) {
        $scope.openModal("#rekeningDasar");
        $scope.modalTitle = "Detail Kode Rekening Dasar";
        $scope.modalButton = "Update";
        $scope.actionButton = "Kembali";
        console.log(data);

        $scope.id = data.data[0].id;
        $scope.formModel.nama_rekening_dasar = data.data[0].nama_rekening_dasar;
        $scope.id_kode_dinas = data.data[0].id_kode_dinas;
        $scope.formModel.kode_rek_dinas = data.data[0].kode_rek_dinas;
        $scope.id_kode_urusan = data.data[0].id_kode_urusan;
        $scope.formModel.kode_rek_urusan = data.data[0].kode_rek_urusan;
        $scope.id_kode_bidang = data.data[0].id_kode_bidang;
        $scope.formModel.kode_rek_bidang = data.data[0].kode_rek_bidang;
        $scope.id_kode_program = data.data[0].id_kode_program;
        $scope.formModel.kode_rek_program = data.data[0].kode_rek_program;
        $scope.id_kode_kegiatan = data.data[0].id_kode_kegiatan;
        $scope.formModel.kode_rek_kegiatan = data.data[0].kode_rek_kegiatan;
        $scope.id_kode_unit = data.data[0].id_kode_unit;
        $scope.formModel.kode_rek_unit = data.data[0].kode_rek_unit;
        $scope.formModel.tahun_anggaran = data.data[0].tahun_anggaran;
        $scope.formModel.jumlah_anggaran_rekening_dasar = data.data[0].jumlah_anggaran_rekening_dasar;
        $scope.id_kpa_ppk = data.data[0].id_kpa_ppk;
        $scope.formModel.nama_kpa_ppk = data.data[0].nama_kpa_ppk;
        $scope.id_pptk = data.data[0].id_pptk;
        $scope.formModel.nama_pptk = data.data[0].nama_pptk;
        $scope.id_bendahara = data.data[0].id_bendahara;
        $scope.formModel.nama_bendahara = data.data[0].nama_bendahara;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.editData = function () {
    $http
      .post("/rekdasar/updateRekeningDasar/" + $scope.id , {
        id_kode_dinas: $scope.id_kode_dinas,
        id_kode_urusan: $scope.id_kode_urusan,
        id_kode_bidang: $scope.id_kode_bidang,
        id_kode_program: $scope.id_kode_program,
        id_kode_kegiatan: $scope.id_kode_kegiatan,
        id_kode_unit: $scope.id_kode_unit,
        nama_rekening_dasar: $scope.formModel.nama_rekening_dasar,
        tahun_anggaran: $scope.formModel.tahun_anggaran,
        jumlah_anggaran_rekening_dasar: $scope.formModel.jumlah_anggaran_rekening_dasar,
        id_kpa_ppk: $scope.id_kpa_ppk,
        id_pptk: $scope.id_pptk,
        id_bendahara: $scope.id_bendahara,
      })
      .then(
        function successCallback(data) {
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

  $scope.deleteData = function(id){
    var isconfirm =  confirm("Ingin Menghapus Data?");
    if (isconfirm) {
      $http.post("/rekdasar/deleteRekeningDasar",{
        id: id,
      }).then(
        function successCallback(data){
          $scope.getRekeningDasar(1);
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
  $scope.id_kode_dinas =null;
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
        $scope.id_kode_dinas = output[0].id;
        $scope.error = null;
        $scope.kode_rek_dinas_style = null;
        $scope.hide_rek_dinas = true;
      } else {
        $scope.kode_rek_dinas_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_rek_dinas = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.kode_rek_dinas_style = { border: "solid red" };
    }
  };

  $scope.fillRekDinas = function (id, kode_rek_dinas) {
    $scope.id_kode_dinas = id;
    $scope.formModel.kode_rek_dinas = kode_rek_dinas;
    $scope.hide_rek_dinas = true;
    $scope.error = false;
    $scope.kode_rek_dinas_style = null;
  };

  // searchbox rekening URUSAN
  $http.get("/rekdasar/getKodeUrusan").then(function (data) {
    $scope.rek_urusan_search = data.data;
  });
  $scope.id_kode_urusan = null;
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
        $scope.id_kode_urusan = output[0].id;
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
    $scope.id_kode_urusan = id;
    $scope.formModel.kode_rek_urusan = kode_rek_urusan;
    $scope.hide_rek_urusan = true;
    $scope.error = false;
    $scope.kode_rek_urusan_style = null;
  };

  // searchbox rekening BIDANG
  $http.get("/rekdasar/getKodeBidang").then(function (data) {
    $scope.rek_bidang_search = data.data;
  });
  $scope.id_kode_bidang = null;
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
        $scope.id_kode_bidang = output[0].id;
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
    $scope.id_kode_bidang = id;
    $scope.formModel.kode_rek_bidang = kode_rek_bidang;
    $scope.hide_rek_bidang = true;
    $scope.error = false;
    $scope.kode_rek_bidang_style = null;
  };

  // searchbox rekening PROGRAM
  $http.get("/rekdasar/getKodeProgram").then(function (data) {
    $scope.rek_program_search = data.data;
  });
  $scope.id_kode_program = null;
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
        $scope.id_kode_program = output[0].id;
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
    $scope.id_kode_program = id;
    $scope.formModel.kode_rek_program = kode_rek_program;
    $scope.hide_rek_program = true;
    $scope.error = false;
    $scope.kode_rek_program_style = null;
  };

  // searchbox rekening KEGIATAN
  $http.get("/rekdasar/getKodeKegiatan").then(function (data) {
    $scope.rek_kegiatan_search = data.data;
  });
  $scope.hide_rek_kegiatan = true;
  $scope.id_kode_kegiatan = null;
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
        $scope.id_kode_kegiatan = output[0].id;
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
    $scope.id_kode_kegiatan = id;
    $scope.formModel.kode_rek_kegiatan = kode_rek_kegiatan;
    $scope.hide_rek_kegiatan = true;
    $scope.error = false;
    $scope.kode_rek_kegiatan_style = null;
  };
  
  // searchbox rekening UNIT
  $http.get("/rekdasar/getKodeUnit").then(function (data) {
    $scope.rek_unit_search = data.data;
  });
  $scope.id_kode_unit = null;
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
        $scope.id_kode_unit = output[0].id;
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
    $scope.id_kode_unit = id;
    $scope.formModel.kode_rek_unit = kode_rek_unit;
    $scope.hide_rek_unit = true;
    $scope.error = false;
    $scope.kode_rek_unit_style = null;
  };
  
  // searchbox KPA PPK
  $http.get("/penanggungjawab/getKpaPpk").then(function (data) {
    $scope.kpa_ppk_search = data.data;
  });
  $scope.id_kpa_ppk = null;
  $scope.hide_kpa_ppk = true;
  $scope.searchKpaPpk = function (string) {
    $scope.hide_kpa_ppk = false;
    $scope.error = null;
    $scope.kpa_ppk_style = null;
    console.log($scope.kpa_ppk_search);
    var output = [];
    if (string != null) {
      angular.forEach($scope.kpa_ppk_search, function (kpa_ppk) {
        if (kpa_ppk.nama_kpa_ppk.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(kpa_ppk);
        }
      });
    } else {
      angular.forEach($scope.kpa_ppk_search, function (kpa_ppk) {
        output.push(kpa_ppk);
      });
    }
    if (output.length > 0) {
      $scope.filterKpaPpk = output;
      if (string != null && string.toLowerCase() == output[0].nama_kpa_ppk.toLowerCase()) {
        $scope.id_kpa_ppk = output[0].id;
        $scope.error = null;
        $scope.kpa_ppk_style = null;
        $scope.hide_kpa_ppk = true;
      } else {
        $scope.kpa_ppk_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_kpa_ppk = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.kpa_ppk_style = { border: "solid red" };
    }
  };

  $scope.fillKpaPpk = function (id, nama_kpa_ppk, nip) {
    $scope.id_kpa_ppk = id;
    $scope.formModel.nama_kpa_ppk = nama_kpa_ppk;
    $scope.hide_kpa_ppk = true;
    $scope.error = false;
    $scope.kpa_ppk_style = null;
  };

  // searchbox PPTK
  $http.get("/penanggungjawab/getPptk").then(function (data) {
    $scope.pptk_search = data.data;
  });
  $scope.id_pptk = null;
  $scope.hide_pptk = true;
  $scope.searchPptk = function (string) {
    $scope.hide_pptk = false;
    $scope.error = null;
    $scope.pptk_style = null;
    console.log($scope.pptk_search);
    var output = [];
    if (string != null) {
      angular.forEach($scope.pptk_search, function (pptk) {
        if (pptk.nama_pptk.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(pptk);
        }
      });
    } else {
      angular.forEach($scope.pptk_search, function (pptk) {
        output.push(pptk);
      });
    }
    if (output.length > 0) {
      $scope.filterPptk = output;
      if (string != null && string.toLowerCase() == output[0].nama_pptk.toLowerCase()) {
        $scope.id_pptk = output[0].id;
        $scope.error = null;
        $scope.pptk_style = null;
        $scope.hide_pptk = true;
      } else {
        $scope.pptk_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_pptk = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.pptk_style = { border: "solid red" };
    }
  };

  $scope.fillPptk = function (id, nama_pptk, nip) {
    $scope.id_pptk = id;
    $scope.formModel.nama_pptk = nama_pptk;
    $scope.hide_pptk = true;
    $scope.error = false;
    $scope.pptk_style = null;
  };

  // searchbox Bendahara
  $http.get("/penanggungjawab/getBendahara").then(function (data) {
    $scope.bendahara_search = data.data;
  });
  $scope.id_bendahara = null;
  $scope.hide_bendahara = true;
  $scope.searchBendahara = function (string) {
    $scope.hide_bendahara = false;
    $scope.error = null;
    $scope.bendahara_style = null;
    console.log($scope.bendahara_search);
    var output = [];
    if (string != null) {
      angular.forEach($scope.bendahara_search, function (bendahara) {
        if (bendahara.nama_bendahara.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(bendahara);
        }
      });
    } else {
      angular.forEach($scope.bendahara_search, function (bendahara) {
        output.push(bendahara);
      });
    }
    if (output.length > 0) {
      $scope.filterBendahara = output;
      if (string != null && string.toLowerCase() == output[0].nama_bendahara.toLowerCase()) {
        $scope.id_bendahara = output[0].id;
        $scope.error = null;
        $scope.bendahara_style = null;
        $scope.hide_bendahara = true;
      } else {
        $scope.bendahara_style = null;
        $scope.message = "Pilih Data Dibawah";
      }
    } else {
      $scope.hide_bendahara = true;
      $scope.error = true;
      $scope.message = "Data Tidak Ditemukan";
      $scope.bendahara_style = { border: "solid red" };
    }
  };

  $scope.fillBendahara = function (id, nama_bendahara, nip) {
    $scope.id_bendahara = id;
    $scope.formModel.nama_bendahara = nama_bendahara;
    $scope.hide_bendahara = true;
    $scope.error = false;
    $scope.bendahara_style = null;
  };

});
