<!--===========================================================================================
// Objectif : Function Forum
// Authors : GUYOT Jordan
// Version : 16/12/2019
=============================================================================================-->

<?php 
require "../../Model/forumDB.php";

function display() {
    $cat = req_display_cat();
    $subcat = req_display_subcat();
    echo '
    <table border="1" class="forum">
        <tr class="header">
            <th class="main">Catégories</th>
            <th class="sub-info">Messages</th>
            <th class="sub-info">Dernier message</th>
        </tr>';
    while($c = $cat->fetch()) {
        $subcat->execute(array($c['id']));
        $subcats = '';
        while($sc = $subcat->fetch()) { 
            $subcats .= '<a href="">'.$sc['nom'].'</a> | ';
        }
        $subcats = substr($subcats, 0, -3);
        echo '
        <tr>
            <td class="main">
                <h4><a href="">'.$c['nom'].'</a></h4>
                <p>
                '.$subcats.'
                </p>
            </td>
            <td class="sub-info">4083495</td>
            <td class="sub-info">04.12.2015 à 14h52<br />de PrimFX</td>
        </tr>';
    } 
    echo '</table>';   
}

?>