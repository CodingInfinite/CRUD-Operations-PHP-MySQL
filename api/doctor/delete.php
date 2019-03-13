<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate doctor object
include_once '../objects/doctor.php';
 
$database = new Database();
$db = $database->getConnection();
 
$doctor = new Doctor($db);
 
// set doctor property values
$doctor->id = $_POST['id'];
 
// remove the doctor
if($doctor->delete()){
    $doctor_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $doctor_arr=array(
        "status" => false,
        "message" => "Doctor Cannot be deleted. may be he's assigned to a patient!"
    );
}
print_r(json_encode($doctor_arr));
?>