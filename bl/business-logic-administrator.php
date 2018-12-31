<?php

    require_once 'bl.php';
    require_once dirname(__DIR__).'\model\administrator-model.php';

   class BusinessLogicAdmin extends BusinessLogic {

        public function get()
        {
            $q = 'SELECT *   FROM administrator';
            
            $results = $this->dal->select($q);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new AdminModel($row));
            }
    
            return $resultsArray;
        }

        public function getAdminData($aUserName, $aPassword)
        {
            $q = "SELECT * FROM `administrator` WHERE `admin_name` = :pUserName AND `admin_password` = :pPassword";
            
            $results = $this->dal->select($q, [
                'pUserName' => $aUserName,
                'pPassword' => $aPassword
            ]);

            $row = $results->fetch();
            return new AdminModel($row);
          
        }

        public function getOne($id)
       {
          $q = 'SELECT * FROM `administrator` WHERE admin_id=:pid';
          
         $results = $this->dal->select($q, [
             'pid' => $id
         ]);
         $row = $results->fetch();
         
        return new AdminModel($row);
       }

       public function IsAdminExists($userName)
        {
            $q = 'SELECT * FROM `administrator` WHERE admin_name=:puserName';
            
           $results = $this->dal->select($q, [
               'puserName' => $userName
           ]);
           $row = $results->fetch();
    
           return new AdminModel($row);

       }
       public function AdminRoleExits($role,$currentAdminId)
       {
         $q = 'SELECT * FROM `administrator` WHERE admin_role=:prole' ; 
         $results = $this->dal->select($q, [
             'prole' => $role
         ]);
         $row = $results->fetch();
         
        return (($row<>false) and ($row['admin_id']<>$currentAdminId));
       }
       
        public function set($f) {
            $query = "INSERT INTO `administrator` (`admin_name`, `admin_role`, `admin_phone`, `admin_email`, `admin_password`, `admin_image`)
                      VALUES (:a, :b, :c ,:d ,:e,:f)";
    
            $params = array(
                "a" =>trim($f->getAdminName()),
                "b" => $f->getAdminRole(),
                "c" => trim($f->getAdminPhone()),
                "d" => trim($f->getAdminEmail()),
                "e" => trim($f->getAdminPassword()),
                "f" => $f->getAdminImage()
            );
            $this->dal->insert($query, $params);
        }

        public function upd($s) {
            $query = "update administrator set `admin_name`=:a, `admin_role`=:b, `admin_phone`=:c, `admin_email`=:d, 
                       `admin_password`=coalesce(:e,`admin_password`),
                          `admin_image`=coalesce(:f,`admin_image`) where `admin_id`=:g";
            $params= array  ( 
                  "a" => trim($s->getAdminName()),
                  "b" => $s->getAdminRole(),
                  "c" => trim($s->getAdminPhone()),
                  "d" => trim($s->getAdminEmail()),
                  "e" => $s->getAdminPassword(),
                  "f" => $s->getAdminImage(),
                  "g" => $s->getAdminId()

              );
  
              $this->dal->update($query, $params);
          }

          public function del($id){
            $query = "DELETE FROM administrator WHERE admin_id=:id";
            $param =array(
                "id" =>$id
            );
            $this->dal->delete($query,$param);
        }
          public function GetAdminImagePath($adminId){
            $query = 'SELECT `admin_image` FROM `administrator` WHERE admin_id = :adminId';
            $results = $this->dal->select($query, [
                'adminId' => $adminId
            ]);
            $row = $results->fetch();

           return $row['admin_image'];
        }
    }