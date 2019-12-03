<?php

function is_challenge_completed($user, $challenge)
{
	if(!($response = $link->query("SELECT id FROM `completed-challenges` WHERE user = ".$user." AND challenge = ".$challenge)))
		throw new Exception("Request failed");
	return ($response->rowCount() > 0);
}

function update_score($user, $score, $add)
{
	if(!$link->query("UPDATE users SET score = '".($score + $add)."' WHERE id = ".$user))
		throw new Exception("Cannot update the score");
	return $score + $add;
}

function update_badges($user, $score)
{
	$achievements = 0;
	if(!($response = $link->query("SELECT id FROM badges WHERE type = 'Score' AND goal <= ".$score)))
		throw new Exception("Request failed");

	if($response->rowCount() > 0)
	{
		while($badge = $response->fetch())
		{
			if(!$link->query("INSERT INTO `completed-badges`(user, badge) VALUES('".$user."', '".$badge['id']."')"))
				throw new Exception("Cannot update badges");
		}
		$achievements += $response->rowCount();
	}
	return $achievements;
}

function add_challenge_completed($user, $challenge)
{
	if(is_challenge_completed($user, $challenge))
		throw new Exception("Challenge already completed");

	if(!$link->query("INSERT INTO `completed-challenges`(user, challenge) VALUES('".$user."', '".$challenge."')"))
		throw new Exception("Cannot add challenge to completed challenges");
}
?>