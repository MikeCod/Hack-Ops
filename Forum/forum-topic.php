<?php
require('../Model/DB.php');
require('./controller/functions.php');
session_start();
$link = NULL;
$link = connect_start();
$title = "No category specified";

if(isset($_GET['cats']) AND !empty($_GET['cats'])) {
   $id_categorie = -1;
   $get_categorie = htmlspecialchars($_GET['cats']);
   $categories = array();
   $req_categories = $link->query('SELECT * FROM f_categories');

   while($c = $req_categories->fetch())
      array_push($categories, array($c['id'], url_custom_encode($c['name'])));

   foreach($categories as $cat) {
      if(in_array($get_categorie, $cat))
         $id_categorie = intval($cat[0]);
   }

   if($id_categorie > 0) {
      $id_subcategorie = -1;
      if(isset($_GET['subcats']) AND !empty($_GET['subcats'])) {
         $get_subcategorie = htmlspecialchars($_GET['subcats']);
         $subcategories = array();
         $req_subcategories = $link->prepare('SELECT * FROM f_subcategories WHERE categories_id = ?');
         $req_subcategories->execute(array($id_categorie));
         $title = htmlspecialchars(ucfirst(mb_strtolower($_GET['cats']))." / ".ucfirst(mb_strtolower($_GET['subcats'])));
            
         while($c = $req_subcategories->fetch())
            array_push($subcategories, array($c['id'], url_custom_encode($c['name'])));

         foreach($subcategories as $cat) {
            if(in_array($get_subcategorie, $cat))
               $id_subcategorie = intval($cat[0]);
         }
      }
      
      $req = "SELECT *, f_topics.id topic_base_id FROM f_topics
      LEFT JOIN `f_topic-categories` ON f_topics.id = `f_topic-categories`.topics_id 
      LEFT JOIN f_categories ON `f_topic-categories`.categories_id = f_categories.id
      LEFT JOIN f_subcategories ON `f_topic-categories`.subcategories_id = f_subcategories.id
      LEFT JOIN users ON f_topics.users_id = users.id
      WHERE f_categories.id = ?";

      $exec_array = array($id_categorie);
      if($id_subcategorie > 0) {
         $req .= " AND f_subcategories.id = ?";
         $exec_array = array($id_categorie,$id_subcategorie);
      }
      else $title = htmlspecialchars(ucfirst(mb_strtolower($_GET['cats'])))." / Unavailable subcategory";

      $req .= " ORDER BY f_topics.id DESC";

      $topics = $link->prepare($req);
      $topics->execute($exec_array);
   }
   else die('Erreur: Catégorie introuvable...');
}
else die('Erreur: Aucune catégorie sélectionnée...');

require('views/forum-topics.view.php');
?>