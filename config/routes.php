<?php
// config/routes.php
use App\Controller\HomeController;
use App\Controller\UserController;
use App\Controller\PostController;

function route($controller, $method) {
    return [$controller, $method];
}

return [
    '/' => [
        'GET' => route(HomeController::class, 'indexPage'),
    ],
    ////////////////////////////////////////////////////////////////////////////////////////
    /// users
    '/users' => [
        'GET' => route(UserController::class, 'indexPage'),
    ],
    '/users/create' => [
        'GET' => route(UserController::class, 'createPage'),
        'POST' => route(UserController::class, 'createAction')
    ],
    '/users/edit/{userId}' => [
        'GET' => route(UserController::class, 'updatePage'),
        'POST' => route(UserController::class, 'updateAction')
    ],

    '/users/delete/{userId}' => [
        'DELETE' => route(UserController::class, 'deleteAction')
    ],

    ////////////////////////////////////////////////////////////////////////////////////////
    /// posts
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


    ////////////////////////////////////////////////////////////////////////////////////////
    /// apis
    '/api/users' => [
        'GET' => route(UserController::class, 'apiIndexAction')
    ]


];
