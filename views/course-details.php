<?php
 if(!isset($_SESSION)) {
  session_start();

  
  require_once dirname(__DIR__).'\controllers\controller-student.php';
  require_once dirname(__DIR__).'\controllers\controller-course.php';
  require_once 'globalFunc.php';


  $cCourse = new CourseController;
 // $cStudent = new StudentController;

  $id = $_GET["id"];
  $role = $_SESSION['role'];


  $selectedCourse = $cCourse->actionViewOne($id);
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

     <form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
          <div class="form-group fileTop"><br>
    <!--header-->
    <div class = "col-md-8">
        <div class = "col-md-6">  
          <h> Course <?php echo $selectedCourse->getCourseName(); ?>
        </div>
        <div class = "col-md-2 col-md-offset-3 ">
          <?php if (!($_SESSION['role'] == RolesEnum::reSales)) { ?>
            <a class="btn btn-info glyphicon glyphicon-pencil" href='views/course-newUpd.php?courseId=<?php echo $id ?>'>  Edit</a>
          <?php } ?>
        </div>
        <br><hr>
    </div> 
        <!--details-->
        <div class = " col-md-12">
          <div id="imgCourseDetail" class = "col-md-6 "> <img src="<?php echo $selectedCourse->getCourseImage(); ?>">  </div>
         <div class="col-md-offset-1 col-md-6">
          <h3> Course <?php echo $selectedCourse->getCourseName(); ?>,
           <?php if  (!empty($selectedCourse->getStudentModelArray())) {
                     echo count($selectedCourse->getStudentModelArray());
            } else
            { echo 0;
            }?>  Students </h3>

               <p><?php echo $selectedCourse->getCourseDescription(); ?></p>   
            </div>
          </div>

          <div class = "divMargin col-md-6">
          <table class=" table table-striped ">
            <?php foreach ($selectedCourse->getStudentModelArray() as $item) { ?>
            <tr>
             <td>  <img class = "imgStudent" src="<?php echo $item->getStudentImage(); ?>"/> </td>
              <td><?php echo $item->getStudentName()?></td>
            
            </tr>
            <?php } ?>
           </table>
            </div>
            </div>
          </div>
          </form>
        </form>
      </div>
</div>   
</body>
</html>
