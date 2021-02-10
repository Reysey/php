<?php
//GET FIRST NAME
    $fName = $_POST['ins_first_name'];
//GET LAST NAME
    $lName = $_POST['ins_last_name'];
//Get GSM
    $gsm = $_POST['ins_gsm'];
//GET Natinal Identification
    $nid = $_POST['ins_nid'];
//GET E-MAIL
    $email = $_POST['ins_email'];
//GET PASSWORD
    $pw    = $_POST['ins_pw'];

//ESTABLISH CONNEXION WITH THE DATABASE
//INCLUDE CONNEXION
    include 'eu_db_connexion.php';

//SET SQL QUERY
        $sql = "INSERT INTO eu_guest (`GUEST_ID`, `GUEST_EMAIL`, `GUEST_NAME`, `GUEST_PASSWORD`, `GUEST_GSM`, `GUEST_NID`) 
                VALUES( NULL,'".$email."','".$fName." ".$lName."' ,'".$pw."','".$gsm."','".$nid."')";
    echo "<hr>";
    echo $sql;
//EXECUTE THE QUERY
        try{
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();
            $dbh->exec($sql);
            $dbh->commit();
        }catch(Exception $ex){
            $dbh->rollBack();
            echo "Failed: ".$ex->getMessage();
        }

    echo "<hr>";
    echo "<a href=\"https://www.euniversity.xyz\" class=\"\">Return To Home</a>";
?>