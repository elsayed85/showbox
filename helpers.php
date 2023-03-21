<?php
include "config.php";

function encrypt($message)
{
    global $key, $iv;
    $keyHex = utf8_decode($key);
    $ivHex = utf8_decode($iv);
    $encrypted = openssl_encrypt($message, "des-ede3-cbc", $keyHex, OPENSSL_RAW_DATA, $ivHex);
    $data = base64_encode($encrypted);
    return $data;
}

function md5_1($message)
{
    return md5($message);
}

function generateVerifyToken($str, $str2, $str3)
{
    if ($str) {
        return md5_1(md5_1($str2) . $str3 . $str);
    }
    return null;
}

function makeid($length)
{
    $result = "";
    $characters = "abcdefghijklmnopqrstuvwxyz0123456789";
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $result .= $characters[rand(0, $charactersLength - 1)];
    }

    return $result;
}

function getExpiryDate()
{
    return time() + (60 * 60 * 12);
}

function buildQuery($pramters)
{
    global $appId, $default;
    $defaultPramters = array(
        'childmode' => $default['childmode'],
        'appid' => $appId,
        'lang' => $_GET['lang'] ?? $default['lang'],
        'expired_date' => getExpiryDate(),

        'platform' => 'android',
        'app_version' => '11.5',
        'channel' => 'Website',
    );
    $pramters = array_merge($defaultPramters, $pramters);
    return json_encode($pramters);
}


function generateEncryptedBody($query)
{
    global $appKey, $key;
    $encryptedQuery = encrypt($query);
    $appKeyHash = md5($appKey);

    $newBody = array(
        'app_key' => $appKeyHash,
        'verify' => generateVerifyToken($encryptedQuery, $appKey, $key),
        'encrypt_data' => $encryptedQuery
    );

    $newBody = json_encode($newBody);

    $words = utf8_encode($newBody);
    $base64 = base64_encode($words);

    return array(
        'data' => $base64,
        'appid' => "27",
        'platform' => "android",
        'version' => "129",
        'medium' => "Website&token" . makeid(32)
    );
}


function call_api($data, $server = 'showbox')
{
    global $default, $servers;
    $headers = [
        'Platform' => 'android',
        'Accept' => 'charset=utf-8',
        'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36',
        'Content-Type' => 'application/x-www-form-urlencoded',
    ];

    $path = $servers[$server ?? $default['server']] ?? $servers['showbox'];

    $curlOptions = array(
        CURLOPT_URL => $path,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => $headers,
    );

    $curl = curl_init();
    curl_setopt_array($curl, $curlOptions);
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}


function jsonFormat($data)
{
    $json = json_encode($data, JSON_PRETTY_PRINT);
    return $json;
}


function call($parameters, $server = 'showbox')
{
    return call_api(generateEncryptedBody(buildQuery($parameters)), $server);
}
