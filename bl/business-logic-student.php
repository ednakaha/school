<?php

    require_once 'bl.php';
    require_once dirname(__DIR__).'\model\student-model.php';
    require_once dirname(__DIR__).'\model\course-model.php';
    require_once dirname(__DIR__).'\bl\business-logic-course.php';

   class BusinessLogicStudents extends BusinessLogic {

        public function get()
        {
            $q = 'SELECT * FROM student ';
            
            $results = $this->dal->select($q);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new StudentModel($row));
            }
    
            return $resultsArray;
        }

        public function IsStudentExists($userEmail, $studentId)
        {
            $q = 'SELECT * FROM `student` WHERE student_email=:puserEmail';
            
           $results = $this->dal->select($q, [
               'puserEmail' => $userEmail
           ]);
           $row = $results->fetch();
    
           return (($row<>false) && ($studentId<>$row['student_id']));

       }
        public function getOne($id)
        {
            $q = 'SELECT * FROM student WHERE `student_id`=:pid';
            
            $results = $this->dal->select($q, [
                'pid' => $id
            ]);
            $row = $results->fetch();

            $s = new StudentModel($row);
            $b = new BusinessLogicCourses;
            $q = 'SELECT * FROM `students_courses` WHERE student_id = :studentId';
            $studentCourseArray = $this->dal->select($q, [
                'studentId' => $id
            ]);
            while ($row = $studentCourseArray->fetch()) {
                array_push($s->courseModelArray,$row['course_id']);
            }
            return $s;
       
        }

        
        public function GetStudentImagePath($studentId){
            $query = 'SELECT `student_image` FROM `student` WHERE student_id = :studentId';
            $results = $this->dal->select($query, [
                'studentId' => $studentId
            ]);
            $row = $results->fetch();

           return $row['student_image'];
        }


   

        public function getStudentsPerCourse($studentId)
        {
            $query = 'SELECT * FROM `student` WHERE student_id = :studentId';
            $results = $this->dal->select($query, [
                'studentId' => $studentId
            ]);
            $row = $results->fetch();

            $s = new StudentModel($row);
            $b = new BusinessLogicCourses();
            $q = 'SELECT * FROM `students_courses` WHERE student_id = :studentId';
            $studentCourseArray = $this->dal->select($q, [
                'studentId' => $studentId
            ]);
            while ($row = $studentCourseArray->fetch()) {
                array_push($s->courseModelArray, $b->getOne($row['course_id']));
            }
            return $s;
        }

        
        public function studentExits($email)
        {
           $q = 'SELECT * FROM `student` WHERE student_email=:pemail';
           
          $results = $this->dal->select($q, [
              'pemail' => $email
          ]);
          $row = $results->fetch();
          
         return ($row<>false);
        }

        public function set($s) {
            $query = "INSERT INTO student (`student_name`, `student_phone`, `student_email`, `student_image`) VALUES (:a, :b, :c,:d)";
            $params = array(
                "a" => $s->getStudentName(),
                "b" => $s->getStudentPhone(),
                "c" => $s->getStudentEmail(),
                "d" => $s->getStudentImage()
            );
           return $this->dal->insert($query, $params);
        }

        public function setStudentCourses($sId,$cId) {
            $query = "INSERT INTO students_courses (`student_id`, `course_id`) VALUES (:a, :b)";
            $params = array(
                "a" =>$sId,
                "b" =>$cId              
            );
           return $this->dal->insert($query, $params);
        }

        public function del($id){
            $query = "DELETE FROM student WHERE student_id=:id";
            $param =array(
                "id" =>$id
            );
            $this->dal->delete($query,$param);

        }

        public function deleteCourses($studentid){
            $query = "DELETE FROM  students_courses WHERE student_id=:id";
            $param =array(
                "id" =>$studentid
            );
            $this->dal->delete($query,$param);

        }
        public function upd($s) {
          $query = "update student set `student_name`=:a, `student_phone`=:b,student_email=:c ,student_image =coalesce(:d,student_image) where student_id=:e";
          $params= array  ( 
                "a" => trim($s->getStudentName()),
                "b" => trim($s->getStudentPhone()),
                "c" => trim($s->getStudentEmail()),
                "d" => $s->getStudentImage(),
                "e" => $s->getStudentId());

            $this->dal->update($query, $params);
        }
            
    }