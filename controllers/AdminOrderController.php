<?php

class AdminOrderController extends AdminBase
{
    public static function actionView($id): bool
    {
        // проверка на доступ к админке
        ///

        $order = Order::getOrderById($id); // Получаем нужный нам заказ

        $productsQuantity = json_decode($order['products'], true);

        $productsIds = array_keys($productsQuantity);

        $products = Product::getProductsByIds($productsIds);

        return true;
    }
}