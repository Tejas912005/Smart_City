<?php
echo "<h1>PHP Works!</h1>";

$DB_HOST = 'sql206.infinityfree.com';
$DB_USER = 'if0_40609259';
$DB_PASS = '0AW8o2spN05T71C';
$DB_NAME = 'if0_40609259_smart_city';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    echo "<p style='color:red'>DB Error: " . $conn->connect_error . "</p>";
} else {
    echo "<p style='color:green'>Database Connected!</p>";
}
?>