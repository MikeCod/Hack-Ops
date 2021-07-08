<?php

$type = "";
$difficulty = "";
get_challenge($type, $difficulty);

try
{
	set_include_path(my_get_include_path()."\\include\\phpseclib\\");
	require "Net/SSH2.php";
	$ssh = new Net_SSH2(CHALLENGE_HOST);
	if(!$ssh->login("ch-ci-1", "user"))
		throw new Exception("REAL Internal error. Login failed");

	$result = "<p style=\"font-size:12pt;\">".$ssh->exec("ping -W 250 -c 4 ".$_POST['host'])."</p>";

	//$ssh_root->exec("flag");
	$ssh->exec("exit");
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}

?>