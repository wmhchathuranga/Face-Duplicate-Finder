 <?php

    // $photo = 'https://media.licdn.com/dms/image/D5603AQFxs9syMnBJuQ/profile-displayphoto-shrink_200_200/0/1675399773013?e=1702512000&v=beta&t=N7GAGwwf01rbHdfdbR5XlYhNDtvUmcSaXd6auDhDs-U';
    // $photo = 'https://media.licdn.com/dms/image/D5603AQGYUZLvGGC7HA/profile-displayphoto-shrink_200_200/0/1678273969729?e=1702512000&v=beta&t=D_3Pcl6JRaP8Dp-OyShbXDCIukYYm7RXqNjo5XyiEVU';
    // $photo = 'https://links.nikkiandchris.io/assets/images/apple-touch-icon.png?v=7bb5ffed';
    // $photo = 'https://upload.wikimedia.org/wikipedia/commons/9/99/Elon_Musk_Colorado_2022_%28cropped2%29.jpg';
    $photo = 'https://media.glamourmagazine.co.uk/photos/6421684583615e34ff19ba8a/16:9/w_1920,c_limit/ADRIANA%20LIMA_%2027032023%20_%20L%20GettyImages-1475729901.jpg';

    function getEndpoint($api_method)
    {
        $api_key = "ko8l77vj2396erkcr9sopuljjg";
        $api_secret = "29n2b3truitanv6u510fl90u2i";
        $api_url = "http://api.skybiometry.com/fc/";
        return $api_url . $api_method . ".json?api_key=" . $api_key . "&api_secret=" . $api_secret;
    }

    function getNamespaces()
    {
        $api_method = "account/namespaces";
        $url = getEndpoint($api_method);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        print $response;
    }

    function getTrainedUsers($namespace)
    {
        $api_method = "account/users";
        $url = getEndpoint($api_method);
        $url = $url . "&namespaces=" . $namespace;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        print $response;
    }

    function getAccountLimits()
    {
        $api_method = "account/limits";
        $url = getEndpoint($api_method);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        print $response;
    }

    function faceSave($tid, $tag, $namespace)
    {
        $api_method = "tags/save";
        $uid = $tag . "@" . $namespace;
        $url = getEndpoint($api_method);
        $url = $url . "&tids=" . $tid . "&uid=" . $uid;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        // print($response);
        curl_close($curl);
        return faceTrain($uid);
    }

    function faceTrain($uid)
    {
        $api_method = "faces/train";
        $url = getEndpoint($api_method);
        $url = $url . "&uids=" . $uid;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        $created = new stdClass();
        if ($result->created[0]->uid) {
            $created->status = "success";
            $created->uid = $result->created[0]->uid;
        } else {
            $created->status = "failed";
            $created->uid = $result->created[0]->uid;
        }
        return $created;
    }

    function faceRecognize($img, $namespace)
    {
        $api_method = "faces/recognize";
        $url = getEndpoint($api_method);
        $url = $url . "&urls=" . $img . "&uids=all@" . $namespace;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        // echo $response;
        // die;
        $uid_results = $result->photos[0]->tags[0]->uids;
        $matched = false;
        $imgObj = new stdClass();
        $uidArray = [];
        foreach ($uid_results as $uid) {
            if ($uid->confidence > 75) {
                $matched = true;
                $imgObj->recognized = true;
                $confidence = new stdClass();
                $confidence->uid = explode('@', $uid->uid)[0];
                $confidence->matching = $uid->confidence;
                array_push($uidArray, $confidence);
                $imgObj->confidence = $uidArray;
            }
        }

        if (!$matched) {
            $tid = $result->photos[0]->tags[0]->tid;
            $imgObj->recognized = false;
            $imgObj->tid = $tid;
        }

        return $imgObj;
    }
