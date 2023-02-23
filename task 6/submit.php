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
    } else {
        header("Location: task_4.php");
    }

    $a = $_POST["first_name"];
    $b = $_POST["sir_name"];
    $fullName = $a ." ". $b;
    $type = $_FILES["image"]["type"];
    $type = substr($type, strpos($type, "/") + 1);
    $image_name = $a . $b . "." . $type;
    $unextracted_marks = explode("\n", $_POST['marks']);
    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = "images/" . $image_name;
    move_uploaded_file($tmp_name, $folder);
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
    if (isset($obj->can_connect_smtp)) {
        if ($obj->can_connect_smtp) {
        } else {
        header("Location: task_4.php");
        // echo $email . " Is Not A Real Email<br><br>";
        }
    } else {
        header("Location: task_4.php");
        // echo $email . "Is Invalid Email<br><br>";
    }

    foreach ($unextracted_marks as $mark) {
        $pos = strpos($mark, "|");
        $marks[substr($mark, 0, $pos)] = substr($mark, $pos + 1);
    }

    $server_file = "./docs/$fullName.doc";
    $server_content = "Form Data\n";
    $server_content .= "Name : " . $fullName . "\n";
    $server_content .= "Email : " . $email . "\n";
    $server_content .= "Phone : " . $parseNumber . "\n";
    $server_content .= "Subject  Marks" . "\n";
    foreach ($marks as $key => $value) {
        // outputs table row as subject => marks
        $server_content .= "$key  $value" . "\n";
    }
    file_put_contents($server_file, $server_content);
    if (file_exists($server_file)) {
        // Set the headers to trigger a download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($server_file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($server_file));

        // Output the file content
        readfile($server_file);
        exit;
    } else {
        // Handle the error
        echo "The file does not exist.";
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