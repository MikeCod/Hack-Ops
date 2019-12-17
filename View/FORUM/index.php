<!--===========================================================================================
// Objectif : Display Forum
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
        <title>Document</title>
    </head>
    <body>
        <table class="forum">
            <tr class="header">
                <th class="main">Catégories</th>
                <th class="sub-info">Messages</th>
                <th class="sub-info">Dernier message</th>
            </tr>
            <?php
            while($c = $cat->fetch()) {
                $subcat->execute(array($c['id']));
                $subcats = '';
                while($sc = $subcat->fetch()) { 
                    $subcats .= '<a href="index.php?idSC='.$sc['id'].'">'.$sc['name'].'</a> | ';
                }
                $subcats = substr($subcats, 0, -3);
            ?>
            <tr>
                <td class="main">
                    <h4><a href="index.php?idC=<?= $c['id'] ?>"><?= $c['name'] ?></a></h4>
                    <p>
                    <?= $subcats ?>
                    </p>
                </td>
                <td class="sub-info" style="text-align: center;">999</td>
                <td class="sub-info" style="text-align: center;">04.12.2015 à 14h52<br />By DragonManiak</td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>