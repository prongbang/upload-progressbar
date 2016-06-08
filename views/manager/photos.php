<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>JS File Upload with Progress</title>
    <?php include_once 'views/fragments/taglib.php'; ?>
</head>
<body ng-app="app">
<nav>
    <div class="container" ng-controller="photosController">
        <h2>JS File Upload with Progress</h2>
        <div class="photo-preview">
            <img ng-repeat="i in storedImage" ng-src="{{i.src}}"/>
        </div>
        <div class="form">
            <form action="./photo/upload" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>
                            <div class="chart" id="circular" data-percent="0"></div>
                            <div id="status"></div>
                        </td>
                        <td>
                            <input id="images" name="images[]" type="file" class="upload" multiple=""/>
                            <label for="images" class="file-upload btn btn-default">
                                <span>Choose images</span>
                            </label>
                        </td>
                        <td><input class="btn btn-primary" type="submit" value="Upload"/></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="photos">
            <h3>Images</h3>
            <div class="photo-preview">
                <img ng-repeat="i in photos" ng-src="{{i.src}}"/>
            </div>
        </div>
    </div>
</nav>
<footer>
    <script type="text/javascript" src="./assets/js/libs/circular.progress.js"></script>
    <script type="text/javascript" src="./assets/js/photos.controller.js"></script>
</footer>
</body>
</html>