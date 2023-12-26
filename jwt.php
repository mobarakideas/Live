<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');
require("phpjwt/src/BeforeValidException.php");
require("phpjwt/src/ExpiredException.php");
require("phpjwt/src/JWT.php");
require("phpjwt/src/SignatureInvalidException.php");

use Firebase\JWT\JWT;

$con = mysqli_connect('localhost', 'root', '', 'student') or die('mysql not connected');

$sql = "SELECT * FROM vcstudent";
$exc = mysqli_query($con, $sql);
$count = mysqli_num_rows($exc);

if ($count > 0) {
    $data = [];

    while ($row = mysqli_fetch_assoc($exc)) {
        $key = "test123";
        $payload = array(
            "NAME" => $row['NAME'],
            "ID" => $row['ID'],
            "EMAIL" => $row['EMAIL'],
            "SEMESTER" => $row['SEMESTER'],
            "COURCE" => $row['COURCE'],
            "PAPER" => $row['PAPER'],
            "SESSION" => $row['SESSION'],
            "UNIT" => $row['UNIT'],
            "PPT" => $row['PPT'],
            "FILE" => $row['FILE'],
            "TOPIC" => $row['TOPIC'],
            "SECTION" => $row['SECTION'],
            "QUESTION" => $row['QUESTION'],
            "TITLE" => $row['TITLE'],
            "LINK" => $row['LINK'],
            "DEPARTMENT" => $row['DEPARTMENT'],
            "DATE" => $row['DATE'],
        );
        $jwt = JWT::encode($payload, $key);

        $myarr = [
            'NAME' => $row['NAME'],
            'ID' => $row['ID'],
            'EMAIL' => $row['EMAIL'],
            'SEMESTER' => $row['SEMESTER'],
            'COURCE' => $row['COURCE'],
            'PAPER' => $row['PAPER'],
            'SESSION' => $row['SESSION'],
            'UNIT' => $row['UNIT'],
            'PPT' => $row['PPT'],
            'FILE' => $row['FILE'],
            'TOPIC' => $row['TOPIC'],
            'SECTION' => $row['SECTION'],
            'QUESTION' => $row['QUESTION'],
            'TITLE' => $row['TITLE'],
            'LINK' => $row['LINK'],
            'DEPARTMENT' => $row['DEPARTMENT'],
            'DATE' => $row['DATE'],
            'jwt' => $jwt,
        ];

        $data[] = $myarr;
    }

    $response = ['msg' => 'data given', 'status' => 101, 'Data' => $data];
    echo json_encode($response);
} else {
    $response = ['msg' => 'No data found', 'status' => 404, 'Data' => null];
    echo json_encode($response);
}

mysqli_close($con);
?>
