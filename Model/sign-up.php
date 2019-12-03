<?php

function add_user($username, $email, $password)
{
	if(!$link->query("INSERT INTO users(username, email, password) VALUES(".$link->quote($_POST['username']).", ".$link->quote($_POST['email']).", '".hash('sha3-512', $_POST['password'])."')"))
		throw new Exception("Cannot add user");
}

?>