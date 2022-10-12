sispj.controller("HakAksesSub", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
    $scope.formModel = {};
    $scope.formModel.id_rekening_dasar = null;
    $scope.formModel.id_kode_belanja_sub5 = null;
    $scope.formModel.id_rekanan = null;
    $scope.id = null;
    // console.log('set default');
    $('.formTambah').empty();
    $scope.tableBarangHide = true;
    number = 1;
  };

  $scope.getMenu = function () {
    console.log('sub menu');
    $http.get("/menu/getMenu/sub").then(function (data) {
      $scope.datas = data.data;
      console.log(data.data);
    }, function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.tambahData = function () {
    $scope.openModal("#Orders");
    $scope.modalTitle = "Tambah Kode Rekening Belanja Sub 5";
    $scope.modalButton = "Simpan";
    $scope.formSubmit = "ng-submit='insertData()'";
    $scope.hideRekRefSub1 = true;
    $scope.hideRekRefSub2 = true;
    $scope.hideRekRefSub3 = true;
    $scope.hideRekRefSub4 = true;
    $scope.setDefault();
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
    // const test = document.getElementsByName("jenis_barang")[0].value;
    var data_jenis_barang = [];
    var data_jumlah_barang = [];
    var data_jenis_satuan_barang = [];

    var jumlahForm = document.getElementsByName("jenis_barang").length;
    for (let i = 0; i < jumlahForm; i++) {
      data_jenis_barang[i] = document.getElementsByName("jenis_barang")[i].value;
    }
    for (let i = 0; i < jumlahForm; i++) {
      data_jumlah_barang[i] = document.getElementsByName("jumlah_barang")[i].value;
    }
    for (let i = 0; i < jumlahForm; i++) {
      data_jenis_satuan_barang[i] = document.getElementsByName("jenis_satuan_barang")[i].value;
    }

    if ($scope.formModel.id_rekanan == null) {
      $scope.formModel.id_rekanan = 'undefined';
    }
    console.log('id rekanan' + $scope.formModel.id_rekanan);
    $http
      .post("/orders/insertOrders", {
        no_pesanan: $scope.formModel.no_pesanan,
        tgl_pesanan: $scope.formModel.tgl_pesanan,
        id_rekening_dasar: $scope.formModel.id_rekening_dasar,
        id_kode_belanja_sub5: $scope.formModel.id_kode_belanja_sub5,
        id_rekanan: $scope.formModel.id_rekanan,
        id_kpa_ppk: $scope.formModel.id_kpa_ppk,
        uraian_pesanan: $scope.formModel.uraian_pesanan,
        jenis_barang: data_jenis_barang,
        jumlah_barang: data_jumlah_barang,
        jenis_satuan_barang: data_jenis_satuan_barang,
        instansi_rekanan: $scope.formModel.instansi_rekanan,
        nama_rekanan: $scope.formModel.nama_rekanan,
        alamat_rekanan: $scope.formModel.alamat_rekanan,
        no_telp_rekanan: $scope.formModel.no_telp_rekanan,
        npwp: $scope.formModel.npwp,
        bank_rekanan: $scope.formModel.bank_rekanan,
        no_rekening_rekanan: $scope.formModel.no_rekening_rekanan,
        jabatan: $scope.formModel.jabatan,
      })
      .then(
        function successCallback(data) {
          console.log(data.data);
          if (data.data.errortext == "") {
            $scope.kode_rek_kegiatan = $scope.nama = null;
            $scope.getOrders();
            $scope.closeModal("#Orders");
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

  $scope.getDetail = function (id, id_rek_dasar) {
    // console.log('id detail = ' + id);
    $scope.setDefault();
    // $('#appendTest').empty();
    $scope.dataRekDasar(id_rek_dasar);
    $scope.dataRekBelanja(id_rek_dasar);
    $scope.hideForAddSub = false;
    $scope.hideRekRef = false;
    $http.get("/orders/getDetailOrders/" + id).then(
      function successCallback(data) {
        // console.log(data.data);
        $scope.openModal("#Orders");
        $scope.modalTitle = "Detail Kode Belanja Sub 5";
        $scope.submitButton = "Update";
        $scope.actionButton = "Kembali";
        // document.getElementsByName("jenis_barang")[i].value = 'text';
        let i = 0;
        let j = data.data.length;
        // console.log('i: ' + i + '| j:' + j + '|k:' + k);
        // mengisi field barang
        while (i < j) {
          $scope.addForm();
          document.getElementsByName("id_barang")[i].value = data.data[i].id_barang;
          document.getElementsByName("jenis_barang")[i].value = data.data[i].jenis_barang;
          document.getElementsByName("jumlah_barang")[i].value = data.data[i].jumlah_barang;
          document.getElementsByName("jenis_satuan_barang")[i].value = data.data[i].jenis_satuan_barang;
          // console.log('get detail while');
          i++;
        }
        $scope.id = data.data[0].id;
        $scope.formModel.no_pesanan = data.data[0].no_pesanan;
        $scope.formModel.tgl_pesanan = new Date(data.data[0].tgl_pesanan);
        $scope.formModel.id_rekening_dasar = data.data[0].id_rekening_dasar;
        $scope.formModel.id_kode_belanja_sub5 = data.data[0].id_kode_belanja_sub5;
        $scope.formModel.id_kpa_ppk = data.data[0].id_kpa_ppk;
        $scope.formModel.jenis_barang = data.data[0].jenis_barang;
        $scope.formModel.jumlah_barang = parseInt(data.data[0].jumlah_barang);
        $scope.formModel.jenis_satuan_barang = data.data[0].jenis_satuan_barang;
        $scope.formModel.uraian_pesanan = data.data[0].uraian_pesanan;
        $scope.formModel.id_rekanan = data.data[0].id_rekanan;
        $scope.formModel.instansi_rekanan = data.data[0].instansi_rekanan;
        $scope.formModel.nama_rekanan = data.data[0].nama_rekanan;
        $scope.formModel.alamat_rekanan = data.data[0].alamat_rekanan;
        $scope.formModel.no_telp_rekanan = data.data[0].no_telp_rekanan;
        $scope.formModel.npwp = data.data[0].npwp;
        $scope.formModel.bank_rekanan = data.data[0].bank_rekanan;
        $scope.formModel.no_rekening_rekanan = data.data[0].no_rekening_rekanan;
        $scope.formModel.jabatan = data.data[0].jabatan;
        $scope.formModel.uraian_pesanan = data.data[0].uraian_pesanan;
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
    var data_id_barang = [];
    var data_jenis_barang = [];
    var data_jumlah_barang = [];
    var data_jenis_satuan_barang = [];

    var jumlahForm = document.getElementsByName("id_barang").length;
    for (let i = 0; i < jumlahForm; i++) {
      data_id_barang[i] = document.getElementsByName("id_barang")[i].value;
    }
    for (let i = 0; i < jumlahForm; i++) {
      data_jenis_barang[i] = document.getElementsByName("jenis_barang")[i].value;
    }
    for (let i = 0; i < jumlahForm; i++) {
      data_jumlah_barang[i] = document.getElementsByName("jumlah_barang")[i].value;
    }
    for (let i = 0; i < jumlahForm; i++) {
      data_jenis_satuan_barang[i] = document.getElementsByName("jenis_satuan_barang")[i].value;
    }

    // console.log('idRekanan: ' + $scope.formModel.id_rekanan);
    console.log('id barang: ' + $scope.id_barang);
    $http
      .post("/orders/updateOrders/" + $scope.id, {
        id_barang: data_id_barang,
        no_pesanan: $scope.formModel.no_pesanan,
        tgl_pesanan: $scope.formModel.tgl_pesanan,
        id_rekening_dasar: $scope.formModel.id_rekening_dasar,
        id_kode_belanja_sub5: $scope.formModel.id_kode_belanja_sub5,
        id_rekanan: $scope.formModel.id_rekanan,
        id_kpa_ppk: $scope.formModel.id_kpa_ppk,
        uraian_pesanan: $scope.uraian_pesanan,
        jenis_barang: data_jenis_barang,
        jumlah_barang: data_jumlah_barang,
        jenis_satuan_barang: data_jenis_satuan_barang,
        instansi_rekanan: $scope.formModel.instansi_rekanan,
        nama_rekanan: $scope.formModel.nama_rekanan,
        alamat_rekanan: $scope.formModel.alamat_rekanan,
        no_telp_rekanan: $scope.formModel.no_telp_rekanan,
        npwp: $scope.formModel.npwp,
        bank_rekanan: $scope.formModel.bank_rekanan,
        no_rekening_rekanan: $scope.formModel.no_rekening_rekanan,
        jabatan: $scope.formModel.jabatan,
        uraian_pesanan: $scope.formModel.uraian_pesanan,
      })
      .then(
        function successCallback(data) {
          console.log(data);
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getOrders();
            $scope.success = true;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
            $scope.message = data.data.message;
            $('.modal').animate({ scrollTop: 0 }, 'fast');
          } else {
            $('.modal').animate({ scrollTop: 0 }, 'fast');
            console.log('data salah');
            $scope.error = true;
            $scope.message = data.data.errortext;
            $timeout(function () {
              $scope.error = false;
            }, 5000);
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
      $http.post("/orders/deleteOrders", {
        id: id,
      }).then(
        function successCallback(data) {
          console.log(data);
          $scope.getOrders();
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
      // console.log("dataRekDasar: " + data.data.id);
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
    if (where != null) {
      $scope.hideRekRefSub1 = false;
      // console.log("data rek belanja " + where);
      $http.get("/orders/getRekBelanja/" + where).then(function (data) {
        $scope.getRekBelanja = data.data;
        // console.log($scope.getRekBelanja);
      });
    }
  };

  $scope.dataKpaPpk = function () {
    $http.get("/penanggungjawab/getKpaPpk/search").then(function (data) {
      console.log(data.data);
      $scope.getPegawai = data.data;
    });
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
  };

  let number = 1;
  // console.log(number);
  $scope.tableBarangHide = true;
  $scope.addForm = function () {
    $scope.tableBarangHide = false;
    $("#tableBarangHide").show();
    console.log('addform');
    const load = document.querySelector('.formTambah');
    const row = document.createElement("tr");
    const no = document.createElement("td");
    const jenis_barang = document.createElement("td");
    const jumlah_barang = document.createElement("td");
    const jenis_satuan_barang = document.createElement("td");
    const action = document.createElement("td");

    // memasukan elemen kedalam table body
    row.appendChild(no);
    row.appendChild(jenis_barang);
    row.appendChild(jumlah_barang);
    row.appendChild(jenis_satuan_barang);
    row.appendChild(action);
    load.appendChild(row);

    const txt_id_barang = document.createElement("input");
    txt_id_barang.setAttribute("hidden", 'true');
    txt_id_barang.setAttribute("type", 'text');
    txt_id_barang.setAttribute("name", 'id_barang');
    // txt_id_barang.setAttribute("id", "id_barang");
    txt_id_barang.setAttribute("class", "form-control barang");

    no.appendChild(txt_id_barang);


    // membuat tag HTML
    const txt_jenis_barang = document.createElement("input");
    txt_jenis_barang.setAttribute("type", 'text');
    txt_jenis_barang.setAttribute("name", 'jenis_barang');
    txt_jenis_barang.setAttribute("id", "jenis_barang");
    txt_jenis_barang.setAttribute("class", "form-control");

    const txt_jumlah_barang = document.createElement("input");
    txt_jumlah_barang.setAttribute("type", 'number');
    txt_jumlah_barang.setAttribute("name", "jumlah_barang");
    txt_jumlah_barang.setAttribute("id", "jumlah_barang");
    txt_jumlah_barang.setAttribute("class", "form-control");

    const txt_jenis_satuan_barang = document.createElement("input");
    txt_jenis_satuan_barang.setAttribute("type", 'text');
    txt_jenis_satuan_barang.setAttribute("name", "jenis_satuan_barang");
    txt_jenis_satuan_barang.setAttribute("id", "jenis_satuan_barang");
    txt_jenis_satuan_barang.setAttribute("class", "form-control");

    const delete_element = document.createElement("button");
    delete_element.setAttribute("type", 'button');
    delete_element.setAttribute("class", 'btn btn-danger deleteForm');
    delete_element.innerHTML = "<i class='fa fa-trash'></i>";
    // delete_element.innerHTML = "<a href='#'>hapus</a>";

    let number = $('.barang').length;
    const txt_no = document.createElement("p");
    txt_no.setAttribute("class", 'number');
    txt_no.innerHTML = number;
    no.appendChild(txt_no);


    // const element = array[index];
    // const txt_no = document.createElement("p");
    // txt_no.setAttribute("class", 'number');
    // txt_no.innerHTML = index;
    // no.appendChild(txt_no);

    // menampilkan tAg html
    action.appendChild(delete_element);
    jenis_barang.appendChild(txt_jenis_barang);
    jumlah_barang.appendChild(txt_jumlah_barang);
    jenis_satuan_barang.appendChild(txt_jenis_satuan_barang);

    number = number + 1;

  };
});
