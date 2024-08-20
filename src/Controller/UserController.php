<?php
namespace App\Controller;

use App\Model\User;


class UserController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    public function indexAction() {
        $users = $this->userModel->getAllUsers();
        echo $this->twig->render('user_index.twig', ['users' => $users]);
    }

    public function createAction() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $userId = $this->userModel->createUser($name, $email);
        echo $this->twig->render('user_create.twig', ['user_id' => $userId]);
    }

    public function updateAction($userId) {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $result = $this->userModel->updateUser($userId, $name, $email);
        echo $this->twig->render('user_update.twig', ['result' => $result]);
    }

    public function deleteAction($userId) {
        $result = $this->userModel->deleteUser($userId);
        echo $this->twig->render('user_delete.twig', ['result' => $result]);
    }

    public function editAction($userId) {
        $user = $this->userModel->getUserById($userId);
        echo $this->twig->render('user_edit.twig', ['user' => $user]);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////
    // apis
    public function apiIndexAction() {
        $users = $this->userModel->getAllUsers();
        header('Content-Type: application/json');
        echo json_encode($users);
    }
}
