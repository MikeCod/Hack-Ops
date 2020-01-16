<?php

function available_email($link, $email)
{
	if(!($result = $link->query("SELECT id FROM users WHERE email = ".$link->quote($email))))
		throw new Exception("Request failed");
	return ($result->rowCount() == 0);
}

function available_username($link, $username)
{
	if(!($result = $link->query("SELECT id FROM users WHERE username = ".$link->quote($username))))
		throw new Exception("Request failed");
	return ($result->rowCount() == 0);
}

function add_user($link, $username, $email, $password)
{
	if(!$link->query("INSERT INTO users(username, email, password) VALUES(".$link->quote($username).", ".$link->quote($email).", '".hash('sha3-512', $password)."')"))
		throw new Exception("Cannot add user");
}

?>