<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

// 보안 헤더 추가
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self';");

// 입력 필터링
$requestUri = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');
$method = htmlspecialchars($_SERVER['REQUEST_METHOD'], ENT_QUOTES, 'UTF-8');

//라우터 추가
$routes = require __DIR__ . '/../config/routes.php';

$callback = null;
foreach ($routes as $path => $handler) {
    if ($path === $requestUri && isset($handler[$method])) {
        $callback = $handler[$method];
        break;
    }
}

if ($callback !== null) {
    list($class, $method) = $callback;
    $controller = new $class();

    if (!method_exists($controller, $method)) {
        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
        exit;
    }

    $controller->$method();
} else {
    // 404 Not Found
    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
    exit;
}
