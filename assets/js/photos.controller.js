app.controller("photosController", function ($scope, $http, circular) {

    $scope.percent = 0;
    $scope.photos = [];

    $scope.storedImage = [];

    $scope.findAll = function () {
        $http.get("./photo").success(function (response) {
            $scope.photos = response;
        });
    };

    $scope.init = function () {
        document.querySelector('#images').addEventListener('change', handleFileSelect, false);
        circular.load();
        $scope.findAll();
    };

    function handleFileSelect(e) {
        $scope.$apply(function () {
            $scope.storedImage = [];
        });
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        filesArr.forEach(function (f) {
            if (!f.type.match("image.*")) return;
            var reader = new FileReader();
            reader.onload = function (e) {
                var base64 = e.target.result; // f.name
                $scope.$apply(function () {
                    $scope.storedImage.push({src: base64});
                });
            };
            reader.readAsDataURL(f);
        });
    }

    $scope.upload = function () {

        $('form').ajaxForm({
            beforeSend: function () {
                circular.statusEmpty();
                circular.percent('0%', 0);
            },
            uploadProgress: function (event, position, total, percentComplete) {
                circular.percent((percentComplete + '%'), percentComplete);
                circular.load();
            },
            success: function () {
                circular.percent('100%', 100);
                $scope.findAll();
            },
            complete: function (xhr) {
                circular.percent('100%', 100);
                circular.status(xhr.responseText);
                circular.load();
            }
        });
    };

    $scope.init();
    $scope.upload();

});