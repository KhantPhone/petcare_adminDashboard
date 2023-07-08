<?php
	require_once '../common/config.php'; 	
	session_start();
	$errors = array('user_name' => '','user_password' => '' ,'check_login' => '');

	$user_name = "";
	$user_password = "";
	if (isset($_POST['btn_login'])) {
		//check user name is empty or not
 		if (empty($_POST['user_name'])) {
 			$errors['user_name'] = "user name cannot be empty!";
 		}
 		if (empty($_POST['user_password'])) {
 		//check user password is empty or not
 			
 			$errors['user_password'] = "user password cannot be empty!";
 		}
 		if (array_filter($errors)) {
 		 	
 		}
 		else{
 				
 					$_SESSION['user_name'] = $_POST['user_name'];
 						$count = 0;
            				 $sql = "select * from accounts where member_name='$_POST[user_name]' && 
            				 		member_password='$_POST[user_password]' ";
           						 $res = mysqli_query($conn,$sql);
            		 				$count = mysqli_fetch_All($res,MYSQLI_ASSOC);
            						if ($count == null) {
            							$errors['check_login'] = "Invalid user name and password";
            						}else{

            							
            							$sql = "UPDATE `accounts` SET `modified_at` = CURRENT_TIMESTAMP where member_name='$_POST[user_name]'";
            							 if (!mysqli_query($conn,$sql)) {
            							 		echo "Update failed.".mysqli_error($conn);
            							 }
            							header("location: index.php");
            						}
 		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Pet Care</title>
	<link rel="stylesheet" href="../assets/library/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/library/fontawesome/fontawesome-all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@300&family=Playfair+Display:wght@500&display=swap" rel="stylesheet">	
	<link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/login.css">
	 

</head>
<body>
	<div class="container font-lemon">
		<form action="" method="post">
			<h2>Login</h2>			
			<div class="input-group">											
				<input type="text" name="user_name" autocomplete="on" placeholder="USER NAME"value="<?php echo $user_name ?>">
				<div class="text-danger font-lemon font-12 mt-2 "><?php echo $errors['user_name'] ?></div>
			</div>		

			<div class="input-group">											
				<input type="password" id="password-field" name="user_password" placeholder="USER PASSWORD" value="<?php echo $user_password ?>">
				<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
				<div class="text-danger font-lemon font-12 mt-2 "><?php echo $errors['user_password']; ?></div>
				<div class="text-danger font-lemon font-12 mt-2"><?php echo $errors['check_login']; ?></div>
			</div>

			<div class="input-group mt-4 mb-4">				
				<input type="submit" value="LogIn" name="btn_login" >
			</div>			
			<a href="register.php" class="registerEdit ">Create Account</a>	
			
			<a href="index.php" class="close">&times;</a>
			
				
			
		</form>	
	</div>
	
	
			
	<script src="../assets/library/bootstrap/jquery-3.4.1.slim.min.js"></script>
	<script src="../assets/library/bootstrap/popper.min.js"></script>
	<script src="../assets/library/bootstrap/bootstrap.min.js"></script>
	<script src="../assets/js/script.js"></script>

</body>
</html>
<script>
	$(".toggle-password").click(function () {
		
	$(this).toggleClass("fa-eye fa-eye-slash");
	var input = $($(this).attr("toggle"));
	if (input.attr("type") == "password"){
		input.attr("type","text");
	}else{
		input.attr("type","password");
	}
	});
</script>


