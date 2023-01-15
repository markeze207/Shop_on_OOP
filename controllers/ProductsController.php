<?php

class ProductsController
{
    public function actionView($productId): bool
    {

        $categories = array();
        $categories = Category::getCategoriesList();

        $brandList = array();
        $brandList = Brand::getBrandList();


        $products = Product::getProductById($productId);

        require_once(ROOT . '/views/product/view.php');
        return true;
    }
}