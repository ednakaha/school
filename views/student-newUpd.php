<?php
 if(!isset($_SESSION)) {
  session_start();
 }
   require_once dirname(__DIR__).'\controllers\controller-course.php';  
   require_once dirname(__DIR__).'\controllers\controller-student.php';
   require_once 'globalFunc.php';
  
  $cStudent = new StudentController;
  $cCourse = new CourseController;

  $pageMode ='';     
  
  $errorsTable = [];
  $hasErrors = false;

  $studentId =isset ($_GET['studentId']) ? $_GET['studentId'] : (isset($_POST['save']) ? $_POST['save'] :  $_POST['delete']);
  if ($studentId>0) //update
  {
    $selectedStudent = $cStudent->actionViewOne($studentId);
    $pageMode =PageStatusMode::psUpdate; 
  }
  else {//new
    $pageMode =PageStatusMode::psNew;
  }

  if (!empty($_POST['delete'])) {
      $cStudent->actionDelete($_POST['delete']);
       //delete courses 
       $cStudent->actionDeleteCourses($_POST['delete']);
      header("location: student-course-base.php");
  }
  else {//new-upd 
    if (! empty($_FILES['pic_path']['name'])){
      $dest = gfUploadFile($errorsTable);
      $dest = str_replace('../','',$dest);
    }
    else $dest=null;
    if ((!empty($_POST['save']))&&(!empty($_POST['student_name']))&&(!empty($_POST['student_phone']))&&(!empty($_POST['student_email'])))  {
         $student = new StudentModel([
             'student_name'  =>  $_POST['student_name'],
             'student_phone' =>  $_POST['student_phone'],
             'student_email' =>  $_POST['student_email'],
             'student_image' =>  $dest
         ]);
        if ($pageMode ==PageStatusMode::psNew){
           //save a new student
           $newStudentId =  $cStudent->actionInsert($student,$errorsTable);
           $hasErrors = empty($errorsTable)? false:true;
           //save selected courses to students_courses table
           if (!($hasErrors)){
            foreach ($_POST['CoursesList'] as $idCourse) {
              $cStudent->actionInsertStudentCourses($newStudentId,$idCourse);
            }//foreach
            }
          }//new
         else{  //update
           //update the studentId for update
          $student->setStudentId($_POST['save']);
          //update data
          $cStudent->actionUpdate($student,$errorsTable);
          $hasErrors = empty($errorsTable)? false:true;
          if (!($hasErrors)){
          
          //delete courses 
          $cStudent->actionDeleteCourses($studentId);
          //save selected courses on students_courses table
          foreach ($_POST['CoursesList'] as $idCourse) {
              $cStudent->actionInsertStudentCourses($studentId,$idCourse);
            }//foreach
          }//no errors
          header("location: student-details.php?id=".$studentId);
         }//update
      }//post[save]
     else {
         if (!empty($_POST)){//on loading
          		array_push($errorsTable, "One or more fields are empty");
              $hasErrors = true;
         }
    }
  }//new-upd

 // $arrayOfStudents = $cStudent->actionView();
  $arrayOfCourses = $cCourse->actionView();
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

   <!--for checkbox  https://bootsnipp.com/snippets/j65Ab 
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
 
  <link  rel="stylesheet" type="text/css" href="mainCss.css">
  <base href="http://localhost/school/">
