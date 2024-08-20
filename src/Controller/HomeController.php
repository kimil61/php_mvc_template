<?php
namespace App\Controller;

class HomeController {
    private $twig;

    public function __construct() {
        // Twig 환경을 설정합니다.
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../View');
        $this->twig = new \Twig\Environment($loader);
    }

    public function indexAction() {
        // Twig를 사용하여 홈 페이지를 렌더링하고 출력합니다.
        echo $this->twig->render('home_index.twig');
    }
}
