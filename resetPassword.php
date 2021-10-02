<?php 
	require_once 'php/utils.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf_token" content="<?php echo createToken(); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reset Password - Secure Site</title>
	<link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']) . '/style.css' ?>" />
</head>
<body>
	<?php if(empty($_GET['id']) && empty($_GET['hash'])) { ?>
		<div class="formWrapper">
			<form id="resetPasswordForm">
				<h1>Password Recovery</h1>
				<div id="errs" class="errorcontainer"></div>
				<div class="inputblock">
					<label for="email">Email</label>
					<input id="email" name="email" type="email" autocomplete="email" required placeholder="Enter your email" onkeydown="if(event.key === 'Enter'){event.preventDefault();passwordResetRequest();}"/>
				</div>
				<br>
				<div class="btn" onclick="passwordResetRequest();">Send Password Reset Request</div>
				<br>
				<br>
				<br>
				<a href="./login">Remembered your password? Log In.</a>
			</form>

			<svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 32 1440 320"><defs><linearGradient id="a" x1="50%" x2="50%" y1="-10.959%" y2="100%"><stop stop-color="#ffffff" stop-opacity=".10" offset="0%"/><stop stop-color="#FFFFFF" stop-opacity=".05" offset="100%"/></linearGradient></defs><path fill="url(#a)" fill-opacity="1" d="M 0 320 L 48 288 C 96 256 192 192 288 160 C 384 128 480 128 576 112 C 672 96 768 64 864 48 C 960 32 1056 32 1152 32 C 1248 32 1344 32 1392 32 L 1440 32 L 1440 2000 L 1392 2000 C 1344 2000 1248 2000 1152 2000 C 1056 2000 960 2000 864 2000 C 768 2000 672 2000 576 2000 C 480 2000 384 2000 288 2000 C 192 2000 96 2000 48 2000 L 0 2000 Z"></path></svg>
			<svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 32 1440 320"><defs><linearGradient id="a" x1="50%" x2="50%" y1="-10.959%" y2="100%"><stop stop-color="#ffffff" stop-opacity=".10" offset="0%"/><stop stop-color="#FFFFFF" stop-opacity=".05" offset="100%"/></linearGradient></defs><path fill="url(#a)" fill-opacity="1" d="M 0 320 L 48 288 C 96 256 192 192 288 160 C 384 128 480 128 576 112 C 672 96 768 64 864 48 C 960 32 1056 32 1152 32 C 1248 32 1344 32 1392 32 L 1440 32 L 1440 2000 L 1392 2000 C 1344 2000 1248 2000 1152 2000 C 1056 2000 960 2000 864 2000 C 768 2000 672 2000 576 2000 C 480 2000 384 2000 288 2000 C 192 2000 96 2000 48 2000 L 0 2000 Z"></path></svg>
		</div>
	<?php } else { ?>
		<div class="formWrapper">
			<form id="changePasswordForm">
				<h1>Change Password</h1>
				<div id="errs" class="errorcontainer"></div>
				<div class="inputblock">
					<label for="password">Password</label>
					<input id="password" name="password" type="password" autocomplete="email" required placeholder="Enter your new password" onkeydown="if(event.key === 'Enter'){event.preventDefault();changePassword();}"/>
				</div>
				<div class="inputblock">
					<label for="confirm-password">Confirm Password</label>
					<input id="confirm-password" name="confirm-password" type="password" autocomplete="email" required placeholder="Confirm your password" onkeydown="if(event.key === 'Enter'){event.preventDefault();changePassword();}"/>
				</div>
				<input id="id" name="id" type="hidden" value="<?php echo htmlspecialchars($_GET['id']); ?>" />
				<input id="hash" name="hash" type="hidden" value="<?php echo htmlspecialchars($_GET['hash']); ?>" />
				<br>
				<div class="btn" onclick="changePassword();">Change Password</div>
				<br>
				<br>
				<br>
				<a href="./login">Go back to log in</a>
			</form>

			<div class="wave"></div>
			<div class="wave"></div>
		</div>
	<?php } ?>

	<script src="<?php echo dirname($_SERVER['PHP_SELF']) . '/script.js' ?>"></script>
</body>
</html>
