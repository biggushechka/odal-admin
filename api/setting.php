<?php

$rootPath = $_SERVER['DOCUMENT_ROOT'];
$origin = $_SERVER['HTTP_ORIGIN'];

// разрешенные домены
$allowedOrigins = [
    'http://otal-estate',
    'https://otal-estate.ru',
    'http://odal'
];

$get_allowedOrigins = file_get_contents($rootPath . "/api/allowed-origins.txt");
$ao_json = json_decode($get_allowedOrigins);

foreach ($ao_json as $itemDomain) {
    $allowedOrigins[] = $itemDomain;
}

// Устанавливаем возможность отправлять ответ для разрешенных доменов
if ($origin != "") {
    if (in_array($origin, $allowedOrigins)) {
        header("Access-Control-Allow-Origin: " . $origin);
//        header('Access-Control-Allow-Methods: POST');
        header("Access-Control-Allow-Credentials: true");
    } else {
        // Сайт, не входящий в список разрешенных, получит ошибку доступа
        header("HTTP/1.1 403 Forbidden");
        exit("Доступ запрещен ((");
    }
}