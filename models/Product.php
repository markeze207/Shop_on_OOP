<?php

class Product
{
    const SHOW_BY_DEFAULT = 6;

    public static function getFilter($minPrice, $maxPrice): array
    {
        if($minPrice && $maxPrice)
        {
            $price = [
                'minPrice' => $minPrice,
                'maxPrice' => $maxPrice
            ];
        } else {
            $price = self::getTotalMinMaxPrice();
        }
        return $price;
    }

    public static function getLatestProduct($count = self::SHOW_BY_DEFAULT, $page = 1, $minPrice = false, $maxPrice = false): array
    {
        $count = intval($count);

        $db = Db::getConnection();

        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $productList = array();

        $price = self::getFilter($minPrice,$maxPrice);

        $result = $db->query("SELECT ID,name,price,image,is_new FROM product WHERE status=1 AND price >= {$price["minPrice"]} AND price <= {$price["maxPrice"]} ORDER BY ID DESC LIMIT $count OFFSET ".$offset);
        $i = 0;
        while($row = $result->fetch())
        {
            $productList[$i]['ID'] = $row['ID'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;

        }
        return $productList;
    }
    public static function getProductsListByCategory($categoryId = false, $page = 1, $minPrice = false, $maxPrice = false)
    {
        if ($categoryId) {

            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();

            $products = array();

            $price = self::getFilter($minPrice,$maxPrice);

            $result = $db->query("SELECT ID,name,price,image,is_new FROM product WHERE status=1 AND category_id='".$categoryId."' AND price >= {$price["minPrice"]} AND price <= {$price["maxPrice"]} ORDER BY `ID` DESC LIMIT ".self::SHOW_BY_DEFAULT.' OFFSET '.$offset);
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['ID'] = $row['ID'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;

            }
            return $products;
        }
    }
    public static function getProductsListByBrand($brandId = false, $page = 1, $minPrice = false, $maxPrice = false)
    {
        if ($brandId) {

            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();

            $products = array();

            $price = self::getFilter($minPrice,$maxPrice);

            $result = $db->query("SELECT ID,name,price,image,is_new FROM product WHERE status=1 AND brand_Id='".$brandId."' AND price >= {$price["minPrice"]} AND price <= {$price["maxPrice"]} ORDER BY `ID` DESC LIMIT ".self::SHOW_BY_DEFAULT.' OFFSET '.$offset);
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['ID'] = $row['ID'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;

            }
            return $products;
        }
    }

    public static function getProductById($id)
    {
        $id = intval($id);

        if($id)
        {
            $db = Db::getConnection();
            $result = $db->query('SELECT * FROM product WHERE ID=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }
    public static function getTotalProducts($minPrice = false, $maxPrice = false)
    {
        $db = Db::getConnection();
        $price = self::getFilter($minPrice, $maxPrice);
        $result = $db->query("SELECT count(ID) as count FROM product WHERE status=1 AND price >= {$price["minPrice"]} AND price <= {$price["maxPrice"]}");

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }
    public static function getTotalProductsInCategory($categoryId, $minPrice = false, $maxPrice = false)
    {
        $db = Db::getConnection();

        $price = self::getFilter($minPrice, $maxPrice);

        $result = $db->query("SELECT count(ID) as count FROM product WHERE status=1 AND category_id = {$categoryId} AND price >= {$price["minPrice"]} AND price <= {$price["maxPrice"]}");

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }
    public static function getTotalProductsInBrand($brandId, $minPrice = false, $maxPrice = false)
    {
        $db = Db::getConnection();

        $price = self::getFilter($minPrice, $maxPrice);

        $result = $db->query("SELECT count(ID) as count FROM product WHERE status=1 AND brand_id = {$brandId} AND price >= {$price["minPrice"]} AND price <= {$price["maxPrice"]}");

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }
    public static function getTotalMinMaxPrice() : Array
    {
        $db = Db::getConnection();

        $result = $db->query("SELECT MIN(price) as minPrice, MAX(price) as maxPrice FROM product WHERE status=1");

        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }
    public static function getMinMaxPriceInCategory($categoryId) : Array
    {
        $db = Db::getConnection();

        $result = $db->query("SELECT MIN(price) as minPrice, MAX(price) as maxPrice FROM product WHERE status=1 AND category_id = ".$categoryId);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }
    public static function getMinMaxPriceInBrand($brandId) : Array
    {
        $db = Db::getConnection();

        $result = $db->query("SELECT MIN(price) as minPrice, MAX(price) as maxPrice FROM product WHERE status=1 AND brand_id = ".$brandId);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }
    public static function getProductsByIds($idsArray): array
    {
        $products = array();

        $db = Db::getConnection();

        $idsString = implode(',',$idsArray);

        $productsInCart = Cart::getProducts();

        $sql = "SELECT * FROM product WHERE status=1 AND ID IN ($idsString)";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;

        while($row = $result->fetch())
        {
            $products[$i]['ID'] = $row['ID'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['total'] = $row['price'] * $productsInCart[$row['ID']];
            $i++;
        }
        return $products;
    }

}