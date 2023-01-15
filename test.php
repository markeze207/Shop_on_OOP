<?php
session_start();
$array1 = [
    'id1',
    'id2',
    'id3'
];
echo '<pre>';
$_SESSION['products']['10'] = 29;
print_r ($_SESSION);
echo '</pre>';