<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id = -1;
$name = "";
$location = "";
$update = false;
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];

    $sql = "INSERT into data(name, location) VALUES('$name', '$location')";

    $mysqli->query($sql) or die($mysqli->error());

    $_SESSION['message'] = "Record has been saved...!!";
    $_SESSION['msg_type'] = "success";
    header("location: index.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $sql = "DELETE FROM data WHERE id = $id";
    $mysqli->query($sql) or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted...!!";
    $_SESSION['msg_type'] = "danger";
    header("location: index.php");

}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $sql = "SELECT * FROM data WHERE id = $id";
    $result = $mysqli->query($sql) or die($mysqli->error());
    
    if($result->num_rows==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];

    }

}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $sql = "UPDATE data SET name='$name', location='$location' WHERE id='$id'";
    $mysqli->query($sql) or die($mysqli->error());

    $_SESSION['message'] = "Record has been updated...!!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}
?>