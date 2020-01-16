<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Document</title>
   </head>
   <body>
   <table border=1 class="forum">
   <tr class="header">
      <th class="main">Sujet</th>
      <th class="sub-info">Auteur</th>
      <th class="sub-info hide-640">Réponses</th>
      <th class="sub-info messages hide-640">Vues</th>
      <th class="sub-info">Dernière rép.</th>
   </tr>
   <?php while($t = $topics->fetch()) { ?>
   <tr>
      <td class="main">
         <h4><a href=""><a href="topic.php?title=<?= url_custom_encode($t['title']) ?>&id=<?= $t['topic_base_id'] ?>"><?= $t['title'] ?></a></a></h4>
      </td>
      <td class="sub-info"><p><?= $t['username'] ?></p><!-- <p>le <?= $t['date_create'] ?></p> --></td>
      <td class="sub-info hide-640"><p><?= rep_nbr_topic($t['topic_base_id']) ?></p></td>
      <td class="sub-info hide-640"><p>1562</p></td>
      <td class="sub-info"><p><?= last_rep_topic($t['topic_base_id']) ?></p></td>
   </tr>
   <?php } ?>
</table>
   <a href="./new-topic.php?cats=<?= $id_categorie ?>">Créer un nouveau topic</a>
   </body>
</html>
