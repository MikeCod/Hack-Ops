<?php

    require('../M_badge.php');
    session_start();

    $error = "";
    if(!isset($_POST['name']))
        $_POST['name'] = '';
    if(!isset($_POST['level']))
        $_POST['level'] = '';
    if(!isset($_POST['desc']))
        $_POST['desc'] = '';
    if(!isset($_POST['type']))
        $_POST['type'] = '';
    
    if(isset($_POST['createB']))
    {
        $link = NULL;
        try
        {
            if(!($link = connect_start()))
                throw new Exception("Could not connect to database");
                
            if(!isset($_POST['nom']) or empty($_POST['nom']) or
                !isset($_POST['birthday_date_day']) or empty($_POST['birthday_date_day']) or !is_numeric($_POST['birthday_date_day']) or
                !isset($_POST['birthday_date_month']) or empty($_POST['birthday_date_month']) or !is_numeric($_POST['birthday_date_month']) or
                !isset($_POST['birthday_date_year']) or empty($_POST['birthday_date_year']) or !is_numeric($_POST['birthday_date_year']) or
                !checkdate($_POST['birthday_date_month'], $_POST['birthday_date_day'], $_POST['birthday_date_year']) or
                !isset($_POST['proprio']) or empty($_POST['proprio']) or
                !isset($_POST['veterinaire_date_day']) or empty($_POST['veterinaire_date_day']) or !is_numeric($_POST['veterinaire_date_day']) or
                !isset($_POST['veterinaire_date_month']) or empty($_POST['veterinaire_date_month']) or !is_numeric($_POST['veterinaire_date_month']) or
                !isset($_POST['veterinaire_date_year']) or empty($_POST['veterinaire_date_year']) or !is_numeric($_POST['veterinaire_date_year']) or
                !checkdate($_POST['veterinaire_date_month'], $_POST['veterinaire_date_day'], $_POST['veterinaire_date_year']) or
                !isset($_POST['dentiste_date_day']) or empty($_POST['dentiste_date_day']) or !is_numeric($_POST['dentiste_date_day']) or
                !isset($_POST['dentiste_date_month']) or empty($_POST['dentiste_date_month']) or !is_numeric($_POST['dentiste_date_month']) or
                !isset($_POST['dentiste_date_year']) or empty($_POST['dentiste_date_year']) or !is_numeric($_POST['dentiste_date_year']) or
                !checkdate($_POST['dentiste_date_month'], $_POST['dentiste_date_day'], $_POST['dentiste_date_year'])
                )
                throw new Exception("A field is unavailable");
    
            req_add_badge();
            
            header("Location: show.php");
            exit();
        }
        catch(Exception $e)
        {
            $error = $e->getMessage();
        }
        connect_end($link);
    }


    /*
    if(!isset($_POST['nom']) or empty($_POST['nom']) or
    !isset($_POST['birthday_date_day']) or empty($_POST['birthday_date_day']) or !is_numeric($_POST['birthday_date_day']) or
    !isset($_POST['birthday_date_month']) or empty($_POST['birthday_date_month']) or !is_numeric($_POST['birthday_date_month']) or
    !isset($_POST['birthday_date_year']) or empty($_POST['birthday_date_year']) or !is_numeric($_POST['birthday_date_year']) or
    !checkdate($_POST['birthday_date_month'], $_POST['birthday_date_day'], $_POST['birthday_date_year']) or
    !isset($_POST['proprio']) or empty($_POST['proprio']) or
    !isset($_POST['veterinaire_date_day']) or empty($_POST['veterinaire_date_day']) or !is_numeric($_POST['veterinaire_date_day']) or
    !isset($_POST['veterinaire_date_month']) or empty($_POST['veterinaire_date_month']) or !is_numeric($_POST['veterinaire_date_month']) or
    !isset($_POST['veterinaire_date_year']) or empty($_POST['veterinaire_date_year']) or !is_numeric($_POST['veterinaire_date_year']) or
    !checkdate($_POST['veterinaire_date_month'], $_POST['veterinaire_date_day'], $_POST['veterinaire_date_year']) or
    !isset($_POST['dentiste_date_day']) or empty($_POST['dentiste_date_day']) or !is_numeric($_POST['dentiste_date_day']) or
    !isset($_POST['dentiste_date_month']) or empty($_POST['dentiste_date_month']) or !is_numeric($_POST['dentiste_date_month']) or
    !isset($_POST['dentiste_date_year']) or empty($_POST['dentiste_date_year']) or !is_numeric($_POST['dentiste_date_year']) or
    !checkdate($_POST['dentiste_date_month'], $_POST['dentiste_date_day'], $_POST['dentiste_date_year'])
    )
    throw new Exception("A field is unavailable");*/

?>