<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate doctor object
include_once '../objects/doctor.php';
 
$database = new Database();
$db = $database->getConnection();
 
$doctor = new Doctor($db);
 
// set doctor property values
$doctor->name = $_POST['name'];
$doctor->email = $_POST['email'];
$doctor->password = base64_encode($_POST['password']);
$doctor->phone = $_POST['phone'];
$doctor->gender = isset($_POST['gender']);
$doctor->cnic = $_POST['cnic'];
$doctor->address = $_POST['address'];
$doctor->profile_status = 1;
$doctor->specialist = isset($_POST['specialist']);
$doctor->created = date('Y-m-d H:i:s');
 
// create the doctor
if($doctor->create()){
    $doctor_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $doctor->id,
        "name" => $doctor->name,
        "email" => $doctor->email,
        "phone" => $doctor->phone,
        "gender" => $doctor->gender,
        "cnic" => $doctor->cnic,
        "address" => $doctor->address,
        "specialist" => $doctor->specialist
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