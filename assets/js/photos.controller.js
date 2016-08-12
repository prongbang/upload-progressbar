app.controller("photosController", function ($scope, $http) {

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

    function ajaxSubmit(files, index) {

        if (files.length != index) {
            // specify exact data for formdata
            var formData = new FormData();
            // Main magic with files here
            formData.append('image', files[index]);
            var formSubmit = $("<form method='POST' action='./photo/upload' enctype='multipart/form-data'></form>");
            var myBar = $("#myBar" + index);

            index++;

            formSubmit.ajaxSubmit({
                formData: formData,
                beforeSend: function (e) {
                    myBar.css("width", "0%");
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    myBar.css("width", percentComplete + "%");
                },
                complete: function (xhr) {
                    myBar.css("width", "100%");
                    console.log(xhr.responseText);
                    $scope.$apply(function () {
                        $scope.findAll();
                    });
                    ajaxSubmit(files, index);
                },
                error: function (e) {
                    console.error(e);
                }
            });
        }
    }

    $scope.upload = function () {

        var typeFile = 'input[type=file]';
        var form = $('#mainForm')[0];
        var files = $(typeFile, form)[0].files;

        // Sending form
        if (files.length > 0) {
            ajaxSubmit(files, 0);
        }

    };

    $scope.init();

});

