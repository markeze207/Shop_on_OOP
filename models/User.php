<?php

class User
{
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = ?';

        $result = $db->prepare($sql);
        $result->execute([$email]);

        $user = $result->fetch();

        if ($user && password_verify($password, $user['password']))
        {
            return $user['ID'];
        }
        return false;
    }

    public static function auth($userId): void
    {
        session_start();
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {

        if(isset($_SESSION['user']))
        {
            return $_SESSION['user'];
        }
        header('Location: /user/login');
        return false;
    }

    public static function register($name, $email, $password): bool
    {

        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $db = Db::getConnection();

        $sql = 'INSERT INTO user (name, email, password) VALUES (?, ?, ?)';

        $result = $db->prepare($sql);
        return $result->execute([$name, $email, $password]);
    }

    public static function checkName($name): bool
    {
        if(strlen($name) >= 4)
        {
            return true;
        }
        return false;
    }

    public static function checkEmail($email): bool
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        return false;
    }

    public static function checkPassword($password): bool
    {
        if(strlen($password) >= 6)
        {
            return true;
        }
        return false;
    }

    public static function checkEmailExist($email): bool
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email = ?';

        $result = $db->prepare($sql);
        $result->execute([$email]);

        if($result->fetchColumn())
        {
            return true;
        }
        return false;   
    }
    public static function isGuest() : bool
    {
        if(isset($_SESSION['user']))
        {
            return false;
        }
        return true;
    }

    public static function checkPhone(string $userPhone): bool
    {
        return preg_match('/^[0-9]{9,14}\z/', $userPhone);
    }
}