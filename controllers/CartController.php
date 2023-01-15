<?php

class CartController
{
    public  function actionIndex() : bool
    {
        $productsInCart = false;

        $productsInCart = Cart::getProducts();

        if($productsInCart)
        {
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);

            $totalPrice = Cart::getTotalPrice($products);
        }

        $result = false;
        if(isset($_POST['submit']))
        {
            $userFCS = htmlspecialchars($_POST['FCS']);
            $userPhone = htmlspecialchars($_POST['phone']);
            $userAddress = htmlspecialchars($_POST['address']);

            $errors = false;

            if(!User::checkPhone($userPhone))
            {
                $errors[] = 'Неправильный телефон';
            }
            if(!$errors)
            {
                $productsInCart = Cart::getProducts();

                if(User::isGuest())
                {
                    $userId = null;
                } else {
                    $userId = User::checkLogged();
                }

                $result = Order::save($userFCS, $userPhone, $userAddress, $userId, $productsInCart);
                if($result)
                {
                    mail('admin@admin.com', 'Новый заказ: ','http://localhost');

                    Cart::clear();
                }
            }
        }
        require_once (ROOT . '/views/cart/index.php');

        return true;
    }

    public function actionEditQuantity($idProduct, $quantity) : bool
    {
        Cart::editQuantity($idProduct, $quantity);
        return true;
    }
    public function actionDeleteProduct($idProduct): bool
    {
        Cart::deleteProduct($idProduct);
        return true;
    }
    public function actionAddAjax($id): bool
    {
        echo Cart::addProduct($id);
        return true;
    }
}