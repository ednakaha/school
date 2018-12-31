
<?php
//enum for page status mode
abstract class PageStatusMode
{
    const psNew = 0;
    const psUpdate = 1;
}

abstract class RolesEnum
{
    const reNone    = 0;
    const reOwner   = 1;
    const reManager = 2;
    const reSales   = 3;

}

$rolesDescription = ['None','Owner','Manager','Sales'];


function gfLenghtPhone($phone)
{
	if (strlen($phone) > 15) {
        return  "Phone number is over 15 chars";
	}
}

function gfLenghtName($name)
{
	if (strlen($name) > 50) {
        return   "User name is over 50 chars";
    }
}

function gfRoleExists($roleId){
    global $rolesDescription;
    if (empty($rolesDescription[(int) $roleId]))
      return "There is no such role";
}

function gfLenghtDescription($description)
{
	if (strlen($description) > 500) {
        return  "Description is over 500 chars";
	}
}

function gfLenghtPassword($password)
{
	if (strlen($password) > 200) {
        return  "Password is over 200 chars";
	}
}
function gfLenghtEMail($mail)
{
	if (strlen($mail) > 254) {
        return  "E-mail is over 254 chars";
	}
}
function gfLenghtImage($imagePath)
{
	if (strlen($imagePath) > 150) {
        return  "Image path is over 150 chars";
	}
}

function gfIsValidPhoneNumber($aPhoneNumber)
{
        //eliminate every char except 0-9
        $justNums = preg_replace("/[^0-9]/", '', $aPhoneNumber);


        //if we have 9-10 digits left, it's probably valid.
        if (!((strlen($justNums) >= 9)  and (strlen($justNums) <= 15)))
        return "Invalid phone number";
}
    // email
    function gfIsValidEmail($mail){
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		return "Invalid email format";
    }
}



  
function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
function gfUploadFile(&$errorsTable){
        $uploadOk = 1;
        $fileName = $_FILES['pic_path']['name'];
        $path = '../Images/';
        $OrigImage = basename( $fileName);
        $ext =strtolower(pathinfo($OrigImage, PATHINFO_EXTENSION));
        $dest = $path .GUID().'.' .$ext; 

        // Check file size
        if ($_FILES["pic_path"]["size"] > 500000) {
            array_push($errorsTable, "Your file is too large, should be maximum 500KB");
            $uploadOk = 0;
        }

        //  file formats
        if($ext != "jpg" && $ext != "png" && $ext != "jpeg"  && $ext != "gif" ) {
            array_push($errorsTable, "Only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            array_push($errorsTable, "Your file was not uploaded.");
        // if everything is ok, try to upload file
        } else {
            if (!(move_uploaded_file($_FILES["pic_path"]["tmp_name"], $dest)) ) {
                array_push($errorsTable, "There was an error uploading your file.");
                $uploadOk = 0;
            }
        }
  if  ($uploadOk == 0)
       $dest = "";//empty
  return $dest;
}
?>
<script>

 function gfConfirmDelete(e)
       {

         $conf = confirm('Are you sure want to delete this record?');
          if(!$conf){
            e.preventDefault();
              return false;
            }       
       }
</script>