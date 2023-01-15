<?php

class News
{
    const SHOW_BY_DEFAULT = 3;
    public static function getPostCount()
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT count(ID) as count FROM blog");

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }
    public static function getTotalPosts($count = self::SHOW_BY_DEFAULT, $page = 1): array
    {
        $count = intval($count);

        $db = Db::getConnection();

        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $post = array();

        $result = $db->query("SELECT * FROM blog ORDER BY ID DESC LIMIT $count OFFSET ".$offset);
        $i = 0;
        while($row = $result->fetch())
        {
            $post[$i]['ID'] = $row['ID'];
            $post[$i]['date'] = $row['date'];
            $post[$i]['title'] = $row['title'];
            $post[$i]['text'] = $row['text'];
            $post[$i]['image'] = $row['image'];
            $post[$i]['rating'] = $row['rating'];
            $i++;

        }
        return $post;
    }
    public static function getPostById($id): array
    {
        $db = Db::getConnection();

        $post = array();

        $result = $db->query("SELECT * FROM blog WHERE ID = {$id}");
        $i = 0;
        while($row = $result->fetch())
        {
            $post[$i]['date'] = $row['date'];
            $post[$i]['title'] = $row['title'];
            $post[$i]['text'] = $row['text'];
            $post[$i]['image'] = $row['image'];
            $post[$i]['rating'] = $row['rating'];
            $i++;

        }
        return $post;
    }
    public static function checkNextPost($id)
    {
        $db = Db::getConnection();

        $sql = $db->query("SELECT ID FROM blog WHERE ID > {$id} ORDER BY ID LIMIT 1");
        $result = $sql->fetch();
        $count = $sql->rowCount();

        if($count > 0)
        {
            return $result['ID'];
        }
        return false;
    }
    public static function checkPrePost($id)
    {
        $db = Db::getConnection();

        $sql = $db->query("SELECT ID FROM blog WHERE ID < {$id} ORDER BY ID DESC LIMIT 1 ");
        $result = $sql->fetch();
        $count = $sql->rowCount();

        if($count > 0)
        {
            return $result['ID'];
        }
        return false;
    }
}