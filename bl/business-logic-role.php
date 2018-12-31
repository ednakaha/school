<?php

    require_once 'bl.php';
    require_once dirname(__DIR__).'\model\role-model.php';

   class BusinessLogicRoles extends BusinessLogic {

        public function get()
        {
            $q = 'SELECT * FROM role ';
            
            $results = $this->dal->select($q);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new RoleModel($row));
            }
    
            return $resultsArray;
        }

        public function getOne($id)
        {
            $q = 'SELECT * FROM role WHERE `role_id`=:pid';
            
            $results = $this->dal->select($q, [
                'pid' => $id
            ]);
            $row = $results->fetch();
            return new RoleModel($row);
       
        }

            
    }