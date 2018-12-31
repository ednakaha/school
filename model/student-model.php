<?php  
require_once 'model.php';
    class StudentModel implements IModel {
        private $student_id;
        private $student_name;
        private $student_phone;
        private $student_email;
        private $student_image;


        function __construct($arr) {
            if (!empty($arr['student_id']))   
            $this->student_id = $arr['student_id'];

            $this->student_name        = $arr['student_name']; 
            $this->student_phone       = $arr['student_phone'];
            $this->student_email       = $arr['student_email'];
            $this->student_image       = $arr['student_image'];
            $this->courseModelArray    = [];

        }

        function getStudentId() {
            return $this->student_id;
        }
        function getStudentName() {
            return $this->student_name;
        }
        function getStudentPhone() {
            return $this->student_phone;
        }
        function getStudentEmail() {
            return $this->student_email;
        }
        function getStudentImage() {
            $image =  $this->student_image;
            if (empty($image)) return null;  //for COALESCE
            else return $image;
        }

        function getCourseModelArray() {
            return $this->courseModelArray;
        }
        

        function setStudentId($q){
            $this->student_id = $q;
        }
        function setStudentName($q){
            $this->student_name= $q;
        }
        function setStudentPhone($q){
            $this->student_phone= $q;
        }
        function setStudentEmail($q){
            $this->student_email= $q;
        }
        function setStudentImage($q){
            $this->student_image= $q;
        }
    }


?>