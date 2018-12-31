<?php
 if(!isset($_SESSION)) {
  session_start();
 } 
   require_once dirname(__DIR__).'\controllers\controller-administrator.php';
   require_once dirname(__DIR__).'\controllers\controller-role.php';
   require_once 'globalFunc.php';
  
  $cAdmin = new AdminController;
  $cRole = new RoleController;

  $pageMode ='';     
  
  $errorsTable = [];
  $hasErrors = false;

  $adminId =(!empty($_GET['adminId'])) ? $_GET['adminId'] : (isset($_POST['save']) ? $_POST['save'] : $_POST['delete']);
  if ($adminId>0) //update
  {
    $selectedAdmin = $cAdmin->actionViewOne($adminId);
    $pageMode =PageStatusMode::psUpdate; 
  }
  else {//new
    $pageMode =PageStatusMode::psNew;
  }

  if (!empty($_POST['delete'])) {
      $cAdmin->actionDelete($_POST['delete']);
      header("location: admin-base.php");
  }
  else {//new-upd 
    if (! empty($_FILES['pic_path']['name'])){
      $dest = gfUploadFile($errorsTable);
      $dest = str_replace('../','',$dest);
    }
    else $dest=null;
    if ((!empty($_POST['save']))&&(!empty(trim($_POST['admin_name'])))&&(!empty($_POST['admin_phone']))&&(!empty($_POST['admin_email'])))  {

         $admin = new AdminModel([
             'admin_name'     => trim($_POST['admin_name']),
             'admin_phone'    => trim($_POST['admin_phone']),
             'admin_email'    => trim($_POST['admin_email']),
             'admin_role'     =>  $_POST['selector'],
             'admin_password' => (empty($_POST['admin_password'])? "": md5( trim($_POST['admin_password']))),
             'admin_image'    => trim($dest)
         ]);
         
        if ($pageMode ==PageStatusMode::psNew){
           //save a new admin
           $cAdmin->actionInsert($admin,$errorsTable);
           $hasErrors = empty($errorsTable)? false:true;
           }//new
         else{  //update
           //update the adminId for update
          $admin->setAdminId($_POST['save']);
          //update data
          $cAdmin->actionUpdate($admin,$errorsTable);
          $hasErrors = empty($errorsTable)? false:true;
         }//update
         if (!$hasErrors)
         header("location: admin-base.php");
      }//post[save]
     else {
         if (!empty($_POST)){//on loading
       		array_push($errorsTable, "One or more fields are empty");
          $hasErrors = true;
         }
    }
  }//new-upd

  $arrayOfRoles = $cRole->actionView();
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link  rel="stylesheet" type="text/css" href="mainCss.css">
  <base href="http://localhost/school/">
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

  
  
