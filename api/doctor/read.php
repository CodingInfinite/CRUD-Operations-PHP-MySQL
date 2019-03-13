<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/doctor.php';
 
// instantiate database and doctor object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$doctor = new Doctor($db);
 
// query doctor
$stmt = $doctor->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
 
    // doctors array
    $doctors_arr=array();
    $doctors_arr["doctors"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
        $doctor_item=array(
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "phone" => $phone,
            "gender" => $gender,
            "cnic" => $cnic,
            "address" => $address,
            "profile_status" => $profile_status,
            "specialist" => $specialist,
            "created" => $created
        );

        array_push($doctors_arr["doctors"], $doctor_item);
    }
 
    echo json_encode($doctors_arr["doctors"]);
}
else{
    echo json_encode(array());
}
?>