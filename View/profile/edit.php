<!--===========================================================================================
// Gestion de : affichage de edit profile
// Auteurs : Charles Régniez, Dimtri Simon
// Version du : 27/11/2019
=============================================================================================-->

<!-- TODO ask to authentify before edit -->
<h1>Edit Profile</h1>
<input type="text" id="edit-username" value="<?php echo $_SESSION['username'] ?>">
<input type="text" id="edit-email" value="<?php echo $_SESSION['email'] ?>">
<input type="password" id="edit-password" placeholder="Actual Password">
<br>
<p>Only if you want to change your password :</p>
<input type="password" id="edit-password-new" placeholder="New password">
<input type="password" id="edit-password-new-confirm" placeholder="Confirm New password">
<input type="submit" value="edit" onclick="submit_edit();">
<script type="text/javascript">
	function submit_edit()
	{
		var req = new XMLHttpRequest();
		req.onreadystatechange = function() {
			if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
				if(this.responseText == "*") {
					Swal.fire(
						"Profile Updated",
						"Modification in profile has been implemented",
						"success"
					).then((result) => {
	  					if (result.value)
							document.location.href = "dashboard.php";
					});
				}
				else set_error(this.responseText);
			}
		};
		req.open("POST", "profile/C_edit.php", true);
		req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		req.send(
			"username="+document.getElementById("edit-username").value+
			"&email="+document.getElementById("edit-email").value+
			"&password="+document.getElementById("edit-password").value+
			"&password-new="+document.getElementById("edit-password-new").value+
			"&password-new-confirm="+document.getElementById("edit-password-new-confirm").value 
		);
	}
</script>
