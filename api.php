 <?php

    require_once "./restAPI.php";

    // Enable CORS
    header("Access-Control-Allow-Origin: *"); // Allow requests from any origin (not recommended for production)

    // You can restrict allowed origins to specific domains by specifying them like this:
    // header("Access-Control-Allow-Origin: https://example.com, https://anotherdomain.com");

    // Additional headers for handling preflight requests and credentials
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Credentials: true");

    if (isset($_POST['action'])) {

        $action = $_POST['action'];
        if ($action == "recon") {
            if (isset($_POST['image'])) {
                if (isset($_POST['namespace'])) {
                    $namespace =  $_POST['namespace'];
                    $img = urlencode($_POST['image']);
                    echo json_encode(faceRecognize($img, $namespace));
                }
            }
        } else if ($action == "train") {
            if (isset($_POST['tag'])) {
                if (isset($_POST['namespace'])) {
                    $namespace =  $_POST['namespace'];
                    $tid = urlencode($_POST['tid']);
                    $tag = urlencode($_POST['tag']);
                    echo json_encode(faceSave($tid, $tag, $namespace));
                }
            }
        }
    }
