<!--===========================================================================================
// Gestion de : affichage de delete profile
// Auteurs : Charles Régniez, Dimitri Simon
// Version du : 21/01/2019
=============================================================================================-->
<h1>Delete Profile</h1>
<input type="password" id="delete-password" placeholder="Actual Password">
<?php button ("Delete account", "submit_delete();", false, 200, "#e33"); ?>
<script type="text/javascript">
	function submit_delete()
	{
		var req = new XMLHttpRequest();
		req.onreadystatechange = function() {
			if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
				if(this.responseText == "*") {
					Swal.fire(
						"Profile Deleted",
						"Your profile has been deleted",
						"success"
					).then((result) => {
	  					if (result.value)
							document.location.href = "../Controller/sign-out.php";
					});
				}
				else set_error(this.responseText);
			}
		};
		req.open("POST", "../Controller/profile/C_delete.php", true);
		req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		req.send("delete-password="+document.getElementById("delete-password").value);
	}
</script>