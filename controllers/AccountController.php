<?php

class AccountController
{
    public function actionIndex(): bool
    {

        $userId = User::checkLogged();

        require_once(ROOT . '/views/account/index.php');

        return true;
    }
}