<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo NAME ?></title>
        <link rel="icon" type="image/jpg" href="">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link rel="stylesheet" media="all" type="text/css" href="../include/css/style.css">
        <link rel="stylesheet" media="all" type="text/css" href="../include/css/button.css">
    </head>
    <body>
    <!--<h1>Catégorie</h1>-->
    <table border=2 class="forum">
        <tr class="header">
            <th class="ain">Catégories</th>
            <th class="ub-info">Messages</th>
            <th class="ub-info">Dernier message</th>
        </tr>
        <?php
        while($c = $categories->fetch()) {
            $subcat->execute(array($c['id']));
            $subcategories = '';
            while($sc = $subcat->fetch()) 
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