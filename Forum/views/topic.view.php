<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Forum</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="include/wysibb/jquery.wysibb.min.js"></script>
        <link rel="stylesheet" href="include/wysibb/wbbtheme.css" />
        <script>
            $(function() {
            var optionsWbb = {
            buttons: "bold,italic,underline,|,justifycenter,|,img,link,|,code,quote,home",
            lang: "fr",
            allButtons: {
                home: {
                    title: 'Back Home',
                    buttonText: 'Home',
                    transform: {
                    '<a href="index.php">{SELTEXT}</a>':'[home]{SELTEXT}[/home]'
                    }
                }
            }
            }
            $("#wysibb").wysibb(optionsWbb);
            })
        </script>
    </head>
    <body>
        <table border=1 class="forum">
            <tr class="header">
                <th class="sub-info w10">Auteur</th>
                <th class="main center">Sujet: <?= $topic['title'] ?></th>
            </tr>
            <?php if($current_page == 1) { ?>
            <tr>
                <td><?= get_pseudo($topic['users_id']) ?></td>
                <td>
                    <?php
                    $parser->parse(nl2br($topic['content']));
                    echo $parser->getAsHtml();
                    ?>
                </td>
            </tr>
            <?php } ?>
            <?php while($r = $reps->fetch()) { ?>
            <tr>
                <td><?= get_pseudo($r['users_id']) ?></td>
                <td><?= $r['content'] ?></td>
            </tr>
            <?php } ?>
        </table>
        <?php
        for($i = 1; $i <= $total_pages; $i++) {
            if($i == $current_page) {
                echo $i.' ';
            } else {
                echo '<a href="topic.php?title='.$get_title.'&id='.$get_id.'&page='.$i.'">'.$i.'</a> ';
            }
        }
        ?>
        <br />
        <?php if(isset($_SESSION['id'])) { ?>
        <form method="POST">
            <textarea id="wysibb" placeholder="Write Here..." name="topic_rep" style="width:80%"><?php if(isset($rep)) { echo $rep; } ?></textarea><br />
            <input type="submit" name="topic_rep_submit" value="Poster ma réponse"></form>
        </form>
        <?php if(isset($rep_msg)) { echo $rep_msg; } ?>
        <?php } else { ?>
        <p>Veuillez vous connecter ou créer un compte pour poster une réponse</p>
        <?php } ?>
        <br>
        <a href="./">Back to Menu</a>
    </body>
</html>