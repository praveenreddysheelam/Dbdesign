<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Contact Application</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    />

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  </head>

  <body>
<?php 
$mysqli = new mysqli('localhost','root','','dbdesign') or die();
echo ("working");
if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    echo $id; 
    $mysqli->query("DELETE  FROM dates where Contact_id='$id'")or die($mysqli->error);
    $mysqli->query("DELETE  FROM phone where Contact_id='$id'")or die($mysqli->error);
    $mysqli->query("DELETE  FROM address where Contact_id='$id'")or die($mysqli->error);
    $mysqli->query("DELETE  FROM contact where Contact_id='$id'")or die($mysqli->error);
}
if(isset($_GET['listdata'])){
 $sql="select contact.contact_id as Contact_id,
 contact.Fname as Fname,
 contact.Mname as Mname,
 contact.Lname as Lname,
 address.address_type as Address_type,
    address.address as Address,
    address.city as City,
    address.state as State,
    address.zip as Zip,
    phone.phone_type as Phone_type,
    phone.area_code as Area_code,
    phone.phone_number as Phone_Number,
    dates.date_type as Date_type,
    dates.date_value as Date_value
from contact
 left join address on contact.contact_id = address.contact_id
 left join phone on contact.contact_id = phone.contact_id
 left join dates on contact.contact_id = dates.contact_id";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 echo' <form id="mform" method="POST " action="create.php">
 <div class="form-group">
  <label for="firstname">First Name:</label>
  <input type="text" class="form-control" id="search" name="search">
  </div>
  <button type="submit" class="btn btn-warning" value="Submit" id="Btn" name="searchdata">Search </button>
</form>';
    echo "<table style='1px solid black' class='table'><thead><tr><th>First Name</th><th>Middle Name</th>
    <th>Last Name</th><th>Phone_type</th><th>Area_code</th><th>Phone_Number</th><th>Address</th>
    <th>Address_type</th><th>City</th><th>State</th><th>Zip</th><th>Date_type</th>
    <th>Date</th></tr></thead>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //echo'<tr><td>'.$row["Contact_id"].'</td></tr>';
      echo "<tr><td>".$row["Fname"]."</td><td>".$row["Mname"]."</td><td> ".$row["Lname"]."</td><td>".$row["Phone_type"].
      "</td><td>".$row["Area_code"]."</td><td>".$row["Phone_Number"]."</td><td>".$row["Address"].
      "</td><td>".$row["Address_type"]."</td><td>".$row["City"]."</td><td>".$row["State"]."</td><td>".$row["Zip"].
      "</td><td>".$row["Date_type"]."</td><td>".$row["Date_value"].
      "</td><td><a href='update.php?edit=". $row["Contact_id"]."' class='btn btn-info'>Update</a>".
      "   "."<a href='create.php?delete=".$row["Contact_id"]."' class='btn btn-danger'>Delete</a></td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
  

 //echo($result);

}
if(isset($_GET['searchdata']))
{
   $value=$_GET['search'].trim(" ");
   $str=str_replace(' ', '', $value);
   echo $str;
  $sql="select contact.contact_id as Contact_id,
  contact.Fname as Fname,
  contact.Mname as Mname,
  contact.Lname as Lname,
  address.address_type as Address_type,
     address.address as Address,
     address.city as City,
     address.state as State,
     address.zip as Zip,
     phone.phone_type as Phone_type,
     phone.area_code as Area_code,
     phone.phone_number as Phone_Number,
     dates.date_type as Date_type,
     dates.date_value as Date_value
 from contact
  left join address on contact.contact_id = address.contact_id
  left join phone on contact.contact_id = phone.contact_id
  left join dates on contact.contact_id = dates.contact_id 
  where concat(concat(contact.Fname,contact.Mname),contact.Lname)='$str'";
 $result = $mysqli->query($sql);
 if ($result->num_rows > 0) {
  echo' <form id="mform" method="POST " action="create.php">
  <div class="form-group">
   <label for="firstname">First Name:</label>
   <input type="text" class="form-control" placeholder="First Name" id="search" name="search">
   </div>
   <button type="submit" class="btn btn-warning" value="Submit" id="Btn" name="searchdata">Search </button>
 </form>';
     echo "<table style='1px solid black' class='table'><thead><tr><th>First Name</th><th>Middle Name</th>
     <th>Last Name</th><th>Phone_type</th><th>Area_code</th><th>Phone_Number</th><th>Address</th>
     <th>Address_type</th><th>City</th><th>State</th><th>Zip</th><th>Date_type</th>
     <th>Date</th></tr></thead>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
       //echo'<tr><td>'.$row["Contact_id"].'</td></tr>';
       echo "<tr><td>".$row["Fname"]."</td><td>".$row["Mname"]."</td><td> ".$row["Lname"]."</td><td>".$row["Phone_type"].
       "</td><td>".$row["Area_code"]."</td><td>".$row["Phone_Number"]."</td><td>".$row["Address"].
       "</td><td>".$row["Address_type"]."</td><td>".$row["City"]."</td><td>".$row["State"]."</td><td>".$row["Zip"].
       "</td><td>".$row["Date_type"]."</td><td>".$row["Date_value"].
       "</td><td><a href='update.php?edit=". $row["Contact_id"]."' class='btn btn-info'>Update</a>".
       "   "."<a href='create.php?delete=".$row["Contact_id"]."' class='btn btn-danger'>Delete</a></td></tr>";
     }
     echo "</table>";
   } else {
     echo "0 results";
   }
}
if(isset($_POST['save']))
{
    $first=$_POST['first'];
    $middle=$_POST['middle'];
    $last=$_POST['last'];
    $mysqli->query("INSERT INTO contact(Fname,Mname,Lname) values('$first','$middle','$last')") or die($mysqli->error);
    $sql = "SELECT contact_id FROM contact where Fname='$first' and Mname='$middle'";
    $result = $mysqli->query($sql);
    $type=$_POST['ptype'];
    $num=$_POST['pnumber'];
    $code=$_POST['code'];
    $address=$_POST['address'];
    $adtype=$_POST['addresstype'];
    $city=$_POST['city'];
     $state=$_POST['state'];
     $zip=$_POST['zip']; 
     $dtype=$_POST['dtype'];
     $date=$_POST['date'];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<br> id: ". $row["contact_id"];
      $result1=$row["contact_id"];
      $mysqli->query("INSERT INTO phone(contact_id,phone_type,Area_code,Phone_Number) values('$result1','$type','$code','$num')") or die($mysqli->error);
      $mysqli->query("INSERT INTO address(contact_id,address_type,address,city,state,zip) values('$result1','$adtype','$address','$city','$state','$zip')") or die($mysqli->error);
      $mysqli->query("INSERT INTO dates(contact_id,date_type,date_value) values('$result1','$dtype','$date')") or die($mysqli->error);
    }
}

}
?>
</body>
</html>

