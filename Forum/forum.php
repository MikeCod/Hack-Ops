<?php
require('../Model/DB.php');
require('./controller/functions.php');
session_start();
$link = NULL;
try {
    if(!($link = connect_start()))
    throw new Exception("Could not connect to database");
    $categories = $link->query('SELECT * FROM f_categories ORDER BY name');
    $subcat = $link->prepare('SELECT * FROM f_subcategories WHERE categories_id = ? ORDER BY name');
    require('views/forum.view.php');
} catch (Exception $th) {
    echo "Internal error: ".$th->getMessage();
}
connect_end($link);
?>