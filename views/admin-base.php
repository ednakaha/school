<?php
 if(!isset($_SESSION)) {
    session_start();
 }
    
  require_once dirname(__DIR__).'\controllers\controller-administrator.php';

   

  $cAdmin = new AdminController;

  $arrayOfAdmins = $cAdmin->actionView();
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <link  rel="stylesheet" type="text/css" href="views/mainCss.css">
  <base href="http://localhost/school/" >
</head>
<body>


<?php include 'menu.php'; ?>
<?php include 'menu-admin.php'; ?>
<div class="container">
    <form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
      <div class ="gradient-style-3   col-md-10  fileTopBase" id ="sch_main_container">

              <p class="col-md-10 col-md-offset-3 baseStyle"> מספר מנהלים במערכת 
              <?php echo count($arrayOfAdmins); ?>     
              
        </div>     
      </form>
     </div>  
</body>
</html>
