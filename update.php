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
    session_start();
    $mysqli = new mysqli('localhost','root','','dbdesign') or die();
    echo ("working");
    $fname="";
    $lname="";
    $mname="";
    $ptype="";
    $code="";
    $number="";
    $address="";
    $adtype="";
    $city="";
    $state="";
    $zip="";
    $dtype="";
    $date="";
    if(isset($_GET['edit']))
    {
        $_SESSION['cid']=$_GET['edit'];
        $id=$_GET['edit'];
        $result=$mysqli->query("SELECT * FROM contact where Contact_id='$id'")or die($mysqli->error);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $fname=$row['Fname'];
            $mname=$row['Mname'];
            $lname=$row['Lname'];
          }
        }
        $result=$mysqli->query("SELECT * FROM phone where Contact_id='$id'")or die($mysqli->error);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $ptype=$row['Phone_type'];
            $code=$row['Area_code'];
            $number=$row['Phone_Number'];
          }

        }
        $result=$mysqli->query("SELECT * FROM address where Contact_id='$id'")or die($mysqli->error);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $address=$row['Address'];
            $adtype=$row['Address_type'];
            $city=$row['City'];
            $state=$row['State'];
            $zip=$row["Zip"];
          }

        }
        $result=$mysqli->query("SELECT * FROM dates where Contact_id='$id'")or die($mysqli->error);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $dtype=$row['Date_type'];
            $date=$row['Date_value'];
          }

        }
    }
    if(isset($_POST['change']))
    {
      echo("fhg");
      $first=$_POST['first'];
    $middle=$_POST['middle'];
    $last=$_POST['last'];
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
     $id=$_SESSION['cid'];
     echo $id;
     $mysqli->query("UPDATE contact SET Fname='$first', Mname='$middle', Lname='$last' WHERE Contact_id=$id")or die($mysqli->error);
     $mysqli->query("UPDATE phone SET Phone_type='$type', Phone_Number='$number', Area_code='$code' WHERE Contact_id=$id")or die($mysqli->error);
     $mysqli->query("UPDATE address SET Address='$address', Address_type='$adtype', City='$city',State='$state',Zip='$zip' WHERE Contact_id=$id")or die($mysqli->error);
     $mysqli->query("UPDATE dates SET Date_type='$dtype', Date_value='$date' WHERE Contact_id=$id")or die($mysqli->error);
    }
   
  ?>    
<div>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6"> <h1>Update Contact</h1>
  
  <?php
  ?>
  <form id="myForm" method="POST" action="update.php">
  <div class="form-group">
  <label for="firstname">First Name:</label>
  <input type="text" class="form-control" placeholder="First Name" id="fname" name="first" value="<?php echo $fname; ?>">
  </div>
  <div class="form-group">
    <label for="middlename">Middle Name:</label>
    <input type="text" class="form-control" placeholder="Middle Name" id="mname" name="middle" value="<?php echo $mname; ?>">
    </div>
  <div class="form-group">
    <label for="lastname">Last Name:</label>
    <input type="text" class="form-control" placeholder="Last Name" id="lname" name="last" value="<?php echo $lname; ?>">
    </div>
    <div class="form-group">
        <label for="phonetype">Phone Type:</label>
        <input type="text" class="form-control" placeholder="Phone Type" name="ptype"value="<?php echo $ptype; ?>">
    </div>
    <div class="form-group">
      <label for="phonenumber">Area Code:</label>
      <input type="text" class="form-control"  name="code"value="<?php echo $code; ?>">
  </div>
    <div class="form-group">
        <label for="phonenumber">Phone Number:</label>
        <input type="text" class="form-control" placeholder="Phone Number" name="pnumber" value="<?php echo $number; ?>">
    </div>
  <div class="form-group">
  <label for="Address">Address:</label>
  <input type="text" class="form-control" placeholder="Address" name="address" value="<?php echo $address; ?>">
  </div>
  <div class="form-group">
    <label for="AddressType">Address Type:</label>
    <input type="text" class="form-control" placeholder="Address Type" name="addresstype" value="<?php echo $adtype; ?>">
  </div>
  <div class="form-group">
    <label for="City">City:</label>
    <input type="text" class="form-control"  name="city" value="<?php echo $city; ?>">
    </div>
    <div class="form-group">
        <label for="State">State:</label>
        <input type="text" class="form-control"  name="state" value="<?php echo $state; ?>">
    </div>
    <div class="form-group">
        <label for="Zip">Zip:</label>
        <input type="text" class="form-control"  name="zip" value="<?php echo $zip; ?>">
        </div>
        <div class="form-group">
            <label for="DateType">Date Type:</label>
            <input type="text" class="form-control"  name="dtype"value="<?php echo $dtype; ?>">
            </div>
        <div class="form-group">
            <label for="Date">Date:</label>
            <input type="date" class="form-control"  name="date" value="<?php echo $date; ?>">
       </div>
  
  
  <button type="submit" class="btn btn-warning" value="Submit" id="validateBtn" name="change">UPDATE </button>
  </form>
  
</div>
<div class="col-md-3"></div>
</div>
</div>
</body>
</html>