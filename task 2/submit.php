<?php
if (isset($_POST["submit_btn"])) {
    $a = $_POST["first_name"];
    $b = $_POST["sir_name"];
    //$image_name = $_FILES['image']['name'];
    $type = $_FILES["image"]["type"];
     $type = substr($type, strpos($type, "/") + 1);
     $image_name = $a.$b.".".$type;
    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = "images/" . $image_name;
    move_uploaded_file($tmp_name, $folder);
    echo "welcome " . $a . ' ' . $b ."<br><br>";
    echo "<img src=$folder width=400px,height=auto>";
}
?>