<?php
$username = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['Feedback'];
$email = $_POST['address'];
$phoneCode = $_POST['city'];
$phone = $_POST['zip'];
if (!empty($email) || !empty($password) || !empty($Feedback) || !empty($address) || !empty($city) || !empty($zip)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "form";
    //create connection
    $conn = new mysqli($host, $dbemail, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From feedbak Where email = ? Limit 1";
     $INSERT = "INSERT Into feedback (email, password, Feedback, address, city, zip) values(?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssssi", $email, $password, $Feedback, $address, $city, $zip);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>