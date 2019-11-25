

<div class="starter-template ">
	
			<h2>Sign Up</h2>

			<form name="myForm" action="<?php echo $currurl; ?>index.php/login/regs" onsubmit="return validateForm()" method="post">
				<label class="form-label"> Name: </label>
				<input class="form-field width60" name="name" type="text" value="" />
				<br />
				<label class="form-label required"> Username </label>
				<input class="form-field width60" name="username" type="text" value="" />
				<br />
				<label class="form-label"> Password: </label>
				<input class="form-field width60" name="password" type="password" value="" />
			
				<?
					 if (empty($this->session->userdata('usernameexit'))) {
						
						
					}else{
						echo "username exist";
					}
				?>


				<br />
				<input type="submit" class="button white" value="SignUp" />
			</form>

	
</div>

<script>
	function validateForm() {
  var x = document.forms["myForm"]["name"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["username"].value;
  if (x == "") {
    alert("Username must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["password"].value;
  if (x == "") {
    alert("Password must be filled out");
    return false;
  }
}
	</script>