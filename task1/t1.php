<!DOCTYPE html>
<html>
<?php
    if (isset($_POST["submit_btn"])) {
        $a = $_POST["first_name"];
        $b = $_POST["sir_name"];
        $full= $a . ' ' . $b ;
    }
    ?>
<body>
    <form action="" method="POST">
        <label for="first_name">enter your first name</label><br>
        <input type="text" name="first_name" class="first_name" required pattern="[a-zA-Z]*"><br><br>
        <label for="sir_name">enter your last name</label><br>
        <input type="text" name="sir_name" class="last_name" required pattern="[a-zA-Z]*"><br><br>
        <label for="full_name">enter your full name</label><br>
        <input type="text" name="full_name" class="full_name" readonly value="<?php if(isset($full)){
            echo $full;
        } ?>"><br><br>
        <input type="submit" name="submit_btn">
    </form>
   

</body>

</html>