</head>
<body>

    <?php include 'menu.php'; ?>
    <?php include 'menu-student-course.php'; ?>
    <div class ="col-md-8 " id ="sch_main_container">
     <div class="container">
     <form enctype = "multipart/form-data" accept-charset="UTF-8" action='<?php echo 'views/'.basename($_SERVER['PHP_SELF']); ?>' name='addStudent' method='POST' >

    <div class="form-group fileTop"><br>

      
    <?php if ($hasErrors) { ?>
    <div class="alert alert-danger" role="alert">
    <ul>
        <?php foreach ($errorsTable as $error) { ?>
        <li> <?php echo $error; ?></li>
        <?php } ?>
    </ul>
    </div>
    <?php } ?>
      <!--header -->
      <div class = "col-md-8">
      <div class = "col-md-6">
         <button value =<?php echo $studentId  ?> name='save' type="submit" class="btn btn-info glyphicon glyphicon-send">  Save</button> 
      </div>
        <div class = "col-md-2 col-md-offset-1 ">  
          <?php if ($pageMode ==PageStatusMode::psUpdate) { ?>
            <button id='delete' onclick="gfConfirmDelete(event)" value='<?php echo $selectedStudent->getStudentId() ?>' name='delete' class="btn btn-info glyphicon glyphicon-trash">  Delete</button>
          <?php } ?>
      </div>
      <br><hr class = "col-md-9">
      </div>
      <!--details-->
      <div class = "col-md-6">
      <?php if ($pageMode ==PageStatusMode::psNew) { ?>
    
                <label for="lat">Name</label>
                <input type="text" class="emptyErrArr form-control" name='student_name' id="student_name" maxlength="50" require>

                <label for="lat">Phone</label>
                <input  type="number" class="emptyErrArr form-control" name='student_phone' id="student_phone" maxlength="15" 
                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" require>
               
                <label for="lat">Email</label>
                <input  type="email" class="emptyErrArr form-control" name='student_email' id="student_email" maxlength="254" require>

                <label for="lat">Image</label>              
                <input type="file" id="imgInp" name="pic_path">
                <img  class = "imgCourse" id="imgIdS" src="#" alt="image student" maxlength="150" >

                <!--list of courses -->
                <?php   foreach ($arrayOfCourses as $item) { ?> 
                <label class="customcheck"> <?php echo $item->getCourseName(); ?>
                <input type="checkbox" name="CoursesList[]" value='<?php echo $item->getCourseId(); ?> ' >
                <span class="checkmark"></span>
                </label> 
                <?php }?>
        <?php } else //if ($pageMode ==PageStatusMode::psUpdate)
          { ?>
       <label for="lat">Name</label>
                <input type="text" class="emptyErrArr form-control" name='student_name' id="student_name" require value=' <?php echo $selectedStudent->getStudentName(); ?>' maxlength="50">

                <label for="lat">Phone</label>
                <input  type="number" class="emptyErrArr form-control" name='student_phone' id="student_phone" require
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                      value= '<?php echo $selectedStudent->getStudentPhone(); ?>' maxlength="15">
               
                <label for="lat">Email</label>
                <input  type="email" class="emptyErrArr form-control" name='student_email' id="student_email"  require value=' <?php echo $selectedStudent->getStudentEmail(); ?>' maxlength="254">

                <label for="lat">Image</label>              
                <input type="file" id="imgInp" name="pic_path">
                <img  class = "imgCourse" id="imgIdS" src='<?php echo $selectedStudent->getStudentImage(); ?>' alt="image student" maxlength="150">

                <!--list of courses -->
                <?php   foreach ($arrayOfCourses as $item) { 
                 $doChecked = in_array( $item->getCourseId(), $selectedStudent->getCourseModelArray()) ? true:false; ?>
                <label class="customcheck"> <?php echo $item->getCourseName(); ?>
                  <?php if ($doChecked) { ?> 
                    <input  type="checkbox"  name="CoursesList[]" value='<?php echo $item->getCourseId(); ?> ' checked >
                  <?php } else { ?>
                   <input  type="checkbox"  name="CoursesList[]" value='<?php echo $item->getCourseId(); ?> '  >
                  <?php } ?>
            
                <span class="checkmark"></span>
                </label> 
                <?php }?>
  
            

            </div>

            <?php }?> <!-- ($pageMode ==PageStatusMode::psUpdate)-->
            
          
          </div>
         </div>
        </form>
      </div>

      <script>
          //empty errors table
          $('.emptyErrArr').on('input',function(){
                $hasErrors = false;
            $('.alert').hide()
          });
        
      //img
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
         