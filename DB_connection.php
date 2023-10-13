<?php  

$sName = "localhost";
$uName = "yash";
$pass  = "yash123"; 
$db_name = "yashchadb";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {  // Use $e, not $Exeption
    echo "Connection failed: " . $e->getMessage();
    exit;
}
