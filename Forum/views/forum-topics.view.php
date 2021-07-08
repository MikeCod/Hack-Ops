<?php
function button($text, $a, $href = false, $width = 200, $color = "white")
{
   $text = str_replace(' ', '<span style="color:transparent">_</span>', $text);
   if ($color != "white")
      $color .= ";text-shadow:unset";
   echo '
   <div class="svg-wrapper">
      <svg height="40" width="'.$width.'">
         <rect class="shape" height="40" width="'.$width.'" />
         <div class="text">
            <a style="color:'.$color.';'.(!$href ? 'cursor:pointer;" onclick' : '" href').'="'.$a.'"><span class="spot"></span>'.$text.'</a>
         </div>
      </svg>
   </div>';
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <link rel="icon" type="image/jpg" href="">
      <link rel="stylesheet" media="all" type="text/css" href="../include/css/style.css">
      <link rel="stylesheet" media="all" type="text/css" href="../include/css/button.css">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
      <title>Forum</title>
   </head>
   <body>
      <div id="banner" style="float:left;">
            <div style="padding-left:10%; padding-right:10%; padding-top:10px; height:50px; background:linear-gradient(black 90%, #2a2a2a 90%); font-size:24pt;">
                <?= NAME ?> <img src="../logo.jpg" width="40" height="40">
            </div>
        </div>
      <?php
         button("Dashboard", "../View/dashboard.php", true);
         button("Back", "./", true);
      ?>
      <h1 style="padding-left:200px;"><?= $title ?></h1>
      <table style="padding-top:100px; padding-left:250px; padding-bottom:40px;">
         <tr class="main">
            <th class="sub-info">Subject</th>
            <th class="sub-info">Author</th>
            <th class="sub-info hide-640">Answers</th>
            <th class="sub-info" style="width:400px;">Last answer</th>
         </tr>
         <?php while($t = $topics->fetch()) { ?>
         <tr>
            <td class="sub-info">
               <h4><a href="topic.php?title=<?= url_custom_encode($t['title']) ?>&id=<?= $t['topic_base_id'] ?>"><?= $t['title'] ?></a></h4>
            </td>
            <td class="sub-info"><?= $t['username'] ?><!-- <p>le <?= $t['date_create'] ?></p> --></td>
            <td class="sub-info hide-640"><?= rep_nbr_topic($t['topic_base_id']) ?></td>
            <td class="sub-info"><?= last_rep_topic($t['topic_base_id']) ?></td>
         </tr>
         <?php } ?>
      </table>
      <?php button("Create new topic", "new-topic.php?cats=".$id_categorie, true); ?>
   </body>
</html>
