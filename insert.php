<?php
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$dept = $_POST['dept'];
$year = $_POST['year'];
if (!empty($name) ||!empty($lastname) || !empty($password) || !empty($gender) || !empty($email) ||!empty($dept)
||!empty($year)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "guvi";
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (name, lastname, password, gender, email, dept, year) values(?, ?, ?, ?, ?, ?, ?)";
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
      $stmt->bind_param("sssssii", $name, $lastname, $password, $gender, $email, $dept, $year);
      $stmt->execute();
      header('location: relog.html');
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
    }
} else {
 echo "All field are required";
}

function get_data()
{
   $connect=mysqli_connect('localhost','root','','guvi');
   $query="SELECT * FROM register";
   $result=mysqli_query($connect,$query);
   $userdata=array();
   while ($row=mysqli_fetch_array($result)) {
      $userdata[]=array(
        'name'     =>  $row["name"],
        'lastname' =>  $row["lastname"],
        'password' =>  $row["password"],
        'gender'   =>  $row["gender"],
        'email'    =>  $row["email"],
        'dept'     =>  $row["dept"],
        'year'     =>  $row["year"]
      );
   }
   return json_encode($userdata);
}
$filename=detailshere . ".json";

if (file_put_contents($filename, get_data())) {
    echo $filename . 'file_created';}
else
    {echo $filename . 'file_created_error';}

?>