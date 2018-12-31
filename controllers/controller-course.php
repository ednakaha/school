<?php
    require_once 'controller.php';
    require_once dirname(__DIR__).'\bl\business-logic-course.php';
  

    class CourseController extends Controller {
        private $bl;

        function __construct() {
            $this->bl = new BusinessLogicCourses;
        }

        function actionView() {
            $data = $this->bl->get();
            return $data;
        }

        function actionViewOne($id) {
            $data = $this->bl->getOne($id);
            return $data;
        }

        function actionInsert($course) {
            return $this->bl->set($course);
        }

        function actionUpdate($course) {
             $this->bl->upd($course);
        }

        function actionDelete($courseId) {
             //del the file
            $filepath = $this->bl->GetCourseImagePath($courseId);
            if (!empty($filepath))
            {
                unlink('../'.$filepath);
            }

            $this->bl->del($courseId);
            
        }
    }
?>