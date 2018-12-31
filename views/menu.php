<?php
  if(!isset($_SESSION)) {
  session_start();
    }  

    require_once 'globalFunc.php';
    require_once dirname(__DIR__).'\controllers\controller-administrator.php';

    $cAdmin = new AdminController;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">


    <!--  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   -->
      <!-- All the files that are required -->
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
      <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <script src="/node_modules/jquery/dist/jquery.min.js"></script>
      <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
      <link  rel="stylesheet" type="text/css" href="views/mainCss.css">
      <base href="http://localhost/school/" >

</head>

<body>
   <div class="container">
   <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="z-index: 9999999">


       <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
              <li id="nav-login-btn" class="navbar-left "> <img src="THE URL TO YOUR IMAGE" alt="" /></li>       
              <li id="nav-login-btn" class="navbar-left "><a href="views/student-course-base.php">school  </a></li>
              <li id="nav-login-btn" class="navbar-left "><a href="#" >   |  </a></li>
            
              <?php
               if (($_SESSION['role'] == RolesEnum::reOwner) || 	($_SESSION['role'] ==RolesEnum::reManager)){ ?>
                
                 <li id="nav-login-btn" class="navbar-left "><a href="views/admin-base.php" >Administration </a></li>
               
              <li id="nav-login-btn" class="navbar-left"><a href="#">   |  </a></li>
              <?php  } ?>

 
             
              <!--<li  class="navbar-right "><a href="views/register.php">Register</a></li>
              <li  class="navbar-right "><a href="#" >   |  </a></li>-->
             <div class="col-md-4 col-md-offset-4 navbar-right menuMargin">
             <div class="col-md-4 ">
                 <li  class="navbar-right "><a href="#" > <?php echo  $cAdmin->actionViewOne($_SESSION['id'])->getAdminName()?> -  <?php echo $rolesDescription[$_SESSION['role']]?></a></li>
                 <br>
                 <li ><a  class="navbar-right" href="views/logout.php" >Logout</a></li>
               </div>
             <div class= "col-md-2 ">  
              <li  > <img  class="imgLogo" id="imgId" src=<?php echo  $cAdmin->actionViewOne($_SESSION['id'])->getAdminImage() ?> alt="image admin" /></li> 
               </div>
           
            
              <div>

              </ul>
      </div>
    </nav>

    </div>
</body>
</html>