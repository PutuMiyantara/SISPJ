sispj.controller("Orders", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    $scope.error = false;
    $scope.success = false;
    $scope.formModel = {};
    $scope.formModel.id_rekening_dasar = null;
    $scope.formModel.id_kode_belanja_sub5 = null;
    $scope.formModel.id_rekanan = null;
    $scope.id = null;
    // console.log('set default');
    $('#appendTest').empty();
  };

  $scope.getOrders = function () {
    // console.log('test');
    $http.get("/orders/getOrders").then(function (data) {
      $scope.datas = data.data;
      // console.log(data);
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
    var data_uraian_pesanan = [];

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
    for (let i = 0; i < jumlahForm; i++) {
      data_uraian_pesanan[i] = document.getElementsByName("uraian_pesanan")[i].value;
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
        id_pegawai: $scope.formModel.id_pegawai,
        jenis_barang: data_jenis_barang,
        jumlah_barang: data_jumlah_barang,
        jenis_satuan_barang: data_jenis_satuan_barang,
        uraian_pesanan: data_uraian_pesanan,
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
        // console.log(data.data);
        // mengisi field barang
        while (i < j) {
          $scope.addForm();
          document.getElementsByName("id_barang")[i].value = data.data[i].id;
          document.getElementsByName("jenis_barang")[i].value = data.data[i].jenis_barang;
          document.getElementsByName("jumlah_barang")[i].value = data.data[i].jumlah_barang;
          document.getElementsByName("jenis_satuan_barang")[i].value = data.data[i].jenis_satuan_barang;
          document.getElementsByName("uraian_pesanan")[i].value = data.data[i].uraian_pesanan;
          // console.log('get detail while');
          i++;
        }
        $scope.id = data.data[0].id_orders;
        $scope.formModel.no_pesanan = data.data[0].no_pesanan;
        $scope.formModel.tgl_pesanan = new Date(data.data[0].tgl_pesanan);
        $scope.formModel.id_rekening_dasar = data.data[0].id_rekening_dasar;
        $scope.formModel.id_kode_belanja_sub5 = data.data[0].id_kode_belanja_sub5;
        $scope.formModel.id_pegawai = data.data[0].id_pegawai;
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
    var data_uraian_pesanan = [];

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
    for (let i = 0; i < jumlahForm; i++) {
      data_uraian_pesanan[i] = document.getElementsByName("uraian_pesanan")[i].value;
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
        id_pegawai: $scope.formModel.id_pegawai,
        jenis_barang: data_jenis_barang,
        jumlah_barang: data_jumlah_barang,
        jenis_satuan_barang: data_jenis_satuan_barang,
        uraian_pesanan: data_uraian_pesanan,
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
          console.log(data);
          if (data.data.errortext == "") {
            $scope.getDetail($scope.id);
            $scope.getOrders();
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
      $http.post("/orders/deleteOrders", {
        id: id,
      }).then(
        function successCallback(data) {
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

  $scope.dataPegawai = function () {
    $http.get("/pegawai/searchPegawai").then(function (data) {
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

  // let number = 1;
  // const numberArray = [];
  // $scope.tableBarangHide = true;

  // $scope.addForm = function () {
  //   $scope.tableBarangHide = false;
  //   // console.log('addform');
  //   const load = document.querySelector('.load_content');
  //   const row = document.createElement("tr");
  //   const no = document.createElement("td");
  //   const jenis_barang = document.createElement("td");
  //   const jumlah_barang = document.createElement("td");
  //   const jenis_satuan_barang = document.createElement("td");
  //   const uraian_pesanan = document.createElement("td");
  //   const action = document.createElement("td");

  //   // memasukan elemen kedalam table body
  //   load.appendChild(row);
  //   row.appendChild(no);
  //   row.appendChild(jenis_barang);
  //   row.appendChild(jumlah_barang);
  //   row.appendChild(jenis_satuan_barang);
  //   row.appendChild(uraian_pesanan);
  //   row.appendChild(action);

  //   // membuat text nik
  //   const txt_jenis_barang = document.createElement("input");
  //   txt_jenis_barang.setAttribute("type", 'text');
  //   txt_jenis_barang.setAttribute("id", "jenis_barang");
  //   txt_jenis_barang.setAttribute("class", "form-control");

  //   const txt_jumlah_barang = document.createElement("input");
  //   txt_jumlah_barang.setAttribute("type", 'number');
  //   txt_jumlah_barang.setAttribute("id", "jumlah_barang");
  //   txt_jumlah_barang.setAttribute("class", "form-control");

  //   const txt_jenis_satuan_barang = document.createElement("input");
  //   txt_jenis_satuan_barang.setAttribute("type", 'text');
  //   txt_jenis_satuan_barang.setAttribute("id", "jenis_satuan_barang");
  //   txt_jenis_satuan_barang.setAttribute("class", "form-control");

  //   const txt_uraian_pesanan = document.createElement("input");
  //   txt_uraian_pesanan.setAttribute("type", 'text');
  //   txt_uraian_pesanan.setAttribute("id", "uraian_pesanan");
  //   txt_uraian_pesanan.setAttribute("class", "form-control");

  //   // const txt_no = document.createElement("p");
  //   // txt_no.innerHTML = number;
  //   const delete_element = document.createElement("button");
  //   delete_element.setAttribute("class", 'btn btn-danger');
  //   delete_element.setAttribute("ng-click", 'deleteForm');
  //   delete_element.innerHTML = "<i class='fa fa-trash'></i>";
  //   // delete_element.innerHTML = "<a href='#'>hapus</a>";

  //   // memasukan text nik kedalam nik 
  //   action.appendChild(delete_element);
  //   jenis_barang.appendChild(txt_jenis_barang);
  //   jumlah_barang.appendChild(txt_jumlah_barang);
  //   jenis_satuan_barang.appendChild(txt_jenis_satuan_barang);
  //   uraian_pesanan.appendChild(txt_uraian_pesanan);

  //   const txt_no = document.createElement("p");
  //   for (let index = 1; index < numberArray.length; index++) {
  //     // const element = array[index];
  //     txt_no.innerHTML = numberArray[index];
  //     no.appendChild(txt_no);
  //   }
  //   numberArray.push(number);
  //   number = number + 1;

  //   delete_element.onclick = function () {
  //     row.parentNode.removeChild(row);
  //   }
  // };

  $scope.deleteForm = function () {
    // console.log('test');
    // const list = document.querySelector('.load_content');
    // list.removeChild(row);
  };

  $scope.tableBarangHide = true;

  var load, row, no, jenis_barang, jumlah_barang, jenis_satuan_barang, uraian_pesanan, action;
  $scope.addForm = function () {
    $scope.tableBarangHide = false;
    // console.log('addform');
    // const load = document.querySelector('.load_content');
    // const row = document.createElement("tr")
    // const no = document.createElement("td");
    // const jenis_barang = document.createElement("td");
    // const jumlah_barang = document.createElement("td");
    // const jenis_satuan_barang = document.createElement("td");
    // const uraian_pesanan = document.createElement("td");
    // const action = document.createElement("td");

    load = document.querySelector('.load_content');
    row = document.createElement("tr")
    no = document.createElement("td");
    jenis_barang = document.createElement("td");
    jumlah_barang = document.createElement("td");
    jenis_satuan_barang = document.createElement("td");
    uraian_pesanan = document.createElement("td");
    action = document.createElement("td");

    // memasukan elemen kedalam table body
    load.appendChild(row);
    row.appendChild(no);
    row.appendChild(jenis_barang);
    row.appendChild(jumlah_barang);
    row.appendChild(jenis_satuan_barang);
    row.appendChild(uraian_pesanan);
    row.appendChild(action);

    // membuat text nik
    const txt_jenis_barang = document.createElement("input");
    txt_jenis_barang.setAttribute("type", 'text');
    txt_jenis_barang.setAttribute("id", "jenis_barang");
    txt_jenis_barang.setAttribute("class", "form-control");

    const txt_jumlah_barang = document.createElement("input");
    txt_jumlah_barang.setAttribute("type", 'number');
    txt_jumlah_barang.setAttribute("id", "jumlah_barang");
    txt_jumlah_barang.setAttribute("class", "form-control");

    const txt_jenis_satuan_barang = document.createElement("input");
    txt_jenis_satuan_barang.setAttribute("type", 'text');
    txt_jenis_satuan_barang.setAttribute("id", "jenis_satuan_barang");
    txt_jenis_satuan_barang.setAttribute("class", "form-control");

    const txt_uraian_pesanan = document.createElement("input");
    txt_uraian_pesanan.setAttribute("type", 'text');
    txt_uraian_pesanan.setAttribute("id", "uraian_pesanan");
    txt_uraian_pesanan.setAttribute("class", "form-control");

    // const txt_no = document.createElement("p");
    // txt_no.innerHTML = number;
    const delete_element = document.createElement("button");
    delete_element.setAttribute("type", 'button');
    delete_element.setAttribute("class", 'btn btn-danger');
    delete_element.setAttribute("ng-click", 'deleteForm()');
    delete_element.innerHTML = "<i class='fa fa-trash'></i>";
    // delete_element.innerHTML = "<a href='#'>hapus</a>";

    // memasukan text nik kedalam nik 
    action.appendChild(delete_element);
    jenis_barang.appendChild(txt_jenis_barang);
    jumlah_barang.appendChild(txt_jumlah_barang);
    jenis_satuan_barang.appendChild(txt_jenis_satuan_barang);
    uraian_pesanan.appendChild(txt_uraian_pesanan);

    delete_element.onclick = function () {
      row.parentNode.removeChild(row);
      console.log(row.parentNode);
    }
  };
});
