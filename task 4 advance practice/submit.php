<?php
    require('phone/vendor/autoload.php');
    if (isset($_POST["submit_btn"])) {
    $phoneUtil = libphonenumber\PhoneNumberUtil::getInstance();
    $arrRegions = $phoneUtil->getSupportedRegions();
    $number = $_POST['phone_number'];
    $region = $_POST['country_code'];
    $parseNumber = $phoneUtil->parse($number, $region);
    if ($phoneUtil->isValidNumber($parseNumber)) {
        echo "number is valid: ";
    }
    else {
        echo "number is not valid";
    }
    $a = $_POST["first_name"];
    $b = $_POST["sir_name"];
    $type = $_FILES["image"]["type"];
    $type = substr($type, strpos($type, "/") + 1);
    $image_name = $a . $b . "." . $type;
    $unextracted_marks = explode("\n", $_POST['marks']);
    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = "images/" . $image_name;
    move_uploaded_file($tmp_name, $folder);
    echo "<b> welcome </b>" . $a . ' ' . $b . "<br><br>";
    echo "<img src=$folder width=400px,height=auto>";

    foreach ($unextracted_marks as $mark) {
        $pos = strpos($mark, "|");
        $marks[substr($mark, 0, $pos)] = substr($mark, $pos + 1);
    }
}
?>
<br><br>
<table>
    <tr>
        <td>Subject &nbsp;</td>
        <td>Marks</td>
    </tr>
    <?php
    foreach ($marks as $key => $value) {
        echo "<tr><td>$key</td><td>$value</td></tr>";
    }
    ?>
</table>