 <?php

    require_once "./restAPI.php";

    if (isset($_POST['action'])) {

        $action = $_POST['action'];
        if ($action == "recon") {
            if (isset($_POST['image'])) {
                $img = urlencode($_POST['image']);
                echo json_encode(faceRecognize($img));
            }
        } else if ($action == "train") {
            if (isset($_POST['tag'])) {
                $tid = urlencode($_POST['tid']);
                $tag = urlencode($_POST['tag']);
                echo json_encode(faceSave($tid, $tag, "timebucks"));
            }
        }
    }
