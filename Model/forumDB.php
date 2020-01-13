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
/*
if(isset($_GET['cat']) AND !empty($_GET['cat'])) {
    $get_cat = htmlspecialchars($_GET['cat']);
    $cats = array();
    $req_cats = $link->query('SELECT * FROM f_categories');
    while($c = $req_cats->fetch()) {
        array_push($cats, array($c['id'],url_custom_encode($c['name'])));
    }
    foreach($cats as $categorie) {
        if(in_array($get_cat, $categorie)) {
            $f_id_categorie = intval($categorie[0]);
        }
    }
    if(@$f_categories_id) {
        if(isset($_GET['subcat']) AND !empty($_GET['subcat'])) {
            $get_subcat = htmlspecialchars($_GET['subcat']);
            $subcats = array();
            $req_subcats = $link->prepare('SELECT * FROM f_subcategories WHERE f_subcategories_id  = ?');
            $req_subcats->execute(array($f_categories_id));
            while($c = $req_subcats->fetch()) {
                array_push($subcats, array($c['id'],url_custom_encode($c['name'])));
            }
            foreach($subcats as $categorie) {
                if(in_array($get_subcat, $categorie)) {
                    $f_subcategories_id = intval($categorie[0]);
                }
            }
        }
        $req = "SELECT * FROM f_topics
                LEFT JOIN `f_topic-categories` ON f_topics.id = `f_topic-categories`.f_topics_id
                LEFT JOIN f_categories ON `f_topic-categories`.`f_categories_id` = `f_categories_id`
                LEFT JOIN f_subcategories ON `f_topic-categories`.`f_subcategories_id` = `f_subcategories_id`
                LEFT JOIN users ON f_topics.users_id = users.id
                WHERE f_categories.id = ?";
        var_dump($req);

        if(@$f_subcategories_id) {
            $req .= " AND f_subcategories.id = ?";
            $exec_array = array($f_categories_id,$f_subcategories_id);
        } else {
            $exec_array = array($f_categories_id);
        }

        $req .= " ORDER BY f_topics.id DESC";

        $topics = $link->prepare($req);
        $topics->execute($exec_array);
    } else {
        die('Erreur: Catégorie introuvable...');
    }
} else {
    die('Erreur: Aucune catégorie sélectionnée...');
}*/

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