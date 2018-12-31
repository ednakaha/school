<?php  
require_once 'model.php';
    class CourseModel implements IModel {
        private $course_id;
        private $course_name;
        private $course_description;
        private $course_image;


        function __construct($arr) {
            if (!empty($arr['course_id']))   
            $this->course_id = $arr['course_id'];

            $this->course_name        = $arr['course_name']; 
            $this->course_description = $arr['course_description'];
            $this->course_image       = $arr['course_image'];
            $this->studentModelArray    = [];
        }

        function getCourseId() {
            return $this->course_id;
        }
        function getCourseName() {
            return $this->course_name;
        }
        function getCourseDescription() {
            return $this->course_description;
        }
        function getCourseImage() {
            $image =  $this->course_image;
            if (empty($image)) return null;  //for COALESCE
            else return $image;
        }

        function getStudentModelArray() {
            return $this->studentModelArray;
        }
        function setCourseId($id){
            $this->course_id= $id;
        }
        function setCourseName($q){
            $this->course_name= $q;
        }
        function setCourseDescription($q){
            $this->course_description= $q;
        }
        function setCourseImage($q){
            $this->course_image= $q;
        }
    }

?>