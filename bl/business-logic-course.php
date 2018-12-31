<?php

    require_once 'bl.php';
    require_once dirname(__DIR__).'\model\course-model.php';

   class BusinessLogicCourses extends BusinessLogic {

        public function get()
        {
            $q = 'SELECT * FROM course ';
            
            $results = $this->dal->select($q);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new CourseModel($row));
            }
    
            return $resultsArray;
        }

  
  //      public function getCoursePerStudent($courseId)
         public function getOne($courseId)
        {
            $query = 'SELECT * FROM `course` WHERE course_id = :courseId order by course_name asc ';
            $results = $this->dal->select($query, [
                'courseId' => $courseId
            ]);
            $row = $results->fetch();

            $s = new CourseModel($row);
            $b = new BusinessLogicStudents;
            $q = 'SELECT * FROM `students_courses` WHERE course_id = :courseId';
            $studentCourseArray = $this->dal->select($q, [
                'courseId' => $courseId
            ]);
            while ($row = $studentCourseArray->fetch()) {
                array_push($s->studentModelArray, $b->getOne($row['student_id']));
            }
            return $s;
        }

        public function GetCourseImagePath($courseId){
            $query = 'SELECT `course_image` FROM `course` WHERE course_id = :courseId';
            $results = $this->dal->select($query, [
                'courseId' => $courseId
            ]);
            $row = $results->fetch();

           return $row['course_image'];
        }


        public function courseExits($name)
        {
           $q = 'SELECT * FROM `course` WHERE course_name=:pname';
           
          $results = $this->dal->select($q, [
              'pname' => $name
          ]);
          $row = $results->fetch();
          
         return ($row<>false);
        }

        public function set($s) {
            $query = "INSERT INTO course (`course_name`, `course_description`, `course_image`) VALUES (:a, :b, :c)";
            $params = array(
                "a" => trim($s->getCourseName()),
                "b" => trim($s->getCourseDescription()),
                "c" => $s->getCourseImage()
            );
            $this->dal->insert($query, $params);
        }
        public function del($id){
            $query = "DELETE FROM course WHERE course_id=:id";
            $param =array(
                "id" =>$id
            );
            $this->dal->delete($query,$param);
        }

        public function upd($s) {
          $query = "update course set `course_name`=:a, `course_description`=:b, `course_image`=coalesce(:c,`course_image`) where `course_id`=:d";
          $params= array  ( 
                "a" => $s->getCourseName(),
                "b" => $s->getCourseDescription(),
                "c" => $s->getCourseImage(),
                "d" => $s->getCourseId()
            );

            $this->dal->update($query, $params);
        }
            
    }