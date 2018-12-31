<?php
 if(!isset($_SESSION)) {
    session_start();
 }
    
  require_once dirname(__DIR__).'\controllers\controller-student.php';
  require_once dirname(__DIR__).'\controllers\controller-course.php';


  

  $cStudent = new StudentController;
  $cCourse = new CourseController; 
  
  
  $arrayOfCourses = $cCourse->actionView();
  $arrayOfStudents = $cStudent->actionView();
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <link  rel="stylesheet" type="text/css" href="views/mainCss.css">
  <base href="http://localhost/school/" >
</head>
<body>


<form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
    <div class ="col-md-4 fileTop" >
   <!--Courses-->
            <div class="scrollbar col-md-6" id="style-15">
                <div class="panel-group ">
                    <div>
                        <h4 class="baseStyle panel-title col-md-10 "> Courses    </h4>
                        <a  class="col-md-1 plus" href='views/course-newUpd.php?courseId=-1'>+</a>                    
                    </div>
                    <div >
                           <?php foreach ($arrayOfCourses as $item) { ?>
                            
                            <div class ="divMenu col-md-12 marginMenu">
                            <div class ="col-md-4"> 
                                <img  class="imgCourse" id="imgId" src=<?php echo $item->getCourseImage() ?> alt="image course" />
                           </div>
                           <div class ="col-md-8">
                                <a class="adminFont" href='views/course-details.php?id=<?php echo $item->getCourseId() ?>'><?php echo $item->getCourseName() ?></a> 
                            </div>
                           </div>
                            <?php } ?>
                    </div>
                </div><!--panel group-->
                </div>
   <!--Students-->
            <div class="scrollbar col-md-6 pull-right" id="style-15">
                        <div class=" panel-group">
                        <div>        
                            <h4 class="baseStyle panel-title col-md-10 "   >  Students  </h4>
                            <a  class="col-md-1 plus" href='views/student-newUpd.php?studentId=-1'>+</a>
                            </div>
                        <div >
                                <?php foreach ($arrayOfStudents as $item) { ?>
                                <div class ="divMenu col-md-12 marginMenu">
                                    <div class ="col-md-4">  
                                      <img  class="imgStudent" id="imgId" src=<?php echo $item->getStudentImage() ?> alt="image student" />
                                    </div>
                                    <div class ="col-md-8">
                                      <a class="adminFont" href='views/student-details.php?id=<?php echo $item->getStudentId() ?>'><?php echo $item->getStudentName() ?></a><br>
                                      <a class="adminFont" href='views/student-details.php?id=<?php echo $item->getStudentId() ?>'><?php echo $item->getStudentPhone() ?></a>
                                    </div>
                                </div>            
                                <?php } ?>
                            </div>
                        </div>
                     </div>
                </div>
         </div> 
</form>
</body>
</html>
