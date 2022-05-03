<?php

namespace App\Controller;

use App\Model\User;
use Aternos\Model\Query\SelectQuery;
use Devanych\View\Renderer;
use Phpass\Hash;

class UserController extends Controller
{
    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_login_form'])){
            $user = $_POST['user_login_form'];
            $email = $user['email'];

            if (!$this->validateEmail($email)){
                $msg = 'Wrong email format.';
                setcookie('info', $msg, time() + 5);
                return header('Location: /login');
            }

            $result = User::query((new \Aternos\Model\Query\SelectQuery())->where(['email'=>$email])->limit(1));
            if (!$result->wasSuccessful()) {
                $msg = 'Something goes wrong... try again later. ';
                setcookie('info', $msg, time() + 5);
                return header('Location: /login');
            }

            if (count($result) == 0) {
                $msg = 'Email does not exist. ';
                setcookie('info', $msg, time() + 5);
                return header('Location: /login');
            }
            $passwordHash = $result[0]->getPassword();

            $phpassHash = new Hash;
            if ($phpassHash->checkPassword($user['password'], $passwordHash)) {
                $_SESSION['user'] = $result[0];
            } else {
                $msg = 'Password is incorrect. Try again.';
                setcookie('info', $msg, time() + 5);
            }
            return header('Location: /login');
        }

        if (!isset($_SESSION['user'])){
            $renderer = new Renderer($this->path);
            $content = $renderer->render('user/login');

            echo $content;
        } else {
            return header('Location: /products');
        }
    }

    public function logout(){
        if (isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }

        return header('Location: /login');
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_register_form'])){
            $user = $_POST['user_register_form'];
            $username = $user['username'];
            $email = $user['email'];
            $password = $user['password'];

            if (!$this->validateEmail($email)){
                $msg = 'Wrong email format.';
                setcookie('info', $msg, time() + 5);
                return header('Location: /register');
            }

            $phpassHash = new Hash;
            $passwordHashed = $phpassHash->hashPassword($password);

            $userModel = new User();
            $userModel->setUsername($username);
            $userModel->setEmail($email);
            $userModel->setPassword($passwordHashed);

            try {
                $userModel->save();
                $msg = 'Account created successfully! Welcome ' . $username . '!';
                setcookie('info', $msg, time() + 5);
                $_SESSION['user'] = $userModel;
                return header('Location: /register');
            } catch (\Exception $e) {
                $msg = 'Ups... Something goes wrong. Try again later.';
                setcookie('info', $msg, time() + 5);
                return header('Location: /register');
            }
        }
        $renderer = new Renderer($this->path);
        $content = $renderer->render('user/register');

        echo $content;
    }

    private function validateEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
        }
    }

}
