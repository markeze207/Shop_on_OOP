<?php

class SiteController
{
    public function actionIndex(): bool
    {

        $categories = array();
        $categories = Category::getCategoriesList();

        $brandList = array();
        $brandList = Brand::getBrandList();

        $latestProduct = array();
        $latestProduct = Product::getLatestProduct(6);

        require_once(ROOT . '/views/site/index.php');
        return true;
    }
    public function actionContact(): bool
    {

        $userMail = '';
        $userText = '';
        $userSubject = '';
        $result = false;

        if(isset($_POST['submit']))
        {
            $userMail = $_POST['userEmail'];
            $userSubject = $_POST['userSubject'];
            $userText = $_POST['userText'];

            $errors = false;

            if(!User::checkEmail($userMail))
            {
                $errors[] = 'Неправильный email';
            } else {
                $result = mail('admin@admin.com','Тема письма - '.$userSubject, 'Сообщение - ',$userText. '<br> От - '. $userMail);
                $result = true;
            }
        }
        require_once (ROOT . '/views/site/contact.php');
        return true;
    }
}