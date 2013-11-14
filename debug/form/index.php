<!DOCTYPE html>
<html lang="es">
<head>
	<title>Test Form</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/style.css" media="screen" />
	<script type="text/javascript" src="/js/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="js/form-configuration.js"></script>
</head>
<body>
	<form action="contact_form.php" class="contact-form" method="POST" novalidate> 
		<div class="fieldset-group">
			<fieldset>
				<legend>Contact Details</legend>
				<input id="name" name="name" type="text" placeholder="Name" />
				<input id="email" name="email" type="email" placeholder="Email" />
			</fieldset><!-- End of Personal Details -->
 
			<fieldset>
				<legend>Project Details</legend>
				<input id="title" name="title" type="text" placeholder="Title (Optional)" />
				<input id="subject" name="subject" type="text" placeholder="Subject (Optional)" />
				<textarea id="comments" name="comments" cols="30" rows="10" placeholder="Comments/Brief (Optional)"></textarea>
			</fieldset><!-- End of Project Details -->
			<input name="submit" type="submit" value="Submit" />
		</div><!-- End of Fieldsets -->
	</form><!-- End of  Form -->
	<div id="form-result"></div>
</body>
</html>