<?php
function bitmaszyna_api($method,$params = array())
{
    $key = "put yourkey here";
    $secret = "put your secret here";

    $params["nonce"] = time();

    $post = http_build_query($params, "", "&");
    $sign = hash_hmac("sha512", $post, $secret);
    $headers = array(
        "Rest-Key: " . $key,
        "Rest-Sign: " . $sign,
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, "https://bitmaszyna.pl/api/".$method);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $ret = curl_exec($curl);

    return $ret;
}

echo bitmaszyna_api("funds");
?>
