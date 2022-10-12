sispj.controller("Kuwitansi", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
    $scope.formModel = {};
    $scope.formModel.id_rekening_dasar = null;
    $scope.formModel.id_kode_belanja_sub5 = null;
    $scope.formModel.id_rekanan = null;
    $scope.id = null;
  };

  $scope.getKuwitansi = function () {
    console.log('test');
    $http.get("/kuwitansi/getKuwitansi").then(function (data) {
      $scope.datas = data.data;
      console.log(data.data);
    }, function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function () {
    $scope.openModal("#Kuwitansi");
    $scope.modalTitle = "Tambah Kode Rekening Belanja Sub 5";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
    $scope.hideRekRefSub1 = true;
    $scope.hideRekRefSub2 = true;
    $scope.hideRekRefSub3 = true;
    $scope.hideRekRefSub4 = true;
    $scope.formOrders = false;
    $scope.setDefault();
    $scope.formModel.status_spj = "0";
  }

  $scope.submitData = function () {
    if ($scope.id == null) {
      $scope.insertData();
      console.log('insertdata');
    }
    else {
      $scope.editData()
      console.log('edit data');
    }
  }

  $scope.insertData = function () {
    if ($scope.formModel.id_rekanan == null) {
      $scope.formModel.id_rekanan = 'undefined';
    }
    console.log('id rekanan' + $scope.formModel.id_rekanan);
    $http
      .post("/kuwitansi/insertKuwitansi", {
        no_kuwitansi: $scope.formModel.no_kuwitansi,
        tgl_kuwitansi: $scope.formModel.tgl_kuwitansi,
        id_rekening_dasar: $scope.formModel.id_rekening_dasar,
        id_kode_belanja_sub5: $scope.formModel.id_kode_belanja_sub5,
        nominal: $scope.formModel.nominal,
        uraian_belanja: $scope.formModel.uraian_belanja,
        dasar_spj_bukti: $scope.formModel.dasar_spj_bukti,
        status_spj: $scope.formModel.status_spj,
        keterangan: $scope.formModel.keterangan,
        id_rekanan: $scope.formModel.id_rekanan,
        instansi_rekanan: $scope.formModel.instansi_rekanan,
        nama_rekanan: $scope.formModel.nama_rekanan,
        alamat_rekanan: $scope.formModel.alamat_rekanan,
        no_telp_rekanan: $scope.formModel.no_telp_rekanan,
        npwp: $scope.formModel.npwp,
        bank_rekanan: $scope.formModel.bank_rekanan,
        no_rekening_rekanan: $scope.formModel.no_rekening_rekanan,
        jabatan: $scope.formModel.jabatan,
        id_order: $scope.formModel.id_order,
      })
      .then(
        function successCallback(data) {
          console.log(data.data);
          if (data.data.errortext == "") {
            $scope.kode_rek_kegiatan = $scope.nama = null;
            $scope.getKuwitansi();
            $scope.closeModal("#Kuwitansi");
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

  $scope.getDetail = function (id, id_rek_dasar, id_kode_belanja_sub5) {
    $scope.formOrders = false;
    console.log('id detail = ' + id);
    $scope.setDefault();
    $scope.dataRekDasar(id_rek_dasar);
    $scope.dataRekBelanja(id_rek_dasar);
    $scope.dataOrders(id_kode_belanja_sub5);
    $scope.hideForAddSub = false;
    $scope.hideRekRef = false;
    $http.get("/kuwitansi/getDetailKuwitansi/" + id).then(
      function successCallback(data) {
        console.log(data.data);

        $scope.openModal("#Kuwitansi");
        $scope.modalTitle = "Detail Kode Belanja Sub 5";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";

        $scope.id = data.data[0].id;
        $scope.formModel.no_kuwitansi = parseInt(data.data[0].no_kuwitansi);
        $scope.formModel.tgl_kuwitansi = new Date(data.data[0].tgl_kuwitansi);
        $scope.formModel.id_rekening_dasar = data.data[0].id_rekening_dasar;
        $scope.formModel.id_kode_belanja_sub5 = data.data[0].id_kode_belanja_sub5;
        $scope.formModel.nominal = data.data[0].nominal;
        $scope.formModel.uraian_belanja = data.data[0].uraian_belanja;
        $scope.formModel.dasar_spj_bukti = data.data[0].dasar_spj_bukti;
        $scope.formModel.id_rekanan = data.data[0].id_rekanan;
        $scope.formModel.keterangan_spj = data.data[0].keterangan_spj;
        $scope.formModel.status_spj = data.data[0].status_spj;
        $scope.formModel.keterangan = data.data[0].keterangan;
        $scope.formModel.instansi_rekanan = data.data[0].instansi_rekanan;
        $scope.formModel.nama_rekanan = data.data[0].nama_rekanan;
        $scope.formModel.alamat_rekanan = data.data[0].alamat_rekanan;
        $scope.formModel.no_telp_rekanan = data.data[0].no_telp_rekanan;
        $scope.formModel.npwp = data.data[0].npwp;
        $scope.formModel.bank_rekanan = data.data[0].bank_rekanan;
        $scope.formModel.no_rekening_rekanan = data.data[0].no_rekening_rekanan;
        $scope.formModel.jabatan = data.data[0].jabatan;
        $scope.formModel.id_order = data.data[0].id_order;
        if (data.data[0].id_order != null) {
          $scope.formOrders = true;
          $scope.formModel.jenis_barang = data.data[0].jenis_barang;
          $scope.formModel.jumlah_barang = parseInt(data.data[0].jumlah_barang);
          $scope.formModel.jenis_satuan_barang = data.data[0].jenis_satuan_barang;
          $scope.formModel.uraian_pesanan = data.data[0].uraian_pesanan;
        }
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.editData = function () {
    if ($scope.formModel.id_rekanan == null) {
      $scope.formModel.id_rekanan = 'undefined';
    }
    console.log('idRekanan: ' + $scope.formModel.id_rekanan);
    console.log('id edit: ' + $scope.id);
    $http
      .post("/kuwitansi/updateKuwitansi/" + $scope.id, {
        no_kuwitansi: $scope.formModel.no_kuwitansi,
        tgl_kuwitansi: $scope.formModel.tgl_kuwitansi,
        id_rekening_dasar: $scope.formModel.id_rekening_dasar,
        id_kode_belanja_sub5: $scope.formModel.id_kode_belanja_sub5,
        nominal: $scope.formModel.nominal,
        uraian_belanja: $scope.formModel.uraian_belanja,
        dasar_spj_bukti: $scope.formModel.dasar_spj_bukti,
        keterangan_spj: $scope.formModel.keterangan_spj,
        status_spj: $scope.formModel.status_spj,
        keterangan: $scope.formModel.keterangan,
        id_rekanan: $scope.formModel.id_rekanan,
        instansi_rekanan: $scope.formModel.instansi_rekanan,
        nama_rekanan: $scope.formModel.nama_rekanan,
        alamat_rekanan: $scope.formModel.alamat_rekanan,
        no_telp_rekanan: $scope.formModel.no_telp_rekanan,
        npwp: $scope.formModel.npwp,
        bank_rekanan: $scope.formModel.bank_rekanan,
        no_rekening_rekanan: $scope.formModel.no_rekening_rekanan,
        jabatan: $scope.formModel.jabatan,
        id_order: $scope.formModel.id_order,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getKuwitansi();
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
      $http.post("/kuwitansi/deleteKuwitansi", {
        id: id,
      }).then(
        function successCallback(data) {
          $scope.getKuwitansi();
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
  };

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
      console.log("dataRekDasar: " + data.data.id);
      $scope.getRekDasar = data.data;
    });
  };

  $scope.rekDasarChange = function (where) {
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
    $scope.dataRekBelanja(where);
  };

  $scope.dataRekBelanja = function (where) {
    console.log(where);
    if (where != null) {
      $scope.hideRekRefSub1 = false;
      console.log("data rek belanja " + where);
      $http.get("/orders/getRekBelanja/" + where).then(function (data) {
        $scope.getRekBelanja = data.data;
        console.log($scope.getRekBelanja);
      });
    }
  };

  $scope.rekBelanjaChange = function (where) {
    console.log('belanja change ' + where);
    if (where != null) {
      $http.get("/rekdasar/getDetailRekeningDasar/" + where).then(
        function successCallback(data) {
          console.log(data);
        },
        function errorCallback(response) {
          console.log(response);
          alert("error");
        }
      );
    }
    $scope.dataOrders(where);
  };

  $scope.dataOrders = function (where) {
    console.log(where);
    if (where != null) {
      $scope.hideRekRefSub1 = false;
      console.log("data rek belanja " + where);
      $http.get("/rekbelanja/searchOrders/" + where).then(function (data) {
        $scope.getOrders = data.data;
        console.log($scope.getOrders);
      });
    }
  };



  $scope.ordersChange = function (where) {
    console.log(where);
    console.log('this orderschange')
    if (where != null) {
      $scope.hideRekRefSub1 = false;
      console.log("data rek belanja " + where);
      $http.get("/orders/getDetailOrders/" + where).then(function (data) {
        console.log(data);
        $scope.formModel.jenis_barang = data.data[0].jenis_barang;
        $scope.formModel.jumlah_barang = parseInt(data.data[0].jumlah_barang);
        $scope.formModel.jenis_satuan_barang = data.data[0].jenis_satuan_barang;
        $scope.formModel.uraian_pesanan = data.data[0].uraian_pesanan;
      });
    }
  };

  // searchbox REKANAN
  $http.get("/orders/getInstansiRekanan").then(function (data) {
    $scope.instansi_rekanan = data.data;
  });
  $scope.hide_rekanan = true;
  $scope.id_rekanan = null;
  $scope.searchInstansiRekanan = function (string) {
    console.log("instansi rekanan Search", string);
    $scope.hide_rekanan = false;
    $scope.error = null;
    $scope.instansi_rekanan_style = null;

    var output = [];
    if (string != null) {
      angular.forEach($scope.instansi_rekanan, function (rekanan) {
        if (rekanan.instansi_rekanan.toLowerCase().indexOf(string.toLowerCase()) >= 0) {
          output.push(rekanan);
        }
      });
    } else {
      angular.forEach($scope.instansi_rekanan, function (rekanan) {
        output.push(rekanan);
      });
    }
    if (output.length > 0) {
      $scope.filterInstansiRekanan = output;
      if (string != null && string.toLowerCase() == output[0].instansi_rekanan.toLowerCase()) {
        $scope.formModel.id_rekanan = output[0].id;
        $scope.fillInstansiRekanan(output[0].id, output[0].instansi_rekanan, output[0].nama_rekanan, output[0].alamat_rekanan, output[0].no_telp_rekanan, output[0].npwp, output[0].bank_rekanan, output[0].no_rekening_rekanan, output[0].jabatan);
        $scope.error = null;
        $scope.instansi_rekanan_style = null;
        $scope.hide_rekanan = true;
        $scope.rekananRO = true;
      } else {
        $scope.formModel.id_rekanan = null;
        $scope.instansi_rekanan_style = null;
        $scope.message = "Pilih Data Dibawah";
        $scope.formModel.nama_rekanan = null;
        $scope.formModel.alamat_rekanan = null;
        $scope.formModel.no_telp_rekanan = null;
        $scope.formModel.npwp = null;
        $scope.formModel.bank_rekanan = null;
        $scope.formModel.no_rekening_rekanan = null;
        $scope.formModel.jabatan = null;
      }
      console.log(output);
    } else {
      $scope.formModel.id_rekanan = null;
      $scope.hide_rekanan = true;
      $scope.formModel.nama_rekanan = null;
      $scope.formModel.alamat_rekanan = null;
      $scope.formModel.no_telp_rekanan = null;
      $scope.formModel.npwp = null;
      $scope.formModel.bank_rekanan = null;
      $scope.formModel.no_rekening_rekanan = null;
      $scope.formModel.jabatan = null;
    }
  };

  $scope.fillInstansiRekanan = function (id, instansi_rekanan, nama_rekanan, alamat_rekanan, no_telp_rekanan, npwp, bank_rekanan, no_rekening_rekanan, jabatan) {
    $scope.formModel.id_rekanan = id;
    $scope.formModel.instansi_rekanan = instansi_rekanan;
    $scope.formModel.nama_rekanan = nama_rekanan;
    $scope.formModel.alamat_rekanan = alamat_rekanan;
    $scope.formModel.no_telp_rekanan = no_telp_rekanan;
    $scope.formModel.npwp = npwp;
    $scope.formModel.bank_rekanan = bank_rekanan;
    $scope.formModel.no_rekening_rekanan = no_rekening_rekanan;
    $scope.formModel.jabatan = jabatan;
    $scope.hide_rekanan = true;
    $scope.error = false;
    $scope.hide_rekanan_style = null;
    $scope.rekananRO = true;
  };

  $scope.printKuwitansi = function () {
    console.log('test');
    var url = window.location.href;
    console.log(url);
  };
});
