<?php

class Brand
{
    public static function getBrandList(): array
    {
        $db = Db::getConnection();

        $brandList = array();

        $result = $db->query("SELECT ID,name FROM brands ORDER BY sort_order ASC");

        $i = 0;
        while($row = $result->fetch())
        {
            $brandList[$i]['ID'] = $row['ID'];
            $brandList[$i]['name'] = $row['name'];
            $brandList[$i]['count'] = self::getBrandCount($row['ID']);
            $i++;
        }
        return $brandList;
    }
    public static function getBrandCount($brandId)
    {
        $db = Db::getConnection();

        return $db->query("SELECT COUNT(*) FROM product WHERE brand_id = '".$brandId."'")->fetchColumn();
    }
}