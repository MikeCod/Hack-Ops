<?php

function get_rank($link, $score)
{
	if(!($response = $link->query("SELECT count(id) FROM users WHERE score <= ".$score)))
		throw new Exception("Request failed");
	return $response->fetch()[0];
}

?>