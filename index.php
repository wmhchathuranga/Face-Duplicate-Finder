 <?php
    require_once("./FCClientPHP.php");

    $api_key = 'YOUR_API_KEY';
    $api_secret = 'YOUR_API_SECRET';

    $fc = new FCClientPHP("ko8l77vj2396erkcr9sopuljjg", "29n2b3truitanv6u510fl90u2i");
    $photo = 'https://media.licdn.com/dms/image/D5603AQFxs9syMnBJuQ/profile-displayphoto-shrink_200_200/0/1675399773013?e=1702512000&v=beta&t=N7GAGwwf01rbHdfdbR5XlYhNDtvUmcSaXd6auDhDs-U';
    $photo = 'https://media.licdn.com/dms/image/D5603AQGYUZLvGGC7HA/profile-displayphoto-shrink_200_200/0/1678273969729?e=1702512000&v=beta&t=D_3Pcl6JRaP8Dp-OyShbXDCIukYYm7RXqNjo5XyiEVU';
    $photo = 'https://links.nikkiandchris.io/assets/images/apple-touch-icon.png?v=7bb5ffed';
    $photo = 'https://upload.wikimedia.org/wikipedia/commons/9/99/Elon_Musk_Colorado_2022_%28cropped2%29.jpg';
    $photo = 'https://www.rollingstone.com/wp-content/uploads/2023/02/elon-twitter-new-ceo.jpg?w=1581&h=1054&crop=1';
    $user_id = "elonmusk@timebucks";

    // Upload a user photo and detect faces
    function trainFace($fc, $photo, $user_id)
    {

        $response = $fc->faces_detect($photo);

        if (!empty($response->photos[0]->tags)) {
            // Faces detected in the photo
            $tags = $response->photos[0]->tags;

            foreach ($tags as $tag) {
                $face = $tag->tid; // The tag ID associated with the detected face
                $fc->tags_save($face, $user_id);
                $response = $fc->faces_train($user_id);
                echo json_encode($response);
            }

            // You can proceed to the next steps for face recognition.
        } else {
            // No faces detected
            echo 'No faces were detected in the photo.';
        }
    }


    function recognizeFace($fc, $photo, $user_id)
    {
        $response = $fc->faces_recognize($photo, $user_id);

        echo json_encode($response);
        // if (!empty($response->photos[0]->tags[0]->uids)) {
        //     $recognized_uids = $response->photos[0]->tags[0]->uids;
        //     echo $recognized_uids;

        //     // Check if the recognized_uids array contains the user ID for the user who claims the photo.
        //     // If a match is found, you can consider it a successful recognition.
        // } else {
        //     // No recognized faces
        //     echo 'No recognized faces in the photo.';
        // }
    }

    // trainFace($fc, $photo, $user_id);
    recognizeFace($fc, $photo, $user_id);
