<?php

class Cart
{
    public static function addProduct($id): string
    {
        $id = intval($id);

        $productsInCart = array();

        // Если в корзине уже есть товар (они хранятся в сессии)
        if(isset($_SESSION['products']))
        {
            // То заполняем наш массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Если товар уже есть в корзине, но был добавлен еще раз, то увеличиваем количество
        if(array_key_exists($id, $productsInCart))
        {
            $productsInCart[$id]++;
        } else {
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItem();
    }
    public static function getProducts()
    {
        if(isset($_SESSION['products']))
        {
            return $_SESSION['products'];
        }
        return false;
    }

    public static function countItem(): int
    {
        if(isset($_SESSION['products']))
        {
            return count($_SESSION['products']);
        } else {
            return 0;
        }
    }
    public static function getTotalPrice($products): float|int
    {
        $productsInCart = self::GetProducts();

        $total = 0;

        if($productsInCart)
        {
            foreach($products as $item)
            {
                $total += $item['price'] * $productsInCart[$item['ID']];
            }
        }
        return $total;
    }
    public static function editQuantity($idProduct, $quantity): void
    {
        $_SESSION['products'][$idProduct] = $quantity;
    }
    public static function deleteProduct($idProduct): void
    {
        unset($_SESSION['products'][$idProduct]);
    }
    public static function clear(): void
    {
        if(isset($_SESSION['products']))
        {
            unset($_SESSION['products']);
        }
    }
}