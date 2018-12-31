<?php  
require_once 'model.php';
require_once dirname(__DIR__).'\bl\business-logic-role.php';


    class AdminModel implements IModel {
        private $admin_id;        
        private $admin_name;
        private $admin_role;
        private $admin_phone;
        private $admin_email;
        private $admin_password;
        private $admin_image;


        function __construct($arr) {
            if (!empty($arr['admin_id']))   
            $this->admin_id = $arr['admin_id'];

            $this->admin_name        = $arr['admin_name']; 
            $this->admin_role        = $arr['admin_role'];
            $this->admin_phone       = $arr['admin_phone'];
            $this->admin_email       = $arr['admin_email'];
            $this->admin_image       = $arr['admin_image'];        
            $this->admin_password    = $arr['admin_password'];
        
        }

        function getAdminId() {
            return $this->admin_id;
        }
        function getAdminName() {
            return $this->admin_name;
        }
        function getAdminRole() {
            return $this->admin_role;
        }
        function getAdminPhone() {
            return $this->admin_phone;
        }
        function getAdminEmail() {
            return $this->admin_email;
        }
        function getAdminPassword() {
            $pass =  $this->admin_password;
            if (empty($pass)) 
            return null;  //for COALESCE
            else return $pass;
        }

        function getAdminImage() {
            $image =  $this->admin_image;
            if (empty($image)) return null;  //for COALESCE
            else return $image;
        }

        function setAdminId($q){
            $this->admin_id=$q; 
        }
         function setAdminName($q){
            $this->admin_name=$q; 
        }
        function setAdminRole($q){
            $this->admin_role=$q; 
        }
        function setAdminPhone($q){
            $this->admin_phone=$q; 
        }
        function setAdminEmail($q){
            $this->admin_email=$q; 
        }
        function setAdminPassword($q){
            $this->admin_password=$q; 
        }

     }

?>