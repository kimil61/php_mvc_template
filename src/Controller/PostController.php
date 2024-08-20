<?php
namespace App\Controller;

use App\Model\Post;

class PostController {
    private $postModel;
    private $twig;

    public function __construct() {
        $this->postModel = new Post();
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../View');
        $this->twig = new \Twig\Environment($loader);
    }

    public function indexAction() {
        $posts = $this->postModel->getAllPosts();
        echo $this->twig->render('post_index.twig', ['posts' => $posts]);
    }

    public function createAction() {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $authorId = $_POST['author_id'] ?? 1; // 기본적으로 1번 유저가 작성자라고 가정
        $postId = $this->postModel->createPost($title, $content, $authorId);
        echo $this->twig->render('post_create.twig', ['post_id' => $postId]);
    }

    public function editAction($postId) {
        $post = $this->postModel->getPostById($postId);
        echo $this->twig->render('post_edit.twig', ['post' => $post]);
    }

    public function updateAction($postId) {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $result = $this->postModel->updatePost($postId, $title, $content);
        echo $this->twig->render('post_update.twig', ['result' => $result]);
    }

    public function deleteAction($postId) {
        $result = $this->postModel->deletePost($postId);
        echo $this->twig->render('post_delete.twig', ['result' => $result]);
    }
}
