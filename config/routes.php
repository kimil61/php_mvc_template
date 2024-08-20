<?php

use App\Controller\HomeController;
use App\Controller\UserController;
use App\Controller\PostController;

function route($controller, $method) {
    return [$controller, $method];
}

return [
    '/' => [
        'GET' => route(HomeController::class, 'indexAction'),
    ],
    '/users' => [
        'GET' => route(UserController::class, 'indexAction'),
    ],
    '/users/create' => [
        'POST' => route(UserController::class, 'createAction')
    ],
    '/users/edit/{userId}' => [
        'GET' => route(UserController::class, 'editAction')
    ],
    '/users/update/{userId}' => [
        'POST' => route(UserController::class, 'updateAction')
    ],
    '/users/delete/{userId}' => [
        'POST' => route(UserController::class, 'deleteAction')
    ],
    '/posts' => [
        'GET' => route(PostController::class, 'indexAction')
    ],
    '/posts/create' => [
        'POST' => route(PostController::class, 'createAction')
    ],
    '/posts/edit/{postId}' => [
        'GET' => route(PostController::class, 'editAction')
    ],
    '/posts/update/{postId}' => [
        'POST' => route(PostController::class, 'updateAction')
    ],
    '/posts/delete/{postId}' => [
        'POST' => route(PostController::class, 'deleteAction')
    ],
    '/api/users' => [
        'GET' => route(UserController::class, 'apiIndexAction')
    ]
];
