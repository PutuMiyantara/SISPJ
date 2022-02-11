var sispj = angular.module("sispj", ["datatables", "chart.js"]);

sispj.directive("fileInput", [
  "$parse",
  function ($parse) {
    return {
      restrict: "A",
      link: function (scope, elm, attrs) {
        elm.bind("change", function () {
          $parse(attrs.fileInput).assign(scope, elm[0].files);
          scope.$apply();
        });
      },
    };
  },
]);

// jika mau menggunakan directive select2 bisa menambah atribut select2 dengan dara menambah tulisan select2="" pada dalam tag
sispj.directive("select2", function($timeout, $parse) {
  return {
    restrict: 'AC',
    require: 'ngModel',
    link: function(scope, element, attrs) {
      console.log(attrs);
      $timeout(function() {
        element.select2();
        element.select2Initialized = true;
      });

      var refreshSelect = function() {
        if (!element.select2Initialized) return;
        $timeout(function() {
          element.trigger('change');
        });
      };
      
      var recreateSelect = function () {
        if (!element.select2Initialized) return;
        $timeout(function() {
          element.select2('destroy');
          element.select2();
        });
      };

      scope.$watch(attrs.ngModel, refreshSelect);

      if (attrs.ngOptions) {
        var list = attrs.ngOptions.match(/ in ([^ ]*)/)[1];
        // watch for option list change
        scope.$watch(list, recreateSelect);
      }

      if (attrs.ngDisabled) {
        scope.$watch(attrs.ngDisabled, refreshSelect);
      }
    }
  };
});
