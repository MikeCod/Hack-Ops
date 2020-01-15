<?php
require('../Model/DB.php');
session_start();
$link = NULL;
$link = connect_start();
if(isset($_SESSION['id'])) {
    if(isset($_POST['tpSubmit'])) {
        if(isset($_POST['tpTitle'],$_POST['tpContent'])) {
            $title = htmlspecialchars($_POST['tpTitle']);
            $content = htmlspecialchars($_POST['tpContent']);
            if(!empty($title) AND !empty($content)) {
                if(strlen($title) <= 70) {
                    if(isset($_POST['tpMail'])) {
                        $notif_mail = 1;
                    } else {
                        $notif_mail = 0;
                    }
                    $req = $link->prepare('INSERT INTO f_topics (users_id, title, content, notif_user, date_create) VALUES(?,?,?,?,NOW())');
                    $req->execute(array($_SESSION['id'],$title,$content,$notif_mail));
                } else {
                    $tpError = "Votre sujet ne peut pas dépasser 70 caractères";
                }
            } else {
                $tpError = "Veuillez compléter tous les champs";
            }
        }
    }
} else {
    $tpError = "Veuillez vous connecter pour poster un nouveau topic";
}
connect_end($link);
require('views/new-topic.view.php');

?>