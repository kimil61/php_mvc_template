<?php
// /src/Controller/UserController.php
namespace App\Controller;

use App\Model\User;
use App\Validation\Validator;


class UserController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    public function indexPage() {
        $users = $this->userModel->getAllUsers();
        echo $this->twig->render('user_index.twig', ['users' => $users]);
    }

    public function createPage() {
        echo $this->twig->render('user_create.twig');
    }

    public function createAction() {
        $data = $_POST;
        $rules = [
            'username' => ['required', 'min:5'],
            'email' => ['required', 'email']
        ];

        $validator = new Validator($data, $rules);
        if ($validator->validate()) {
            $userId = $this->userModel->createUser($data['username'], $data['email']);
            header('Location: /users');  // Redirect after successful creation
            exit();
        } else {
            // Handling errors, possibly passing them back to a view
            echo $this->twig->render('user_create.twig', ['errors' => $validator->getErrors(),'user'=>$data]);
        }
    }

    public function updatePage($userId) {
        $user = $this->userModel->getUserById($userId);
        echo $this->twig->render('user_edit.twig', ['user' => $user]);
    }

    public function updateAction($userId) {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $result = $this->userModel->updateUser($userId, $username, $email);

        // 업데이트 후 /users로 리디렉션
        header('Location: /users');
        exit();
    }

    public function deleteAction($userId) {
        $result = $this->userModel->deleteUser($userId);

        // 삭제 후 /users로 리디렉션
        header('Location: /users');
        exit();
    }



    /////////////////////////////////////////////////////////////////////////////////////////////
    // apis
    public function apiIndexAction() {
        $users = $this->userModel->getAllUsers();
        header('Content-Type: application/json');
        echo json_encode($users);
    }
}
