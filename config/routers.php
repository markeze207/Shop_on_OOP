<?php

return array(
    'news/post/([0-9]+)' => 'news/view/$1',
    'news/page([0-9]+)' => 'news/index/$1',
    'news' => 'news/index',

    'products/([0-9]+)' => 'products/view/$1',

    'catalog/price-([0-9]+)-([0-9]+)/page([0-9]+)' => 'catalog/index/$3/$1/$2',
    'catalog/page([0-9]+)' => 'catalog/index/$1',
    'catalog/price-([0-9]+)-([0-9]+)' => 'catalog/index/1/$1/$2',
    'catalog' => 'catalog/index',

    'category/([0-9]+)/price-([0-9]+)-([0-9]+)/page([0-9]+)' => 'catalog/category/$1/$4/$2/$3',
    'category/([0-9]+)/price-([0-9]+)-([0-9]+)' => 'catalog/category/$1/1/$2/$3',
    'category/([0-9]+)/page([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',

    'cart/editQuantity/id_([0-9]+)/quantity_([0-9]+)' => 'cart/editQuantity/$1/$2',
    'cart/deleteProduct/id_([0-9]+)' => 'cart/deleteProduct/$1',
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart' => 'cart/index',

    'brand/([0-9]+)/price-([0-9]+)-([0-9]+)/page([0-9]+)' => 'catalog/brand/$1/$4/$2/$3',
    'brand/([0-9]+)/price-([0-9]+)-([0-9]+)' => 'catalog/brand/$1/1/$2/$3',
    'brand/([0-9]+)/page([0-9]+)' => 'catalog/brand/$1/$2',
    'brand/([0-9]+)' => 'catalog/brand/$1',

    'user/login' => 'user/login',
    'user/logout' => 'user/logout',

    'account' => 'account/index',
    'contact' => 'site/contact',

    ''=>'site/index',
);