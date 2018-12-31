
<?php
    require_once 'controller.php';
    require_once dirname(__DIR__).'\views\globalFunc.php';
    require_once dirname(__DIR__).'\bl\business-logic-administrator.php';
    require_once dirname(__DIR__).'\controllers\controller-role.php';
    
    
    

    class AdminController extends Controller {
        private $bl;
        private $controller;
       
        function __construct() {
            $this->bl = new BusinessLogicAdmin;
            $this->controllerR = new RoleController;
        }

        function actionView() {
            $data = $this->bl->get();
            return $data;
        }

         function actionViewOne($adminId){
            $data = $this->bl->getOne($adminId);
            return $data;
         }
         function actionLogin($aUserName, $aPassword){
            $data = $this->bl->getAdminData($aUserName, $aPassword);
            return $data;
         }

         function actionDelete($adminId) {
            //del the file from folder
            $filepath = $this->bl->GetAdminImagePath($adminId);
            if (!empty($filepath))
            {
                unlink('../'.$filepath);
            }

          $this->bl->del($adminId);
        
        }

        
       function IsExistsUserName($currentUserName,$currentUserId){
        $role = $this->bl->IsAdminExists($currentUserName);
        if (! empty($role->getAdminId()) && ($role->getAdminId()<>$currentUserId))
         {
            $roleName =  $this->controllerR->actionViewOne($role->getAdminRole())->getRoleName();
            if (!empty($roleName)){        
                return "Already exists such username with role of:" .$roleName ;
            }      
         }
        }

         //one Owner
         function IsExistsOwner($currentUserId){
            if ( $this->bl->AdminRoleExits(RolesEnum::reOwner,$currentUserId))
            {
                return "Already exists username with a role of owner";
            }
    
         }

         
          function doValidation($admin,&$errorsTable)  {
            array_push($errorsTable ,gfLenghtPhone($admin->getAdminPhone()));
            array_push($errorsTable ,gfLenghtImage($admin->getAdminImage()));
            array_push($errorsTable ,gfLenghtName($admin->getAdminName()));
            array_push($errorsTable ,gfIsValidPhoneNumber($admin->getAdminPhone()));
            array_push($errorsTable ,gfLenghtEMail($admin->getAdminEmail()));
            array_push($errorsTable ,gfIsValidEmail($admin->getAdminEmail()));
            array_push($errorsTable ,gfRoleExists($admin->getAdminRole()));
            array_push($errorsTable ,$this->IsExistsUserName($admin->getAdminName(),$admin->getAdminId()));
            if (($admin->getAdminRole())==RolesEnum::reOwner){
                array_push($errorsTable,$this->IsExistsOwner($admin->getAdminId()));
            }
            //remove empty  records
            $errorsTable= array_filter($errorsTable);
          }

         function actionUpdate($admin,&$errorsTable) {
            $this->doValidation($admin,$errorsTable);
            if (empty($errorsTable))
                $this->bl->upd($admin);
       }


  
    
        function actionInsert($admin,&$errorsTable) {
           
            $this->doValidation($admin,$errorsTable);
      
           if (empty($errorsTable))
            return $this->bl->set($admin);
        }
    }
?>