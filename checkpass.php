<?php
$db = mysqli_connect('localhost','root','','guvi');
$selected=mysqli_select_db($db,'register');
if(isset($_POST['password']))
{
	$password= $_POST['password'];

	$query= mysqli_query($db,"SELECT * FROM register WHERE password='$password'");
	if(mysqli_num_rows($query)>0)
	{
	$qwerty = array();
    while($row =mysqli_fetch_assoc($query))
    {
        $qwerty[] = $row;
    }
    $fp = fopen('showdetails.json', 'w');
    fwrite($fp, json_encode($qwerty));
    fclose($fp);
    $json=file_get_contents("showdetails.json");
            $data =  json_decode($json,true);

            if (count($data)) {
            // Open the table
            foreach ($data as $stand)
          {
           echo '<br><br><br><br><br><center><b><h1 style="font-family: arial;
           font-size: 18pt;
           color: blue;
           text-align: center;font-size:50px;">YOUR DETAILS</h1><b><br><table border="10"
       style="background-color: aqua;border-spacing: 0.5rem; border-color: red blue gold teal;">';
           echo '<tr padding: 20px;><td padding: 20px;>';
           echo "First Name : ";
           echo $stand["name"];
           echo '</td></tr>';

           echo '<tr padding: 20px;><td padding: 20px;>';
           echo "Last Name : ";
           echo $stand["lastname"];

           echo '<tr padding: 20px;><td padding: 20px;>';
           echo "Password : ";
           echo  $stand["password"];
           echo '</td></tr>';

           echo '<tr padding: 20px;><td padding: 20px;>';
           echo "Gender : ";
           echo $stand["gender"];
           echo '</td></tr>';

           echo '<tr padding: 20px;><td padding: 20px;>';
           echo "Email : ";
           echo $stand["email"];
           echo '</td></tr>';

           echo '<tr padding: 20px;><td padding: 20px;>';
           echo "Dept : ";
           echo $stand["dept"];
           echo '</td></tr>';

           echo '<tr padding: 20px;><td padding: 20px;>';
           echo "Year : ";
           echo $stand["year"];
           echo '</td></tr>';

           echo '</center></table>';
           
            }
        }

       
     exit();
	}
	else
	{
		header('location: wrongpas.html');
	}
}
?>