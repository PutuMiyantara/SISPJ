sispj.controller("HakAkses", function ($scope, $http, $window, $timeout) {
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

  $scope.getRoleAkses = function () {
    // console.log('test');
    $http.get("/hakakses/getRoleAkses/").then(function (data) {
      $scope.datas = data.data;
      // console.log(data);
    }, function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.getDetail = function (role_name) {
    // $window.location.href = "/manage/menu/detail/";
    $http.get("/hakakses/getMenu/").then(function (data) {
      $scope.openModal("#HakAkses");
      $scope.modalTitle = data['nama'];
      $scope.modalButton = "Update";
      $scope.actionButton = "Kembali";
      $scope.errorMessage = null;
      $scope.error = false;
      $scope.hide = true;
      $scope.dataMenu = data.data;
      console.log(data);
    }, function errorCallback(response) {
      console.log(response);
      alert("error");
    });
  };

  $scope.openModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("show");
  };

  $scope.closeModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("hide");
  };
});
