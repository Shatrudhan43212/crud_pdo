<?php 
require_once('db.php'); 
session_start();
// Save Data
if(isset($_POST['submit']) && $_POST['submit'] = 'SaveData'){
    array_pop($_POST); // Remove last element like: submit filed.
    if(!empty(array_filter($_POST))){
        $_SESSION = $_POST;
        if(trim($_POST['name']) == '') $_SESSION['name_err'] = '<div style="color: red;">Name is required.</div>';
        elseif(trim($_POST['email']) == '') $_SESSION['eamil_err'] = '<div style="color: red;">Email is required.</div>';
        elseif(trim($_POST['password']) == '') $_SESSION['password_err'] = '<div style="color: red;">Password is required.</div>';
        elseif(trim($_POST['gender']) == '') $_SESSION['gender'] = '<div style="color: red;">Gender is required.</div>';
        //elseif(empty($_FILES['image']['name'])) $_SESSION['image_err'] = '<div style="color: red;">Please choose an image.</div>';
        elseif($_POST['email'] != '' && $_POST['password'] != ''){
            $imagesName = '';
            if(!empty($_FILES['image']['name'])){
                $folderName = "uploads";
                $imagesResults = imageUploads($_FILES, $folderName);
                if($imagesResults['status'] == false){
                    $_SESSION['image_err'] = '<div style="color: red;">'.$imagesResults['msg'].'.</div>';
                    header('location: form.php'); die;
                }else{
                    $imagesName = $imagesResults['imageName'];
                }
            }
            //calling insert function
            $results = insertData('users', array_filter($_POST), $imagesName); 
            if($results == true){ $_SESSION['msg'] = '<h4 style="text-align:center; color: green;">Data Inserted Successfully!</h4>'; header('location: form.php'); }
            else print_r($results); die;
        }
    }
    else $_SESSION['msg'] = '<h4 style="text-align:center; color: red;">Mandatory fields are required.</h4>';
}

// Insert into Database...
function insertData($table_name, $dataArray, $imageName){
    global $conn;
    $columns = $columns_bindings = array();
    foreach ($dataArray as $column_name => $data) {
        $columns[] = $column_name;
        $columns_bindings[] = ':' . $column_name;
    }
    array_push($columns, "password_hidden","images"); // adding password_view column
    array_push($columns_bindings, ":password_hidden",":images");
    $ins_query = 'INSERT INTO `' . $table_name . '`(' . implode(', ', $columns) . ') VALUES (' . implode(', ', $columns_bindings) . ')';
    $stmt = $conn->prepare($ins_query);

    $dataArray['password_hidden'] = md5($dataArray['password']);
    $dataArray['images'] = $imageName;
    foreach ($dataArray as $column_name => $data){
        $stmt->bindValue(":" . $column_name, strip_tags($data)); 
    }
    return (!$stmt->execute()) ? $stmt->errorInfo() : true;
}


// Image uploads function
function imageUploads($imageData, $folderName){
    $fileName = $imageData["image"]["name"];
    $fileSize = $imageData["image"]["size"];
    //$fileType = $imageData["image"]["type"];
    $fileTemp = $imageData["image"]["tmp_name"];
    $file_Ext = explode('.', strtolower($fileName));
    $file_Ext = end($file_Ext);
    $newFileName = date("Ymd").time().".".$file_Ext;
    $extensions= array("jpeg","jpg","png");
    if(in_array($file_Ext, $extensions) === false){
        return array("status" => false, "msg" => "Please choose a JPEG or PNG file."); die;
    } 
    elseif($fileSize > 2097152){
        return array("status" => false, "msg" => "File size must be less or equal 2 MB"); die;
    } 
    else{
        move_uploaded_file($fileTemp, $folderName."/".$newFileName);
        return array("status" => true, "imageName" => $newFileName);
    }
}

function getUserList(){
    global $conn;

}



?>