<?php

$type = "";
$difficulty = "";
get_challenge($type, $difficulty);

try
{
	set_include_path(my_get_include_path()."\\include\\phpseclib\\");
	require "Net/SSH2.php";
	require "Net/SCP.php";
	$ssh = new Net_SSH2(CHALLENGE_HOST);
	$ssh_root = new Net_SSH2(CHALLENGE_HOST);
	if(!$ssh->login("user", "user") or !$ssh_root->login("root", "toor"))
		throw new Exception("REAL Internal error. Login failed");

	$scp_flag = new Net_SCP($ssh_root);
	file_put_contents("C:/flag", '<script src="../../../include/js/sweetalert2.all.js"></script><script type="text/javascript">Swal.fire("Congrats !", "You can now validate this challenge with the flag '.get_flag($type, $difficulty).'", "success");</script>');
	if(!$scp_flag->put("/home/user/flag", "C:/flag", NET_SCP_LOCAL_FILE))
		throw new Exception("REAL Internal error. Cannot send the temp file flag.");
	
	$result = "<p style=\"font-size:12pt;\">".$ssh->exec("ping -W 250 -c 4 ".$_POST['host'])."</p>";

	//$ssh_root->exec("flag");
	$ssh_root->exec("exit");
	$ssh->exec("exit");
}
catch(Exception $e)
{
	$result = "<p class=\"error\">".$e->getMessage()."</p>";
}

?>