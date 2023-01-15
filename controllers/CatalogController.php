<?php


class CatalogController
{
    public function actionIndex($page = 1, $minPrice = false, $maxPrice = false) : bool
    {

        $categories = array();
        $categories = Category::getCategoriesList();

        $brandList = array();
        $brandList = Brand::getBrandList();

        $latestProduct = array();
        $latestProduct = Product::getLatestProduct(6, $page, $minPrice, $maxPrice);

        $total = Product::getTotalProducts($minPrice, $maxPrice);

        $pagination = new Pagination($total, Product::SHOW_BY_DEFAULT);

        $prices = Product::getTotalMinMaxPrice();

        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    public function actionCategory($categoryId, $page = 1, $minPrice = false, $maxPrice = false): bool
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $brandList = array();
        $brandList = Brand::getBrandList();

        $categoryProduct = array();
        $categoryProduct = Product::getProductsListByCategory($categoryId, $page, $minPrice, $maxPrice);

        $total = Product::getTotalProductsInCategory($categoryId, $minPrice, $maxPrice);

        $pagination = new Pagination($total, Product::SHOW_BY_DEFAULT);

        require_once(ROOT . '/views/catalog/category.php');

        return true;
    }

    public function actionBrand($brandId, $page = 1, $minPrice = false, $maxPrice = false): bool
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $brandList = array();
        $brandList = Brand::getBrandList();

        $brandProduct = array();
        $brandProduct = Product::getProductsListByBrand($brandId, $page, $minPrice, $maxPrice);

        $total = Product::getTotalProductsInBrand($brandId, $minPrice, $maxPrice);

        $pagination = new Pagination($total, Product::SHOW_BY_DEFAULT);

        require_once(ROOT . '/views/catalog/brand.php');

        return true;
    }
}