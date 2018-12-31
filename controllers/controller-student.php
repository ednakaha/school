<?php
    require_once 'controller.php';
    require_once dirname(__DIR__).'\bl\business-logic-student.php';


    class StudentController extends Controller {
        private $bl;

        function __construct() {
            $this->bl = new BusinessLogicStudents;
        }

        function actionView() {
            $data = $this->bl->get();
            return $data;
        }
        
        function actionViewOne($studentId) {
            $data = $this->bl->getOne($studentId);
            return $data;
        }

        function actionViewStudentsPerCourse($student)
        {
            $data = $this->bl->getStudentsPerCourse($student);
            return $data;
        }
    
            
       function IsExistsStudent($currentEmail,$currentUserId){
        $exists = $this->bl->IsStudentExists($currentEmail,$currentUserId);
         if ($exists){        
                return "Already exists such student with this E-mail";                 
            }      
        
        }
       
        function doValidation($admin,&$errorsTable)  {
            array_push($errorsTable ,gfLenghtPhone($admin->getStudentPhone()));
            array_push($errorsTable ,gfLenghtImage($admin->getStudentImage()));
            array_push($errorsTable ,gfLenghtName($admin->getStudentName()));
            array_push($errorsTable ,gfIsValidPhoneNumber($admin->getStudentPhone()));
            array_push($errorsTable ,gfLenghtEMail($admin->getStudentEmail()));
            array_push($errorsTable ,gfIsValidEmail($admin->getStudentEmail()));
            array_push($errorsTable ,$this->IsExistsStudent($admin->getStudentEmail(),$admin->getStudentId()));
          
            //remove empty  records
            $errorsTable= array_filter($errorsTable);
          }

       function actionUpdate($student,&$errorsTable) {
        $this->doValidation($student,$errorsTable);
        if (empty($errorsTable))
            $this->bl->upd($student);
       }

    
        function actionInsert($student,&$errorsTable) {         
            $this->doValidation($student,$errorsTable);
      
           if (empty($errorsTable))
            return $this->bl->set($student);
        }


        function actionInsertStudentCourses($sId,$cId) {
            return $this->bl->setStudentCourses($sId,$cId);
        }

        function actionDeleteCourses($student){
            $this->bl->deleteCourses($student);
        }

        function actionDelete($studentId) {
              //del the file from folder
              $filepath = $this->bl->GetStudentImagePath($studentId);
              if (!empty($filepath))
              {
                  unlink('../'.$filepath);
              }

            $this->bl->del($studentId);
          
       }
    }
?>