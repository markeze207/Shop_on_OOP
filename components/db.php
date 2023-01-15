<?php

class Db
{
    public static function getConnection(): PDO
    {
        return new PDO("mysql:host=localhost;dbname=shop", "root", "");
    }
}