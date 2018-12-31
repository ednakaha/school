<?php  
require_once 'model.php';
    class RoleModel implements IModel {
        private $role_id;
        private $role_name;


        function __construct($arr) {
            if (!empty($arr['role_id']))   
            $this->role_id = $arr['role_id'];

            $this->role_name = $arr['role_name']; 

        
        }

        function getRoleId() {
            return $this->role_id;
        }
        function getRoleName() {
            return $this->role_name;
        }
        function setRoleName($q){
            $this->role_name= $q;
        }
    }


?>