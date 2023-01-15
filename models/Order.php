<?php

class Order
{

    public static function save($userFCS, $userPhone, $userAddress, $userId, $products): bool
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_FCS, user_phone, user_address, user_id, products) VALUES (:user_FCS, :user_phone, :user_address, :user_id, :products)';

        $products = json_encode($products);

        $result = $db->prepare($sql);

        $result->bindParam(':user_FCS',$userFCS);
        $result->bindParam(':user_phone',$userPhone);
        $result->bindParam(':user_address',$userAddress);
        $result->bindParam(':user_id',$userId);
        $result->bindParam(':products',$products);

        return $result->execute();
    }
    public static function getOrderById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);

        $result->setFetchMode(PDO::FETCH_ASSOC); // Получаем данные в виде массива

        return $result->execute();
    }
}
