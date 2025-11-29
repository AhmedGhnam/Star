<?php

declare(strict_types=1);

namespace App\users\controllers;

use App\users\Models\User;
use App\helpers\Paginator;
use App\helpers\Session;
use App\helpers\ErrorsPages;

class UserController extends BaseController {

    public function __construct(){
        parent::__construct();
    }

    public function create(array $data = []) {
        $this->render('create', $data);
    }

    public function index(): void {
        // if(!Session::isAdmin()) {
        //     ErrorsPages::errorShow(403);
        //     exit;
        // }
        $page    = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $search = isset($_GET['s']) ? trim($_GET['s']) : ''; 
        $order = $_GET['order'] ?? 'id';
        $sort = $_GET['sort'] ?? 'ASC';
        $paginator = new Paginator($page, 5);
        if($search !== '') {
            $totalUsers = User::countSearch($search);
            $users = User::search($search, $paginator->perPage, $paginator->offset, $order, $sort);
        } else {
            $totalUsers = User::countAll();
            $users = User::getAll($paginator->perPage, $paginator->offset, $order, $sort);
        }
        $totalPages = ceil($totalUsers / $paginator->perPage);

        $this->render('all', compact('users', 'page', 'totalPages', 'order', 'sort', 'search'));
    }

    public function validateUser(string $username): array {
        $errors = [];
        if($username === '') {               
                $errors['username'][]= 'UserName Can\'t Be Empty';
            }

        if(strlen($username) < 4) {
            $errors['username'][] = 'UserName Must Be At least 4 Letters';
        }

        return $errors;
    }

    public function store() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username'] ?? '');

            $errors = $this->validateUser($username);

            // Upload Photo

            $profilePhotoPath = null;

            if(!empty($_FILES['profile_picture']['name'])) {
                $uploadDir = __DIR__ . '/../../users/uploads/';
                if(!is_dir($uploadDir)){ mkdir($uploadDir, 0777, true);}
                $fileName = time() . '_' . basename($_FILES['profile_picture']['name']);
                $targetFile = $uploadDir . $fileName;
                if(move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
                    $profilePhotoPath = '/star/app/users/uploads/' . $fileName;
                } else {
                    $errors[] = 'Failed to upload profile picture';
                }
            }


            if(!empty($errors['username'])) {
                $this->create(['errors' => $errors, 'old' => ['username' => $username]]);
                return;
            }
        }

        $user = new User(null, $username, null, 'user', 0, date('d/m/Y g:i A'));
        $user->profilePicture = $profilePhotoPath;
        $user->save();
        
        header('Location: /star/users/create');
        exit;
    }

    public function edit(int $id) {
        $user = User::find($id,null);
        if(!$user) {
            http_response_code(404);
            echo 'This User Is Not Exist';
            return;
        }

        $this->render('edit', ['user' => $user, 'errors'=> [], 'old' => ['username' => $user->userName]]);
    }

    public function profile(int $id) {
        $user = User::find($id, null);
        if(!$user) {
            ErrorsPages::errorShow(404);
            return;
        }

        $this->render('profile', ['user' => $user, 'errors' => []]);
    }

    public function update(int $id) {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']) ?? '';

            $errors = $this->validateUser($username);

            if(!empty($errors['username'])) {
                $user = User::find($id, null);
                $this->render('edit', ['user' => $user, 'errors' => $errors, 'old' => ['username' => $username]]);
                return;
            }

            $user = User::find($id, null);
            if(!$user) {
                header('Location: /star/users');
                exit;
            }
            $user->userName = $username;
            $user->save();

            header('Location: /star/users');
            exit;


        }
    }

    public function remove(int $id) {
        $user = User::find($id, null);
        if(!$user) {
            header('Location: /star/users');
            exit;
        }

        header('Location: /star/users');
        exit;

    }

    // public function search() {

    //     $search = isset($_GET['s']) ? trim($_GET['s']) : ''; 
    //     $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    //     $totalUsers = User::countSearch($search);
    //     $paginator = new Paginator($page, 5);
    //     $totalPages = ceil($totalUsers/ $paginator->perPage);
    //     $users = User::search($search, $paginator->perPage, $paginator->offset);

    //     $this->render('all', ['users' => $users, 'totalPages' => $totalPages, 'page' => $page, 'search' => $search]);
    // }

    public function render(string $view, array $data) {

        $defaults = ['errors' => [], 'old' => []];

        extract(array_merge($defaults, $data));
        $viewPath = __DIR__ . "/../views/{$view}.php";
        require __DIR__ . "/../views/layout/header.php";
        require $viewPath;
        require __DIR__ . "/../views/layout/footer.php";
        
    }

}