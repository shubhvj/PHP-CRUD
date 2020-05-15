<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>PHP-CRUD</title>
</head>

<body>
    <div class="container">
    <?php require_once 'process.php'; ?>

    <?php
        if(isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>    
    
        <?php endif;?>
    <?php

        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $sql = "SELECT * from data ORDER BY name";
        $result = $mysqli->query($sql) or die(mysqli_error($mysqli));            
    ?>

            <div class="d-flex justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                        <?php 
                            while($row = $result->fetch_assoc()):?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                                <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                </table>
            </div>
    
    <div class="d-flex justify-content-center">
                <form action="process.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">   
                        <label>Name:</label>
                        <input class="form-control" type="text" name="name" 
                            value="<?php echo $name; ?>" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input class="form-control" type="text" name="location"
                        value="<?php echo $location; ?>" placeholder="Enter your location">
                    </div>
                    <div class="form-group">
                        <?php
                            if($update == true):
                        ?>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-primary" name="save">Save</button>
                        <?php endif ?>    
                    </div>
                </form>      
    </div>
    </div>
</body>

</html>