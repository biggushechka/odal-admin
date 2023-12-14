<?php

$version = "";
$version_new = "";
$root = $_SERVER['DOCUMENT_ROOT'];

if ($_SERVER['HTTP_HOST'] == 'odal-admin') {
    $version = mt_rand(10000, 99999999);
} else {
    $getFileVersion = file($root."/backend/version.txt", FILE_IGNORE_NEW_LINES);
    $version_now = $getFileVersion[0];
    $version_new = $getFileVersion[1];

    if ($version != $version_new) {
        $version = $version_new;
        $getFileVersion[0] = $getFileVersion[1];
        file_put_contents($root."/backend/version.txt", implode(PHP_EOL, $getFileVersion));

        clearCash($root . "/assets", $version);
        clearCash($root . "/components", $version);
        clearCash($root . "/pages", $version);
        clearCash($root . "/plugins/modal", $version);
    }
}