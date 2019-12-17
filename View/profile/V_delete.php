<!--===========================================================================================
// Gestion de : affichage de delete profile
// Auteurs : Charles Régniez, Dimitri Simon
// Version du : 17/12/2019
=============================================================================================-->

<!-- Did not understand why they're is no the information in the query 

<h1>Delete Profile</h1>
<p>Are you sure you want to delete your profile ?</p>
<form methode="get" action="../Controller/profile/Controllerdelete.php">
<input type="text" id="delete-email" value="<?php echo $_SESSION['email'] ?>">
<input type="password" id="delete-password" placeholder="Actual Password">
<input type="submit" value="delete">
</form>

-->

<!-- trying to copy dimitri's method -->

<!-- TODO ask to authentify before edit -->
<!-- 
<h1>Delete Profile</h1>
<input type="text" id="delete-email" value="<?php echo $_SESSION['email'] ?>">
<input type="password" id="delete-password" placeholder="Actual Password">
<input type="submit" value="edit" onclick="submit_edit();">
<script type="text/javascript">
	function submit_edit()
	{
		var req = new XMLHttpRequest();
		req.onreadystatechange = function() {
			if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
				if(this.responseText == "*") {
					Swal.fire(
						"Profile Deleted",
						"Your profile is been deleted",
						"success"
					).then((result) => {
	  					if (result.value)
							document.location.href = "dashboard.php";
					});
				}
				else set_error(this.responseText);
			}
		};
		req.open("GET", "../Controller/profile/Controllerdelete.php", true);
		req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		req.send(
			"&email="+document.getElementById("delete-email").value+
			"&password="+document.getElementById("delete-password").value
		);
	}
</script>
-->

