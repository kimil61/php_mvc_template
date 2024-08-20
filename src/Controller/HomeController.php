<?php
namespace App\Controller;

class HomeController extends BaseController {
    public function __construct() {
        parent::__construct();
    }


    public function indexAction() {
        // Twig를 사용하여 홈 페이지를 렌더링하고 출력합니다.
        echo $this->twig->render('home_index.twig');
    }
}
