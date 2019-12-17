<!--===========================================================================================
// Objectif : Display Forum : New Topic
// Authors : GUYOT Jordan
// Version : 16/12/2019
=============================================================================================-->
<?php 
require "../../Controller/FORUM/forum.php";
session_start();

if(isset($_POST['tpSubmit'])) {
    newTopic();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo NAME ?></title>
    </head>
    <body>
        <form method="POST">
            <table>
                <tr>
                    <th colspan="2">New Topic</th>
                </tr>
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="tpTitle" size="70" maxlength="70" /></td>
                </tr>
                <tr>
                    <td>Categorie</td>
                    <td>
                        <select>
                            <option>Categorie 1</option>
                            <option>Categorie 2</option>
                            <option>Categorie 3</option>
                            <option>Categorie 4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>SubCategorie</td>
                    <td>
                        <select>
                            <option>SubCategorie 1</option>
                            <option>SubCategorie 2</option>
                            <option>SubCategorie 3</option>
                            <option>SubCategorie 4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Message</td>
                    <td><textarea name="tpContent"></textarea></td>
                </tr>
                <tr>
                    <td>Notify me of replies by email</td>
                    <td><input type="checkbox" name="tpMail" /></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="tpSubmit" value="Send" /></td>
                </tr>
                <?php if(isset($terror)) { ?>
                <tr>
                    <td colspan="2"><?= $terror ?></td>
                </tr>
                <?php } echo "ID Session". $_SESSION['id']; ?>
            </table>
        </form>
    </body>
</html>