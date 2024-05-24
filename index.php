<?php
ini_set('error_reporting',1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

//Turn on PDO error reporting
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


function addStudent($dbh,$sid,$last,$first,$birthdate,$gpa,$advisor)
{
    $sql = 'INSERT INTO student(sid, last, first, birthdate, gpa, advisor) 
    VALUES(:sid, :last, :first, :birthdate, :gpa, :advisor)';

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':sid',$sid,PDO::PARAM_STR);
    $statement->bindParam(':last',$last,PDO::PARAM_STR);
    $statement->bindParam(':first',$first,PDO::PARAM_STR);
    $statement->bindParam(':birthdate',$birthdate,PDO::PARAM_STR);
    $statement->bindParam(':gpa',$gpa,PDO::PARAM_STR);
    $statement->bindParam(':advisor',$advisor,PDO::PARAM_STR);

    $statement->execute();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sid = $_POST['sid'];
    $last = $_POST['last'];
    $first = $_POST['first'];
    $birthdate = $_POST['birthdate'];
    $gpa = $_POST['gpa'];
    $advisor = $_POST['advisor'];
    addStudent($dbh,$sid,$last,$first,$birthdate,$gpa,$advisor);
    echo '<p>Student successfully added</p>';
}