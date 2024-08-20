<?php
// public/index.php
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

// _method 필드를 통해 DELETE 및 PUT 메서드 처리
if ($method === 'POST' && isset($_POST['_method'])) {
    $method = $_POST['_method'];
}

//라우터 추가
$routes = require __DIR__ . '/../config/routes.php';

$callback = null;
$params = [];

foreach ($routes as $path => $handler) {
    $pathRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $path);
    if (preg_match('#^' . $pathRegex . '$#', $requestUri, $matches)) {
        array_shift($matches);  // 첫 번째 요소는 전체 매칭된 문자열이므로 제거
        $params = $matches;
        if (isset($handler[$method])) {
            $callback = $handler[$method];
        }
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

    // 동적 라우트의 파라미터를 메서드에 전달
    call_user_func_array([$controller, $method], $params);
} else {
    // 404 Not Found
    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
    exit;
}