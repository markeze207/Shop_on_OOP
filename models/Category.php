<?php

class Category 
{
    public static function getCategoriesList(): array
    {
        $db = Db::getConnection();

        $categoriesList = array();

        $result = $db->query("SELECT ID,name FROM category ORDER BY sort_order ASC");

        $i = 0;
        while($row = $result->fetch())
        {
            $categoriesList[$i]['ID'] = $row['ID'];
            $categoriesList[$i]['name'] = $row['name'];
            $categoriesList[$i]['count'] = self::getCategoryCount($row['ID']);
            $i++;
        }
        return $categoriesList;
    }
    public static function getCategoryCount($categoryId)
    {
        $db = Db::getConnection();

        return $db->query("SELECT COUNT(*) FROM product WHERE category_id = '".$categoryId."'")->fetchColumn();
    }
}