</head>
<body>
<?php include 'menu.php'; ?>

    <?php  if (!($_SESSION['role'] == RolesEnum::reSales)) { 
        include 'menu-admin.php'; ?>

    <div class ="col-md-6 fileTop" id ="sch_main_container">
     <div class="container">

    
    <?php if ($hasErrors) { ?>
    <div class="alert alert-danger" role="alert">
    <ul>
        <?php foreach ($errorsTable as $error) { ?>
        <li> <?php echo $error; ?></li>
        <?php } ?>
    </ul>
    </div>
    <?php } ?>


    <form enctype = "multipart/form-data" accept-charset="UTF-8" action='<?php echo 'views/'.basename($_SERVER['PHP_SELF']); ?>'
          name='addAdmin' method='POST'>

      <div class="form-group "><br>
      <!--header-->
      <div class = "col-md-8">
      <div class = "col-md-6">  
         <button value =<?php echo $adminId  ?> id="save" name='save' type="submit" class="btn btn-info glyphicon glyphicon-send">  Save</button> 
        </div>
        <div class = "col-md-2 col-md-offset-1 ">  
      <?php if ($pageMode ==PageStatusMode::psUpdate) { ?>
        <!--delete-->
               <!--Manager not allowed to delete himself-->
               <?php  if (!(($_SESSION['role'] == RolesEnum::reManager) &&
                       ($_SESSION['id'] ==  $selectedAdmin->getAdminId()))) {?>
                  <button id='delete' onclick="gfConfirmDelete(event)" value='<?php echo $selectedAdmin->getAdminId() ?>' name='delete' class="btn btn-info glyphicon glyphicon-trash">  Delete</button>
                <?php } ?>
              <?php }?><!--update-->
        </div>
        <br><hr class = "col-md-9">
      </div>
        <!--details-->
      <div class = "col-md-6">
      <?php if ($pageMode ==PageStatusMode::psNew) { ?>
    
                <label for="lat">Name</label>
                <input type="text" class="emptyErrArr form-control" name='admin_name' require id="admin_name" maxlength="50">

                <label for="lat">Phone</label>
                <input  type="number" class="emptyErrArr form-control" name='admin_phone' require id="admin_phone"  
                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="15">
               
                <label for="lat">Email</label>
                <input  type="email" class="emptyErrArr form-control" name='admin_email' require id="admin_email" maxlength="254">
                
                <label for="password" >Password</label>
				    		<input type="password" class="emptyErrArr form-control" id="admin_password" name="admin_password" maxlength="250">
				
                <label for="lat">Image</label>              
                <input type="file" id="imgInp" name="pic_path">
                <img  class = "imgAdmin" id="imgIdS" src="#" alt="image admin" />

                <!--roles-->
                <div>
                    <select name="selector"  title="Select the role" class="mdb-select md-form">
                    <?php foreach($arrayOfRoles as $role) { ?>
                     <option value='<?php echo $role->getRoleId() ?>'><?php echo $role->getRoleName() ?></option>
                    <?php } ?>           
                    </select>
                </div> <!-- end roles-->
        <?php } else //if ($pageMode ==PageStatusMode::psUpdate)
          { ?>
                <label for="lat">Name</label>
                <input type="text" class="emptyErrArr form-control" name='admin_name' id="admin_name" require value=' <?php echo $selectedAdmin->getAdminName(); ?>' maxlength="50">

                <label for="lat">Phone</label>
                <input  type="number" class="emptyErrArr form-control" name='admin_phone' id="admin_phone" require 
                        value= '<?php echo $selectedAdmin->getAdminPhone(); ?>' maxlength="15"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
               
                <label for="lat">Email</label>
                <input  type="email" class="emptyErrArr form-control" name='admin_email' id="admin_email" require value=' <?php echo $selectedAdmin->getAdminEmail(); ?>'maxlength="254">

                <label for="password" >Password</label>
				    		<input type="password" class="emptyErrArr form-control" id="admin_password" name="admin_password" maxlength="250">

                <label for="lat">Image</label>              
                <input type="file" id="imgInp" name="pic_path">
                <img  class = "imgAdmin" id="imgIdS" src='<?php echo $selectedAdmin->getAdminImage(); ?>' alt="image admin" />
            <!--roles selector-->
            <!--Manager not allowed to change his role-->
                <div>
                <label for="lat">Role</label>   <br>           
                <?php  if (($_SESSION['role'] == RolesEnum::reManager) &&
                           ($_SESSION['id'] ==  $selectedAdmin->getAdminId())){ ?>
                     <select name="selector" disabled   title="Select the role" class="mdb-select md-form" searchable="Search here..">
                     <?php  }
                else {?>
                    <select name="selector"  title="Select the role" class="mdb-select md-form" searchable="Search here..">
                    <?php } ?>
                      <?php foreach($arrayOfRoles as $role) { 
                          if ($role->getRoleId() == $selectedAdmin->getAdminRole()) { ?>
                         <option selected value='<?php echo $role->getRoleId() ?>'><?php echo $role->getRoleName() ?></option>
                      <?php } else {?>                  
                         <option value='<?php echo $role->getRoleId() ?>'><?php echo $role->getRoleName() ?></option>
                      <?php } }?>           
                    </select>
                  </div> <!--select-->
            </div>

            <?php }?> <!-- ($pageMode ==PageStatusMode::psUpdate)-->
            
          
          </div> 
         </div>
        </form>
      </div>

      <script>

        
       //load image
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
        //end load image

        //empty errors table
        $('.emptyErrArr').on('input',function(){
              $hasErrors = false;
          $('.alert').hide()
        });
        //enabled select-option before submit if it's disabled (manager + his details) for post

        jQuery(function ($) {        
          $('form').bind('submit', function () {
            $(this).find(':disabled').removeAttr('disabled');
          });
        });

     </script>
    </div>   
<?php }  // if (!($_SESSION['role'] == RolesEnum::reSales)) { ?>
</body>
</html>
         