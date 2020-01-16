<?php
require('../Model/DB.php');
session_start();
$link = NULL;
$link = connect_start();

if(isset($_GET['cats'])) {
    $get_categorie = htmlspecialchars($_GET['cats']);
    $categorie = $link->prepare('SELECT * FROM f_categories WHERE id = ?');
    $categorie->execute(array($get_categorie));
    $cat_exist = $categorie->rowCount();

    if($cat_exist == 1) {
        $categorie = $categorie->fetch();
        $categorie = $categorie['name'];
        $subcategories = $link->prepare('SELECT * FROM f_subcategories WHERE categories_id = ? ORDER BY name');
        $subcategories->execute(array($get_categorie));

        if(isset($_SESSION['id'])) {
            if(isset($_POST['tpSubmit'])) {
                if(isset($_POST['tpTitle'],$_POST['tpContent'])) {
                    $title = htmlspecialchars($_POST['tpTitle']);
                    $content = htmlspecialchars($_POST['tpContent']);
                    $content = utf8_encode($content);
                    $content = str_replace('ï»¿','',$content);
                    $content = utf8_decode($content);

                    $subcategorie = htmlspecialchars($_POST['subcats']);
                    $verify_sc = $link->prepare('SELECT id FROM f_subcategories WHERE id = ? AND categories_id = ?');
                    $verify_sc->execute(array($subcategorie,$get_categorie));
                    $verify_sc = $verify_sc->rowCount();

                    if($verify_sc == 1) {
                        if(!empty($title) AND !empty($content)) {
                            if(strlen($title) <= 70) {
                                if(isset($_POST['tpMail'])) {
                                    $notif_mail = 1;
                                } else {
                                    $notif_mail = 0;
                                }
                                $ins = $link->prepare('INSERT INTO f_topics (users_id, title, content, notif_user, date_create) VALUES(?,?,?,?,NOW())');
                                $ins->execute(array($_SESSION['id'],$title,$content,$notif_mail));

                                $lt = $link->query('SELECT id FROM f_topics ORDER BY id DESC LIMIT 0,1');
                                $lt = $lt->fetch();
                                $topic_id = $lt['id'];
                                $ins = $link->prepare('INSERT INTO `f_topic-categories` (topics_id, categories_id, subcategories_id) VALUES (?,?,?)');
                                $ins->execute(array($topic_id, $get_categorie, $subcategorie));
                            } else {
                                $terror = "Votre title ne peut pas dépasser 70 caractères";
                            }
                        } else {
                            $terror = "Veuillez compléter tous les champs";
                        }
                    } else {
                        $terror = "Sous-catégorie invalide";
                    }
                }
            }
        } else {
            $terror = "Veuillez vous connecter pour poster un nouveau topic";
        }
    } else {
        die('Catégorie invalide...');
    }
} else {
    die('Aucune catégorie définie...');
}
 
 
connect_end($link);
require('views/new-topic.view.php');

?>