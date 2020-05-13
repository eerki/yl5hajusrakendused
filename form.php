<?php
require_once("connect.php");
if(isset($_POST['submit'])){
    
    if(empty($_POST["title"])) {
        echo "fill out title";
    }  elseif (empty($_POST["description"])) {
        echo "give me desc";
    } elseif (empty($_POST["episodes"])) {
        echo "give me a topic";
    } elseif (empty($_POST["air"])) {
        echo "give me topic2";
    } else {
    
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";;
        } else {
        echo "File is not an image.";
        }

        $target = "http://yl5hajusrakendused.tak17pold.itmajakas.ee/upload/";
        $sql = "INSERT INTO my_favorite_subject (title, image, description, episodes, air)
        VALUES ('".$_POST["title"]."','". $target.$_FILES["image"]["name"]."','".$_POST["description"]."','".$_POST["episodes"]."', '".$_POST["air"]."')";

        if ($mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
    <div class="container">
        <h2>Form</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group" enctype="multipart/form-data">
                <label for="exampleInputPassword1">Title</label>
                <input type="text"  name="title" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Image</label>
                <input name="image" type="file">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Topic1</label>
                <input type="text" name="episodes" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Topic2</label>
                <input type="text" name="air" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>