<?php
    require_once 'controller.php';
    require_once dirname(__DIR__).'\bl\business-logic-role.php';


    class RoleController extends Controller {
        private $bl;

        function __construct() {
            $this->bl = new BusinessLogicRoles;
        }

        function actionView() {
            $data = $this->bl->get();
            return $data;
        }
        function actionViewOne($roleId) {
            $data = $this->bl->getOne($roleId);
            return $data;
        }

        function actionInsert($role) {
            return $this->bl->set($role);
        }
    }
?>