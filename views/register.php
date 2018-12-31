<?php
require_once dirname(__DIR__).'\controllers\controller-administrator.php';
require_once dirname(__DIR__).'\controllers\controller-role.php';

require_once 'globalFunc.php';


  $cAdmin = new AdminController;
  $cRole = new RoleController;

  $arrayOfRoles = $cRole->actionView();


  $errorsTable = [];
  $hasErrors = false;


  if (!empty($_POST['reg_username']) && !empty($_POST['reg_password']) && !empty($_POST['reg_password_confirm'])) {
    $aPass1 =$_POST['reg_password'];
	$aPass2 =$_POST['reg_password_confirm'];
	if (!($aPass1==$aPass2)) //!confirm password  = password
	{
		array_push($errorsTable, "Confirm password and password are not equal");
        $hasErrors = true;
	}

	 if (!$hasErrors)
	 {
		if (! empty($_FILES['pic_path']['name'])){
			$dest = gfUploadFile($errorsTable);
			$dest = str_replace('../','',$dest);
		}
		  else $dest=null;
		$admin = new AdminModel([
				'admin_name' =>  $_POST['reg_username'],
				'admin_role' =>  $_POST['selectRole'],
				'admin_phone'=>  $_POST['reg_phone'],
				'admin_email'=>  $_POST['reg_email'],
				'admin_image'=>  trim($dest), 
				'admin_password'=>  md5(trim($aPass1))
			]);
		
			$cAdmin->actionInsert($admin,$errorsTable);
			$hasErrors = empty($errorsTable)? false:true;
			if (!$hasErrors)
			header("location: login.php");
    

	}
}  
else{
	if (!empty($_POST)){//on loading
      	array_push($errorsTable, "User name or passwords are missing");
		$hasErrors = true;
	}
}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- All the files that are required -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>

<link  rel="stylesheet" type="text/css" href="views/mainCss.css">
<base href="http://localhost/school/">




</head>

<body>

<div class='container'>


<div class=" col-md-5 col-md-offset-3 fileTop logo">
	<div class=" h1">register</div>

	    <?php if ($hasErrors) { ?>
    <div class="alert alert-danger" role="alert">
    <ul>
        <?php foreach ($errorsTable as $error) { ?>
        <li> <?php echo $error; ?></li>
        <?php } ?>
    </ul>
    </div>
    <?php } ?>

	<!-- Main Form -->
	<div class="login-form-1">
	<form  id="register-form" class="text-left" enctype = "multipart/form-data" accept-charset="UTF-8" action='<?php echo 'views/'.basename($_SERVER['PHP_SELF']); ?>' name='addAdmin' method='POST' >
    <form enctype = "multipart/form-data" accept-charset="UTF-8" action='<?php echo 'views/'.basename($_SERVER['PHP_SELF']); ?>'
	<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="reg_username" >User name</label>
						<input type="text" class="form-control emptyErrArr" id="reg_username" name="reg_username" placeholder="username" maxlength="50" require>
					</div>
					<div class="form-group">
						<label for="reg_password" >Password</label>
						<input type="password" class="form-control emptyErrArr" id="reg_password" name="reg_password" placeholder="password" maxlength="250" require>
					</div>
					<div class="form-group">
						<label for="reg_password_confirm" >Password Confirm</label>
						<input type="password" class="form-control emptyErrArr" id="reg_password_confirm" name="reg_password_confirm" placeholder="confirm password" require maxlength="250">
					</div>
					
					<div class="form-group">
						<label for="reg_email" >Email</label>
						<input type="text" class="form-control emptyErrArr" id="reg_email" name="reg_email" placeholder="email" maxlength="254" require>
                    </div>
                    
                    <div class="form-group">
						<label for="reg_phone" >Phone</label>
						<input type="text" class="form-control emptyErrArr" id="reg_phone" name="reg_phone" placeholder="phone" maxlength="15" require>
					</div>
					

                    <div class="form-group">
                        <label id="reg_select"  for="lat">Role</label> 
                        <select id="reg_select" class="form-control" name='selectRole'>
                        <?php foreach($arrayOfRoles as $role) { ?>
                        <option value='<?php echo $role->getRoleId() ?>'><?php echo $role->getRoleName() ?></option>
                        <?php } ?>      
                        </select> 
                    </div>
                    
					<div class="form-group">
				     <label for="lat">Image</label>              
                     <input type="file" id="imgInp" name="pic_path">
                     <img  class = "imgAdmin" id="imgIdS" src="#" alt="image admin" />
                    </div>
				</div>
				<button name="save" type="submit" class="login-button">save</button>
			</div>
			<div class="etc-login-form">
				<p>already have an account? <a href="index.php">login here</a></p>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>
<script>

//image           
		function readPicture(input) {
		if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#imgIdS').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
		}
		}

		$("#imgInp").change(function(){
		readPicture(this);
		});

//empty errors table
	$('.emptyErrArr').on('input',function(){
           $hasErrors = false;
		   $('.alert').hide()
		});
</script>
</div>
</body>
</html>