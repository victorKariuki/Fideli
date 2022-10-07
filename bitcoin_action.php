<?php
// Get POST data
$first = (!empty($_POST['FName']) ? $_POST['FName'] : '');
$last = (!empty($_POST['LName']) ? $_POST['LName'] : '');
$myage = (!empty($_POST['Age']) ? $_POST['Age'] : '');
$gen = (!empty($_POST['Gender']) ? $_POST['Gender'] : 0);

try {
    // Connect to db
    $db = new db('mysql:dbname=pdodb;host=localhost', 'candlest_cd', 'candlest_cd');
    // $sql=mysqli_connect('localhost','candlest_cd','candlest_cd','candlest_cd');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set SQL
    $sql = 'INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:first, :last, :myage, :gen)';
    // Prepare query
    $query = $db->prepare($sql);
    // Execute query
    $query->execute(array(':first' => $first, ':last' => $last, ':myage' => $myage, ':gen' => $gen));
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}