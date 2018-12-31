<?php
  if(!isset($_SESSION)) {
	session_start();
  }//session

  require_once 'controllers\controller-administrator.php';
  require_once 'views\globalFunc.php';

  $cAdmin = new AdminController;
  $errors = [];
  $hasErrors = false;

  if (!empty($_POST['lg_username']) && !empty($_POST['lg_password'])) {
    $aPass =md5(trim($_POST['lg_password']));
    $aUserName=$_POST['lg_username']; 
  
	$AdminData= $cAdmin->actionLogin($aUserName,$aPass);
	if ($AdminData->getAdminId()!=null){
		$_SESSION['role'] = $AdminData->getAdminRole();
		$_SESSION['id']   = $AdminData->getAdminId();
		header("location: views\student-course-base.php");
	}
	else
	{ 
		array_push($errors, 'Wrong username or password');
		$hasErrors=true;
		$_SESSION['role'] = RolesEnum::reNone;
		$_SESSION['id']   =-1;
	}
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 	crossorigin="anonymous">

	
	<!-- All the files that are required -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	
	<link  rel="stylesheet" type="text/css" href="views/mainCss.css">

  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
	<base href="http://localhost/school/">
</head>

<body>

<div class='container'>
<div class="text-center">

	<div class="logo">login</div>
	<div class="login-form-1">

	<?php if ($hasErrors) { ?>
    <div class="alert alert-danger" role="alert">
    <ul>
        <?php foreach ($errors as $error) { ?>
        <li> <?php echo $error; ?></li>
        <?php } ?>
    </ul>
    </div>
    <?php } ?>


    <form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
	

			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="lg_username" class="sr-only" >Username</label>
						<input type="text" class="form-control emptyErrArr" id="lg_username" name="lg_username" placeholder="username">
					</div>
					<div class="form-group">
						<label for="lg_password" class="sr-only" >Password</label>
						<input type="password" class="form-control emptyErrArr" id="lg_password" name="lg_password" placeholder="password">
					</div>
				
				</div>
				<button name="login" type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p >new user? <a href="views/register.php">create new account</a></p>
			</div>
			</div>
		</form>
		
	</div>
</div>

<script>
		//empty errors table
		$('.emptyErrArr').on('input',function(){
           $hasErrors = false;
		   $('.alert').hide()
		});
</script>
</div>
</body>
</html>



<!--<?php
//session_start();
//$_SESSION['role'] = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">
    <base href="http://localhost/school/" >
    <title>School</title>
</head>

<body>
  <div class='container'>
     <div class="col-md-4 col-md-offset-4">
    <form>
      <h1>School's Manu</h1>           
    <header>
        <div class="panel panel-default" style="padding-left: 20px;padding-bottom: 20px; width: 240px">
        <a href='views/register.php'  class="h1 btn btn-info" style="width: 200px;" > register </a>
        <a href='views/login.php'  class="h1 btn btn-info" style="width: 200px;">login </a>
        <a href='views/menu.php'    class="h1 btn btn-info" style="width: 200px;"> Menu </a>
        <a href='views/student-course-base.php'   class="h1 btn btn-info" style="width: 200px;"> School </a>
        <a href='views/admin-base.php'   class="h1 btn btn-info" style="width: 200px;"> admin </a>
        </div>

      
    
    </div>
    </header>
    </form>
   </div>
  </div>   

</body>

</html>-->