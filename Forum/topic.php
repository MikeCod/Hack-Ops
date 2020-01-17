<?php
require('../Model/DB.php');
require('./controller/functions.php');
require_once('./include/jBBCode-1.3.0/jBBcode/Parser.php');
session_start();
$link = NULL;
$link = connect_start();

if(isset($_GET['title'],$_GET['id']) AND !empty($_GET['title']) AND !empty($_GET['id'])) {
    $get_title = htmlspecialchars($_GET['title']);
    $get_id = htmlspecialchars($_GET['id']);

    $origin_title = $link->prepare('SELECT title FROM f_topics WHERE id = ?');
    $origin_title->execute(array($get_id));
    $origin_title = $origin_title->fetch()['title'];

    $parser = new JBBCode\Parser();
    $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
    $parser->addBBCode("quote", '<blockquote>{param}</blockquote>');
    $parser->addBBCode("center", '<div align="center">{param}</div>');
    if($get_title == url_custom_encode($origin_title)) {
        $topic = $link->prepare('SELECT * FROM f_topics WHERE id = ?');
        $topic->execute(array($get_id));
        $topic = $topic->fetch();

        if(isset($_POST['topic_rep_submit'],$_POST['topic_rep'])) {
            $rep = htmlspecialchars($_POST['topic_rep']);
            if(isset($_SESSION['id'])) {
                if(!empty($rep)) {
                    $ins = $link->prepare('INSERT INTO f_message(topics_id,users_id,content,date_post) VALUES (?,?,?,NOW())');
                    $ins->execute(array($get_id,$_SESSION['id'],$rep));
                    $rep_msg = "Votre réponse a bien été postée";
                    unset($rep);
                } else {
                    $rep_msg = "Votre réponse ne peut pas être vide !";
                }
            } else {
                $rep_msg = "Veuillez vous connecter ou créer un compte pour poster une réponse";
            }
        }
        if(isset($_GET['page']) AND $_GET['page'] > 1) {
            $rep_page = 6;
        } else {
            $rep_page = 5;
        }
        $total_rep_request = $link->prepare('SELECT * FROM f_message WHERE topics_id = ?');
        $total_rep_request->execute(array($get_id));
        $total_rep = $total_rep_request->rowCount();
        $total_pages = ceil($total_rep/$rep_page);

        if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $total_pages) {
            $_GET['page'] = intval($_GET['page']);
            $current_page = $_GET['page'];
        } else {
            $current_page = 1;
        }
        $start = ($current_page - 1) * $rep_page;
        $reps = $link->prepare('SELECT * FROM f_message WHERE topics_id = ? LIMIT '.$start.','.$rep_page);
        $reps->execute(array($get_id));
    } else {
        die('Erreur: Le title ne correspond pas à l\'id');
    }
    require('views/topic.view.php');
} else {
    die('Erreur...');
}
?>