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
$doctor->name = $_POST['name'];
$doctor->email = $_POST['email'];
$doctor->password = base64_encode($_POST['password']);
$doctor->phone = $_POST['phone'];
$doctor->cnic = $_POST['cnic'];
$doctor->address = $_POST['address'];
 
// create the doctor
if($doctor->update()){
    $doctor_arr=array(
        "status" => true,
        "message" => "Successfully Updated!"
    );
}
else{
    $doctor_arr=array(
        "status" => false,
        "message" => "Email already exists!"
    );
}
print_r(json_encode($doctor_arr));
?>