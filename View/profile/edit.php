<!--===========================================================================================
// Gestion de : affichage de edit profile
// Auteurs : Charles Régniez, Dimtri Simon
// Version du : 21/01/2019
=============================================================================================-->

<!-- TODO ask to authentify before edit -->
<h1>Edit Profile</h1>

<input type="text" id="edit-username" value="<?php echo $_SESSION['username'] ?>">
<input type="text" id="edit-email" value="<?php echo $_SESSION['email'] ?>">
<input type="password" id="edit-password" placeholder="Actual Password">
<p>Only if you want to change your password :</p>
<input type="password" id="edit-password-new" placeholder="New password">
<input type="password" id="edit-password-new-confirm" placeholder="Confirm New password">
<div style="padding-left:calc(50% - 100px);">
<?php button ("Edit", "submit_edit();", false, 200, "deepskyblue"); ?>
</div>

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
				else set_error(this.responseText); // print error message
			}
		};
		req.open("POST", "../Controller/profile/C_edit.php", true);	
		req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // add an header 
		req.send(
			"edit-username="+document.getElementById("edit-username").value+
			"&edit-email="+document.getElementById("edit-email").value+
			"&edit-password="+document.getElementById("edit-password").value+
			"&edit-password-new="+document.getElementById("edit-password-new").value+
			"&edit-password-new-confirm="+document.getElementById("edit-password-new-confirm").value 
		);
	}
</script>