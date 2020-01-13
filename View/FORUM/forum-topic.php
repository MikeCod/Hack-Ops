<!--===========================================================================================
// Objectif : Display Forum : Index
// Authors : GUYOT Jordan
// Version : 16/12/2019
=============================================================================================-->
<?php 
require "../../Controller/FORUM/forum.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo NAME ?></title>
    </head>
    <body>
        <table class="forum">
            <tr class="header">
                <th class="main">Sujet</th>
                <th class="sub-info w10">Messages</th>
                <th class="sub-info w20">Dernier message</th>
                <th class="sub-info w20">Création</th>
            </tr>
            <?php while($t = $topics->fetch()) { ?>
            <tr>
                <td class="main">
                    <h4><a href="forum-topic.php?idT=<?= $t['id'] ?>"><?= $t['title'] ?></a></h4>
                </td>
                <td class="sub-info" style="text-align: center;">4083495</td>
                <td class="sub-info" style="text-align: center;">25.12.2015 à 18h07<br />de Anonyme</td>
                <td class="sub-info" style="text-align: center;"><?= $t['date_create'] ?><br />par DragonManiak</td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>