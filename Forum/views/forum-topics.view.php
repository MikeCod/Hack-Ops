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
         <h4><a href=""><?= $t['title'] ?></a></h4>
      </td>
      <td class="sub-info">4083495</td>
      <td class="sub-info">25.12.2015 à 18h07<br />de DM</td>
      <td class="sub-info"><?= $t['date_create'] ?><br />par <?= $t['username'] ?></td>
   </tr>
   <?php } ?>
</table>