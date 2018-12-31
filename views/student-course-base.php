<?php
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


<?php include 'menu.php'; ?>
<?php include 'menu-student-course.php'; ?>
    <div class="container">

    <form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
    <div class ="gradient-style-3 col-md-6  fileTopBase" id ="sch_main_container">

        <p class = " col-md-8 col-md-offset-3  baseStyle"> מספר תלמידים במערכת 
          <?php echo count($arrayOfStudents); ?>     
          
          <p class ="col-md-8 col-md-offset-3   baseStyle"> מספר קורסים במערכת 
          <?php echo count($arrayOfCourses); ?>     
          </div>
        </form>
      
     </div>  
</body>
</html>
