<?php

function is_challenge_completed($link, $user, $challenge)
{
	if(!($response = $link->query("SELECT id FROM `completed-challenges` WHERE user = ".$user." AND challenge = ".$challenge)))
		throw new Exception("Request failed");
	return ($response->rowCount() > 0);
}

function add_challenge_completed($link, $user, $challenge)
{
	if(is_challenge_completed($link, $user, $challenge))
		throw new Exception("Challenge already completed");
	if(!$link->query("INSERT INTO `completed-challenges`(user, challenge) VALUES(".$user.", ".$challenge.")"))
		throw new Exception("Cannot add challenge to completed challenges");
}

function update_score($link, $user, $score, $add)
{
	if(!$link->query("UPDATE users SET score = '".($score + $add)."' WHERE id = ".$user))
		throw new Exception("Cannot update the score");
	return $score + $add;
}

function is_badge_not_completed($link, $user, $badge)
{
	if(!($response = $link->query("SELECT id FROM `completed-badges` WHERE badge = ".$badge." AND user = ".$user)))
		throw new Exception("Request failed");
	return ($response->rowCount() == 0);
}

function get_completed_challenges($link, $user)
{
	if(!($response = $link->query("SELECT id FROM `completed-challenges` WHERE user = ".$user)))
		throw new Exception("Request failed");
	return $response->rowCount();
}

function update_badges($link, $user, $score)
{
	$badges = 0;
	if(!($response = $link->query("SELECT id FROM badges WHERE type = 'Score' AND goal <= ".$score)))
		throw new Exception("Request failed");

	if($response->rowCount() > 0)
	{
		while($badge = $response->fetch())
		{
			if(is_badge_not_completed($link, $user, $badge['id'])) {
				if(!$link->query("INSERT INTO `completed-badges`(user, badge) VALUES('".$user."', '".$badge['id']."')"))
					throw new Exception("Cannot update badges");
				++$badges;
			}
		}
	}

	if(!($response = $link->query("SELECT id FROM badges WHERE type = 'Challenge' AND goal <= ".get_completed_challenges($link, $user))))
		throw new Exception("Request failed");

	if($response->rowCount() > 0)
	{
		while($badge = $response->fetch())
		{
			if(is_badge_not_completed($link, $user, $badge['id'])) {
				if(!$link->query("INSERT INTO `completed-badges`(user, badge) VALUES('".$user."', '".$badge['id']."')"))
					throw new Exception("Cannot update badges");
				++$badges;
			}
		}
	}

	require "Model/profile.php";
	if(!($response = $link->query("SELECT id FROM badges WHERE type = 'Rank' AND goal >= ".get_rank($link, $score))))
		throw new Exception("Request failed");

	if($response->rowCount() > 0)
	{
		while($badge = $response->fetch())
		{
			if(is_badge_not_completed($link, $user, $badge['id'])) {
				if(!$link->query("INSERT INTO `completed-badges`(user, badge) VALUES('".$user."', '".$badge['id']."')"))
					throw new Exception("Cannot update badges");
				++$badges;
			}
		}
	}
	return $badges;
}

?>