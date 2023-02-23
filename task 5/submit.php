<?php
    require('phone/vendor/autoload.php');
    if (isset($_POST["submit_btn"])) {
    $phoneUtil = libphonenumber\PhoneNumberUtil::getInstance();
    $arrRegions = $phoneUtil->getSupportedRegions();
    $number = $_POST['phone_number'];
    $region = $_POST['country_code'];
    $requiredRegion = strtok($region, ' ');
    $parseNumber = $phoneUtil->parse($number, $requiredRegion);
    if ($phoneUtil->isValidNumber($parseNumber)) {
        echo "Number Is Valid : ";
    }
    else {
        header("Location: task_4.php");
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
    echo "<b><i> WELCOME </i></b>" ."<b>$a</b>" . ' ' . "<b>$b</b>". "<br><br>";
    $email = $_POST['email'];
    $curl = curl_init();

    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => "https://api.apilayer.com/email_verification/{$email}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: ztj9jQp829v8dUyv2WwdZAKTa6qkr6mk"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        )
    );

    $response = curl_exec($curl);

    curl_close($curl);
    $obj = json_decode($response);
    // print_r($obj);
    if (isset($obj->can_connect_smtp)) {
        if ($obj->can_connect_smtp) {
            echo "The Email You Entered ".$email ." Is A Real Email<br><br>";
        } else {
            echo $email." Is Not A Real Email<br><br>";
        }
    } else {
        echo $email ."Is Invalid Email<br><br>";
    }
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