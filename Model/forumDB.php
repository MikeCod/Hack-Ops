<!--===========================================================================================
// Objectif : SQL request Forum
// Authors : GUYOT Jordan
// Version : 16/12/2019
=============================================================================================-->

<?php 
require "DB.php";

function req_display_cat() {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if (!($cat = $link->query("SELECT * FROM f_categories ORDER BY name"))) {
                throw new Exception("No access to the table");
        }
        return $cat;
    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}

function req_display_subcat() {
    $link = NULL;
    try
    {
        if(!($link = connect_start()))
            throw new Exception("Could not connect to database");
        if (!($subcat = $link->prepare("SELECT * FROM f_subcategories WHERE f_id_categories = ? ORDER BY name"))) {
            throw new Exception("No access to the table");
        }
        return $subcat;
    } catch (Exception $th) {
        echo "Internal error: ".$th->getMessage();
    }
    connect_end($link);
}


?>