<?php
namespace App\Controller;

class BaseController {
    protected $twig;

    public function __construct() {
        // Twig 환경을 한 번만 설정합니다.
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../View');
        $this->twig = new \Twig\Environment($loader);
    }
}