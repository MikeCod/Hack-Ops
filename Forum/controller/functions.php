<?php 
function url_custom_encode($title) {
   $title = htmlspecialchars($title);
   $find = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Œ', 'œ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Š', 'š', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Ÿ', '?', '?', '?', '?', 'Ž', 'ž', '?', 'ƒ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
   $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
   $title = str_replace($find, $replace, $title);
   $title = strtolower($title);
   $mots = preg_split('/[^A-Z^a-z^0-9]+/', $title);
   $encoded = "";

   foreach($mots as $mot) {
      if(strlen($mot) >= 3 OR str_replace(['0','1','2','3','4','5','6','7','8','9'], '', $mot) != $mot) {
         $encoded .= $mot.'-';
      }
   }
   $encoded = substr($encoded, 0, -1);
   return $encoded;
}
function get_pseudo($id) {
   global $link;
   $pseudo = $link->prepare('SELECT username FROM users WHERE id = ?');
   $pseudo->execute(array($id));
   $pseudo = $pseudo->fetch()['username'];
   return $pseudo;
}

function rep_nbr_categorie($id_categorie) {
   global $link;
   $nbr = $link->prepare('SELECT f_message.id FROM f_message LEFT JOIN `f_topic-categories` ON `f_topic-categories`.topics_id = f_messages.topics_id WHERE `f_topic-categories`.categories_id = ?');
   $nbr->execute(array($id_categorie));
   return $nbr->rowCount();
}
function rep_nbr_topic($topics_id) {
   global $link;
   $nbr = $link->prepare('SELECT f_message.id FROM f_message LEFT JOIN f_topics ON f_topics.id = f_message.topics_id WHERE f_topics.id = ?');
   $nbr->execute(array($topics_id));
   return $nbr->rowCount();
}
function last_rep_categorie($id_categorie) {
   global $link;
   $rep = $link->prepare('SELECT f_message.* FROM f_message LEFT JOIN `f_topic-categories` ON `f_topic-categories`.topics_id = f_message.topics_id WHERE `f_topic-categories`.categories_id = ? ORDER BY f_message.date_post DESC LIMIT 0,1');
   $rep->execute(array($id_categorie));
   if($rep->rowCount() > 0) {
      $rep = $rep->fetch();
      $dr = $rep['date_post'];
      $dr .= '<br /> de '.get_pseudo($rep['users_id']);
   } else {
      $dr = 'Aucune réponse...';
   }
   return $dr;
}
function last_rep_topic($topics_id) {
   global $link;
   $rep = $link->prepare('SELECT f_message.* FROM f_message LEFT JOIN f_topics ON f_topics.id = f_message.topics_id WHERE f_topics.id = ? ORDER BY f_message.date_post DESC LIMIT 0,1');
   $rep->execute(array($topics_id));
   if($rep->rowCount() > 0) {
      $rep = $rep->fetch();
      $dr = $rep['date_post'];
      $dr .= '<br /> de '.get_pseudo($rep['users_id']);
   } else {
      $dr = 'Aucune réponse...';
   }
   return $dr;
}
?>