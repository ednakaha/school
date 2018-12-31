<?php
 if(!isset($_SESSION)) {
    session_start();
 }
    
  require_once dirname(__DIR__).'\controllers\controller-administrator.php';
  require_once 'globalFunc.php';

  $cAdmin = new AdminController;
  
  $arrayOfAdmin = $cAdmin->actionView();
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <link  rel="stylesheet" type="text/css" href="views/mainCss.css">
  <base href="http://localhost/school/" >
</head>
<body>


<form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
    <div class ="col-md-4 fileTop">
   <!--Admins-->
            <div class="scrollbar col-md-8 " id="style-15">
                <div class="panel-group col-md-12">
                    <div>
                        <h4 class="baseStyle panel-title col-md-10"> Administrators    </h4>
                        <a  class="col-md-1 plus" href='views/admin-newUpd.php?adminId=-1'>+</a>                    
                    </div>
                    <div >
                   <?php  if (!  ($_SESSION['role']== RolesEnum::reSales)){
                            foreach ($arrayOfAdmin as $item) { 
                                //manager not allowed to see owner
                                if (!  (($_SESSION['role']== RolesEnum::reManager) && ($item->getAdminRole() == RolesEnum::reOwner ))){ ?>
                            
                            <div class ="divMenu col-md-12 marginMenu">
                            <div class ="col-md-5"> 
                              <img  class="imgAdmin" id="imgId" src=<?php echo $item->getAdminImage() ?> alt="image administrator" />
                             </div>
                             <div class ="col-md-7">
                              <a class="adminFont" href='views/admin-newUpd.php?adminId=<?php echo $item->getAdminId() ?>'><?php echo $item->getAdminName() ?>,
                                                                      <?php echo $rolesDescription[$item->getAdminRole()]?><br>
                        
                              <a class="adminFont" href='views/admin-newUpd.php?adminId=<?php echo $item->getAdminId() ?>'><?php echo $item->getAdminPhone() ?></a> <br>
                              <a class="adminFont" href='views/admin-newUpd.php?adminId=<?php echo $item->getAdminId() ?>'><?php echo $item->getAdminEmail() ?></a> 
                                </div>
                             </div>
                            <?php }     // !  ($_SESSION['role']== RolesEnum::reManager) && ($item->getAdminRole() == RolesEnum::reOwner ))
                            }           //foreach
                        }               //!  ($_SESSION['role']== RolesEnum::reSales
                        ?>
            
                    </div>
                </div><!--panel group-->
            </div> <!--scrollbar-->
    </div>
</form>
</body>
</html>
