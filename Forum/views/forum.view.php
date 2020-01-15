<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
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
        while($c = $categories->fetch()) {
            $subcat->execute(array($c['id']));
            $subcategories = '';
            while($sc = $subcat->fetch()) { 
                $subcategories .= '<a href="./forum-topic.php?cats='.url_custom_encode($c['name']).'&subcats='.url_custom_encode($sc['name']).'">'.$sc['name'].'</a> | ';
            }
            $subcategories = substr($subcategories, 0, -3);
        ?>
        <tr>
            <td class="main">
                <h4><a href=""><?= $c['name'] ?></a></h4>
                <p>
                    <?= $subcategories ?>
                </p>
            </td>
            <td class="sub-info">4083495</td>
            <td class="sub-info">04.12.2015 à 14h52<br />de DM</td>
        </tr>
        <?php } ?>
    </table>
    </body>
</html>