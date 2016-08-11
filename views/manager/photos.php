<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Upload with Progressbar</title>
    <?php include_once 'views/fragments/taglib.php'; ?>
</head>
<body ng-app="app">
<nav>
    <div class="container" ng-controller="photosController">
        <header class="codrops-header">
            <h1>Upload with Progressbar</h1>
            <p>Source Code:
                <strong>
                    <a href="https://github.com/prongbang/upload-progressbar">Click Here</a>
                </strong>
            </p>
        </header>
        <div class="content">
            <div class="box">
                <table style="width: 100%;" ng-if="storedImage.length > 0">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 10%;">Image</th>
                        <th>Status</th>
                    </tr>
                    <tr ng-repeat="i in storedImage">
                        <td ng-bind="$index+1"></td>
                        <td>
                            <div class="photo-preview">
                                <img ng-src="{{i.src}}"/>
                            </div>
                        </td>
                        <td style="padding-right: 13px;">
                            <div class="progress-container">
                                <div id="myBar{{$index}}" class="progressbar green" style="width:0%"></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box">
                <form id="mainForm" action="./photo/upload" method="post" enctype="multipart/form-data">
                    <div align="right">
                        <table class="table">
                            <tr>
                                <td>
                                    <input id="images" name="images[]" type="file" class="upload" multiple=""/>
                                    <label for="images" class="file-upload-btn btn btn-primary">
                                        <span>Choose images</span>
                                    </label>
                                </td>
                                <td><input ng-click="upload()" class="btn btn-pad btn-default" type="button" value="Upload"/></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <div class="content">
            <div class="box" style="height: 250px;overflow: auto;" ng-if="photos.length > 0">
                <table style="width: 100%;">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 10%;">Image</th>
                        <th>Name</th>
                    </tr>
                    <tr ng-repeat="i in photos">
                        <td ng-bind="$index+1"></td>
                        <td>
                            <div class="photo-preview">
                                <img ng-src="{{i.src}}"/>
                            </div>
                        </td>
                        <td ng-bind="i.src"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</nav>
<footer>
    <script type="text/javascript" src="./assets/js/photos.controller.js"></script>
</footer>
</body>
</html>