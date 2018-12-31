<?php
 if(!isset($_SESSION)) {
  session_start();

  
  require_once dirname(__DIR__).'\controllers\controller-student.php';
  require_once dirname(__DIR__).'\controllers\controller-course.php';
  require_once 'globalFunc.php';



  $cStudent = new StudentController;
  $cCourse = new CourseController;

  $id = $_GET["id"];
  $role = $_SESSION['role'];


  $selectedStudent = $cStudent->actionViewOne($id);
}//session
?>
 
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <link  rel="stylesheet" type="text/css" href="mainCss.css">
  <base href="http://localhost/school/" >
</head>
<body>

    <?php include 'menu.php'; ?>
    <?php include 'menu-student-course.php'; ?>
    <div class ="col-md-8" id ="sch_main_container">
     <div class="container">

          <form action='<?php echo 'views/'.basename($_SERVER['PHP_SELF']); ?>' method='POST'>
          <div class = "col-md-12 fileTop" >
        <!--header-->
      <div class = "col-md-8">
        <div class = "col-md-6">  
          <a class = " btn btn-info glyphicon glyphicon-pencil" href='views/student-newUpd.php?studentId=<?php echo $id ?>'>Edit</a>
         </div>
            <br><hr>
        </div> 
          <!--student -->
          <div class="divMargin">
          <div class="col-md-8"> 
          <div class="imgCourseDetail col-md-3"> <img src="<?php echo $selectedStudent->getStudentImage(); ?>" style=""/> 
          </div>
          <div>
         <div class = "col-md-6 col-md-offset-2">
          <h4> <?php echo $selectedStudent->getStudentName(); ?>
          <h4> <?php echo $selectedStudent->getStudentPhone(); ?>
          <h4> <?php echo $selectedStudent->getStudentEmail(); ?>
          </div>
 

          <!-- courses -->
        <div class = "col-md-12 divMargin"></div>
        <div>
           <?php if  (!empty($selectedStudent->getCourseModelArray())) {
                foreach ($selectedStudent->getCourseModelArray() as $item) { 
                  $selectedCourse = $cCourse->actionViewOne($item);?>
                  <div class="marginMenu col-md-8 col-md-offset-3 ">
                  <div class="col-md-2"> <img src="<?php echo $selectedCourse->GetCourseImage(); ?>" style="width:40px; height:40px;"/></div> 
                  <div class="col-md-10"> <spam><?php echo $selectedCourse->getCourseName(); ?> </spam> </div>
                </div>
                <?php }} ?>
               
                
                     
                </div>
                </div>
     
          </div>
         </div>
        </form>
      </div>
</div>   
</body>
</html>
