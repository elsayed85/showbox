<?php

$key = "123d6cedf626dy54233aa1w6";
$iv = "wEiphTn!";
$appId = "com.tdo.showbox";
$appKey = "moviebox";

$servers = [
    "showbox" => "https://showbox.shegu.net/api/api_client/index/",
    "mbpapi" => "https://mbpapi.shegu.net/api/api_client/index/",
];

$default = [
    "page" => 1,
    "pagelimit" => 10,
    "lang" => "en",
    "childmode" => 0,
    "server" => "showbox", // showbox, mbpapi
];
