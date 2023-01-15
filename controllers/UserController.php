<?php

class UserController
{
    public function actionLogin(): bool
    {

        $name = '';
        $email = '';
        $password = '';

        $resultRegistration = false;
        $errorsRegistration = false;
        $errorsLogin = false;

        if(isset($_POST['submitLogin']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!User::checkEmail($email))
            {
                $errorsLogin[] = 'Неправильный ввод e-mail';
            }
            if(!User::checkPassword($password))
            {
                $errorsLogin[] = 'Пароль не должен быть короче 6-х символов';
            }

            $userId = User::checkUserData($email, $password);

            if(!$userId)
            {
                $errorsLogin[] = 'Неправильные данные для входа на сайта';

            } else {

                User::auth($userId);
                header('Location: /account/');

            }
        }

        if(isset($_POST['submitRegistration']))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!User::checkName($name))
            {
                $errorsRegistration[] = 'Имя не должно быть короче 4-х символов';
            }
            if(!User::checkEmail($email))
            {
                $errorsRegistration[] = 'Неправильный e-mail';
            }
            if(!User::checkPassword($password))
            {
                $errorsRegistration[] = 'Пароль не должен быть короче 6-х символов';
            } 

            if(User::checkEmailExist($email))
            {
                $errorsRegistration[] = 'Такой e-mail уже зарегистрирован';
            }

            if(!$errorsRegistration)
            {
                $resultRegistration = User::register($name, $email, $password);
            }
        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    public function actionLogout() : void
    {
        session_start();

        unset($_SESSION['user']);
        header('Location: /');
    }
}