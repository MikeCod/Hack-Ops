<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Forum</title>
      <link rel="icon" type="image/jpg" href="">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
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
      <form class="fntopic" method="POST">
         <table border=2 class="forum ntopic">
            <tr class="header">
               <th class="main">Nouveau Topic</th>
               <th></th>
            </tr>
            <tr>
               <td>Sujet</td>
               <td><input type="text" name="tpTitle" size="70" maxlength="70" /></td>
            </tr>
            <tr>
               <td>Catégorie</td>
               <td>
               <?= $categorie ?>
               </td>
            </tr>
            <tr>
               <td>Sous-Catégorie</td>
               <td>
                  <select name="subcats">
                     <?php while($sc = $subcategories->fetch()) { ?>
                     <option value="<?= $sc['id'] ?>"><?= $sc['name'] ?></option>
                     <?php } ?>
                  </select>
               </td>
            </tr>
            <tr>
               <td>Message</td>
               <td><textarea id="wysibb" name="tpContent"></textarea></td>
            </tr>
            <tr>
               <td>Me notifier des réponses par mail</td>
               <td><input type="checkbox" name="tmail" /></td>
            </tr>
            <tr>
               <td colspan="2"><input type="submit" name="tpSubmit" value="Poster le Topic" /></td>
            </tr>
            <?php if(isset($terror)) { ?>
            <tr>
               <td colspan="2"><?= $terror ?></td>
            </tr>
            <?php } ?>
         </table>
      </form>
      <br><a href="./">Back to Menu</a>
      <a href="../">Main Menu</a><br>
   </body>
</html>