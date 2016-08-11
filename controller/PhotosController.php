<?php

include_once 'utils/FileUtil.php';
include_once 'models/Photos.php';

$app->get('/', function () use ($app) {

    $app->render("manager/photos.php");

});

$app->post('/photo/uploads', function () use ($app) {

    $name = 'images';

    if (!empty($_FILES[$name])) {

        $status = FileUtil::uploads($_FILES[$name], "assets/images/");

        foreach ($status as $images) {
            if ($images['status'] == "Success") {
                $photo = new Photos();
                $photo->src = $images['src'];
                $photo->date = date("Y-m-d H:i:s");
                $photo->save();
            }
        }

    }
});

$app->post('/photo/upload', function () use ($app) {

    $name = 'image';

    if (!empty($_FILES[$name])) {

        $status = FileUtil::upload($_FILES[$name], "assets/images/");

        if ($status['status'] == "Success") {
            $photo = new Photos();
            $photo->src = $status['src'];
            $photo->date = date("Y-m-d H:i:s");
            $photo->save();
        }

    }
});

$app->get('/photo', function () {
    $photo = new Photos();
    echo json_encode($photo->findAll());
});
