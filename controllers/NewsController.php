<?php

class NewsController
{
    public static function actionIndex($page = 1): bool
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $brandList = array();
        $brandList = Brand::getBrandList();

        $total = News::getPostCount();

        $posts = array();

        $posts = News::getTotalPosts(News::SHOW_BY_DEFAULT, $page);

        $pagination = new Pagination($total, News::SHOW_BY_DEFAULT);

        require_once(ROOT . '/views/news/index.php');

        return true;
    }
    public static function actionView($id): bool
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $brandList = array();
        $brandList = Brand::getBrandList();

        $nextPost = News::checkNextPost($id);
        $prePost = News::checkPrePost($id);

        $postById = News::getPostById($id);

        require_once(ROOT . '/views/news/view.php');

        return true;
    }
}