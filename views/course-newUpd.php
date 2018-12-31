<?php
 if(!isset($_SESSION)) {
  session_start();
 }
  
  require_once dirname(__DIR__).'\controllers\controller-student.php';
  require_once dirname(__DIR__).'\controllers\controller-course.php';
  require_once 'globalFunc.php';
  
  
  $cCourse= new CourseController;
  $cStudent = new StudentController;
  $pageMode ='';
  $errorsTable = [];
  $hasErrors = false;

//get courseid from url or Save\delete 
  $courseId =isset ($_GET['courseId']) ? $_GET['courseId'] : (isset($_POST['save']) ? $_POST['save'] :  $_POST['delete']);
  if ($courseId>0) //update
  {
    $selectedCourse = $cCourse->actionViewOne($courseId);
    $pageMode =PageStatusMode::psUpdate; 
  }
  else {//new
    $pageMode =PageStatusMode::psNew;
  }
  
  if (!empty($_POST['delete'])) {
    //delete from courses
    $cCourse->actionDelete($_POST['delete']);
  
    header("location: student-course-base.php");
  }
  else //new-upd
  {

    if (! empty($_FILES['pic_path']['name'])){
      $dest = gfUploadFile($errorsTable);
      $dest = str_replace('../','',$dest);
    }
    else $dest = null;
    if ((!empty($_POST['save']))&&(!empty($_POST['course_name']))&&(!empty($_POST['course_description'])))  {
         $course = new CourseModel([
             'course_name'        =>  $_POST['course_name'],
             'course_description' =>  $_POST['course_description'],
             'course_image'       =>  $dest
         ]);
        if ($pageMode ==PageStatusMode::psNew){
          echo "actionsave";
           $newStudentId =  $cCourse->actionInsert($course);
        }
        else{
        echo "actionUpdate";
           $course->setCourseId($_POST['save']);
           $cCourse->actionUpdate($course);
           header("location: course-details.php?id=".$courseId);
         }
   }//empty
   else {
    if (!empty($_POST)){//on loading
         array_push($errorsTable, "One or more fields are empty");
         $hasErrors = true;
    }//if
  }//else
 }//new-upd

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
       <form enctype = "multipart/form-data" accept-charset="UTF-8" action='<?php echo 'views/'.basename($_SERVER['PHP_SELF']); ?>' name='addCourse' method='POST' >  
       <div class="form-group fileTop"><br>
     <!--header -->
     <div class = "col-md-8">
     <div class = "col-md-6">  
      <button value =<?php echo $courseId  ?> name='save' type="submit" class="btn btn-info glyphicon glyphicon-send">  Save</button> 
     </div>
     <div class = "col-md-2 col-md-offset-1 ">  
          <?php    if (empty($selectedCourse->getStudentModelArray())) { ?>      
            <button id='delete' onclick="gfConfirmDelete(event)" value='<?php echo $selectedCourse->getCourseId()  ?>' name='delete' class="btn btn-info glyphicon glyphicon-trash">  Delete</button>
          <?php }   //count(students)=0 ?> 
      </div>

      <br><hr  class = "col-md-9">
      </div>
      <div class = "col-md-6">

      <?php if ($pageMode ==PageStatusMode::psNew) { ?>
                <label for="lat">Name</label>
                <input type="text" class="form-control" name='course_name' require id="course_name" maxlength="50">

                <label for="lat">Description</label>
                <input  type="text" class="form-control" name='course_description' id="course_description" maxlength="500">

                <label for="lat">Image</label>              
                <input type="file"  id="imgInp" name="pic_path">
                <img  class = "imgCourse" id="imgIdS" src="#" alt="image course" maxlength="150">

      <?php } else //if ($pageMode ==PageStatusMode::psUpdate)
      { ?>
                <label for="lat">Name</label>
                <input type="text" class="form-control" name='course_name' require id="course_name" value='<?php echo $selectedCourse->getCourseName(); ?>' maxlength="50" >

                <label for="lat">Description</label>
                <input  type="text" class="form-control" name='course_description' id="course_description" value='<?php echo $selectedCourse->getCourseDescription(); ?>' maxlength="500">

                <label for="lat">Image</label>          
                
                <input type="file"  id="imgInp" name="pic_path" value ='<?php echo $selectedCourse->getCourseImage(); ?>' maxlength="150">
                <img  class="imgCourse" id="imgIdS" src='<?php echo $selectedCourse->getCourseImage(); ?>' alt="image course" >


          <?php    if (!empty($selectedCourse->getStudentModelArray())) { ?>

                    <span class=""> Total  <?php echo count($selectedCourse->getStudentModelArray()); ?> students taking this course</span>
                    <?php } //count(students)>0
                     else { }   // button Delete on top //count(students)=0 ?> 

                </div>

         <?php }?> <!-- ($pageMode ==PageStatusMode::psUpdate)-->
         </div>
        </form>
      </div>

      <script>
     

       function readPicture(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#imgIdS').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#imgInp").change(function(){
          readPicture(this);
      });
      </script>
    </div>
</body>
</html>
