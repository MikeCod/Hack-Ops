<!--===========================================================================================
// Objectif : SQL request Forum
// Authors : GUYOT Jordan
// Version : 16/12/2019
=============================================================================================-->

<?php 
require "DB.php";

$link = NULL;
$link = connect_start();
$cat = $link->query('SELECT * FROM f_categories ORDER BY name');
$subcat = $link->prepare('SELECT * FROM f_subcategories WHERE f_categories_id = ? ORDER BY name');
connect_end($link);

function test() {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if (!($result = $link->query("SELECT * FROM f_categories"))) {
                throw new Exception("No access to the table");
        }
        return $result;
    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}

?>